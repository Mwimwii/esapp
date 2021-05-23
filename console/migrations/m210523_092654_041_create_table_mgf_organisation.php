<?php

use yii\db\Migration;

class m210523_092654_041_create_table_mgf_organisation extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%mgf_organisation}}',
            [
                'id' => $this->primaryKey(),
                'cooperative' => $this->string(50)->notNull(),
                'acronym' => $this->string(10)->notNull(),
                'registration_type' => $this->string(30)->notNull(),
                'registration_no' => $this->string(30)->notNull(),
                'trade_license_no' => $this->string(30)->notNull(),
                'registration_date' => $this->date()->notNull(),
                'business_objective' => $this->text(),
                'email_address' => $this->string(40)->notNull(),
                'physical_address' => $this->string(50)->notNull(),
                'tel_no' => $this->string(15),
                'province_id' => $this->integer()->unsigned(),
                'district_id' => $this->integer()->unsigned(),
                'applicant_id' => $this->integer()->notNull(),
                'is_active' => $this->integer(1)->defaultValue('1'),
                'date_created' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            ],
            $tableOptions
        );

        $this->createIndex('applicant_id', '{{%mgf_organisation}}', ['applicant_id']);
        $this->createIndex('email_address', '{{%mgf_organisation}}', ['email_address'], true);
        $this->createIndex('trade_license_no', '{{%mgf_organisation}}', ['trade_license_no'], true);
        $this->createIndex('registration_no', '{{%mgf_organisation}}', ['registration_no'], true);

        $this->addForeignKey(
            'fk_org_district',
            '{{%mgf_organisation}}',
            ['district_id'],
            '{{%district}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'fk_org_province',
            '{{%mgf_organisation}}',
            ['province_id'],
            '{{%province}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'mgf_organisation_ibfk_1',
            '{{%mgf_organisation}}',
            ['applicant_id'],
            '{{%mgf_applicant}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
    }

    public function down()
    {
        $this->dropTable('{{%mgf_organisation}}');
    }
}
