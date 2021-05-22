<?php

use yii\db\Migration;

class m210521_150433_025_create_table_awpb_component extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%awpb_component}}',
            [
                'id' => $this->primaryKey(),
                'code' => $this->string(10)->notNull(),
                'parent_component_id' => $this->integer(),
                'name' => $this->string()->notNull(),
                'description' => $this->string()->notNull(),
                'outcome' => $this->text(),
                'output' => $this->text(),
                'type' => $this->integer()->notNull()->defaultValue('0')->comment('0 Main component, 1 Subcomponent,'),
                'access_level' => $this->integer()->defaultValue('0')->comment('0 All.1 District, 2 Programme,'),
                'subcomponent' => $this->string(),
                'funder_id' => $this->integer(),
                'expense_category_id' => $this->integer(),
                'gl_account_code' => $this->string(4),
                'created_at' => $this->integer()->unsigned()->notNull(),
                'updated_at' => $this->integer()->unsigned()->notNull(),
                'created_by' => $this->integer()->notNull(),
                'updated_by' => $this->integer()->notNull(),
            ],
            $tableOptions
        );

        $this->createIndex('description', '{{%awpb_component}}', ['description'], true);
        $this->createIndex('component_description', '{{%awpb_component}}', ['name'], true);
        $this->createIndex('component_code', '{{%awpb_component}}', ['code'], true);
        $this->createIndex('funder_id', '{{%awpb_component}}', ['funder_id']);
        $this->createIndex('expense_category_id', '{{%awpb_component}}', ['expense_category_id']);
        $this->createIndex('parent_component_id', '{{%awpb_component}}', ['parent_component_id']);

        $this->addForeignKey(
            'awpb_component_ibfk_1',
            '{{%awpb_component}}',
            ['expense_category_id'],
            '{{%awpb_expense_category}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'awpb_component_ibfk_2',
            '{{%awpb_component}}',
            ['funder_id'],
            '{{%awpb_funder}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
    }

    public function down()
    {
        $this->dropTable('{{%awpb_component}}');
    }
}
