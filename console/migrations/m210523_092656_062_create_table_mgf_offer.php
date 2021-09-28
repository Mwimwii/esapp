<?php

use yii\db\Migration;

class m210523_092656_062_create_table_mgf_offer extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%mgf_offer}}',
            [
                'id' => $this->primaryKey(),
                'proposal_id' => $this->integer()->notNull(),
                'organisation_id' => $this->integer()->notNull(),
                'status' => $this->string(),
                'amountoffered' => $this->decimal(12, 2)->notNull(),
                'contribution' => $this->decimal(12, 2)->notNull(),
                'responded' => $this->boolean()->defaultValue('0'),
                'date_created' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
                'date_responde' => $this->timestamp(),
                'createdby' => $this->integer()->notNull(),
            ],
            $tableOptions
        );

        $this->createIndex('organisation_id', '{{%mgf_offer}}', ['organisation_id']);
        $this->createIndex('proposal_id', '{{%mgf_offer}}', ['proposal_id']);
        $this->createIndex('createdby', '{{%mgf_offer}}', ['createdby']);

        $this->addForeignKey(
            'mgf_offer_ibfk_1',
            '{{%mgf_offer}}',
            ['createdby'],
            '{{%users}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'mgf_offer_ibfk_2',
            '{{%mgf_offer}}',
            ['proposal_id'],
            '{{%mgf_proposal}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'mgf_offer_ibfk_3',
            '{{%mgf_offer}}',
            ['organisation_id'],
            '{{%mgf_organisation}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
    }

    public function down()
    {
        $this->dropTable('{{%mgf_offer}}');
    }
}
