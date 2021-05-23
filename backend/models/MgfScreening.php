<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "mgf_screening".
 *
 * @property int $id
 * @property int $conceptnote_id
 * @property int $organisation_id
 * @property string|null $criterion
 * @property int|null $satisfactory
 * @property string|null $approve_submittion
 * @property string|null $verified_by
 * @property MgfConceptNote $conceptnote
 */
class MgfScreening extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mgf_screening';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['conceptnote_id', 'organisation_id'], 'required'],
            [['conceptnote_id', 'organisation_id'], 'integer'],
            [['criterion'], 'string'],
            [['approve_submittion'], 'safe'],
            [['satisfactory'], 'safe'],
            [['verified_by'], 'string', 'max' => 20],
            [['conceptnote_id'], 'exist', 'skipOnError' => true, 'targetClass' => MgfConceptNote::className(), 'targetAttribute' => ['conceptnote_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'conceptnote_id' => 'Conceptnote ID',
            'organisation_id' => 'Organisation',
            'criterion' => 'Criterion',
            'satisfactory' => 'Satisfactory',
            'approve_submittion' => 'Approve Submittion',
            'verified_by' => 'Verified By',
            'province_id' => 'Province ID',
            'district_id' => 'District ID',
        ];
    }

    /**
     * Gets query for [[Conceptnote]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getConceptnote()
    {
        return $this->hasOne(MgfConceptNote::className(), ['id' => 'conceptnote_id']);
    }
}
