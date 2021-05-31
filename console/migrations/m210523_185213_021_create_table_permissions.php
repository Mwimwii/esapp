<?php

use yii\db\Migration;

class m210523_185213_021_create_table_permissions extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%permissions}}',
            [
                'id' => $this->primaryKey(),
                'right' => $this->text(),
                'definition' => $this->text(),
                'active' => $this->integer()->notNull()->defaultValue('1'),
            ],
            $tableOptions
        );
    }

    public function down()
    {
        $this->dropTable('{{%permissions}}');
    }
}
