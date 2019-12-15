<?php

namespace app\models;

class Filtername extends \yii\db\ActiveRecord{

    public static function tableName()
    {
        return 'filtername';
    }

    public static function getInfo()
    {
        return self::find()->orderBy(['typeproductid' => SORT_ASC, 'id' => SORT_ASC])->all();
    }

    public static function  findById($id){
        return self::find()->where(['id'=>$id])->one();
    }

    public static function  findById2($id){
        return self::find()->where(['typeproductid'=>$id])->all();
    }
    
    public function getTypeproduct()
    {
        return $this->hasOne(Typeproduct::className(), ['id' => 'typeproductid']);
    }
}