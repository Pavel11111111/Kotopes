<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;

class Variation extends \yii\db\ActiveRecord{

    public static function tableName()
    {
        return 'variation';
    }

    public static function getInfo($productid){
        return self::find()->where(['productid' => $productid])->all();
    }

    public static function getInfo2($variationid){
        return self::find()->where(['id' => $variationid])->one();
    }

    public static function getAllVariations(){
        return self::find()->orderBy(['id' => SORT_DESC])->all();
    }
    public function getProduct()
    {
        return $this->hasOne(Products::className(), ['id' => 'productid']);
    }
}