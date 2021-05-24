<?php

namespace frontend\models;
use Yii;
use backend\models\Districts;
use backend\models\Provinces;
use common\models\User;

/**
 * This is the model class for table "mgf_applicant".
 *
 * @property int $id
 * @property string|null $title
 * @property int|null $province_id
 * @property int|null $district_id
 * @property int confirmed
 * @property string $first_name
 * @property string $last_name
 * @property string $mobile
 * @property string|null $nationalid
 * @property string|null $address
 * @property string|null $applicant_type
 * @property int $user_id
 * @property int|null $organisation_id
 * @property string $date_created
 *
 * @property District $district
 * @property Province $province
 * @property Users $user
 * @property MgfApplication[] $mgfApplications
 * @property MgfContact[] $mgfContacts
 * @property MgfOrganisation[] $mgfOrganisations
 */
class MgfApplicant extends \yii\db\ActiveRecord{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mgf_applicant';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'address', 'applicant_type'], 'string'],
            [['province_id', 'district_id', 'user_id', 'organisation_id','confirmed'], 'integer'],
            [['first_name', 'last_name', 'mobile', 'user_id'], 'required'],
            [['date_created','confirmed'], 'safe'],
            [['first_name', 'last_name'], 'string', 'max' => 30],
            [['mobile', 'nationalid'], 'string', 'max' => 15],
            [['district_id'], 'exist', 'skipOnError' => true, 'targetClass' => Districts::className(), 'targetAttribute' => ['district_id' => 'id']],
            [['province_id'], 'exist', 'skipOnError' => true, 'targetClass' => Provinces::className(), 'targetAttribute' => ['province_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'province_id' => 'Province',
            'district_id' => 'District',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'mobile' => 'Mobile',
            'nationalid' => 'Passport/ID No.',
            'address' => 'Address',
            'confirmed'=>'Confirmed',
            'applicant_type' => 'Applicant Type',
            'user_id' => 'User ID',
            'organisation_id' => 'Organisation',
            'date_created' => 'Date Created',
        ];
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
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * Gets query for [[MgfApplications]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMgfApplications()
    {
        return $this->hasMany(MgfApplication::className(), ['applicant_id' => 'id']);
    }

    /**
     * Gets query for [[MgfContacts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMgfContacts()
    {
        return $this->hasMany(MgfContact::className(), ['applicant_id' => 'id']);
    }

    /**
     * Gets query for [[MgfOrganisations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMgfOrganisations()
    {
        return $this->hasMany(MgfOrganisation::className(), ['applicant_id' => 'id']);
    }
}
