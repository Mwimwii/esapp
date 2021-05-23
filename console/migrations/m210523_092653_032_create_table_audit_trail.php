<?php

use yii\db\Migration;

class m210523_092653_032_create_table_audit_trail extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%audit_trail}}',
            [
                'id' => $this->primaryKey()->unsigned(),
                'user' => $this->integer()->notNull(),
                'action' => $this->text()->notNull(),
                'date' => $this->integer()->unsigned()->notNull(),
                'ip_address' => $this->string()->notNull()->defaultValue(''),
                'user_agent' => $this->string()->notNull()->defaultValue(''),
            ],
            $tableOptions
        );

        $this->createIndex('fk_audit_trail_1_idx', '{{%audit_trail}}', ['user']);

        $this->addForeignKey(
            'fk_audit_trail_1',
            '{{%audit_trail}}',
            ['user'],
            '{{%users}}',
            ['id'],
            'NO ACTION',
            'NO ACTION'
        );
    }

    public function down()
    {
        $this->dropTable('{{%audit_trail}}');
    }
}
