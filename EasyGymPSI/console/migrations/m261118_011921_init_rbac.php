<?php

use yii\db\Migration;

class m261118_011921_init_rbac extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        Yii::$app->runAction('rbac/init');
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        Yii::$app->authManager->removeAll();
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m261118_011921_init_rbac cannot be reverted.\n";

        return false;
    }
    */
}
