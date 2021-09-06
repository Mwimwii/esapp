<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "mgf_business_perfomance_indicator".
 *
 * @property int $id
 * @property int|null $category_id
 * @property int|null $indicator_id
 * * @property string|null $agribusiness_indicators
 * @property string|null $status_at_application
 * @property string|null $status_after_1yr
 * @property string|null $status_after_2yr
 * @property int $proposal_id
 * @property string $date_created
 * @property string $date_update
 * @property int $created_by
 * @property int|null $updated_by
 */
class MgfBusinessPerfomanceIndicator extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mgf_business_perfomance_indicator';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'indicator_id', 'proposal_id', 'created_by', 'updated_by'], 'integer'],
            [['proposal_id', 'created_by'], 'required'],
            [['date_created', 'date_update'], 'safe'],
            [['agribusiness_indicators','status_at_application', 'status_after_1yr', 'status_after_2yr'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Category ID',
            'indicator_id' => 'Indicator ID',
            'agribusiness_indicators'=>'Agribusiness Indicators',
            'status_at_application' => 'Status At Application',
            'status_after_1yr' => 'Status After 1yr',
            'status_after_2yr' => 'Status After 2yr',
            'proposal_id' => 'Proposal ID',
            'date_created' => 'Date Created',
            'date_update' => 'Date Update',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }
}
