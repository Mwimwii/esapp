<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "mgf_organisational_details".
 *
 * @property int $id
 * @property int $mgt_Staff
 * @property int $senior_Staff
 * @property int $junior_Staff
 * @property int $others
 * @property string $last_board
 * @property string $last_agm
 * @property string $last_audit
 * @property string|null $has_finance
 * @property string|null $has_resources
 * @property int $organisation_id
 * @property string $date_created
 *
 * @property MgfOrganisation $organisation
 */
class MgfOrganisationalDetails extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mgf_organisational_details';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mgt_Staff', 'senior_Staff', 'junior_Staff', 'others', 'last_board', 'last_agm', 'last_audit', 'organisation_id'], 'required'],
            [['mgt_Staff', 'senior_Staff', 'junior_Staff', 'others', 'organisation_id'], 'integer'],
            [['last_board', 'last_agm', 'last_audit', 'date_created'], 'safe'],
            [['has_finance', 'has_resources'], 'string'],
            [['organisation_id'], 'exist', 'skipOnError' => true, 'targetClass' => MgfOrganisation::className(), 'targetAttribute' => ['organisation_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'mgt_Staff' => 'Number of Management Staff: ',
            'senior_Staff' => 'Number of Senior Staff',
            'junior_Staff' => 'Number of Junior Staff',
            'others' => 'Others',
            'last_board' => 'Date of Last Board Meeting',
            'last_agm' => 'Date of Last Annual General Meeting',
            'last_audit' => 'Date of Last Audit Report',
            'has_finance' => 'Does the enterprise have a bank account?',
            'has_resources' => 'Is the enterprise capable of raising financial or other resources from its owners?',
            'date_created' => 'Date Created',
        ];
    }

    /**
     * Gets query for [[Organisation]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrganisation()
    {
        return $this->hasOne(MgfOrganisation::className(), ['id' => 'organisation_id']);
    }
}
