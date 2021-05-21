<?php

use yii\db\Migration;

class m210521_150435_049_create_table_me_faabs_training_attendance_sheet extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%me_faabs_training_attendance_sheet}}',
            [
                'id' => $this->primaryKey(),
                'faabs_group_id' => $this->integer()->notNull(),
                'farmer_id' => $this->integer()->notNull(),
                'household_head_type' => $this->string(45)->notNull()->defaultValue('Male headed')->comment('Female headed or Male headed'),
                'topic' => $this->text()->notNull()->comment('Training course'),
                'facilitators' => $this->text()->notNull()->comment('Facilitators/Organisation'),
                'partner_organisations' => $this->text(),
                'training_date' => $this->date()->notNull(),
                'duration' => $this->string(10)->notNull()->comment('Duration hours and minutes'),
                'created_at' => $this->integer()->unsigned()->notNull(),
                'updated_at' => $this->integer()->unsigned()->notNull(),
                'created_by' => $this->integer(),
                'updated_by' => $this->integer(),
                'full_names' => $this->string(),
                'youth_non_youth' => $this->string(),
                'marital_status' => $this->string(45),
                'sex' => $this->string(45),
                'year_of_birth' => $this->string(6),
                'quarter' => $this->string(2),
                'topic_indicator' => $this->text(),
                'topic_subcomponent' => $this->string(45),
            ],
            $tableOptions
        );

        $this->createIndex('fk_me_faabs_training_attendance_sheet_2_idx', '{{%me_faabs_training_attendance_sheet}}', ['faabs_group_id']);
        $this->createIndex('fk_me_faabs_training_attendance_sheet_1_idx', '{{%me_faabs_training_attendance_sheet}}', ['farmer_id']);

        $this->addForeignKey(
            'fk_me_faabs_training_attendance_sheet_1',
            '{{%me_faabs_training_attendance_sheet}}',
            ['farmer_id'],
            '{{%me_faabs_category_a_farmers}}',
            ['id'],
            'NO ACTION',
            'NO ACTION'
        );
        $this->addForeignKey(
            'fk_me_faabs_training_attendance_sheet_2',
            '{{%me_faabs_training_attendance_sheet}}',
            ['faabs_group_id'],
            '{{%me_faabs_groups}}',
            ['id'],
            'NO ACTION',
            'NO ACTION'
        );
    }

    public function down()
    {
        $this->dropTable('{{%me_faabs_training_attendance_sheet}}');
    }
}
