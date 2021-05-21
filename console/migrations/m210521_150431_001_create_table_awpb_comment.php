<?php

use yii\db\Migration;

class m210521_150431_001_create_table_awpb_comment extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%awpb_comment}}',
            [
                'id' => $this->primaryKey(),
                'awpb_template_id' => $this->integer()->notNull(),
                'district_id' => $this->integer(),
                'province_id' => $this->integer(),
                'description' => $this->text()->notNull(),
                'created_at' => $this->integer()->unsigned()->notNull(),
                'updated_at' => $this->integer()->unsigned()->notNull(),
                'created_by' => $this->integer(),
                'updated_by' => $this->integer(),
            ],
            $tableOptions
        );
    }

    public function down()
    {
        $this->dropTable('{{%awpb_comment}}');
    }
}
