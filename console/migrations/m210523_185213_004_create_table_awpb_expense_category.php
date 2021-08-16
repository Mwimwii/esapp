<?php

use yii\db\Migration;

class m210523_185213_004_create_table_awpb_expense_category extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%awpb_expense_category}}',
            [
                'id' => $this->primaryKey(),
                'code' => $this->string(6)->notNull(),
                'status' => $this->integer()->notNull(),
                'name' => $this->string()->notNull(),
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
        $this->dropTable('{{%awpb_expense_category}}');
    }
}
