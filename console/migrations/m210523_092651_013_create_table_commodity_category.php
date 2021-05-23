<?php

use yii\db\Migration;

class m210523_092651_013_create_table_commodity_category extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%commodity_category}}',
            [
                'id' => $this->primaryKey(10)->unsigned(),
                'name' => $this->string()->notNull(),
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
        $this->dropTable('{{%commodity_category}}');
    }
}
