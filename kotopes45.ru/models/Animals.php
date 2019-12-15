<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;

class Animals extends \yii\db\ActiveRecord{

    public static function tableName()
    {
        return 'animals';
    }

    public static function getInfo($userid)
    {
        if($userid == null){
            return self::find()->orderBy(['dateinsert' => SORT_DESC])->where(['checkrecord' => 1])->all();
        }
        else {
            $query = self::find()->where(['userid' => $userid,'checkrecord' => 1])->orderBy(['dateinsert' => SORT_DESC])->all();
            $query2 = self::find()->where(['!=', 'userid', $userid])->andWhere(['checkrecord' => 1])->orderBy(['dateinsert' => SORT_DESC])->all();
            return array_merge ($query, $query2);
        }
    }

    public static function getInfo2($userid)
    {
        if($userid == null){
            return self::find()->orderBy(['countlikes' => SORT_DESC])->where(['checkrecord' => 1])->all();
        }
        else {
            $query = self::find()->where(['userid' => $userid])->orderBy(['countlikes' => SORT_DESC,'checkrecord' => 0])->all();
            $query2 = self::find()->where(['!=', 'userid', $userid])->andWhere(['checkrecord' => 1])->orderBy(['countlikes' => SORT_DESC])->all();
            return array_merge($query, $query2);
        }
    }

    public static function getInfo3()
    {
        return self::find()->where(['checkrecord' => 0])->all();
    }

    public static function getInfo4()
    {
        return self::find()->where(['checkrecord' => 1])->all();
    }

    public static function  findByFileName($filename, $fileextension){
        return self::find()->where(['img'=>$filename . '.' . $fileextension])->one();
    }

    public static function insertLike($animals_id){
        $likes = new Likes();
        $info = $likes::getInfo(Yii::$app->user->identity->id, $animals_id);
        if($info == null){
            $likes->animals_id = $animals_id;
            $likes->user_id = Yii::$app->user->identity->id;
            $likes->save();
            $animal = Animals::findById($animals_id);
            $animal->countlikes += 1;
            $animal->save();
            return 'OKPLUS';
        }
        else{
            $info->delete();
            $animal = Animals::findById($animals_id);
            $animal->countlikes -= 1;
            $animal->save();
            return 'OKMINUS';
        }
    }

    public static function findById($id){
        return self::find()->where(['id'=>$id])->one();
    }
}