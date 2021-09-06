<?php

use yii\db\Migration;

class m210523_092652_024_create_table_mgf_operation extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%mgf_operation}}',
            [
                'id' => $this->primaryKey(),
                'operation_type' => $this->string(30)->notNull(),
                'date_created' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            ],
            $tableOptions
        );

        $this->createIndex('operation_type', '{{%mgf_operation}}', ['operation_type'], true);
    }

    public function down()
    {
        $this->dropTable('{{%mgf_operation}}');
    }
}
