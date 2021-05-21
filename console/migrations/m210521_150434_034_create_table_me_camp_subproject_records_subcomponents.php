<?php

use yii\db\Migration;

class m210521_150434_034_create_table_me_camp_subproject_records_subcomponents extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%me_camp_subproject_records_subcomponents}}',
            [
                'id' => $this->primaryKey(),
                'facilitation_id' => $this->integer()->notNull(),
                'sub_component' => $this->string()->notNull(),
                'females' => $this->string(45)->notNull()->defaultValue('0'),
                'males' => $this->string(45)->notNull()->defaultValue('0'),
                'women_headed' => $this->string(45)->notNull()->defaultValue('0'),
                'youth' => $this->string(45)->notNull()->defaultValue('0'),
                'created_at' => $this->integer()->unsigned()->notNull(),
                'updated_at' => $this->integer()->unsigned()->notNull(),
                'created_by' => $this->integer(),
                'updated_by' => $this->integer(),
            ],
            $tableOptions
        );

        $this->createIndex('fk_me_camp_subproject_records_subcomponents_1_idx', '{{%me_camp_subproject_records_subcomponents}}', ['facilitation_id']);

        $this->addForeignKey(
            'fk_me_camp_subproject_records_subcomponents_1',
            '{{%me_camp_subproject_records_subcomponents}}',
            ['facilitation_id'],
            '{{%me_camp_subproject_records_improved_tech_facilitation}}',
            ['id'],
            'NO ACTION',
            'NO ACTION'
        );
    }

    public function down()
    {
        $this->dropTable('{{%me_camp_subproject_records_subcomponents}}');
    }
}
