<?php

use yii\db\Migration;

class m210521_150434_036_create_table_awpb_activity extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%awpb_activity}}',
            [
                'id' => $this->primaryKey(),
                'activity_code' => $this->string(10)->notNull(),
                'parent_activity_id' => $this->integer(),
                'component_id' => $this->integer()->notNull(),
                'outcome_id' => $this->integer(),
                'output_id' => $this->integer(),
                'commodity_type_id' => $this->integer()->unsigned(),
                'type' => $this->integer()->notNull()->comment('0 Main activity, 1 Subactivity'),
                'activity_type' => $this->string(),
                'awpb_template_id' => $this->integer(),
                'description' => $this->string()->notNull(),
                'name' => $this->string(40)->notNull(),
                'unit_of_measure_id' => $this->integer(),
                'programme_target' => $this->double(),
                'cumulative_planned' => $this->double()->notNull(),
                'cumulative_actual' => $this->double()->notNull(),
                'indicator_id' => $this->integer(),
                'funder_id' => $this->integer(),
                'gl_account_code' => $this->string(4),
                'quarter_one_budget' => $this->double(),
                'quarter_two_budget' => $this->double(),
                'quarter_three_budget' => $this->double(),
                'quarter_four_budget' => $this->double(),
                'total_budget' => $this->double(),
                'expense_category_id' => $this->integer(),
                'created_at' => $this->integer()->unsigned()->notNull(),
                'updated_at' => $this->integer()->unsigned()->notNull(),
                'created_by' => $this->integer(),
                'updated_by' => $this->integer(),
            ],
            $tableOptions
        );

        $this->createIndex('component_id', '{{%awpb_activity}}', ['component_id']);
        $this->createIndex('name', '{{%awpb_activity}}', ['name'], true);
        $this->createIndex('commodity_id', '{{%awpb_activity}}', ['commodity_type_id']);
        $this->createIndex('description', '{{%awpb_activity}}', ['description'], true);
        $this->createIndex('output_id', '{{%awpb_activity}}', ['output_id']);
        $this->createIndex('outcome_id', '{{%awpb_activity}}', ['outcome_id']);
        $this->createIndex('indicator_id', '{{%awpb_activity}}', ['indicator_id']);
        $this->createIndex('funder_id', '{{%awpb_activity}}', ['funder_id']);
        $this->createIndex('activity_code', '{{%awpb_activity}}', ['activity_code']);
        $this->createIndex('unit_of_measure_id', '{{%awpb_activity}}', ['unit_of_measure_id']);
        $this->createIndex('awpb_template_id', '{{%awpb_activity}}', ['awpb_template_id']);
        $this->createIndex('expense_category_id', '{{%awpb_activity}}', ['expense_category_id']);

        $this->addForeignKey(
            'awpb_activity_ibfk_7',
            '{{%awpb_activity}}',
            ['outcome_id'],
            '{{%awpb_outcome}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'awpb_activity_ibfk_8',
            '{{%awpb_activity}}',
            ['output_id'],
            '{{%awpb_output}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'awpb_activity_ibfk_9',
            '{{%awpb_activity}}',
            ['commodity_type_id'],
            '{{%awpb_commodity_type}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'awpb_activity_ibfk_1',
            '{{%awpb_activity}}',
            ['component_id'],
            '{{%awpb_component}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'awpb_activity_ibfk_2',
            '{{%awpb_activity}}',
            ['expense_category_id'],
            '{{%awpb_expense_category}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'awpb_activity_ibfk_3',
            '{{%awpb_activity}}',
            ['awpb_template_id'],
            '{{%awpb_template}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'awpb_activity_ibfk_4',
            '{{%awpb_activity}}',
            ['unit_of_measure_id'],
            '{{%awpb_unit_of_measure}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'awpb_activity_ibfk_5',
            '{{%awpb_activity}}',
            ['funder_id'],
            '{{%awpb_funder}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'awpb_activity_ibfk_6',
            '{{%awpb_activity}}',
            ['indicator_id'],
            '{{%awpb_indicator}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
    }

    public function down()
    {
        $this->dropTable('{{%awpb_activity}}');
    }
}
