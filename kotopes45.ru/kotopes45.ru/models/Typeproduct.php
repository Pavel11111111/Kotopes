<?php

namespace app\models;

class Typeproduct extends \yii\db\ActiveRecord{

    public static function tableName()
    {
        return 'typeproduct';
    }

    public static function getInfo()
    {
        return self::find()->orderBy(['typeanimalsname' => SORT_ASC])->all();
    }

    public static function  findById($id){
        return self::find()->where(['id'=>$id])->one();
    }

    public static function  findByTypeAnimalsName($name){
        return self::find()->where(['typeanimalsname'=>$name])->all();
    }
}