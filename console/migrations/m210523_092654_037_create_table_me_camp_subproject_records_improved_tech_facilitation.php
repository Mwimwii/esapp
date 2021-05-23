<?php

use yii\db\Migration;

class m210523_092654_037_create_table_me_camp_subproject_records_improved_tech_facilitation extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%me_camp_subproject_records_improved_tech_facilitation}}',
            [
                'id' => $this->primaryKey(),
                'camp_id' => $this->integer()->unsigned()->notNull(),
                'output_level_indicator_id' => $this->integer()->notNull(),
                'year' => $this->string(5)->notNull(),
                'quarter' => $this->string(4),
                'created_at' => $this->integer()->unsigned()->notNull(),
                'updated_at' => $this->integer()->unsigned()->notNull(),
                'created_by' => $this->integer(),
                'updated_by' => $this->integer(),
            ],
            $tableOptions
        );

        $this->createIndex('fk_me_camp_subproject_improved_tech_facilitation_1_idx', '{{%me_camp_subproject_records_improved_tech_facilitation}}', ['output_level_indicator_id']);

        $this->addForeignKey(
            'fk_me_camp_subproject_improved_tech_facilitation_1',
            '{{%me_camp_subproject_records_improved_tech_facilitation}}',
            ['output_level_indicator_id'],
            '{{%me_camp_subproject_records_output_level_indicators}}',
            ['id'],
            'NO ACTION',
            'NO ACTION'
        );
    }

    public function down()
    {
        $this->dropTable('{{%me_camp_subproject_records_improved_tech_facilitation}}');
    }
}
