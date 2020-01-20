<?php

namespace app\models;

use Yii;

class Basket extends \yii\db\ActiveRecord{

    public static function tableName()
    {
        return 'basket';
    }
     public static function getInfoByUserId($userid)
    {
        return self::find()->where(['user_id' => $userid])->all();
    }
    public static function getInfoCountVariationByUserId($userid)
    {
        return self::find()->select('count')->where(['user_id' => $userid])->all();
    }
    public static function getInfoByUserIdAndVariationId($userid, $variationid)
    {
        return self::find()->where(['user_id' => $userid, 'variation_id' => $variationid])->one();
    }
    
    public function getVariation()
    {
        return $this->hasOne(Variation::className(), ['id' => 'variation_id']);
    }
}