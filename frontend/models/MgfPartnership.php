<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "mgf_partnership".
 *
 * @property int $id
 * @property string $partner_name
 * @property string $partnership_aim
 * @property string $start_date
 * @property string $end_date
 * @property string $partnership_status
 * @property int $experience_id
 * @property int $organisation_id
 * @property string $date_created
 *
 * @property MgfOrganisation $organisation
 */
class MgfPartnership extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mgf_partnership';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['partner_name', 'partnership_aim', 'start_date', 'end_date', 'partnership_status', 'experience_id', 'organisation_id'], 'required'],
            [['start_date', 'end_date', 'date_created'], 'safe'],
            [['partnership_status'], 'string'],
            [['experience_id', 'organisation_id'], 'integer'],
            [['partner_name', 'partnership_aim'], 'string', 'max' => 50],
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
            'partner_name' => 'Partner Name',
            'partnership_aim' => 'Partnership Aim',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'partnership_status' => 'Partnership Status',
            'experience_id' => 'Experience ID',
            'organisation_id' => 'Organisation',
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
