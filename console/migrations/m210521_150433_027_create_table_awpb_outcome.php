<?php

use yii\db\Migration;

class m210521_150433_027_create_table_awpb_outcome extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%awpb_outcome}}',
            [
                'id' => $this->primaryKey(),
                'outcome_code' => $this->string(10)->notNull(),
                'component_id' => $this->integer(),
                'name' => $this->string(40)->notNull(),
                'outcome_description' => $this->string()->notNull(),
                'created_at' => $this->integer()->unsigned()->notNull(),
                'updated_at' => $this->integer()->unsigned()->notNull(),
                'created_by' => $this->integer(),
                'updated_by' => $this->integer(),
            ],
            $tableOptions
        );

        $this->createIndex('component_id', '{{%awpb_outcome}}', ['component_id']);
        $this->createIndex('outcome_code', '{{%awpb_outcome}}', ['outcome_code'], true);

        $this->addForeignKey(
            'awpb_outcome_ibfk_1',
            '{{%awpb_outcome}}',
            ['component_id'],
            '{{%awpb_component}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
    }

    public function down()
    {
        $this->dropTable('{{%awpb_outcome}}');
    }
}
