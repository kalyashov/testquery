<?php

use yii\db\Schema;
use yii\db\Migration;

class m160218_175237_drop_user_table extends Migration
{
    public function up()
    {
        $this->dropTable('user');
    }

    public function down()
    {
        echo "m160218_175237_drop_user_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
