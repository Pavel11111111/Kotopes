<?php

namespace app\models;

class Userssearchhistory extends \yii\db\ActiveRecord{

    public static function tableName()
    {
        return 'userssearchhistory';
    }
    
    public static function getAllInfoByUserid($user_id){
         return self::find()->where(['user_id' => $user_id])->all();
    }
    
    public static function getInfo($user_id)
    {
        return self::find()->select(['searchtext'])->asArray()->where(['user_id' => $user_id])->orderBy(['id' => SORT_DESC])->limit(5)->all();
    }
    
    public static function getInfoByOldRecord($user_id)
    {
        return self::find()->where(['user_id' => $user_id])->orderBy(['id' => SORT_DESC])->offset(5)->one();
    }
}