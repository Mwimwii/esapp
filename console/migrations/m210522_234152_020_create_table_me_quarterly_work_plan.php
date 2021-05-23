<?php

use yii\db\Migration;

class m210522_234152_020_create_table_me_quarterly_work_plan extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%me_quarterly_work_plan}}',
            [
                'id' => $this->primaryKey(),
                'activity_id' => $this->integer()->notNull(),
                'province_id' => $this->integer()->notNull(),
                'district_id' => $this->integer()->notNull(),
                'month' => $this->integer()->notNull(),
                'quarter' => $this->string(15)->notNull(),
                'year' => $this->string(5)->notNull(),
                'status' => $this->integer()->notNull()->defaultValue('0'),
                'district_approval_status' => $this->integer()->notNull()->defaultValue('0'),
                'provincial_approval_status' => $this->integer()->notNull(),
                'Remarks' => $this->text()->notNull(),
                'esapp_comments' => $this->text(),
                'created_at' => $this->integer()->unsigned()->notNull(),
                'updated_at' => $this->integer()->unsigned()->notNull(),
                'created_by' => $this->integer(),
                'updated_by' => $this->integer(),
            ],
            $tableOptions
        );
    }

    public function down()
    {
        $this->dropTable('{{%me_quarterly_work_plan}}');
    }
}
