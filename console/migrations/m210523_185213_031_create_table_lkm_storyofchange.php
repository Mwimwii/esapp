<?php

use yii\db\Migration;

class m210523_185213_031_create_table_lkm_storyofchange extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%lkm_storyofchange}}',
            [
                'id' => $this->primaryKey(),
                'category_id' => $this->integer()->notNull(),
                'title' => $this->text()->notNull()->comment('Title of the story of change'),
                'interviewee_names' => $this->text()->notNull(),
                'interviewer_names' => $this->text()->notNull(),
                'date_interviewed' => $this->date()->notNull(),
                'introduction' => $this->text()->comment('Introduction of the story: 2-3 sentences summary of the case study or success story'),
                'challenge' => $this->text()->comment('The problem that was being addressed in the story'),
                'actions' => $this->text()->comment('What was done, how, by and with who etc'),
                'results' => $this->text()->comment('what changed and what difference was made'),
                'conclusions' => $this->text()->comment('Factors that seemed to be critical to achieving the outcomes'),
                'sequel' => $this->text()->comment('Summarising what happens next, whether this seems to be the end of the story or whether the programme will continue to track changes'),
                'status' => $this->integer()->notNull()->defaultValue('0'),
                'paio_review_status' => $this->integer()->defaultValue('0'),
                'paio_comments' => $this->text(),
                'ikmo_review_status' => $this->integer()->defaultValue('0'),
                'ikmo_comments' => $this->text(),
                'created_at' => $this->integer()->unsigned()->notNull(),
                'updated_at' => $this->integer()->unsigned()->notNull(),
                'created_by' => $this->integer(),
                'updated_by' => $this->integer(),
                'camp_id' => $this->integer(),
                'district_id' => $this->integer(),
                'province_id' => $this->integer(),
            ],
            $tableOptions
        );

        $this->createIndex('fk_lkm_storyofchange_1_idx', '{{%lkm_storyofchange}}', ['category_id']);

        $this->addForeignKey(
            'fk_lkm_storyofchange_1',
            '{{%lkm_storyofchange}}',
            ['category_id'],
            '{{%lkm_storyofchange_category}}',
            ['id'],
            'NO ACTION',
            'NO ACTION'
        );
    }

    public function down()
    {
        $this->dropTable('{{%lkm_storyofchange}}');
    }
}
