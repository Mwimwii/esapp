<?php

use yii\db\Migration;

class m210523_092658_075_create_table_mgf_input_item extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%mgf_input_item}}',
            [
                'id' => $this->primaryKey(),
                'item_no' => $this->integer()->notNull(),
                'input_name' => $this->string(40)->notNull(),
                'unit_of_measure' => $this->string(10)->notNull(),
                'project_year_1' => $this->decimal(9, 2)->notNull()->defaultValue('0.00'),
                'project_year_2' => $this->decimal(9, 2)->defaultValue('0.00'),
                'project_year_3' => $this->decimal(9, 2)->notNull()->defaultValue('0.00'),
                'project_year_4' => $this->decimal(9, 2)->notNull()->defaultValue('0.00'),
                'project_year_5' => $this->decimal(9, 2)->unsigned()->notNull(),
                'project_year_6' => $this->decimal(9, 2)->unsigned()->notNull(),
                'project_year_7' => $this->decimal(9, 2)->unsigned()->notNull(),
                'project_year_8' => $this->decimal(9, 2)->unsigned()->notNull(),
                'unit_cost' => $this->decimal(9, 2)->notNull(),
                'total_cost' => $this->decimal(9, 2)->notNull(),
                'comment' => $this->text()->notNull(),
                'activity_id' => $this->integer()->notNull(),
                'date_created' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
                'createdby' => $this->integer()->notNull(),
            ],
            $tableOptions
        );

        $this->createIndex('activity_id', '{{%mgf_input_item}}', ['activity_id']);
        $this->createIndex('createdby', '{{%mgf_input_item}}', ['createdby']);

        $this->addForeignKey(
            'mgf_input_item_ibfk_1',
            '{{%mgf_input_item}}',
            ['createdby'],
            '{{%users}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'mgf_input_item_ibfk_2',
            '{{%mgf_input_item}}',
            ['activity_id'],
            '{{%mgf_activity}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
    }

    public function down()
    {
        $this->dropTable('{{%mgf_input_item}}');
    }
}
