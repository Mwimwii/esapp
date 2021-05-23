<?php

use yii\db\Migration;

class m210522_234152_008_create_table_awpb_unit_of_measure extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%awpb_unit_of_measure}}',
            [
                'id' => $this->primaryKey(),
                'name' => $this->string(40)->notNull(),
                'status' => $this->integer()->notNull(),
                'created_by' => $this->integer()->notNull(),
                'created_at' => $this->integer()->notNull(),
                'updated_by' => $this->integer()->notNull(),
                'updated_at' => $this->integer()->notNull(),
            ],
            $tableOptions
        );
    }

    public function down()
    {
        $this->dropTable('{{%awpb_unit_of_measure}}');
    }
}
