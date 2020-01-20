<?php

namespace app\models;

class Filterproduct1 extends \yii\db\ActiveRecord{

    public static function tableName()
    {
        return 'filterproduct1';
    }

    public static function findByProductId($productid){
        return self::find()->where(['productid' => $productid])->all();
    }

    public static function findByTypeAnimalsId($typeanimalsid, $productid){
        return self::find()->where(['typeanimalsid' => $typeanimalsid, 'productid' => $productid])->one();
    }

    public function getTypeanimals()
    {
        return $this->hasOne(Typeanimals::className(), ['id' => 'typeanimalsid']);
    }
}