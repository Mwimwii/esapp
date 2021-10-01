<?php

use yii\db\Migration;

class m210523_092656_063_create_table_mgf_pastproject extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%mgf_pastproject}}',
            [
                'id' => $this->primaryKey(),
                'project_name' => $this->string(50)->notNull(),
                'years_assisted' => $this->integer()->notNull(),
                'amount_assisted' => $this->decimal()->notNull(),
                'obligations_met' => $this->string()->notNull(),
                'outcome_response' => $this->text()->notNull(),
                'organisation_id' => $this->integer()->notNull(),
                'experience_id' => $this->integer()->notNull(),
                'date_created' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            ],
            $tableOptions
        );

        $this->createIndex('experience_id', '{{%mgf_pastproject}}', ['experience_id']);
        $this->createIndex('organisation_id', '{{%mgf_pastproject}}', ['organisation_id']);

        $this->addForeignKey(
            'mgf_pastproject_ibfk_1',
            '{{%mgf_pastproject}}',
            ['organisation_id'],
            '{{%mgf_organisation}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'mgf_pastproject_ibfk_2',
            '{{%mgf_pastproject}}',
            ['experience_id'],
            '{{%mgf_experience}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
    }

    public function down()
    {
        $this->dropTable('{{%mgf_pastproject}}');
    }
}
