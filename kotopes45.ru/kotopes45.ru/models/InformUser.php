<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "inform_user".
 *
 * @property int $id
 * @property int $variation_id
 * @property string $email
 *
 * @property Variation $variation
 */
class InformUser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'inform_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['variation_id', 'email'], 'required'],
            [['variation_id'], 'integer'],
            [['email'], 'string', 'max' => 100],
            [['variation_id'], 'exist', 'skipOnError' => true, 'targetClass' => Variation::className(), 'targetAttribute' => ['variation_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'variation_id' => 'Variation ID',
            'email' => 'Email',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVariation()
    {
        return $this->hasOne(Variation::className(), ['id' => 'variation_id']);
    }

    public static function  getByVariationId($id)
    {
        return self::find()->select('email')->where(['variation_id'=>$id])->all();
    }
}
