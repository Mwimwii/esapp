<?php

use yii\db\Migration;

class m210523_092653_030_create_table_user extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%user}}',
            [
                'id' => $this->primaryKey(),
                'username' => $this->string()->notNull(),
                'auth_key' => $this->string(32)->notNull(),
                'password_hash' => $this->string()->notNull(),
                'password_reset_token' => $this->string(),
                'email' => $this->string()->notNull(),
                'status' => $this->smallInteger()->notNull()->defaultValue('10'),
                'created_at' => $this->integer()->notNull(),
                'updated_at' => $this->integer()->notNull(),
                'verification_token' => $this->string(),
            ],
            $tableOptions
        );

        $this->createIndex('password_reset_token', '{{%user}}', ['password_reset_token'], true);
        $this->createIndex('email', '{{%user}}', ['email'], true);
        $this->createIndex('username', '{{%user}}', ['username'], true);
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}
