<?php

use yii\db\Migration;

class m210523_185213_027_create_table_awpb_indicator extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%awpb_indicator}}',
            [
                'id' => $this->primaryKey(),
                'component_id' => $this->integer()->notNull(),
                'outcome_id' => $this->integer()->notNull(),
                'output_id' => $this->integer(),
                'name' => $this->string(40)->notNull(),
                'description' => $this->string()->notNull(),
                'unit_of_measure_id' => $this->integer(),
                'created_at' => $this->integer()->unsigned()->notNull(),
                'updated_at' => $this->integer()->unsigned()->notNull(),
                'created_by' => $this->integer(),
                'updated_by' => $this->integer(),
            ],
            $tableOptions
        );

        $this->createIndex('component_id', '{{%awpb_indicator}}', ['component_id']);

        $this->addForeignKey(
            'awpb_indicator_ibfk_1',
            '{{%awpb_indicator}}',
            ['component_id'],
            '{{%awpb_component}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'awpb_indicator_ibfk_2',
            '{{%awpb_indicator}}',
            ['unit_of_measure_id'],
            '{{%awpb_unit_of_measure}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
    }

    public function down()
    {
        $this->dropTable('{{%awpb_indicator}}');
    }
}
