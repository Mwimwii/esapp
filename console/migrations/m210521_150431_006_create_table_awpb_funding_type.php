<?php

use yii\db\Migration;

class m210521_150431_006_create_table_awpb_funding_type extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%awpb_funding_type}}',
            [
                'id' => $this->primaryKey(),
                'funding_type_code' => $this->string(6)->notNull(),
                'funding_type_name' => $this->string()->notNull(),
                'created_at' => $this->integer()->unsigned()->notNull(),
                'updated_at' => $this->integer()->unsigned()->notNull(),
                'created_by' => $this->integer(),
                'updated_by' => $this->integer(),
            ],
            $tableOptions
        );

        $this->createIndex('funding_type_code', '{{%awpb_funding_type}}', ['funding_type_code'], true);
    }

    public function down()
    {
        $this->dropTable('{{%awpb_funding_type}}');
    }
}
