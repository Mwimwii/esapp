<?php

use yii\db\Migration;

class m210523_092652_021_create_table_me_faabs_training_topics extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%me_faabs_training_topics}}',
            [
                'id' => $this->primaryKey(),
                'topic' => $this->text()->notNull(),
                'output_level_indicator' => $this->text()->notNull(),
                'category' => $this->text()->notNull(),
                'subcomponent' => $this->text(),
            ],
            $tableOptions
        );
    }

    public function down()
    {
        $this->dropTable('{{%me_faabs_training_topics}}');
    }
}
