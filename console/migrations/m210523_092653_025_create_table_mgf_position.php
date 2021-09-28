<?php

use yii\db\Migration;

class m210523_092653_025_create_table_mgf_position extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%mgf_position}}',
            [
                'id' => $this->primaryKey(),
                'position' => $this->string(30)->notNull(),
                'date_created' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            ],
            $tableOptions
        );

        $this->createIndex('position', '{{%mgf_position}}', ['position'], true);
    }

    public function down()
    {
        $this->dropTable('{{%mgf_position}}');
    }
}
