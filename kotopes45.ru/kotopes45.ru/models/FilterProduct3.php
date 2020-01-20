<?php

namespace app\models;

class Filterproduct3 extends \yii\db\ActiveRecord{

    public static function tableName()
    {
        return 'filterproduct3';
    }

    public static function findByProductId($productid){
        return self::find()->where(['productid' => $productid])->all();
    }

    public static function findByFilterParamId($filterparamid, $productid){
        return self::find()->where(['filterparamid' => $filterparamid, 'productid' => $productid])->one();
    }
}