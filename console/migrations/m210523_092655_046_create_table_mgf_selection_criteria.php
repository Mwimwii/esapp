<?php

use yii\db\Migration;

class m210523_092655_046_create_table_mgf_selection_criteria extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%mgf_selection_criteria}}',
            [
                'id' => $this->primaryKey(),
                'criterion' => $this->text()->notNull(),
                'category_id' => $this->integer()->notNull(),
                'date_created' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
                'createdby' => $this->integer()->notNull(),
            ],
            $tableOptions
        );

        $this->createIndex('category_id', '{{%mgf_selection_criteria}}', ['category_id']);
        $this->createIndex('createdby', '{{%mgf_selection_criteria}}', ['createdby']);

        $this->addForeignKey(
            'mgf_selection_criteria_ibfk_1',
            '{{%mgf_selection_criteria}}',
            ['createdby'],
            '{{%users}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'mgf_selection_criteria_ibfk_2',
            '{{%mgf_selection_criteria}}',
            ['category_id'],
            '{{%mgf_selection_category}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
    }

    public function down()
    {
        $this->dropTable('{{%mgf_selection_criteria}}');
    }
}
