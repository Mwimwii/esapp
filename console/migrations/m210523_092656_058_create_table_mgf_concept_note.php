<?php

use yii\db\Migration;

class m210523_092656_058_create_table_mgf_concept_note extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%mgf_concept_note}}',
            [
                'id' => $this->primaryKey(),
                'project_title' => $this->string(30)->notNull(),
                'estimated_cost' => $this->decimal(12, 2)->notNull(),
                'starting_date' => $this->date()->notNull(),
                'operation_id' => $this->integer()->notNull(),
                'implimentation_period' => $this->string(),
                'other_operation_type' => $this->text(),
                'application_id' => $this->integer()->notNull(),
                'organisation_id' => $this->integer()->notNull(),
                'date_created' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
                'date_submitted' => $this->timestamp(),
            ],
            $tableOptions
        );

        $this->createIndex('operation_id', '{{%mgf_concept_note}}', ['operation_id']);
        $this->createIndex('organisation_id', '{{%mgf_concept_note}}', ['organisation_id']);
        $this->createIndex('application_id', '{{%mgf_concept_note}}', ['application_id']);

        $this->addForeignKey(
            'mgf_concept_note_ibfk_1',
            '{{%mgf_concept_note}}',
            ['application_id'],
            '{{%mgf_application}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'mgf_concept_note_ibfk_2',
            '{{%mgf_concept_note}}',
            ['organisation_id'],
            '{{%mgf_organisation}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'mgf_concept_note_ibfk_3',
            '{{%mgf_concept_note}}',
            ['operation_id'],
            '{{%mgf_operation}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
    }

    public function down()
    {
        $this->dropTable('{{%mgf_concept_note}}');
    }
}
