<?php

use yii\db\Migration;

class m261111_155018_init_rbac extends Migration
{
    public function safeUp()
    {
        $auth = Yii::$app->authManager;


        // --- 1. PERMISSÕES ---
        $loginBackend = $auth->createPermission('loginBackend');
        $loginBackend->description = 'Aceder ao Back-office';
        $auth->add($loginBackend);

        $gerirSocios = $auth->createPermission('gerirSocios');
        $gerirSocios->description = 'Gerir inscrições, sócios e pagamentos';
        $auth->add($gerirSocios);

        $gerirTreinos = $auth->createPermission('gerirTreinos');
        $gerirTreinos->description = 'Criar e editar planos de treino e aulas';
        $auth->add($gerirTreinos);

        $gerirSistema = $auth->createPermission('gerirSistema');
        $gerirSistema->description = 'Gestão global (utilizadores, ginásios)';
        $auth->add($gerirSistema);


        // --- 2. ROLES (PAPÉIS) E HIERARQUIA ---

        // Cliente (Acede ao Back-office para ver faturas/planos)
        $cliente = $auth->createRole('cliente');
        $auth->add($cliente);
        $auth->addChild($cliente, $loginBackend);

        // Funcionário / Personal Trainer (Gere sócios e treinos)
        $funcionario = $auth->createRole('funcionario');
        $auth->add($funcionario);
        $auth->addChild($funcionario, $loginBackend);
        $auth->addChild($funcionario, $gerirSocios);
        $auth->addChild($funcionario, $gerirTreinos);

        // Admin (Herda tudo do funcionário + Gere o sistema)
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $funcionario);
        $auth->addChild($admin, $gerirSistema);

        // Atribui o role admin ao utilizador "admin" (se existir)
        $adminId = (new \yii\db\Query())
            ->select('id')
            ->from('{{%user}}')
            ->where(['username' => 'admin'])
            ->scalar();

        if ($adminId) {
            $auth->assign($admin, $adminId);
        }
    }

    public function safeDown()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();
    }
}