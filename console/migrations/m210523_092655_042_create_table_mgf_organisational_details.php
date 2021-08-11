<?php

use yii\db\Migration;

class m210523_092655_042_create_table_mgf_organisational_details extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%mgf_organisational_details}}',
            [
                'id' => $this->primaryKey(),
                'mgt_Staff' => $this->integer()->notNull(),
                'senior_Staff' => $this->integer()->notNull(),
                'junior_Staff' => $this->integer()->notNull(),
                'others' => $this->integer()->notNull(),
                'last_board' => $this->date()->notNull(),
                'last_agm' => $this->date()->notNull(),
                'last_audit' => $this->date()->notNull(),
                'has_finance' => $this->string(),
                'has_resources' => $this->string(),
                'organisation_id' => $this->integer()->notNull(),
                'date_created' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            ],
            $tableOptions
        );

        $this->createIndex('organisation_id', '{{%mgf_organisational_details}}', ['organisation_id']);

        $this->addForeignKey(
            'mgf_organisational_details_ibfk_1',
            '{{%mgf_organisational_details}}',
            ['organisation_id'],
            '{{%mgf_organisation}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
    }

    public function down()
    {
        $this->dropTable('{{%mgf_organisational_details}}');
    }
}
