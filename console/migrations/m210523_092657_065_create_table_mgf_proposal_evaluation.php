<?php

use yii\db\Migration;

class m210523_092657_065_create_table_mgf_proposal_evaluation extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%mgf_proposal_evaluation}}',
            [
                'id' => $this->primaryKey(),
                'proposal_id' => $this->integer()->notNull(),
                'criterion_id' => $this->integer()->notNull(),
                'awardedscore' => $this->integer(2),
                'grade' => $this->string(70),
                'comment' => $this->text(),
                'date_created' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
                'createdby' => $this->integer()->notNull(),
            ],
            $tableOptions
        );

        $this->createIndex('criterion_id', '{{%mgf_proposal_evaluation}}', ['criterion_id']);
        $this->createIndex('proposal_id', '{{%mgf_proposal_evaluation}}', ['proposal_id']);
        $this->createIndex('createdby', '{{%mgf_proposal_evaluation}}', ['createdby']);

        $this->addForeignKey(
            'mgf_proposal_evaluation_ibfk_1',
            '{{%mgf_proposal_evaluation}}',
            ['createdby'],
            '{{%users}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'mgf_proposal_evaluation_ibfk_2',
            '{{%mgf_proposal_evaluation}}',
            ['proposal_id'],
            '{{%mgf_proposal}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'mgf_proposal_evaluation_ibfk_3',
            '{{%mgf_proposal_evaluation}}',
            ['criterion_id'],
            '{{%mgf_selection_criteria}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
    }

    public function down()
    {
        $this->dropTable('{{%mgf_proposal_evaluation}}');
    }
}
