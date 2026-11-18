<?php

declare(strict_types=1);

namespace console\controllers;

use Yii;
use yii\console\Controller;
use yii\console\ExitCode;
use yii\db\Query;

class RbacController extends Controller
{
    public function actionInit(): int
    {
        $auth = Yii::$app->authManager;

        // guarda os roles ja atribuidos, para os repor no fim
        $assignments = (new Query())
            ->select(['item_name', 'user_id'])
            ->from('auth_assignment')
            ->all();

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

        foreach ($assignments as $row) {
            $role = $auth->getRole($row['item_name']);
            if ($role !== null) {
                $auth->assign($role, $row['user_id']);
            }
        }

        $adminId = (new Query())->select('id')->from('{{%user}}')->where(['username' => 'admin'])->scalar();
        if ($adminId && $auth->getAssignment('admin', $adminId) === null) {
            $auth->assign($admin, $adminId);
        }

        $this->stdout("RBAC inicializado.\n");

        return ExitCode::OK;
    }
}