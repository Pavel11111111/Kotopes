<?php

namespace app\models;

class Hots extends \yii\db\ActiveRecord{

    public static function tableName()
    {
        return 'hots';
    }

    public static function  findByFileName($filename, $fileextension){
        return self::find()->where(['img'=>$filename . '.' . $fileextension])->one();
    }

    public static function  findById($id){
        return self::find()->where(['id'=>$id])->one();
    }

    public static function getInfo()
    {
        return self::find()->orderBy(['id' => SORT_ASC])->all();
    }
}