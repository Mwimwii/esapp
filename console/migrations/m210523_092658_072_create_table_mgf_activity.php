<?php

use yii\db\Migration;

class m210523_092658_072_create_table_mgf_activity extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%mgf_activity}}',
            [
                'id' => $this->primaryKey(),
                'activity_no' => $this->integer()->notNull(),
                'activity_name' => $this->string(40)->notNull(),
                'subtotal' => $this->decimal(12, 2)->notNull()->defaultValue('0.00'),
                'componet_id' => $this->integer()->notNull(),
                'inputs' => $this->integer()->notNull()->defaultValue('0'),
                'date_created' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
                'createdby' => $this->integer()->notNull(),
            ],
            $tableOptions
        );

        $this->createIndex('componet_id', '{{%mgf_activity}}', ['componet_id']);
        $this->createIndex('createdby', '{{%mgf_activity}}', ['createdby']);

        $this->addForeignKey(
            'mgf_activity_ibfk_1',
            '{{%mgf_activity}}',
            ['createdby'],
            '{{%users}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'mgf_activity_ibfk_2',
            '{{%mgf_activity}}',
            ['componet_id'],
            '{{%mgf_component}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
    }

    public function down()
    {
        $this->dropTable('{{%mgf_activity}}');
    }
}
