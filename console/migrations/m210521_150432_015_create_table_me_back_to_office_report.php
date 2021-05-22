<?php

use yii\db\Migration;

class m210521_150432_015_create_table_me_back_to_office_report extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%me_back_to_office_report}}',
            [
                'id' => $this->primaryKey(),
                'start_date' => $this->date()->notNull(),
                'end_date' => $this->date()->notNull(),
                'name_of_officer' => $this->string(45)->notNull(),
                'team_members' => $this->text(),
                'key_partners' => $this->text()->comment('Key partners in each location/site visited'),
                'purpose_of_assignment' => $this->text()->notNull(),
                'summary_of_assignment_outcomes' => $this->text()->notNull(),
                'key_findings' => $this->text()->notNull(),
                'key_recommendations' => $this->text()->notNull()->comment('Key Recommendations/Actions to be taken, by whom'),
                'copy_sent_to' => $this->text(),
                'annexes' => $this->text(),
                'status' => $this->integer()->notNull()->defaultValue('0')->comment('Pending submission for review=0, Reviewed and accepted=1,Submitted for review=2,Reviewed and sent back for more information=3'),
                'reviewer_comments' => $this->string(45),
                'created_at' => $this->integer()->unsigned()->notNull(),
                'updated_at' => $this->integer()->unsigned()->notNull(),
                'created_by' => $this->integer(),
                'updated_by' => $this->integer(),
            ],
            $tableOptions
        );
    }

    public function down()
    {
        $this->dropTable('{{%me_back_to_office_report}}');
    }
}
