<?php

use yii\db\Migration;

class m210523_092656_054_create_table_me_faabs_groups extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%me_faabs_groups}}',
            [
                'id' => $this->primaryKey(),
                'camp_id' => $this->integer()->unsigned()->notNull(),
                'name' => $this->string()->notNull(),
                'code' => $this->string(20),
                'status' => $this->integer()->defaultValue('1'),
                'created_at' => $this->integer()->unsigned()->notNull(),
                'updated_at' => $this->integer()->unsigned()->notNull(),
                'created_by' => $this->integer(),
                'updated_by' => $this->integer(),
            ],
            $tableOptions
        );

        $this->createIndex('fk_me_faabs_groups_1_idx', '{{%me_faabs_groups}}', ['camp_id']);

        $this->addForeignKey(
            'fk_me_faabs_groups_1',
            '{{%me_faabs_groups}}',
            ['camp_id'],
            '{{%camp}}',
            ['id'],
            'NO ACTION',
            'NO ACTION'
        );
    }

    public function down()
    {
        $this->dropTable('{{%me_faabs_groups}}');
    }
}
