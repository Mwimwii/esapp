<?php

namespace frontend\models;
use backend\models\Districts;
use backend\models\Provinces;

use Yii;

/**
 * This is the model class for table "mgf_organisation".
 *
 * @property int $id
 * @property string $cooperative
 * @property string $acronym
 * @property string $registration_type
 * @property string $registration_no
 * @property string $trade_license_no
 * @property string $registration_date
 * @property string|null $business_objective
 * @property string $email_address
 * @property string $physical_address
 * @property int $organisational_branches
 * @property string|null $tel_no
 * @property string|null $fax_no
 * @property int|null $province_id
 * @property int|null $district_id
 * @property int $applicant_id
 * @property int is_active
 * @property string $date_created
 *
 * @property MgfApplication[] $mgfApplications
 * @property MgfConceptNote[] $mgfConceptNotes
 * @property MgfContact[] $mgfContacts
 * @property District $district
 * @property Province $province
 * @property MgfApplicant $applicant
 */
class MgfOrganisation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mgf_organisation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(){
        return [
            [['cooperative', 'registration_type', 'registration_no', 'registration_date', 'email_address', 'physical_address', 'applicant_id','business_objective','organisational_branches'], 'required'],
            [['registration_date', 'date_created','acronym','trade_license_no'], 'safe'],
            [['province_id', 'district_id', 'applicant_id','is_active','organisational_branches'], 'integer'],
            [['cooperative', 'physical_address'], 'string', 'max' => 50],
            [['acronym'], 'string', 'max' => 10],
            [['registration_type', 'registration_no', 'trade_license_no'], 'string', 'max' => 30],
            [['email_address'], 'string', 'max' => 40],
            [['tel_no','fax_no'], 'string', 'max' => 15],
            [['registration_no'], 'unique'],
            [['trade_license_no'], 'unique'],
            [['email_address'], 'unique'],
            [['district_id'], 'exist', 'skipOnError' => true, 'targetClass' => Districts::className(), 'targetAttribute' => ['district_id' => 'id']],
            [['province_id'], 'exist', 'skipOnError' => true, 'targetClass' => Provinces::className(), 'targetAttribute' => ['province_id' => 'id']],
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
            'cooperative' => 'Name of Organisation',
            'acronym' => 'Acronym of Organisation:',
            'registration_type' => 'Type of Legal Registration',
            'registration_no' => 'Registration No',
            'trade_license_no' => 'Trade Licence No',
            'registration_date' => 'Registration Date',
            'business_objective' => 'Central Business Objective',
            'email_address' => 'Email Address',
            'physical_address' => 'Headquarters Physical Address',
            'tel_no' => 'Tel No',
            'fax_no' => 'Fax No',
            'organisational_branches' => 'Does Your Organisation have Any Branch?',
            'province_id' => 'Province',
            'district_id' => 'District',
            'applicant_id' => 'Applicant',
            'date_created' => 'Date Created',
        ];
    }

    /**
     * Gets query for [[MgfApplications]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMgfApplications()
    {
        return $this->hasMany(MgfApplication::className(), ['organisation_id' => 'id']);
    }

    /**
     * Gets query for [[MgfConceptNotes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMgfConceptNotes()
    {
        return $this->hasMany(MgfConceptNote::className(), ['organisation_id' => 'id']);
    }

    /**
     * Gets query for [[MgfContacts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMgfContacts()
    {
        return $this->hasMany(MgfContact::className(), ['organisation_id' => 'id']);
    }

    /**
     * Gets query for [[District]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDistrict()
    {
        return $this->hasOne(Districts::className(), ['id' => 'district_id']);
    }

    /**
     * Gets query for [[Province]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProvince()
    {
        return $this->hasOne(Provinces::className(), ['id' => 'province_id']);
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