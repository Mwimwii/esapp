<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "mgf_project_risks_and_mitigation_measures".
 *
 * @property int $id
 * @property string|null $expected_risks
 * @property string|null $consequences_of_risk
 * @property string|null $mitigation_measures_planned
 * @property int $proposal_id
 * @property string $date_created
 * @property string $date_update
 * @property int $created_by
 * @property int|null $updated_by
 */
class MgfProjectRisksAndMitigationMeasures extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mgf_project_risks_and_mitigation_measures';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['proposal_id', 'created_by'], 'required'],
            [['proposal_id', 'created_by', 'updated_by'], 'integer'],
            [['date_created', 'date_update'], 'safe'],
            [['expected_risks', 'consequences_of_risk', 'mitigation_measures_planned'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'expected_risks' => 'Expected Risks',
            'consequences_of_risk' => 'Consequences Of Risk',
            'mitigation_measures_planned' => 'Mitigation Measures Planned',
            'proposal_id' => 'Proposal ID',
            'date_created' => 'Date Created',
            'date_update' => 'Date Update',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }
}
