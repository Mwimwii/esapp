<?php

use yii\db\Migration;

class m210523_092655_049_create_table_right_to_role extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%right_to_role}}',
            [
                'id' => $this->primaryKey(),
                'role' => $this->integer()->notNull(),
                'right' => $this->text(),
                'active' => $this->integer()->defaultValue('1'),
            ],
            $tableOptions
        );

        $this->createIndex('fk_right_to_role_1_idx', '{{%right_to_role}}', ['role']);

        $this->addForeignKey(
            'fk_right_to_role_1',
            '{{%right_to_role}}',
            ['role'],
            '{{%roles}}',
            ['id'],
            'NO ACTION',
            'NO ACTION'
        );
    }

    public function down()
    {
        $this->dropTable('{{%right_to_role}}');
    }
}
