<?php

use yii\db\Migration;

class m210523_092655_043_create_table_mgf_partnership extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%mgf_partnership}}',
            [
                'id' => $this->primaryKey(),
                'partner_name' => $this->string(50)->notNull(),
                'partnership_aim' => $this->string(50)->notNull(),
                'start_date' => $this->date()->notNull(),
                'end_date' => $this->date()->notNull(),
                'partnership_status' => $this->string()->notNull(),
                'experience_id' => $this->integer()->notNull(),
                'organisation_id' => $this->integer()->notNull(),
                'date_created' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            ],
            $tableOptions
        );

        $this->createIndex('organisation_id', '{{%mgf_partnership}}', ['organisation_id']);

        $this->addForeignKey(
            'mgf_partnership_ibfk_1',
            '{{%mgf_partnership}}',
            ['organisation_id'],
            '{{%mgf_organisation}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
    }

    public function down()
    {
        $this->dropTable('{{%mgf_partnership}}');
    }
}
