<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "mgf_declaration".
 *
 * @property int $id
 * @property string|null $declaration_parta
 * @property string|null $declaration_partb
 * @property string|null $declaration_partc
 * @property string|null $rep_name
 * @property int|null $rep_aproval
 * @property string|null $approval_date
 * @property string|null $rep_title
 * @property string|null $address
 * @property string|null $phone
 * @property string|null $email
 * @property int $project_id
 * @property string $date_created
 * @property string $date_update
 * @property int $created_by
 * @property int|null $updated_by
 */
class MgfDeclaration extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mgf_declaration';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rep_aproval', 'project_id', 'created_by', 'updated_by'], 'integer'],
            [['approval_date', 'date_created', 'date_update'], 'safe'],
            [['project_id', 'created_by'], 'required'],
            [['declaration_parta', 'declaration_partb', 'declaration_partc'], 'string', 'max' => 300],
            [['rep_name', 'rep_title'], 'string', 'max' => 100],
            [['address'], 'string', 'max' => 200],
            [['phone'], 'string', 'max' => 15],
            [['email'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'declaration_parta' => 'Declaration Parta',
            'declaration_partb' => 'Declaration Partb',
            'declaration_partc' => 'Declaration Partc',
            'rep_name' => 'Rep Name',
            'rep_aproval' => 'Rep Aproval',
            'approval_date' => 'Approval Date',
            'rep_title' => 'Rep Title',
            'address' => 'Address',
            'phone' => 'Phone',
            'email' => 'Email',
            'project_id' => 'Project ID',
            'date_created' => 'Date Created',
            'date_update' => 'Date Update',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }
}
