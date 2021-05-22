<?php

use yii\db\Migration;

class m210521_150432_018_create_table_me_field_monitoring_checklist_issues extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%me_field_monitoring_checklist_issues}}',
            [
                'id' => $this->primaryKey(),
                'level' => $this->string(45)->notNull(),
                'issue_category' => $this->string()->notNull(),
                'issue' => $this->text()->notNull(),
            ],
            $tableOptions
        );
    }

    public function down()
    {
        $this->dropTable('{{%me_field_monitoring_checklist_issues}}');
    }
}
