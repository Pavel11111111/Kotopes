<?php

namespace app\models;

class Delivery_date extends \yii\db\ActiveRecord{

    public static function tableName()
    {
        return 'delivery_date';
    }

    public static function CronDelete()
    {
         return self::find()->orderBy(['id' => SORT_ASC])->limit(3)->all();
    }
    
    public static function CronLastDate()
    {
         return self::find()->orderBy(['id' => SORT_DESC])->limit(1)->all();
    }
    public static function GetInfo()
    {
         return self::find()->orderBy(['id' => SORT_ASC])->all();
    }
}