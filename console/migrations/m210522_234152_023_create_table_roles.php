<?php

use yii\db\Migration;

class m210522_234152_023_create_table_roles extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%roles}}',
            [
                'id' => $this->primaryKey(),
                'role' => $this->text()->notNull(),
                'active' => $this->integer()->defaultValue('1'),
                'created_at' => $this->integer()->unsigned(),
                'updated_at' => $this->integer()->unsigned(),
                'updated_by' => $this->integer(),
                'created_by' => $this->integer(),
            ],
            $tableOptions
        );
    }

    public function down()
    {
        $this->dropTable('{{%roles}}');
    }
}
