<?php

namespace app\models;

class Typeanimals extends \yii\db\ActiveRecord{

    public static function tableName()
    {
        return 'typeanimals';
    }

    public static function  findById($id){
        return self::find()->where(['id'=>$id])->one();
    }

    public static function  findByName($name){
        return self::find()->where(['name'=>$name])->one();
    }

    public static function getInfo()
    {
        return self::find()->orderBy(['id' => SORT_ASC])->all();
    }

    public static function getTypeAnimalsWithoutProduct(){
        return self::find()->leftJoin('filterproduct1', ['id' => 'typeanimalsid'])->where(['filterproduct1id' => null])->leftJoin('products', ['productid' => 'id'])->all();
    }

    public function getChildren()
    {
        return $this->hasMany(AuthItem::className(), ['name' => 'child'])->viaTable('auth_item_child', ['parent' => 'name']);
    }
}