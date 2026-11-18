<?php

declare(strict_types=1);

namespace frontend\models;

use common\models\PerfilUtilizador;
use common\models\User;
use Yii;
use yii\base\Model;

/**
 * Pre-inscricao (cliente) e candidatura (funcionario).
 * Cria user (estado Pending) + perfil + role RBAC. O admin aprova no back-office.
 */
class RegistrationForm extends Model
{
    public $nome;
    public $username;
    public $email;
    public $telefone;
    public $password;

    /**
     * Role a atribuir. Definido pelo controller; nao esta nas rules,
     * por isso nunca pode vir do formulario (POST).
     */
    public string $role = 'cliente';

    public function rules(): array
    {
        return [
            [['nome', 'username', 'email', 'password'], 'required'],
            [['nome'], 'string', 'max' => 100],
            [['username', 'email'], 'string', 'max' => 255],
            ['username', 'string', 'min' => 2],
            ['email', 'email'],
            [['telefone'], 'string', 'max' => 20],
            ['password', 'string', 'min' => 8],
            ['username', 'unique', 'targetClass' => User::class, 'message' => 'This username is already taken.'],
            ['email', 'unique', 'targetClass' => User::class, 'message' => 'This email is already registered.'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'nome' => 'Full name',
            'username' => 'Username',
            'email' => 'Email',
            'telefone' => 'Phone',
            'password' => 'Password',
        ];
    }

    public function register(): bool
    {
        if (!$this->validate()) {
            return false;
        }

        $auth = Yii::$app->authManager;
        $role = $auth->getRole($this->role);
        if ($role === null) {
            throw new \RuntimeException('RBAC role "' . $this->role . '" does not exist. Run: php yii rbac/init');
        }

        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->status = User::STATUS_PENDING;
        $user->setPassword($this->password);
        $user->generateAuthKey();

        $perfil = new PerfilUtilizador();
        $perfil->nome = $this->nome;
        $perfil->telefone = $this->telefone ?: null;

        if (!$perfil->validate(['nome', 'telefone'])) {
            return false;
        }

        if (!$user->save(false)) {
            return false;
        }

        $perfil->user_id = $user->id;
        if (!$perfil->save()) {
            $user->delete();
            return false;
        }

        $auth->assign($role, $user->id);

        return true;
    }
}
