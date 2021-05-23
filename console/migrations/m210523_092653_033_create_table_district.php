<?php

use yii\db\Migration;

class m210523_092653_033_create_table_district extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%district}}',
            [
                'id' => $this->primaryKey()->unsigned(),
                'province_id' => $this->integer()->unsigned()->notNull(),
                'name' => $this->string()->notNull(),
                'lat' => $this->string(20),
                'long' => $this->string(20),
                'created_at' => $this->integer()->unsigned()->notNull(),
                'updated_at' => $this->integer()->unsigned()->notNull(),
                'created_by' => $this->integer(),
                'updated_by' => $this->integer(),
            ],
            $tableOptions
        );

        $this->addForeignKey(
            'fk_district_province',
            '{{%district}}',
            ['province_id'],
            '{{%province}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
    }

    public function down()
    {
        $this->dropTable('{{%district}}');
    }
}
