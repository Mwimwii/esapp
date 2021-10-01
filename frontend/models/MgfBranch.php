<?php

namespace frontend\models;

use backend\models\Districts;
use backend\models\Provinces;
use Yii;

/**
 * This is the model class for table "mgf_branch".
 *
 * @property int $id
 * @property string $address
 * @property int $employess
 * @property int|null $province_id
 * @property int|null $district_id
 * @property int $organisation_id
 * @property string $date_created
 *
 * @property District $district
 * @property Province $province
 * @property MgfOrganisation $organisation
 */
class MgfBranch extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mgf_branch';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['address', 'employess', 'organisation_id'], 'required'],
            [['employess', 'province_id', 'district_id', 'organisation_id'], 'integer'],
            [['date_created'], 'safe'],
            [['address'], 'string', 'max' => 100],
            [['district_id'], 'exist', 'skipOnError' => true, 'targetClass' => Districts::className(), 'targetAttribute' => ['district_id' => 'id']],
            [['province_id'], 'exist', 'skipOnError' => true, 'targetClass' => Provinces::className(), 'targetAttribute' => ['province_id' => 'id']],
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
            'address' => 'Address',
            'employess' => 'Employess',
            'province_id' => 'Province',
            'district_id' => 'District',
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
     * Gets query for [[Organisation]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrganisation()
    {
        return $this->hasOne(MgfOrganisation::className(), ['id' => 'organisation_id']);
    }
}
