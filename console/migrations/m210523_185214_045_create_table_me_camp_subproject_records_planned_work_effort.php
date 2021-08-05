<?php

use yii\db\Migration;

class m210523_185214_045_create_table_me_camp_subproject_records_planned_work_effort extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%me_camp_subproject_records_planned_work_effort}}',
            [
                'id' => $this->primaryKey(),
                'camp_id' => $this->integer()->unsigned()->notNull(),
                'year' => $this->integer()->notNull(),
                'month' => $this->string(15)->notNull(),
                'days_in_month' => $this->integer()->notNull(),
                'days_field' => $this->integer()->notNull()->defaultValue('0'),
                'days_office' => $this->integer()->notNull()->defaultValue('0'),
                'days_total' => $this->integer()->defaultValue('0')->comment('Field days + Office days'),
                'days_other_non_esapp_activities' => $this->integer(),
                'created_at' => $this->integer()->unsigned()->notNull(),
                'updated_at' => $this->integer()->unsigned()->notNull(),
                'created_by' => $this->integer(),
                'updated_by' => $this->integer(),
            ],
            $tableOptions
        );

        $this->createIndex('fk_me_camp_subproject_records_planned_work_effort_1_idx', '{{%me_camp_subproject_records_planned_work_effort}}', ['camp_id']);

        $this->addForeignKey(
            'fk_me_camp_subproject_records_planned_work_effort_1',
            '{{%me_camp_subproject_records_planned_work_effort}}',
            ['camp_id'],
            '{{%camp}}',
            ['id'],
            'NO ACTION',
            'NO ACTION'
        );
    }

    public function down()
    {
        $this->dropTable('{{%me_camp_subproject_records_planned_work_effort}}');
    }
}
