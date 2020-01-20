<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "informationdateslist".
 *
 * @property int $id
 * @property string $date
 *
 * @property Informationtextlist[] $informationtextlists
 */
class Informationdateslist extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'informationdateslist';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date'], 'required'],
            [['date'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInformationtextlists()
    {
        return $this->hasMany(Informationtextlist::className(), ['informationdateslist_id' => 'id']);
    }
    
    public static function getInfo()
    {
        return self::find()->orderBy(['id' => SORT_ASC])->all();
    }
}
