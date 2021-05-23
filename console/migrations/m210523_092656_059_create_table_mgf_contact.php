<?php

use yii\db\Migration;

class m210523_092656_059_create_table_mgf_contact extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%mgf_contact}}',
            [
                'id' => $this->primaryKey(),
                'first_name' => $this->string(30)->notNull(),
                'last_name' => $this->string(30)->notNull(),
                'mobile' => $this->string(15)->notNull(),
                'tel_no' => $this->string(15),
                'physical_address' => $this->string(50),
                'organisation_id' => $this->integer()->notNull(),
                'position_id' => $this->integer()->notNull(),
                'applicant_id' => $this->integer()->notNull(),
                'date_created' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            ],
            $tableOptions
        );

        $this->createIndex('applicant_id', '{{%mgf_contact}}', ['applicant_id']);
        $this->createIndex('position_id', '{{%mgf_contact}}', ['position_id']);
        $this->createIndex('organisation_id', '{{%mgf_contact}}', ['organisation_id']);

        $this->addForeignKey(
            'mgf_contact_ibfk_1',
            '{{%mgf_contact}}',
            ['organisation_id'],
            '{{%mgf_organisation}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'mgf_contact_ibfk_2',
            '{{%mgf_contact}}',
            ['position_id'],
            '{{%mgf_position}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'mgf_contact_ibfk_3',
            '{{%mgf_contact}}',
            ['applicant_id'],
            '{{%mgf_applicant}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
    }

    public function down()
    {
        $this->dropTable('{{%mgf_contact}}');
    }
}
