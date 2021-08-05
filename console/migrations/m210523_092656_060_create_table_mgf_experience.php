<?php

use yii\db\Migration;

class m210523_092656_060_create_table_mgf_experience extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%mgf_experience}}',
            [
                'id' => $this->primaryKey(),
                'financed_before' => $this->string(),
                'any_collaboration' => $this->string(),
                'collaboration_will' => $this->string(),
                'collaboration_ready' => $this->string(),
                'organisation_id' => $this->integer()->notNull(),
                'date_created' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            ],
            $tableOptions
        );

        $this->createIndex('organisation_id', '{{%mgf_experience}}', ['organisation_id']);

        $this->addForeignKey(
            'mgf_experience_ibfk_1',
            '{{%mgf_experience}}',
            ['organisation_id'],
            '{{%mgf_organisation}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
    }

    public function down()
    {
        $this->dropTable('{{%mgf_experience}}');
    }
}
