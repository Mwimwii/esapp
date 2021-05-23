<?php

use yii\db\Migration;

class m210522_234153_048_create_table_me_faabs_training_topic_enrolment extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%me_faabs_training_topic_enrolment}}',
            [
                'id' => $this->primaryKey(),
                'faabs_id' => $this->integer()->notNull(),
                'training_type' => $this->string()->notNull(),
                'topic_id' => $this->integer()->notNull(),
            ],
            $tableOptions
        );

        $this->createIndex('fk_me_faabs_training_topic_enrolment_1_idx', '{{%me_faabs_training_topic_enrolment}}', ['faabs_id']);
        $this->createIndex('fk_me_faabs_training_topic_enrolment_2_idx', '{{%me_faabs_training_topic_enrolment}}', ['topic_id']);

        $this->addForeignKey(
            'fk_me_faabs_training_topic_enrolment_1',
            '{{%me_faabs_training_topic_enrolment}}',
            ['faabs_id'],
            '{{%me_faabs_groups}}',
            ['id'],
            'NO ACTION',
            'NO ACTION'
        );
        $this->addForeignKey(
            'fk_me_faabs_training_topic_enrolment_2',
            '{{%me_faabs_training_topic_enrolment}}',
            ['topic_id'],
            '{{%me_faabs_training_topics}}',
            ['id'],
            'NO ACTION',
            'NO ACTION'
        );
    }

    public function down()
    {
        $this->dropTable('{{%me_faabs_training_topic_enrolment}}');
    }
}
