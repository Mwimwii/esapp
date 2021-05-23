<?php

use yii\db\Migration;

class m210523_092650_003_create_table_awpb_activity_line extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%awpb_activity_line}}',
            [
                'id' => $this->primaryKey(),
                'activity_id' => $this->integer()->notNull(),
                'name' => $this->string()->notNull(),
                'unit_cost' => $this->double()->notNull(),
                'mo_1' => $this->double(),
                'mo_2' => $this->double(),
                'mo_3' => $this->double(),
                'mo_4' => $this->double(),
                'mo_5' => $this->double(),
                'mo_6' => $this->double(),
                'mo_7' => $this->double(),
                'mo_8' => $this->double(),
                'mo_9' => $this->double(),
                'mo_10' => $this->double(),
                'mo_11' => $this->double(),
                'mo_12' => $this->double(),
                'quarter_one_quantity' => $this->double(),
                'quarter_two_quantity' => $this->double(),
                'quarter_three_quantity' => $this->double(),
                'quarter_four_quantity' => $this->double(),
                'total_quantity' => $this->double()->notNull(),
                'total_amount' => $this->double()->notNull(),
                'mo_1_actual' => $this->double(),
                'mo_2_actual' => $this->double(),
                'mo_3_actual' => $this->double(),
                'mo_4_actual' => $this->double(),
                'mo_5_actual' => $this->double(),
                'mo_6_actual' => $this->double(),
                'mo_7_actual' => $this->double(),
                'mo_8_actual' => $this->double(),
                'mo_9_actual' => $this->double(),
                'mo_10_actual' => $this->double(),
                'mo_11_actual' => $this->double(),
                'mo_12_actual' => $this->double(),
                'status' => $this->integer()->notNull(),
                'district_id' => $this->integer()->unsigned(),
                'province_id' => $this->integer()->unsigned(),
                'created_at' => $this->integer()->unsigned()->notNull(),
                'updated_at' => $this->integer()->unsigned()->notNull(),
                'created_by' => $this->integer(),
                'updated_by' => $this->integer(),
                'year' => $this->string(5),
            ],
            $tableOptions
        );

        $this->createIndex('province_id', '{{%awpb_activity_line}}', ['province_id']);
        $this->createIndex('district_id', '{{%awpb_activity_line}}', ['district_id']);
        $this->createIndex('activity_id', '{{%awpb_activity_line}}', ['activity_id']);
    }

    public function down()
    {
        $this->dropTable('{{%awpb_activity_line}}');
    }
}
