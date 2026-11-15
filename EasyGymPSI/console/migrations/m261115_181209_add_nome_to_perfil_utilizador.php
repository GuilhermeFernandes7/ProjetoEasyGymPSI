<?php

use yii\db\Migration;

class m261115_181209_add_nome_to_perfil_utilizador extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('perfil_utilizador', 'nome', $this->string(100)->null()->after('user_id'));

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('perfil_utilizador', 'nome');

        echo "m261115_181209_add_nome_to_perfil_utilizador cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m261115_181209_add_nome_to_perfil_utilizador cannot be reverted.\n";

        return false;
    }
    */
}
