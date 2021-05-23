<?php

use yii\db\Migration;

class m210522_234152_002_create_table_awpb_commodity_type extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%awpb_commodity_type}}',
            [
                'id' => $this->primaryKey()->unsigned(),
                'category_id' => $this->integer()->unsigned(),
                'name' => $this->string()->notNull(),
                'created_at' => $this->integer()->unsigned()->notNull(),
                'updated_at' => $this->integer()->unsigned()->notNull(),
                'created_by' => $this->integer(),
                'updated_by' => $this->integer(),
            ],
            $tableOptions
        );

        $this->createIndex('fk_commodity_type_1_idx', '{{%awpb_commodity_type}}', ['category_id']);
    }

    public function down()
    {
        $this->dropTable('{{%awpb_commodity_type}}');
    }
}
