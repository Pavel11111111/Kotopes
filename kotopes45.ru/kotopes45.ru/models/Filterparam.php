<?php

namespace app\models;

class Filterparam extends \yii\db\ActiveRecord{

    public static function tableName()
    {
        return 'filterparam';
    }

    public static function getInfo()
    {
        return self::find()->orderBy(['filternameid' => SORT_ASC, 'name'=>SORT_ASC])->all();
    }

    public static function  findById($id){
        return self::find()->where(['id'=>$id])->one();
    }

    public static function  findById2($id){
        return self::find()->where(['filternameid'=>$id])->all();
    }
}