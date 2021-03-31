<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "me_faabs_training_topics".
 *
 * @property int $id
 * @property string $topic
 * @property string $output_level_indicator
 * @property string|null $category
 */
class MeFaabsTrainingTopics extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'me_faabs_training_topics';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['topic', 'output_level_indicator', 'category','subcomponent'], 'required'],
            ['topic', 'unique', 'when' => function($model) {
                    return $model->isAttributeChanged('topic') &&
                            !empty(self::findOne([
                                        'topic' => $model->topic,
                                        "category" => $model->category,
                                        "output_level_indicator" => $model->output_level_indicator
                            ])) ? TRUE : FALSE;
                }, 'message' => 'Topic already exist for category and output indicator!'],
            [['topic', 'output_level_indicator', 'category'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'topic' => 'Topic',
            'output_level_indicator' => 'Output Level Indicator',
            'category' => 'Category',
            'subcomponent' => 'Sub-component',
        ];
    }

    public static function getList() {
        $query = static::find()
                ->select(["CONCAT(category,' - ',topic) as topic", 'id'])
                ->orderBy(['id' => SORT_ASC])
                ->asArray()
                ->all();

        return \yii\helpers\ArrayHelper::map($query, 'id', 'topic');
    }

}
