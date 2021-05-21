<?php

use yii\db\Migration;

class m210521_150432_014_create_table_lkm_storyofchange_interview_guide_template_questions extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%lkm_storyofchange_interview_guide_template_questions}}',
            [
                'id' => $this->primaryKey(),
                'section' => $this->string(45)->notNull(),
                'number' => $this->string(4)->notNull(),
                'question' => $this->text()->notNull(),
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
        $this->dropTable('{{%lkm_storyofchange_interview_guide_template_questions}}');
    }
}
