<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "mgf_experience".
 *
 * @property int $id
 * @property string|null $financed_before
 * @property string|null $collaboration_ready
 * @property string|null $any_collaboration
 * @property string|null $collaboration_will
 * @property int $organisation_id
 * @property string $date_created
 *
 * @property MgfOrganisation $organisation
 */
class MgfExperience extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mgf_experience';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['financed_before', 'any_collaboration','collaboration_will','collaboration_ready'], 'string'],
            [['organisation_id'], 'integer'],
            [['organisation_id'], 'required'],
            [['date_created'], 'safe'],
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
            'financed_before' => 'Have you received grant financing in the past from any project including SAPP?',
            'any_collaboration' => 'Have you been in any collaboration/partnership with smallholder’s farmers/producers/rural agribusiness in the past?',
            'collaboration_will' => 'Are Willingness to continue/expand?',
            'collaboration_ready'=> 'Are you prepared to establish such collaboration?',
            'organisation_id' => 'Organisation',
            'date_created' => 'Date Created',
        ];
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
