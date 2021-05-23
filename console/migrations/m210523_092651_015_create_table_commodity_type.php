<?php

use yii\db\Migration;

class m210523_092651_015_create_table_commodity_type extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%commodity_type}}',
            [
                'id' => $this->primaryKey(10)->unsigned(),
                'category_id' => $this->integer()->unsigned()->notNull(),
                'name' => $this->string()->notNull(),
                'created_at' => $this->integer()->unsigned()->notNull(),
                'updated_at' => $this->integer()->unsigned()->notNull(),
                'created_by' => $this->integer(),
                'updated_by' => $this->integer(),
            ],
            $tableOptions
        );

        $this->createIndex('fk_commodity_type_1_idx', '{{%commodity_type}}', ['category_id']);

        $this->addForeignKey(
            'fk_commodity_type_1',
            '{{%commodity_type}}',
            ['category_id'],
            '{{%commodity_category}}',
            ['id'],
            'NO ACTION',
            'NO ACTION'
        );
    }

    public function down()
    {
        $this->dropTable('{{%commodity_type}}');
    }
}
