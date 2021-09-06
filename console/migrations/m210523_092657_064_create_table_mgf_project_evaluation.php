<?php

use yii\db\Migration;

class m210523_092657_064_create_table_mgf_project_evaluation extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%mgf_project_evaluation}}',
            [
                'id' => $this->primaryKey(),
                'proposal_id' => $this->integer()->notNull(),
                'organisation_id' => $this->integer()->notNull(),
                'window' => $this->string(),
                'status' => $this->integer(1)->notNull()->defaultValue('0'),
                'observation' => $this->text(),
                'declaration' => $this->text(),
                'totalscore' => $this->string(5)->defaultValue('0'),
                'decision' => $this->string(20),
                'date_created' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
                'date_submitted' => $this->timestamp(),
                'date_reviewed' => $this->timestamp(),
                'reviewedby' => $this->integer()->notNull(),
                'signature' => $this->text(),
            ],
            $tableOptions
        );

        $this->createIndex('organisation_id', '{{%mgf_project_evaluation}}', ['organisation_id']);
        $this->createIndex('proposal_id', '{{%mgf_project_evaluation}}', ['proposal_id']);
        $this->createIndex('reviewedby', '{{%mgf_project_evaluation}}', ['reviewedby']);

        $this->addForeignKey(
            'mgf_project_evaluation_ibfk_1',
            '{{%mgf_project_evaluation}}',
            ['reviewedby'],
            '{{%users}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'mgf_project_evaluation_ibfk_2',
            '{{%mgf_project_evaluation}}',
            ['proposal_id'],
            '{{%mgf_proposal}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'mgf_project_evaluation_ibfk_3',
            '{{%mgf_project_evaluation}}',
            ['organisation_id'],
            '{{%mgf_organisation}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
    }

    public function down()
    {
        $this->dropTable('{{%mgf_project_evaluation}}');
    }
}
