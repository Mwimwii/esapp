<?php

use yii\db\Migration;

class m210521_150435_047_create_table_me_faabs_category_a_farmers extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%me_faabs_category_a_farmers}}',
            [
                'id' => $this->primaryKey(),
                'faabs_group_id' => $this->integer()->notNull(),
                'first_name' => $this->string()->notNull(),
                'other_names' => $this->string(),
                'last_name' => $this->string()->notNull(),
                'sex' => $this->string(7)->notNull(),
                'dob' => $this->date()->notNull(),
                'nrc' => $this->string(20),
                'marital_status' => $this->string(15)->notNull(),
                'contact_number' => $this->string(16),
                'relationship_to_household_head' => $this->string(50),
                'registration_date' => $this->date()->notNull(),
                'status' => $this->integer()->notNull()->defaultValue('1'),
                'household_size' => $this->integer()->defaultValue('0'),
                'village' => $this->string(),
                'chiefdom' => $this->string(),
                'block' => $this->string(),
                'zone' => $this->string(),
                'commodity' => $this->string(),
                'created_at' => $this->integer()->unsigned()->notNull(),
                'updated_at' => $this->integer()->unsigned()->notNull(),
                'created_by' => $this->integer(),
                'updated_by' => $this->integer(),
                'title' => $this->string(10)->notNull(),
                'age' => $this->integer(),
            ],
            $tableOptions
        );

        $this->createIndex('fk_me_faabs_farmer_register_1_idx', '{{%me_faabs_category_a_farmers}}', ['faabs_group_id']);

        $this->addForeignKey(
            'fk_me_faabs_category_a_farmers',
            '{{%me_faabs_category_a_farmers}}',
            ['faabs_group_id'],
            '{{%me_faabs_groups}}',
            ['id'],
            'NO ACTION',
            'NO ACTION'
        );
    }

    public function down()
    {
        $this->dropTable('{{%me_faabs_category_a_farmers}}');
    }
}
