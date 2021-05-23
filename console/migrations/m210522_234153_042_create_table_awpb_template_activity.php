<?php

use yii\db\Migration;

class m210522_234153_042_create_table_awpb_template_activity extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%awpb_template_activity}}',
            [
                'id' => $this->primaryKey(),
                'activity_id' => $this->integer()->notNull(),
                'component_id' => $this->integer(),
                'outcome_id' => $this->integer(),
                'output_id' => $this->integer(),
                'awpb_template_id' => $this->integer()->notNull(),
                'funder_id' => $this->integer(),
                'expense_category_id' => $this->integer(),
                'created_at' => $this->integer()->unsigned()->notNull(),
                'updated_at' => $this->integer()->unsigned()->notNull(),
                'created_by' => $this->integer(),
                'updated_by' => $this->integer(),
            ],
            $tableOptions
        );

        $this->createIndex('activity_code', '{{%awpb_template_activity}}', ['activity_id']);
        $this->createIndex('awpb_template_id', '{{%awpb_template_activity}}', ['awpb_template_id']);
        $this->createIndex('component_id', '{{%awpb_template_activity}}', ['component_id']);
        $this->createIndex('expense_category_id', '{{%awpb_template_activity}}', ['expense_category_id']);
        $this->createIndex('funder_id', '{{%awpb_template_activity}}', ['funder_id']);
        $this->createIndex('outcome_id', '{{%awpb_template_activity}}', ['outcome_id']);
        $this->createIndex('output_id', '{{%awpb_template_activity}}', ['output_id']);

        $this->addForeignKey(
            'awpb_template_activity_ibfk_1',
            '{{%awpb_template_activity}}',
            ['activity_id'],
            '{{%awpb_activity}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'awpb_template_activity_ibfk_2',
            '{{%awpb_template_activity}}',
            ['awpb_template_id'],
            '{{%awpb_template}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'awpb_template_activity_ibfk_3',
            '{{%awpb_template_activity}}',
            ['component_id'],
            '{{%awpb_component}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
    }

    public function down()
    {
        $this->dropTable('{{%awpb_template_activity}}');
    }
}
