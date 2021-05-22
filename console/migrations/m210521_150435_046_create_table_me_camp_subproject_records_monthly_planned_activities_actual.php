<?php

use yii\db\Migration;

class m210521_150435_046_create_table_me_camp_subproject_records_monthly_planned_activities_actual extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%me_camp_subproject_records_monthly_planned_activities_actual}}',
            [
                'id' => $this->primaryKey(),
                'planned_activity_id' => $this->integer()->notNull(),
                'hours_worked_field' => $this->string(2)->notNull()->defaultValue('0'),
                'hours_worked_office' => $this->string(2)->notNull()->defaultValue('0'),
                'hours_worked_total' => $this->string(4)->defaultValue('0'),
                'achieved_activity_target' => $this->string(45)->notNull(),
                'beneficiary_target_achieved_total' => $this->string(45)->notNull()->defaultValue('0'),
                'beneficiary_target_achieved_women' => $this->string(45)->notNull()->defaultValue('0'),
                'beneficiary_target_achieved_youth' => $this->string(45)->notNull()->defaultValue('0'),
                'beneficiary_target_achieved_women_headed' => $this->string(45)->notNull()->defaultValue('0'),
                'remarks' => $this->text(),
                'year' => $this->string(5),
                'month' => $this->string(3),
                'created_at' => $this->integer()->unsigned()->notNull(),
                'updated_at' => $this->integer()->unsigned()->notNull(),
                'created_by' => $this->integer(),
                'updated_by' => $this->integer(),
            ],
            $tableOptions
        );

        $this->createIndex('fk_new_table_2_idx', '{{%me_camp_subproject_records_monthly_planned_activities_actual}}', ['planned_activity_id']);

        $this->addForeignKey(
            'fk_new_table_2',
            '{{%me_camp_subproject_records_monthly_planned_activities_actual}}',
            ['planned_activity_id'],
            '{{%me_camp_subproject_records_monthly_planned_activities}}',
            ['id'],
            'NO ACTION',
            'NO ACTION'
        );
    }

    public function down()
    {
        $this->dropTable('{{%me_camp_subproject_records_monthly_planned_activities_actual}}');
    }
}
