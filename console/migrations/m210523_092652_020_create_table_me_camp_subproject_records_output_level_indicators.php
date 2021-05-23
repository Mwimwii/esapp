<?php

use yii\db\Migration;

class m210523_092652_020_create_table_me_camp_subproject_records_output_level_indicators extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%me_camp_subproject_records_output_level_indicators}}',
            [
                'id' => $this->primaryKey(),
                'indicator' => $this->text()->notNull(),
            ],
            $tableOptions
        );
    }

    public function down()
    {
        $this->dropTable('{{%me_camp_subproject_records_output_level_indicators}}');
    }
}
