<?php

use yii\db\Migration;

class m210523_092655_051_create_table_commodity_price_collection extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%commodity_price_collection}}',
            [
                'id' => $this->primaryKey(10)->unsigned(),
                'district' => $this->integer()->unsigned()->notNull(),
                'market_id' => $this->integer()->unsigned()->notNull(),
                'commodity_type_id' => $this->integer()->unsigned()->notNull(),
                'price_level_id' => $this->integer()->unsigned()->notNull(),
                'unit_of_measure' => $this->string(45),
                'price' => $this->double()->notNull(),
                'description' => $this->text(),
                'month' => $this->string(3)->notNull(),
                'year' => $this->string(11)->notNull(),
                'created_at' => $this->integer()->unsigned()->notNull(),
                'updated_at' => $this->integer()->unsigned()->notNull(),
                'created_by' => $this->integer(),
                'updated_by' => $this->integer(),
            ],
            $tableOptions
        );

        $this->createIndex('fk_commodity_price_collection_1_idx', '{{%commodity_price_collection}}', ['district']);
        $this->createIndex('fk_commodity_price_collection_3_idx', '{{%commodity_price_collection}}', ['market_id']);
        $this->createIndex('fk_commodity_price_collection_4_idx', '{{%commodity_price_collection}}', ['commodity_type_id']);
        $this->createIndex('fk_commodity_price_collection_2_idx', '{{%commodity_price_collection}}', ['price_level_id']);

        $this->addForeignKey(
            'fk_commodity_price_collection_1',
            '{{%commodity_price_collection}}',
            ['district'],
            '{{%district}}',
            ['id'],
            'NO ACTION',
            'NO ACTION'
        );
        $this->addForeignKey(
            'fk_commodity_price_collection_2',
            '{{%commodity_price_collection}}',
            ['price_level_id'],
            '{{%commodity_price_level}}',
            ['id'],
            'NO ACTION',
            'NO ACTION'
        );
        $this->addForeignKey(
            'fk_commodity_price_collection_3',
            '{{%commodity_price_collection}}',
            ['market_id'],
            '{{%market}}',
            ['id'],
            'NO ACTION',
            'NO ACTION'
        );
        $this->addForeignKey(
            'fk_commodity_price_collection_4',
            '{{%commodity_price_collection}}',
            ['commodity_type_id'],
            '{{%commodity_type}}',
            ['id'],
            'NO ACTION',
            'NO ACTION'
        );
    }

    public function down()
    {
        $this->dropTable('{{%commodity_price_collection}}');
    }
}
