<?php

use yii\db\Migration;

class m210523_092651_010_create_table_awpb_output extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%awpb_output}}',
            [
                'id' => $this->primaryKey(),
                'output_code' => $this->string(10)->notNull(),
                'outcome_id' => $this->integer()->notNull(),
                'output_description' => $this->string()->notNull(),
                'created_at' => $this->integer()->unsigned()->notNull(),
                'updated_at' => $this->integer()->unsigned()->notNull(),
                'created_by' => $this->integer(),
                'updated_by' => $this->integer(),
            ],
            $tableOptions
        );

        $this->createIndex('outcome_id', '{{%awpb_output}}', ['outcome_id']);
        $this->createIndex('output_code', '{{%awpb_output}}', ['output_code'], true);
    }

    public function down()
    {
        $this->dropTable('{{%awpb_output}}');
    }
}
