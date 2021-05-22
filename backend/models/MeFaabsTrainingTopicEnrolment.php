<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "me_faabs_training_topic_enrolment".
 *
 * @property int $id
 * @property int $faabs_id
 * @property int $training_type
 * @property int $topic_id
 *
 * @property MeFaabsGroups $faabs
 * @property MeFaabsTrainingTopics $topic
 */
class MeFaabsTrainingTopicEnrolment extends \yii\db\ActiveRecord
{
    public $topics;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'me_faabs_training_topic_enrolment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['faabs_id', 'training_type', 'topic_id','topics'], 'required'],
            [['faabs_id', 'topic_id'], 'integer'],
            [['training_type','topics'], 'safe'],
            [['faabs_id'], 'exist', 'skipOnError' => true, 'targetClass' => MeFaabsGroups::className(), 'targetAttribute' => ['faabs_id' => 'id']],
            [['topic_id'], 'exist', 'skipOnError' => true, 'targetClass' => MeFaabsTrainingTopics::className(), 'targetAttribute' => ['topic_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'faabs_id' => 'Faabs ID',
            'training_type' => 'Training Type',
            'topic_id' => 'Topic ID',
        ];
    }

    /**
     * Gets query for [[Faabs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFaabs()
    {
        return $this->hasOne(MeFaabsGroups::className(), ['id' => 'faabs_id']);
    }

    /**
     * Gets query for [[Topic]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTopic()
    {
        return $this->hasOne(MeFaabsTrainingTopics::className(), ['id' => 'topic_id']);
    }
}
