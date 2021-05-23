<?php

use yii\db\Migration;

class m210522_234152_034_create_table_market extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%market}}',
            [
                'id' => $this->primaryKey()->unsigned(),
                'district_id' => $this->integer()->unsigned()->notNull(),
                'name' => $this->string()->notNull(),
                'description' => $this->text(),
                'created_at' => $this->integer()->unsigned()->notNull(),
                'updated_at' => $this->integer()->unsigned()->notNull(),
                'created_by' => $this->integer(),
                'updated_by' => $this->integer(),
            ],
            $tableOptions
        );

        $this->createIndex('fk_market_1_idx', '{{%market}}', ['district_id']);

        $this->addForeignKey(
            'fk_market_1',
            '{{%market}}',
            ['district_id'],
            '{{%district}}',
            ['id'],
            'NO ACTION',
            'NO ACTION'
        );
    }

    public function down()
    {
        $this->dropTable('{{%market}}');
    }
}
