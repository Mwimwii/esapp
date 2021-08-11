<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "mgf_year".
 *
 * @property int $id
 * @property string $year
 * @property int|null $total_submitted
 * @property int|null $compliant
 * @property int|null $non_compliant
 * @property int|null $is_active
 * @property string $date_created
 *
 * @property MgfDistrictEligibility[] $mgfDistrictEligibilities
 * @property MgfWindow[] $mgfWindows
 */
class MgfYear extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mgf_year';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['year'], 'required'],
            [['total_submitted', 'compliant', 'non_compliant', 'is_active'], 'integer'],
            [['date_created'], 'safe'],
            [['year'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'year' => 'Year',
            'total_submitted' => 'Total Submitted',
            'compliant' => 'Compliant',
            'non_compliant' => 'Non Compliant',
            'is_active' => 'Is Active',
            'date_created' => 'Date Created',
        ];
    }

    /**
     * Gets query for [[MgfDistrictEligibilities]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMgfDistrictEligibilities()
    {
        return $this->hasMany(MgfDistrictEligibility::className(), ['year_id' => 'id']);
    }

    /**
     * Gets query for [[MgfWindows]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMgfWindows()
    {
        return $this->hasMany(MgfWindow::className(), ['year_id' => 'id']);
    }
}
