<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "mgf_concept_note".
 *
 * @property int $id
 * @property string $project_title
 * @property float $estimated_cost
 * @property string $starting_date
 * @property int $operation_id
 * @property int|null $implimentation_period
 * @property string|null $other_operation_type
 * @property int $application_id
 * @property int $organisation_id
 * @property string $date_created
 * @property string|null $date_submitted
 * @property MgfApplication $application
 * @property MgfOrganisation $organisation
 * @property MgfOperation $operation
 */
class MgfConceptNote extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mgf_concept_note';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['project_title', 'estimated_cost', 'starting_date', 'operation_id', 'application_id', 'organisation_id'], 'required'],
            [['estimated_cost'], 'number'],
            [['starting_date', 'date_created', 'date_submitted'], 'safe'],
            [['operation_id', 'implimentation_period', 'application_id', 'organisation_id'], 'integer'],
            [['other_operation_type'], 'string'],
            [['project_title'], 'string', 'max' => 30],
            [['application_id'], 'exist', 'skipOnError' => true, 'targetClass' => MgfApplication::className(), 'targetAttribute' => ['application_id' => 'id']],
            [['organisation_id'], 'exist', 'skipOnError' => true, 'targetClass' => MgfOrganisation::className(), 'targetAttribute' => ['organisation_id' => 'id']],
            [['operation_id'], 'exist', 'skipOnError' => true, 'targetClass' => MgfOperation::className(), 'targetAttribute' => ['operation_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'project_title' => 'Project Title',
            'estimated_cost' => 'Estimated Cost',
            'starting_date' => 'Starting Date',
            'operation_id' => 'Operation Type',
            'implimentation_period' => 'Implimentation (Years)',
            'other_operation_type' => 'Other Operation Type',
            'organisation_id' => 'Organisation',
            'date_created' => 'Date Created',
            'date_submitted' => 'Date Submitted',
        ];
    }


    /**
     * Gets query for [[Application]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getApplication()
    {
        return $this->hasOne(MgfApplication::className(), ['id' => 'application_id']);
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

    /**
     * Gets query for [[Operation]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOperation()
    {
        return $this->hasOne(MgfOperation::className(), ['id' => 'operation_id']);
    }
}
