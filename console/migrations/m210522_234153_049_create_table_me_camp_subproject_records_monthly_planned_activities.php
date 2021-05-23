<?php

use yii\db\Migration;

class m210522_234153_049_create_table_me_camp_subproject_records_monthly_planned_activities extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%me_camp_subproject_records_monthly_planned_activities}}',
            [
                'id' => $this->primaryKey(),
                'work_effort_id' => $this->integer()->notNull(),
                'activity_id' => $this->integer()->notNull(),
                'faabs_id' => $this->integer()->notNull(),
                'zone' => $this->string(45),
                'activity_target' => $this->string(),
                'beneficiary_target_total' => $this->integer()->defaultValue('0'),
                'beneficiary_target_women' => $this->string(45)->notNull()->defaultValue('0'),
                'beneficiary_target_youth' => $this->string(45)->notNull()->defaultValue('0'),
                'beneficiary_target_women_headed' => $this->string(45)->notNull()->defaultValue('0'),
                'created_at' => $this->integer()->unsigned()->notNull(),
                'updated_at' => $this->integer()->unsigned()->notNull(),
                'created_by' => $this->integer(),
                'updated_by' => $this->integer(),
            ],
            $tableOptions
        );

        $this->createIndex('fk_me_camp_subproject_records_monthly_planned_activities_1_idx', '{{%me_camp_subproject_records_monthly_planned_activities}}', ['faabs_id']);
        $this->createIndex('fk_me_camp_subproject_records_monthly_planned_activities_2_idx', '{{%me_camp_subproject_records_monthly_planned_activities}}', ['work_effort_id']);

        $this->addForeignKey(
            'fk_me_camp_subproject_records_monthly_planned_activities_1',
            '{{%me_camp_subproject_records_monthly_planned_activities}}',
            ['faabs_id'],
            '{{%me_faabs_groups}}',
            ['id'],
            'NO ACTION',
            'NO ACTION'
        );
        $this->addForeignKey(
            'fk_me_camp_subproject_records_monthly_planned_activities_2',
            '{{%me_camp_subproject_records_monthly_planned_activities}}',
            ['work_effort_id'],
            '{{%me_camp_subproject_records_planned_work_effort}}',
            ['id'],
            'NO ACTION',
            'NO ACTION'
        );
    }

    public function down()
    {
        $this->dropTable('{{%me_camp_subproject_records_monthly_planned_activities}}');
    }
}
