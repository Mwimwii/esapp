<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "mgf_settings".
 *
 * @property int $id
 * @property int $window
 * @property int $max_reviewers
 * @property string $date_created
 */
class MgfSettings extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mgf_settings';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['window', 'max_reviewers'], 'required'],
            [['window', 'max_reviewers'], 'integer'],
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
            'window' => 'Window',
            'max_reviewers' => 'Max Reviewers',
            'date_created' => 'Date Created',
        ];
    }
}
