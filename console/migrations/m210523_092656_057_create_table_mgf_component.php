<?php

use yii\db\Migration;

class m210523_092656_057_create_table_mgf_component extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%mgf_component}}',
            [
                'id' => $this->primaryKey(),
                'component_no' => $this->integer()->notNull(),

                'component_name' => $this->string(100)->notNull(),
                'subtotal' => $this->decimal(12, 2)->notNull()->defaultValue('0.00'),
                'proposal_id' => $this->integer()->notNull(),
                'activities' => $this->integer()->notNull()->defaultValue('0'),
                'date_created' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
                'createdby' => $this->integer()->notNull(),
            ],
            $tableOptions
        );

        $this->createIndex('proposal_id', '{{%mgf_component}}', ['proposal_id']);
        $this->createIndex('createdby', '{{%mgf_component}}', ['createdby']);

        $this->addForeignKey(
            'mgf_component_ibfk_1',
            '{{%mgf_component}}',
            ['createdby'],
            '{{%users}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'mgf_component_ibfk_2',
            '{{%mgf_component}}',
            ['proposal_id'],
            '{{%mgf_proposal}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
    }

    public function down()
    {
        $this->dropTable('{{%mgf_component}}');
    }
}
