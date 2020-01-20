<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "informationtextlist".
 *
 * @property int $id
 * @property string $link
 * @property string $text
 * @property int $informationdateslist_id
 *
 * @property Informationdateslist $informationdateslist
 */
class Informationtextlist extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'informationtextlist';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['informationdateslist_id'], 'required'],
            [['informationdateslist_id'], 'integer'],
            [['link', 'text'], 'string', 'max' => 200],
            [['informationdateslist_id'], 'exist', 'skipOnError' => true, 'targetClass' => Informationdateslist::className(), 'targetAttribute' => ['informationdateslist_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'link' => 'Link',
            'text' => 'Text',
            'informationdateslist_id' => 'Informationdateslist ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInformationdateslist()
    {
        return $this->hasOne(Informationdateslist::className(), ['id' => 'informationdateslist_id']);
    }
}
