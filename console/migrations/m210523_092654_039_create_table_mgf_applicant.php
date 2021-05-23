<?php

use yii\db\Migration;

class m210523_092654_039_create_table_mgf_applicant extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%mgf_applicant}}',
            [
                'id' => $this->primaryKey(),
                'title' => $this->string(),
                'province_id' => $this->integer()->unsigned(),
                'district_id' => $this->integer()->unsigned(),
                'first_name' => $this->string(30)->notNull(),
                'last_name' => $this->string(30)->notNull(),
                'mobile' => $this->string(15)->notNull(),
                'nationalid' => $this->string(15),
                'address' => $this->text(),
                'confirmed' => $this->boolean()->notNull()->defaultValue('0'),
                'applicant_type' => $this->string(),
                'user_id' => $this->integer()->notNull(),
                'organisation_id' => $this->integer(),
                'date_created' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            ],
            $tableOptions
        );

        $this->createIndex('user_id', '{{%mgf_applicant}}', ['user_id']);

        $this->addForeignKey(
            'fk_applicant_district',
            '{{%mgf_applicant}}',
            ['district_id'],
            '{{%district}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'fk_applicant_province',
            '{{%mgf_applicant}}',
            ['province_id'],
            '{{%province}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'mgf_applicant_ibfk_1',
            '{{%mgf_applicant}}',
            ['user_id'],
            '{{%users}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
    }

    public function down()
    {
        $this->dropTable('{{%mgf_applicant}}');
    }
}
