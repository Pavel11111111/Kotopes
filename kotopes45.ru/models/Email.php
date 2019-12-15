<?php
namespace app\models;

use yii\base\Model;

class Email extends Model
{
    public $email;
    public function rules(){
        return[
            ['email', 'required', 'message' => 'Введите адрес эл.почты'],
            ['email','email', 'message' => 'Введите корректный адрес эл.почты'],
            ['email', 'unique', 'targetClass'=>'app\models\User', 'message' => 'Пользователь с таким адресом эл.почты уже зарегистрирован'],
            ['email', 'string', 'min'=>3, 'max'=>50, 'tooShort' => 'Длина адреса эл. почты должна быть не меньше 3 символов' , 'tooLong' => 'Длина адреса эл.почты должна быть не больше 50 символов' ],
        ];
    }
}