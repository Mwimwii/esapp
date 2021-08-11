<?php

use yii\db\Migration;

class m210523_092653_026_create_table_mgf_reviewer extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%mgf_reviewer}}',
            [
                'id' => $this->primaryKey(),
                'title' => $this->string(),
                'login_code' => $this->string(10)->notNull(),
                'first_name' => $this->string(30)->notNull(),
                'last_name' => $this->string(30)->notNull(),
                'mobile' => $this->string(15)->notNull(),
                'reviewer_type' => $this->string(),
                'area_of_expertise' => $this->text()->notNull(),
                'user_id' => $this->integer()->notNull(),
                'confirmed' => $this->integer()->defaultValue('0'),
                'createdBy' => $this->integer()->unsigned(),
                'total_assigned_1' => $this->integer()->defaultValue('0'),
                'total_assigned_2' => $this->integer()->defaultValue('0'),
                'email' => $this->string(50)->notNull(),
                'date_created' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            ],
            $tableOptions
        );

        $this->createIndex('login_code', '{{%mgf_reviewer}}', ['login_code'], true);
    }

    public function down()
    {
        $this->dropTable('{{%mgf_reviewer}}');
    }
}
