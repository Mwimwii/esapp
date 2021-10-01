<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "mgf_pco_pcn".
 *
 * @property int $id
 * @property int $year_id
 * @property int|null $total_submitted
 * @property int|null $compliant
 * @property int|null $non_compliant
 * @property string|null $minutes
 * @property int|null $province_id
 * @property int|null $is_active
 * @property string $date_created
 */
class MgfPcoPcn extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mgf_pco_pcn';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['year_id'], 'required'],
            [['year_id', 'total_submitted', 'compliant', 'non_compliant', 'province_id', 'is_active'], 'integer'],
            [['minutes'], 'string'],
            [['date_created'], 'safe'],
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
            'is_active' => 'Is Active',
            'date_created' => 'Date Created',
        ];
    }
}
