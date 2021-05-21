<?php

use yii\db\Migration;

class m210521_150433_028_create_table_awpb_output extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%awpb_output}}',
            [
                'id' => $this->primaryKey(),
                'component_id' => $this->integer()->notNull(),
                'outcome_id' => $this->integer()->notNull(),
                'name' => $this->string(40)->notNull(),
                'output_description' => $this->string()->notNull(),
                'created_at' => $this->integer()->unsigned()->notNull(),
                'updated_at' => $this->integer()->unsigned()->notNull(),
                'created_by' => $this->integer(),
                'updated_by' => $this->integer(),
            ],
            $tableOptions
        );

        $this->createIndex('component_id', '{{%awpb_output}}', ['component_id']);
        $this->createIndex('outcome_id', '{{%awpb_output}}', ['outcome_id']);

        $this->addForeignKey(
            'awpb_output_ibfk_1',
            '{{%awpb_output}}',
            ['outcome_id'],
            '{{%awpb_outcome}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'awpb_output_ibfk_2',
            '{{%awpb_output}}',
            ['component_id'],
            '{{%awpb_component}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
    }

    public function down()
    {
        $this->dropTable('{{%awpb_output}}');
    }
}
