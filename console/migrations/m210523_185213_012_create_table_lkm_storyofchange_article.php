<?php

use yii\db\Migration;

class m210523_185213_012_create_table_lkm_storyofchange_article extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%lkm_storyofchange_article}}',
            [
                'id' => $this->primaryKey(),
                'story_id' => $this->integer(),
                'article_type' => $this->string(),
                'description' => $this->text(),
                'file' => $this->string()->notNull(),
                'created_at' => $this->integer()->unsigned()->notNull(),
                'updated_at' => $this->integer()->unsigned()->notNull(),
                'created_by' => $this->integer(),
                'updated_by' => $this->integer(),
                'file_name' => $this->string(45),
            ],
            $tableOptions
        );
    }

    public function down()
    {
        $this->dropTable('{{%lkm_storyofchange_article}}');
    }
}
