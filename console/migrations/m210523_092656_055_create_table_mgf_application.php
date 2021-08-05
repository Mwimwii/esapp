<?php

use yii\db\Migration;

class m210523_092656_055_create_table_mgf_application extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%mgf_application}}',
            [
                'id' => $this->primaryKey(),
                'attachements' => $this->integer(1),
                'applicant_id' => $this->integer()->notNull(),
                'organisation_id' => $this->integer()->notNull(),
                'application_status' => $this->string(15)->notNull()->defaultValue('Initialized'),
                'is_active' => $this->boolean()->notNull()->defaultValue('0'),
                'date_created' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
                'date_submitted' => $this->timestamp(),
            ],
            $tableOptions
        );

        $this->createIndex('organisation_id', '{{%mgf_application}}', ['organisation_id']);
        $this->createIndex('applicant_id', '{{%mgf_application}}', ['applicant_id']);

        $this->addForeignKey(
            'mgf_application_ibfk_1',
            '{{%mgf_application}}',
            ['applicant_id'],
            '{{%mgf_applicant}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'mgf_application_ibfk_2',
            '{{%mgf_application}}',
            ['organisation_id'],
            '{{%mgf_organisation}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
    }

    public function down()
    {
        $this->dropTable('{{%mgf_application}}');
    }
}
