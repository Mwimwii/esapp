<?php

use yii\db\Migration;

class m210523_092658_073_create_table_mgf_approval extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%mgf_approval}}',
            [
                'id' => $this->primaryKey(),
                'application_id' => $this->integer()->notNull(),
                'conceptnote_id' => $this->integer()->notNull(),
                'scores' => $this->string(5)->defaultValue('0'),
                'review_remark' => $this->text(),
                'review_submission' => $this->timestamp(),
                'reviewed_by' => $this->string(20),
                'certify_remark' => $this->text(),
                'certify_submission' => $this->timestamp(),
                'certified_by' => $this->string(20),
                'review2_remark' => $this->text(),
                'review2_submission' => $this->timestamp(),
                'reviewed2_by' => $this->string(20),
                'approval_remark' => $this->text(),
                'approve_submittion' => $this->timestamp(),
                'approved_by' => $this->string(20),
            ],
            $tableOptions
        );

        $this->createIndex('application_id', '{{%mgf_approval}}', ['application_id']);
        $this->createIndex('conceptnote_id', '{{%mgf_approval}}', ['conceptnote_id']);

        $this->addForeignKey(
            'mgf_approval_ibfk_1',
            '{{%mgf_approval}}',
            ['conceptnote_id'],
            '{{%mgf_concept_note}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'mgf_approval_ibfk_2',
            '{{%mgf_approval}}',
            ['application_id'],
            '{{%mgf_application}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
    }

    public function down()
    {
        $this->dropTable('{{%mgf_approval}}');
    }
}
