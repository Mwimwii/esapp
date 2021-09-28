<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "mgf_window".
 *
 * @property int $id
 * @property int $year_id
 * @property int $window
 * @property string $open_from
 * @property string $closing_date
 * @property int|null $total_submitted
 * @property int|null $compliant
 * @property int|null $non_compliant
 * @property int|null $is_active
 * @property string $date_created
 *
 * @property MgfYear $year
 */
class MgfWindow extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mgf_window';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['year_id', 'window', 'open_from', 'closing_date'], 'required'],
            [['year_id', 'window', 'total_submitted', 'compliant', 'non_compliant', 'is_active'], 'integer'],
            [['open_from', 'closing_date', 'date_created'], 'safe'],
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
            'window' => 'Window',
            'open_from' => 'Open From',
            'closing_date' => 'Closing Date',
            'total_submitted' => 'Total Submitted',
            'compliant' => 'Compliant',
            'non_compliant' => 'Non Compliant',
            'is_active' => 'Is Active',
            'date_created' => 'Date Created',
        ];
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
