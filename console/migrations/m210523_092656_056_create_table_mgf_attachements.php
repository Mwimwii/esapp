<?php

use yii\db\Migration;

class m210523_092656_056_create_table_mgf_attachements extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%mgf_attachements}}',
            [
                'id' => $this->primaryKey(),
                'registration_certificate' => $this->text()->notNull(),
                'articles_of_assoc' => $this->text()->notNull(),
                'audit_reports' => $this->text(),
                'mou_contract' => $this->text()->notNull(),
                'board_resolution' => $this->text()->notNull(),
                'application_attachement' => $this->text(),
                'organisation_id' => $this->integer()->notNull(),
                'application_id' => $this->integer()->notNull(),
                'date_created' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            ],
            $tableOptions
        );

        $this->createIndex('application_id', '{{%mgf_attachements}}', ['application_id']);
        $this->createIndex('organisation_id', '{{%mgf_attachements}}', ['organisation_id']);

        $this->addForeignKey(
            'mgf_attachements_ibfk_1',
            '{{%mgf_attachements}}',
            ['organisation_id'],
            '{{%mgf_organisation}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'mgf_attachements_ibfk_2',
            '{{%mgf_attachements}}',
            ['application_id'],
            '{{%mgf_application}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
    }

    public function down()
    {
        $this->dropTable('{{%mgf_attachements}}');
    }
}
