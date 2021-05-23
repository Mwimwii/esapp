<?php

use yii\db\Migration;

class m210522_234152_010_create_table_commodity_price_level extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%commodity_price_level}}',
            [
                'id' => $this->primaryKey()->unsigned(),
                'level' => $this->string(45)->notNull(),
                'description' => $this->text(),
                'created_at' => $this->integer()->unsigned()->notNull(),
                'updated_at' => $this->integer()->unsigned()->notNull(),
                'created_by' => $this->integer(),
                'updated_by' => $this->integer(),
            ],
            $tableOptions
        );
    }

    public function down()
    {
        $this->dropTable('{{%commodity_price_level}}');
    }
}
