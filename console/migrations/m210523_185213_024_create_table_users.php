<?php

use yii\db\Migration;

class m210523_185213_024_create_table_users extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%users}}',
            [
                'id' => $this->primaryKey(),
                'role' => $this->integer()->notNull(),
                'first_name' => $this->string()->notNull(),
                'last_name' => $this->string()->notNull(),
                'other_name' => $this->string()->defaultValue(''),
                'title' => $this->string(10)->defaultValue(''),
                'sex' => $this->string(7)->defaultValue('Male'),
                'phone' => $this->string(45),
                'nrc' => $this->string(45),
                'username' => $this->string()->notNull(),
                'email' => $this->string()->notNull()->defaultValue(''),
                'status' => $this->smallInteger()->notNull()->defaultValue('10'),
                'auth_key' => $this->string(32)->notNull(),
                'password' => $this->string()->notNull()->defaultValue(''),
                'password_reset_token' => $this->string(),
                'verification_token' => $this->string(),
                'camp_id' => $this->integer()->unsigned(),
                'district_id' => $this->integer()->unsigned(),
                'province_id' => $this->integer()->unsigned(),
                'updated_by' => $this->integer(),
                'created_by' => $this->integer(),
                'created_at' => $this->integer()->unsigned()->notNull(),
                'updated_at' => $this->integer()->unsigned()->notNull(),
                'type_of_user' => $this->string(45)->defaultValue('Other user')->comment('Type of user different from role. This is there to ammodate users that belong to camps, districts or province
        Available types {Camp user, District user, Provincial user, Other user}'),
            ],
            $tableOptions
        );

        $this->createIndex('fk_users_1_idx', '{{%users}}', ['role']);
        $this->createIndex('fk_users_2_idx', '{{%users}}', ['camp_id']);
        $this->createIndex('fk_users_3_idx', '{{%users}}', ['district_id']);
        $this->createIndex('fk_users_4_idx', '{{%users}}', ['province_id']);

        $this->addForeignKey(
            'fk_users_1',
            '{{%users}}',
            ['role'],
            '{{%roles}}',
            ['id'],
            'NO ACTION',
            'NO ACTION'
        );
    }

    public function down()
    {
        $this->dropTable('{{%users}}');
    }
}
