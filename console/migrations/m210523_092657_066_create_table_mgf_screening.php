<?php

use yii\db\Migration;

class m210523_092657_066_create_table_mgf_screening extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%mgf_screening}}',
            [
                'id' => $this->primaryKey(),
                'conceptnote_id' => $this->integer()->notNull(),
                'organisation_id' => $this->integer()->notNull(),
                'criterion' => $this->text(),
                'satisfactory' => $this->string(4),
                'approve_submittion' => $this->timestamp(),
                'verified_by' => $this->string(20),
            ],
            $tableOptions
        );

        $this->createIndex('organisation_id', '{{%mgf_screening}}', ['organisation_id']);
        $this->createIndex('conceptnote_id', '{{%mgf_screening}}', ['conceptnote_id']);

        $this->addForeignKey(
            'mgf_screening_ibfk_1',
            '{{%mgf_screening}}',
            ['conceptnote_id'],
            '{{%mgf_concept_note}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'mgf_screening_ibfk_2',
            '{{%mgf_screening}}',
            ['organisation_id'],
            '{{%mgf_organisation}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
    }

    public function down()
    {
        $this->dropTable('{{%mgf_screening}}');
    }
}
