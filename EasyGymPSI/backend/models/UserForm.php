<?php

declare(strict_types=1);

namespace backend\models;

use common\models\PerfilUtilizador;
use common\models\User;
use Yii;
use yii\base\Model;

/**
 * Formulario de criar/editar utilizador (user + perfil_utilizador + role RBAC).
 */
class UserForm extends Model
{
    public $id;
    public $nome;
    public $username;
    public $email;
    public $password;
    public $role;
    public $status;

    public static function roleLabels(): array
    {
        return [
            'admin' => 'Admin',
            'funcionario' => 'Staff / PT',
            'cliente' => 'Client',
        ];
    }

    public function rules(): array
    {
        $ignoreSelf = function ($query) {
            if ($this->id) {
                $query->andWhere(['<>', 'id', $this->id]);
            }
        };


        $rules = [
            [['nome', 'username', 'email', 'role', 'status'], 'required'],
            ['nome', 'string', 'max' => 100],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['username', 'unique', 'targetClass' => User::class, 'filter' => $ignoreSelf],
            ['email', 'unique', 'targetClass' => User::class, 'filter' => $ignoreSelf],
            ['password', 'string', 'min' => 8],
            ['role', 'in', 'range' => array_keys(self::roleLabels())],
            ['status', 'in', 'range' => array_keys(User::statusLabels())],
            ['role', 'validateSelf'],
        ];

        if (empty($this->id)) {
            $rules[] = ['password', 'required'];
        }

        return $rules;
    }

    public function attributeLabels(): array
    {
        return [
            'nome' => 'Full name',
            'username' => 'Username',
            'email' => 'Email',
            'password' => 'Password',
            'role' => 'Role',
            'status' => 'Status',
        ];
    }

    /**
     * Impede o admin de se tirar a si proprio o acesso.
     */
    public function validateSelf(): void
    {
        if (!empty($this->id) && (int) $this->id === (int) Yii::$app->user->id) {
            if ($this->role !== 'admin' || (int) $this->status !== User::STATUS_ACTIVE) {
                $this->addError('role', 'You cannot remove your own admin access or deactivate yourself.');
            }
        }
    }

    public static function fromUser(User $user): self
    {
        $form = new self();
        $form->id = $user->id;
        $form->username = $user->username;
        $form->email = $user->email;
        $form->status = $user->status;
        $form->role = $user->getRoleName();
        $form->nome = $user->perfil?->nome;

        return $form;
    }

    /**
     * Grava user, perfil e role numa so transacao. Devolve o User ou null se invalido.
     */
    public function save(): ?User
    {
        if (!$this->validate()) {
            return null;
        }

        $auth = Yii::$app->authManager;
        $role = $auth->getRole($this->role);
        if ($role === null) {
            $this->addError('role', 'Role not found. Run: php yii rbac/init');
            return null;
        }

        $user = $this->id ? User::findOne($this->id) : new User();
        if ($user === null) {
            return null;
        }
        $isNew = $user->isNewRecord;

        $user->username = $this->username;
        $user->email = $this->email;
        $user->status = (int) $this->status;
        if ($isNew) {
            $user->generateAuthKey();
        }
        if ($this->password !== null && $this->password !== '') {
            $user->setPassword($this->password);
        }

        $perfil = $user->perfil ?? new PerfilUtilizador();
        $perfil->nome = $this->nome;
        if (!$perfil->validate(['nome'])) {
            $this->addError('nome', 'Invalid name.');
            return null;
        }

        if (!$user->save(false)) {
            $this->addError('username', 'Could not save the user.');
            return null;
        }

        $perfil->user_id = $user->id;
        if (!$perfil->save()) {
            if ($isNew) {
                $user->delete();
            }
            $this->addError('nome', 'Could not save the profile.');
            return null;
        }

        $auth->revokeAll($user->id);
        $auth->assign($role, $user->id);

        return $user;
    }
}