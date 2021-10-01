<?php

use yii\db\Migration;

class m210523_092655_045_create_table_mgf_selection_category extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%mgf_selection_category}}',
            [
                'id' => $this->primaryKey(),
                'category' => $this->text()->notNull(),
                'date_created' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
                'createdby' => $this->integer()->notNull(),
            ],
            $tableOptions
        );

        $this->createIndex('createdby', '{{%mgf_selection_category}}', ['createdby']);

        $this->addForeignKey(
            'mgf_selection_category_ibfk_1',
            '{{%mgf_selection_category}}',
            ['createdby'],
            '{{%users}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
    }

    public function down()
    {
        $this->dropTable('{{%mgf_selection_category}}');
    }
}
