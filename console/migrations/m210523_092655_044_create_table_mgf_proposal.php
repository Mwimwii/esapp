<?php

use yii\db\Migration;

class m210523_092655_044_create_table_mgf_proposal extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%mgf_proposal}}',
            [
                'id' => $this->primaryKey(),
                'project_title' => $this->string(30),
                'mgf_no' => $this->string(11)->notNull(),
                'organisation_id' => $this->integer()->notNull(),
                'applicant_type' => $this->string(),
                'starting_date' => $this->date()->notNull(),
                'ending_date' => $this->date(),
                'project_length' => $this->integer()->notNull()->defaultValue('0'),
                'number_reviewers' => $this->integer()->notNull()->defaultValue('0'),
                'project_operations' => $this->text(),
                'any_experience' => $this->string(),
                'experience_response' => $this->text(),
                'indicate_partnerships' => $this->text(),
                'proposal_status' => $this->string(20)->notNull()->defaultValue('Created'),
                'date_created' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
                'date_submitted' => $this->timestamp(),
                'problem_statement' => $this->text(),
                'overall_objective' => $this->text(),
                'is_active' => $this->integer(1)->defaultValue('0'),
                'totalcost' => $this->decimal(15, 2)->defaultValue('0.00'),
                'province_id' => $this->integer()->unsigned(),
                'district_id' => $this->integer()->unsigned(),
            ],
            $tableOptions
        );

        $this->createIndex('organisation_id', '{{%mgf_proposal}}', ['organisation_id']);

        $this->addForeignKey(
            'fk_prop_district',
            '{{%mgf_proposal}}',
            ['district_id'],
            '{{%district}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'fk_prop_province',
            '{{%mgf_proposal}}',
            ['province_id'],
            '{{%province}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'mgf_proposal_ibfk_1',
            '{{%mgf_proposal}}',
            ['organisation_id'],
            '{{%mgf_organisation}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
    }

    public function down()
    {
        $this->dropTable('{{%mgf_proposal}}');
    }
}
