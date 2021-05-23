<?php

use yii\db\Migration;

class m210523_185213_007_create_table_awpb_template extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%awpb_template}}',
            [
                'id' => $this->primaryKey(),
                'fiscal_year' => $this->integer()->notNull(),
                'budget_theme' => $this->text()->notNull(),
                'comment' => $this->text()->notNull(),
                'guideline_file' => $this->string(),
                'status' => $this->integer()->notNull()->comment('0 Closed, 1 open, 2 Blockedsed'),
                'created_at' => $this->integer()->unsigned()->notNull(),
                'updated_at' => $this->integer()->unsigned()->notNull(),
                'created_by' => $this->integer(),
                'updated_by' => $this->integer(),
            ],
            $tableOptions
        );

        $this->createIndex('fiscal_year', '{{%awpb_template}}', ['fiscal_year'], true);
    }

    public function down()
    {
        $this->dropTable('{{%awpb_template}}');
    }
}
