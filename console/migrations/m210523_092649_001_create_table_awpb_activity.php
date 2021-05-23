<?php

use yii\db\Migration;

class m210523_092649_001_create_table_awpb_activity extends Migration
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
                'type' => $this->integer()->notNull()->comment('0 Main activity, 1 Subactivity'),
                'activity_type' => $this->string(),
                'awpb_template_id' => $this->integer()->notNull(),
                'description' => $this->string()->notNull(),
                'name' => $this->string(40)->notNull(),
                'unit_of_measure_id' => $this->integer(),
                'programme_target' => $this->double()->notNull(),
                'indicator' => $this->text()->notNull(),
                'quarter_one_budget' => $this->double(),
                'quarter_two_budget' => $this->double(),
                'quarter_three_budget' => $this->double(),
                'quarter_four_budget' => $this->double(),
                'total_budget' => $this->double(),
                'expense_category_id' => $this->integer()->notNull(),
                'created_at' => $this->integer()->unsigned()->notNull(),
                'updated_at' => $this->integer()->unsigned()->notNull(),
                'created_by' => $this->integer(),
                'updated_by' => $this->integer(),
            ],
            $tableOptions
        );

        $this->createIndex('awpb_template_id', '{{%awpb_activity}}', ['awpb_template_id']);
        $this->createIndex('expense_category_id', '{{%awpb_activity}}', ['expense_category_id']);
        $this->createIndex('component_id', '{{%awpb_activity}}', ['component_id']);
        $this->createIndex('name', '{{%awpb_activity}}', ['name'], true);
        $this->createIndex('description', '{{%awpb_activity}}', ['description'], true);
        $this->createIndex('activity_code', '{{%awpb_activity}}', ['activity_code']);
        $this->createIndex('unit_of_measure_id', '{{%awpb_activity}}', ['unit_of_measure_id']);
    }

    public function down()
    {
        $this->dropTable('{{%awpb_activity}}');
    }
}
