<?php

namespace app\models;

class Filterproduct2 extends \yii\db\ActiveRecord{

    public static function tableName()
    {
        return 'filterproduct2';
    }

    public static function findByProductId($productid){
        return self::find()->where(['productid' => $productid])->all();
    }

    public static function findByTypeAnimalsId($typeproductid, $productid){
        return self::find()->where(['typeproductid' => $typeproductid, 'productid' => $productid])->one();
    }
}