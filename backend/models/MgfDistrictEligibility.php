<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "mgf_district_eligibility".
 *
 * @property int $id
 * @property int $year_id
 * @property int|null $total_submitted
 * @property int|null $compliant
 * @property int|null $non_compliant
 * @property string $minutes
 * @property int|null $province_id
 * @property int|null $district_id
 * @property int|null $is_active
 * @property string $date_created
 *
 * @property District $district
 * @property Province $province
 * @property MgfYear $year
 */
class MgfDistrictEligibility extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mgf_district_eligibility';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['year_id',], 'required'],
            [['year_id', 'total_submitted', 'compliant', 'non_compliant', 'province_id', 'district_id', 'is_active'], 'integer'],
            [['minutes'], 'string'],
            [['date_created','minutes'], 'safe'],
            [['district_id'], 'exist', 'skipOnError' => true, 'targetClass' => Districts::className(), 'targetAttribute' => ['district_id' => 'id']],
            [['province_id'], 'exist', 'skipOnError' => true, 'targetClass' => Provinces::className(), 'targetAttribute' => ['province_id' => 'id']],
            [['year_id'], 'exist', 'skipOnError' => true, 'targetClass' => MgfYear::className(), 'targetAttribute' => ['year_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'year_id' => 'Year ID',
            'total_submitted' => 'Total Submitted',
            'compliant' => 'Compliant',
            'non_compliant' => 'Non Compliant',
            'minutes' => 'Minutes',
            'province_id' => 'Province ID',
            'district_id' => 'District ID',
            'is_active' => 'Is Active',
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
     * Gets query for [[Year]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getYear()
    {
        return $this->hasOne(MgfYear::className(), ['id' => 'year_id']);
    }
}
