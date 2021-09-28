<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "mgf_implementation_schedule_short".
 *
 * @property int $id
 * @property string $activity
 * @property int|null $implementation_year
 * @property int|null $qtr1
 * @property int|null $qtr2
 * @property int|null $qtr3
 * @property int|null $qtr4
 * @property int $proposal_id
 * @property string $date_created
 * @property string $date_update
 * @property int $created_by
 * @property int|null $updated_by
 */
class MgfImplementationScheduleShort extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mgf_implementation_schedule_short';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['activity', 'proposal_id', 'created_by'], 'required'],
            [['implementation_year', 'qtr1', 'qtr2', 'qtr3', 'qtr4', 'proposal_id', 'created_by', 'updated_by'], 'integer'],
            [['date_created', 'date_update'], 'safe'],
            [['activity'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'activity' => 'Activity',
            'implementation_year' => 'Implementation Year',
            'qtr1' => 'Qtr1',
            'qtr2' => 'Qtr2',
            'qtr3' => 'Qtr3',
            'qtr4' => 'Qtr4',
            'proposal_id' => 'Proposal ID',
            'date_created' => 'Date Created',
            'date_update' => 'Date Update',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }
}
