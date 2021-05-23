<?php

use yii\db\Migration;

class m210523_092650_002_create_table_awpb_activity_funder extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%awpb_activity_funder}}',
            [
                'id' => $this->primaryKey(),
                'activity_id' => $this->integer()->notNull(),
                'funder_id' => $this->integer()->notNull(),
                'amount' => $this->double()->notNull(),
                'percentage' => $this->double()->notNull(),
            ],
            $tableOptions
        );

        $this->createIndex('funder_id', '{{%awpb_activity_funder}}', ['funder_id']);
        $this->createIndex('activity_id', '{{%awpb_activity_funder}}', ['activity_id']);
    }

    public function down()
    {
        $this->dropTable('{{%awpb_activity_funder}}');
    }
}
