<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace backend\models;

class Downloads extends \yii\db\ActiveRecord{

    public $faabs_group;
    public $camp;
    public $topic;

    public function rules() {
        return [
            [['camp', 'faabs_group','topic'], 'required'],
            [['camp', 'faabs_group','topic'], 'safe'],
        ];
    }

}
