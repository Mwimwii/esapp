<?php

use yii\db\Migration;

class m210522_234152_005_create_table_awpb_funder extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%awpb_funder}}',
            [
                'id' => $this->primaryKey(),
                'code' => $this->string(6)->notNull(),
                'name' => $this->string(40)->notNull(),
                'description' => $this->string()->notNull(),
                'status' => $this->integer()->notNull(),
                'created_at' => $this->integer()->unsigned()->notNull(),
                'updated_at' => $this->integer()->unsigned()->notNull(),
                'created_by' => $this->integer(),
                'updated_by' => $this->integer(),
            ],
            $tableOptions
        );
    }

    public function down()
    {
        $this->dropTable('{{%awpb_funder}}');
    }
}
