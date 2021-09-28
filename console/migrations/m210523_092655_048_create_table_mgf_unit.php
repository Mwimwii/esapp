<?php

use yii\db\Migration;

class m210523_092655_048_create_table_mgf_unit extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%mgf_unit}}',
            [
                'id' => $this->primaryKey(),
                'unit' => $this->string(30)->notNull(),
                'synonym' => $this->string(11)->notNull(),
                'user_id' => $this->integer()->notNull(),
                'date_created' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            ],
            $tableOptions
        );

        $this->createIndex('user_id', '{{%mgf_unit}}', ['user_id']);
        $this->createIndex('unit', '{{%mgf_unit}}', ['unit'], true);

        $this->addForeignKey(
            'mgf_unit_ibfk_1',
            '{{%mgf_unit}}',
            ['user_id'],
            '{{%users}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
    }

    public function down()
    {
        $this->dropTable('{{%mgf_unit}}');
    }
}
