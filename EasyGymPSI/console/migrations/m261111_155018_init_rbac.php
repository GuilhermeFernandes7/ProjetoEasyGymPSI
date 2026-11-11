<?php

use yii\db\Migration;

class m261111_155018_init_rbac extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        // --- 1. PERMISSÕES ---
        $loginBackend = $auth->createPermission('loginBackend');
        $loginBackend->description = 'Aceder ao Back-office (AdminLTE)';
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
        // Cliente (Apenas Frontend)
        $cliente = $auth->createRole('cliente');
        $auth->add($cliente);

        // Rececionista
        $rececionista = $auth->createRole('rececionista');
        $auth->add($rececionista);
        $auth->addChild($rececionista, $loginBackend);
        $auth->addChild($rececionista, $gerirSocios);

        // Personal Trainer
        $pt = $auth->createRole('personalTrainer');
        $auth->add($pt);
        $auth->addChild($pt, $loginBackend);
        $auth->addChild($pt, $gerirTreinos);

        // Admin (Herda permissões do PT e Rececionista + Gere Sistema)
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $pt);
        $auth->addChild($admin, $rececionista);
        $auth->addChild($admin, $gerirSistema);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();
    }
}