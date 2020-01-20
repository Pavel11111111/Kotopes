<?php

namespace app\models;
use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;



class User extends ActiveRecord implements IdentityInterface
{
    public function removePasswordResetToken()
    {
        $this->recover = null;
    }

    public function generatePasswordResetToken()
    {
        $this->recover = Yii::$app->security->generateRandomString() . '_' . time();
    }

    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'recover' => $token,
        ]);
    }

    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {//Проверяет, считается ли переменная пустой. Переменная считается пустой, если она не существует или её значение равно FALSE. empty() не генерирует предупреждение если переменная не существует.
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    public function setPassword($password)
    {
        $this->password = \Yii::$app->getSecurity()->generatePasswordHash($password);
    }

    public function findNumber($number){
        return self::find()->where(['number'=>$number])->one();
    }

    public function findValidate($validate){
        return self::find()->where(['validate'=>$validate])->one();
    }

    public function findEmail($email){
        return self::find()->where(['email'=>$email])->one();
    }

    public static function Search($name,$patronymic,$date){
        return self::find()->where(['name' => $name, 'patronymic' => $patronymic, 'date' => $date])->all();
    }

    public function modifyEmail($email){
        $this->email = $email;
    }


    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    public function getValidate()
    {
        return $this->validate;
    }

    public function getId()
    {
        return $this->id;
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {

    }

    public function getAuthKey()
    {

    }

    public function validateAuthKey($authKey)
    {

    }

    public static function getUsers(){
       /* $query = self::find()->where(['id' => Yii::$app->authManager->getUserIdsByRole('banned')])->all();
        $query2 = self::find()->where(['!=', 'id', Yii::$app->authManager->getUserIdsByRole('banned')])->all();
        echo '<pre>';
        echo var_dump(Yii::$app->authManager->getUserIdsByRole('banned'));
        die('</pre>');*/
        return self::find()->all();
    }
}