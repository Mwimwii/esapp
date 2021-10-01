<?php

use yii\db\Migration;

class m210523_092654_040_create_table_mgf_approval_status extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%mgf_approval_status}}',
            [
                'id' => $this->primaryKey(),
                'approval_status' => $this->string(),
                'lowerlimit' => $this->string(5)->notNull(),
                'upperlimit' => $this->string(5)->notNull(),
                'user_id' => $this->integer()->notNull(),
                'date_created' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            ],
            $tableOptions
        );

        $this->createIndex('user_id', '{{%mgf_approval_status}}', ['user_id']);

        $this->addForeignKey(
            'mgf_approval_status_ibfk_1',
            '{{%mgf_approval_status}}',
            ['user_id'],
            '{{%users}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
    }

    public function down()
    {
        $this->dropTable('{{%mgf_approval_status}}');
    }
}
