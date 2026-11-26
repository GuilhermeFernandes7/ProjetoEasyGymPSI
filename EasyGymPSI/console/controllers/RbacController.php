<?php

declare(strict_types=1);

namespace console\controllers;

use common\models\User;
use Yii;
use yii\console\Controller;
use yii\console\ExitCode;

class RbacController extends Controller
{
    public function actionInit(): int
    {
        $auth = Yii::$app->authManager;

        // guarda quem tem cada role, pela API, para repor no fim
        $assignments = [];
        foreach ($auth->getRoles() as $role) {
            $assignments[$role->name] = $auth->getUserIdsByRole($role->name);
        }

        $auth->removeAll();

        $descriptions = [
            'loginBackend' => 'Entrar no back-office',
            'verAreaCliente' => 'Ver a area do cliente (front-office)',
            'verSocio' => 'Ver socios',
            'criarSocio' => 'Criar socios',
            'editarSocio' => 'Editar socios',
            'apagarSocio' => 'Apagar socios',
            'verTreino' => 'Ver treinos',
            'criarTreino' => 'Criar treinos',
            'editarTreino' => 'Editar treinos',
            'apagarTreino' => 'Apagar treinos',
            'verUtilizador' => 'Ver utilizadores',
            'criarUtilizador' => 'Criar utilizadores',
            'editarUtilizador' => 'Editar utilizadores',
            'apagarUtilizador' => 'Apagar utilizadores',
        ];

        $permissions = [];
        foreach ($descriptions as $name => $description) {
            $permission = $auth->createPermission($name);
            $permission->description = $description;
            $auth->add($permission);
            $permissions[$name] = $permission;
        }

        $cliente = $auth->createRole('cliente');
        $cliente->description = 'Acesso apenas ao front-office (area cliente)';
        $auth->add($cliente);
        $auth->addChild($cliente, $permissions['verAreaCliente']);

        $funcionario = $auth->createRole('funcionario');
        $funcionario->description = 'Funcionario / PT: acesso ao back-office';
        $auth->add($funcionario);
        foreach ([
                     'loginBackend',
                     'verSocio', 'criarSocio', 'editarSocio', 'apagarSocio',
                     'verTreino', 'criarTreino', 'editarTreino', 'apagarTreino',
                 ] as $name) {
            $auth->addChild($funcionario, $permissions[$name]);
        }

        $admin = $auth->createRole('admin');
        $admin->description = 'Administrador do sistema';
        $auth->add($admin);
        $auth->addChild($admin, $funcionario);
        foreach (['verUtilizador', 'criarUtilizador', 'editarUtilizador', 'apagarUtilizador'] as $name) {
            $auth->addChild($admin, $permissions[$name]);
        }

        foreach ($assignments as $roleName => $userIds) {
            $role = $auth->getRole($roleName);
            if ($role === null) {
                continue;
            }
            foreach ($userIds as $userId) {
                $auth->assign($role, $userId);
            }
        }

        $this->stdout("RBAC inicializado.\n");

        return ExitCode::OK;
    }

    /**
     * Atribuicao dinamica de um role: php yii rbac/assign <username> <role>
     */
    public function actionAssign(string $username, string $roleName): int
    {
        $auth = Yii::$app->authManager;
        $role = $auth->getRole($roleName);
        $user = User::findOne(['username' => $username]);

        if ($role === null || $user === null) {
            $this->stderr("Utilizador ou role nao encontrado.\n");

            return ExitCode::DATAERR;
        }

        if ($auth->getAssignment($roleName, $user->id) === null) {
            $auth->assign($role, $user->id);
        }

        $this->stdout("Role {$roleName} atribuido a {$username}.\n");

        return ExitCode::OK;
    }
}