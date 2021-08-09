<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "mgf_contact".
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $mobile
 * @property string|null $tel_no
 * @property string|null $physical_address
 * @property int $organisation_id
 * @property int $position_id
 * @property int $applicant_id
 * @property string $date_created
 *
 * @property MgfOrganisation $organisation
 * @property MgfPosition $position
 * @property MgfApplicant $applicant
 */
class MgfContact extends \yii\db\ActiveRecord{
    /**
     * {@inheritdoc}
     */
    public static function tableName(){
        return 'mgf_contact';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(){
        return [
            [['first_name', 'last_name', 'mobile', 'organisation_id', 'position_id', 'applicant_id'], 'required'],
            [['organisation_id', 'position_id', 'applicant_id'], 'integer'],
            [['date_created'], 'safe'],
            [['first_name', 'last_name'], 'string', 'max' => 30],
            [['mobile', 'tel_no'], 'string', 'max' => 15],
            [['physical_address'], 'string', 'max' => 50],
            [['organisation_id'], 'exist', 'skipOnError' => true, 'targetClass' => MgfOrganisation::className(), 'targetAttribute' => ['organisation_id' => 'id']],
            [['position_id'], 'exist', 'skipOnError' => true, 'targetClass' => MgfPosition::className(), 'targetAttribute' => ['position_id' => 'id']],
            [['applicant_id'], 'exist', 'skipOnError' => true, 'targetClass' => MgfApplicant::className(), 'targetAttribute' => ['applicant_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'mobile' => 'Mobile',
            'tel_no' => 'Tel No',
            'physical_address' => 'Physical Address',
            'organisation_id' => 'Organisation ID',
            'position_id' => 'Position',
            'applicant_id' => 'Applicant',
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

    /**
     * Gets query for [[Position]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPosition()
    {
        return $this->hasOne(MgfPosition::className(), ['id' => 'position_id']);
    }

    /**
     * Gets query for [[Applicant]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getApplicant()
    {
        return $this->hasOne(MgfApplicant::className(), ['id' => 'applicant_id']);
    }
}
