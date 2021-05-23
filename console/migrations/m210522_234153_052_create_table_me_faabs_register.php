<?php

use yii\db\Migration;

class m210522_234153_052_create_table_me_faabs_register extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%me_faabs_register}}',
            [
                'id' => $this->primaryKey(),
                'faabs_group_id' => $this->integer()->notNull(),
                'farmer_id' => $this->integer()->notNull(),
                'present' => $this->string()->defaultValue('Yes'),
                'date' => $this->date()->notNull(),
                'topic' => $this->text()->notNull()->comment('Topic or session covered i.e. Village Chicken housing'),
                'created_at' => $this->integer()->unsigned()->notNull(),
                'updated_at' => $this->integer()->unsigned()->notNull(),
                'created_by' => $this->integer(),
                'updated_by' => $this->integer(),
            ],
            $tableOptions
        );

        $this->createIndex('fk_me_faabs_register_1_idx', '{{%me_faabs_register}}', ['farmer_id']);
        $this->createIndex('fk_me_faabs_register_2_idx', '{{%me_faabs_register}}', ['faabs_group_id']);

        $this->addForeignKey(
            'fk_me_faabs_register_1',
            '{{%me_faabs_register}}',
            ['farmer_id'],
            '{{%me_faabs_category_a_farmers}}',
            ['id'],
            'NO ACTION',
            'NO ACTION'
        );
        $this->addForeignKey(
            'fk_me_faabs_register_2',
            '{{%me_faabs_register}}',
            ['faabs_group_id'],
            '{{%me_faabs_groups}}',
            ['id'],
            'NO ACTION',
            'NO ACTION'
        );
    }

    public function down()
    {
        $this->dropTable('{{%me_faabs_register}}');
    }
}
