<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "favorites".
 *
 * @property int $id
 * @property int $user_id
 * @property int $variation_id
 *
 * @property Variation $variation
 * @property User $user
 */
class Favorites extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'favorites';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'variation_id'], 'required'],
            [['user_id', 'variation_id'], 'integer'],
            [['variation_id'], 'exist', 'skipOnError' => true, 'targetClass' => Variation::className(), 'targetAttribute' => ['variation_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'variation_id' => 'Variation ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVariation()
    {
        return $this->hasOne(Variation::className(), ['id' => 'variation_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    
    public function getInfoByUser()
    {
        return self::find()->orderBy(['id' => SORT_ASC])->where(['user_id' => Yii::$app->user->id])->all();
    }
    
    public function getInfoByUseridAndVariationid($variation_id)
    {
        if(!Yii::$app->user->isGuest){
            return self::find()->orderBy(['id' => SORT_ASC])->where(['user_id' => Yii::$app->user->id, 'variation_id' => $variation_id])->one();
        }else{
            return null;
        }
    }
}
