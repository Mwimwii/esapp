<?php

use yii\db\Migration;

class m210522_234152_033_create_table_lkm_storyofchange_media extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%lkm_storyofchange_media}}',
            [
                'id' => $this->primaryKey(),
                'story_id' => $this->integer()->notNull(),
                'media_type' => $this->text()->notNull(),
                'file_name' => $this->string(),
                'file' => $this->string()->notNull(),
                'created_at' => $this->integer()->unsigned()->notNull(),
                'updated_at' => $this->integer()->unsigned()->notNull(),
                'created_by' => $this->integer(),
                'updated_by' => $this->integer(),
            ],
            $tableOptions
        );

        $this->createIndex('fk_lkm_storyofchange_media_1_idx', '{{%lkm_storyofchange_media}}', ['story_id']);

        $this->addForeignKey(
            'fk_lkm_storyofchange_media_1',
            '{{%lkm_storyofchange_media}}',
            ['story_id'],
            '{{%lkm_storyofchange}}',
            ['id'],
            'NO ACTION',
            'NO ACTION'
        );
    }

    public function down()
    {
        $this->dropTable('{{%lkm_storyofchange_media}}');
    }
}
