<?php

use yii\db\Migration;

class m210523_092656_061_create_table_mgf_final_evaluation extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%mgf_final_evaluation}}',
            [
                'id' => $this->primaryKey(),
                'proposal_id' => $this->integer()->notNull(),
                'organisation_id' => $this->integer()->notNull(),
                'status' => $this->integer(1)->notNull()->defaultValue('0'),
                'finalscore' => $this->string(5),
                'decision' => $this->string(20),
                'notified' => $this->boolean()->notNull()->defaultValue('0'),
                'finalcomment' => $this->text(),
                'response' => $this->text(),
                'date_created' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            ],
            $tableOptions
        );

        $this->createIndex('organisation_id', '{{%mgf_final_evaluation}}', ['organisation_id']);
        $this->createIndex('proposal_id', '{{%mgf_final_evaluation}}', ['proposal_id'], true);

        $this->addForeignKey(
            'mgf_final_evaluation_ibfk_1',
            '{{%mgf_final_evaluation}}',
            ['proposal_id'],
            '{{%mgf_proposal}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'mgf_final_evaluation_ibfk_2',
            '{{%mgf_final_evaluation}}',
            ['organisation_id'],
            '{{%mgf_organisation}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
    }

    public function down()
    {
        $this->dropTable('{{%mgf_final_evaluation}}');
    }
}
