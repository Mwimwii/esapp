<?php

use yii\db\Migration;

class m210523_092650_004_create_table_awpb_component extends Migration
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
                'access_level' => $this->integer()->notNull()->defaultValue('0')->comment('0 Programme, 1 District'),
                'subcomponent' => $this->string(),
                'funder_id' => $this->integer(),
                'expense_category_id' => $this->integer(),
                'created_at' => $this->integer()->unsigned()->notNull(),
                'updated_at' => $this->integer()->unsigned()->notNull(),
                'created_by' => $this->integer()->notNull(),
                'updated_by' => $this->integer()->notNull(),
            ],
            $tableOptions
        );

        $this->createIndex('funder_id', '{{%awpb_component}}', ['funder_id']);
        $this->createIndex('expense_category_id', '{{%awpb_component}}', ['expense_category_id']);
        $this->createIndex('parent_component_id', '{{%awpb_component}}', ['parent_component_id']);
        $this->createIndex('component_description', '{{%awpb_component}}', ['name'], true);
        $this->createIndex('component_code', '{{%awpb_component}}', ['code'], true);
    }

    public function down()
    {
        $this->dropTable('{{%awpb_component}}');
    }
}
