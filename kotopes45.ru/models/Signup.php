<?php

namespace app\models;

use yii\base\Model;
use Yii;
class Signup extends Model
{
    const SCENARIO_CREATE_POST = 'create_post';
    public $email;
    public $number;
    public $password;
    public $password2;
    public $name;
    public $patronymic;
    public $date;
    public $date2;
    public $date3;
    public function rules(){
        return[
            ['email', 'required', 'message' => 'Введите адрес эл.почты'],
            ['email','email', 'message' => 'Введите корректный адрес эл.почты'],
            ['email', 'unique', 'targetClass'=>'app\models\User', 'message' => 'Пользователь с таким адресом эл.почты уже зарегистрирован'],
            ['email', 'string', 'min'=>3, 'max'=>50, 'tooShort' => 'Длина адреса эл. почты должна быть не меньше 3 символов' , 'tooLong' => 'Длина адреса эл.почты должна быть не больше 50 символов' ],
            ['number', 'required', 'message' => 'Введите номер телефона'],
            ['number', 'validateNumber'],
            ['password', 'required', 'message' => 'Введите пароль'],
            ['password', 'string', 'min'=>8, 'max'=>20, 'tooShort' => 'Длина пароля должна быть не меньше 8 символов' , 'tooLong' => 'Длина пароля должна быть не больше 20 символов'],
            ['password', 'validatePassword3'],
            ['password2', 'required', 'message' => 'Подтвердите пароль'],
            ['password2', 'validatePassword2'],
            ['name', 'required', 'message' => 'Введите имя пользователя'],
            ['name', 'validateName'],
            ['patronymic', 'required', 'message' => 'Введите фамилию'],
            ['date', 'validateDate'],
            ['date2', 'validateDate'],
            ['date3', 'validateDate'],
        ];
    }

    public function validatePassword3($attribute, $params){
        if(preg_match('/[0-9]/',$this->password) == 0 || preg_match('/[a-zA-ZА-Яа-я]/ui',$this->password) == 0){
            $this->addError($attribute, 'Пароль должен содержать буквы и цифры');
        }
        else{
            $index = 1;
            $sov = 1;
            $str_len1 = strlen($this->password);
            while ($index < $str_len1) {
                if($sov == 3){
                    break;
                }
                if($this->password[$index] == $this->password[$index-1]){
                    $sov +=1;
                }
                else{
                    $sov = 1;
                }
                $index++;
            }
            if($sov == 3){
                $this->addError($attribute, 'В пароле не должен 3, или больше раз повторяться один и тот же символ');
            }
        }
    }

    public function validateNumber($attribute, $params){
        ///^\+?[0-9]{min,max}$/
        if(preg_match('/^\+?[0-9]{11,11}$/',$this->number)){
            $userModel = new User;
            if($userModel->findNumber($this->number) != null){
                $this->addError($attribute, 'Пользователь с таким номером телефона уже зарегистрирован');
            }
            if($this->number[0] == '8') {
                $number2 = preg_replace('/^8/', '+7', $this->number, 1, $count);
            }
            elseif($this->number[0] == '+') {
                $number2 = preg_replace('/^\\+7/', '8', $this->number, 1, $count);
            }
            if($userModel->findNumber($number2) != null){
                $this->addError($attribute, 'Пользователь с таким номером телефона уже зарегистрирован');
            }
        }
        else{
            $this->addError($attribute, 'Введите корректный номер телефона(только цифры и знак +, если он нужен)');
        }
    }
    public function validateName($attribute, $params){
        if(preg_match('/^[а-яА-Яa-zA-Z]*$/ui',$this->name) == 0){
            $this->addError("name", 'Имена не могут содержать специальных символов и цифр');
        }
        if(preg_match('/^[а-яА-Яa-zA-Z]*$/ui',$this->patronymic) == 0){
            $this->addError("patronymic", 'Имена не могут содержать специальных символов и цифр');
        }
    }

    public function validateDate($attribute, $params){
       if($this->date == null || $this->date3 == null){
            $this->addError("date3", 'заполните поля даты рождения');
            if($this->date == null){
                $this->addError("date", '');
            }
        }
        if(!strtotime($this->date3 . '-' . $this->date2 . '-' . $this->date)){
                $this->addError("date3", 'Введена некорректная дата рождения');
        }
        $time = strtotime($this->date3 . '-' . $this->date2 . '-' . $this->date);
        if($time > time()){
            $this->addError("date3", 'Введена некорректная дата рождения');
        }
    }

    public function validatePassword2($attribute, $params)
    {
        if ($this->password != $this->password2) {
            $this->addError($attribute, 'Введённые пароли не совпадают');
        }
    }

    public function signup(){
        if($this->errors == null){
            $user = new User;
            $user->email = $this->email;
            $user->number = $this->number;
            $user->setPassword($this->password);
            $user->name = $this->name;
            $user->patronymic = $this->patronymic;
            $user->date = $this->date3 . '-' . $this->date2 . '-' . $this->date;
            $random = Yii::$app->security->generateRandomString();
            $user->validate = $random;
            $user->save();
            return $random;
        }else{
            return 'error';
        }
    }

    public function getUser(){
        return User::findOne(['email'=>$this->email]);//а получаем мы его по введенному usernamy
    }
}