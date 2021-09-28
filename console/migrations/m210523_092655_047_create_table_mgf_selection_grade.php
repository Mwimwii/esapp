<?php

use yii\db\Migration;

class m210523_092655_047_create_table_mgf_selection_grade extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%mgf_selection_grade}}',
            [
                'id' => $this->primaryKey(),
                'grade' => $this->string(70)->notNull(),
                'criterion_id' => $this->integer()->notNull(),
                'awardedscore' => $this->integer(2)->notNull(),
                'date_created' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
                'createdby' => $this->integer()->notNull(),
            ],
            $tableOptions
        );

        $this->createIndex('criterion_id', '{{%mgf_selection_grade}}', ['criterion_id']);
        $this->createIndex('createdby', '{{%mgf_selection_grade}}', ['createdby']);

        $this->addForeignKey(
            'mgf_selection_grade_ibfk_1',
            '{{%mgf_selection_grade}}',
            ['createdby'],
            '{{%users}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'mgf_selection_grade_ibfk_2',
            '{{%mgf_selection_grade}}',
            ['criterion_id'],
            '{{%mgf_selection_criteria}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
    }

    public function down()
    {
        $this->dropTable('{{%mgf_selection_grade}}');
    }
}
