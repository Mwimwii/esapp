<?php

use yii\db\Migration;

class m210522_234153_043_create_table_camp extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%camp}}',
            [
                'id' => $this->primaryKey()->unsigned(),
                'district_id' => $this->integer()->unsigned()->notNull(),
                'name' => $this->string()->notNull(),
                'description' => $this->text(),
                'latitude' => $this->string(30),
                'longitude' => $this->string(30),
                'created_at' => $this->integer()->unsigned()->notNull(),
                'updated_at' => $this->integer()->unsigned()->notNull(),
                'created_by' => $this->integer(),
                'updated_by' => $this->integer(),
            ],
            $tableOptions
        );

        $this->createIndex('fk_camp_1_idx', '{{%camp}}', ['district_id']);

        $this->addForeignKey(
            'fk_camp_1',
            '{{%camp}}',
            ['district_id'],
            '{{%district}}',
            ['id'],
            'NO ACTION',
            'NO ACTION'
        );
    }

    public function down()
    {
        $this->dropTable('{{%camp}}');
    }
}
