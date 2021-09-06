<?php

use yii\db\Migration;

class m210523_185213_036_create_table_me_quarterly_operations_funds_requisition extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%me_quarterly_operations_funds_requisition}}',
            [
                'id' => $this->primaryKey(),
                'quarter_workplan_id' => $this->integer()->notNull(),
                'budget_estimate_month_1' => $this->string(50)->defaultValue('0'),
                'budget_estimate_month_2' => $this->string(50)->defaultValue('0'),
                'budget_estimate_month_3' => $this->string(50)->defaultValue('0'),
                'created_at' => $this->integer()->unsigned()->notNull(),
                'updated_at' => $this->integer()->unsigned()->notNull(),
                'created_by' => $this->integer(),
                'updated_by' => $this->integer(),
            ],
            $tableOptions
        );

        $this->createIndex('fk_me_quarterly_operations_funds_requisition_1_idx', '{{%me_quarterly_operations_funds_requisition}}', ['quarter_workplan_id']);

        $this->addForeignKey(
            'fk_me_quarterly_operations_funds_requisition_1',
            '{{%me_quarterly_operations_funds_requisition}}',
            ['quarter_workplan_id'],
            '{{%me_quarterly_work_plan}}',
            ['id'],
            'NO ACTION',
            'NO ACTION'
        );
    }

    public function down()
    {
        $this->dropTable('{{%me_quarterly_operations_funds_requisition}}');
    }
}
