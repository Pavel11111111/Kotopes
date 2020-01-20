<?php

namespace app\models;

class Likes extends \yii\db\ActiveRecord{

    public static function tableName()
    {
        return 'likes';
    }

    public static function getInfo($user_id, $animals_id)
    {
        return self::find()->where(['user_id'=>$user_id, 'animals_id'=>$animals_id])->one();
    }

}