<?php

use yii\db\Migration;

class m210523_092656_052_create_table_me_camp_subproject_records_awpb_objectives extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%me_camp_subproject_records_awpb_objectives}}',
            [
                'id' => $this->primaryKey(),
                'camp_id' => $this->integer()->unsigned()->notNull(),
                'quarter' => $this->integer()->notNull(),
                'key_indicators' => $this->text()->notNull(),
                'period_unit' => $this->string()->notNull(),
                'target' => $this->string()->notNull(),
                'year' => $this->string(5)->notNull(),
                'created_at' => $this->integer()->unsigned()->notNull(),
                'updated_at' => $this->integer()->unsigned()->notNull(),
                'created_by' => $this->integer(),
                'updated_by' => $this->integer(),
            ],
            $tableOptions
        );

        $this->createIndex('fk_me_camp_subproject_records_awpb_objectives_1_idx', '{{%me_camp_subproject_records_awpb_objectives}}', ['camp_id']);

        $this->addForeignKey(
            'fk_me_camp_subproject_records_awpb_objectives_1',
            '{{%me_camp_subproject_records_awpb_objectives}}',
            ['camp_id'],
            '{{%camp}}',
            ['id'],
            'NO ACTION',
            'NO ACTION'
        );
    }

    public function down()
    {
        $this->dropTable('{{%me_camp_subproject_records_awpb_objectives}}');
    }
}
