<?php

use yii\db\Migration;

class m210523_092652_023_create_table_me_field_monitoring_checklists extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%me_field_monitoring_checklists}}',
            [
                'id' => $this->primaryKey(),
                'district_id' => $this->integer(),
                'province_id' => $this->integer(),
                'issue_id' => $this->integer()->notNull(),
                'addressed' => $this->string()->notNull()->defaultValue('No'),
                'comments' => $this->string(45),
                'created_at' => $this->integer()->unsigned()->notNull(),
                'updated_at' => $this->integer()->unsigned()->notNull(),
                'created_by' => $this->integer(),
                'updated_by' => $this->integer(),
            ],
            $tableOptions
        );

        $this->createIndex('fk_me_field_monitoring_checklists_1_idx', '{{%me_field_monitoring_checklists}}', ['issue_id']);

        $this->addForeignKey(
            'fk_me_field_monitoring_checklists_1',
            '{{%me_field_monitoring_checklists}}',
            ['issue_id'],
            '{{%me_field_monitoring_checklist_issues}}',
            ['id'],
            'NO ACTION',
            'NO ACTION'
        );
    }

    public function down()
    {
        $this->dropTable('{{%me_field_monitoring_checklists}}');
    }
}
