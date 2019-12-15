<?php

namespace app\models;

use Yii;
use yii\base\Model;
/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class LoginForm extends Model
{
    public $emailornumber;
    public $password;

    public function rules(){
        return[
            ['emailornumber', 'required', 'message' => 'Введите адрес эл. почты или номер тел.'],
            ['password', 'required', 'message' => 'Введите пароль'],
            ['password', 'validatePassword'] //собственная функция валидации пароля
        ];
    }

    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()){ //если нет ошибок в валидации
            $user = $this->getUser();//получаем пользователя для дальнейшнего сравнения пароля
            if(!$user || !$user->validatePassword($this->password)){ //если мы не нашли такого пользователя, или пароли не совпадают
                //то добавляем новую ошибку для аттрубута password
                $this->addError($attribute, 'Пароль или идентификатор введены неверно');
            }
        }

    }

    public function getUser(){
        $user = User::findOne(['email'=>$this->emailornumber]);//а получаем мы его по введенному usernamy
        if(!$user){
            $user = User::findOne(['number'=>$this->emailornumber]);
            if(!$user){
                /*$index = 0;
                $str_len1 = strlen($this->emailornumber);
                while ($index < $str_len1) {
                    if($index == 0){
                        if($this->emailornumber[0] == '+'){
                            $value = '8';
                            $index++;
                            continue;
                        }
                        else{
                            $value = '+7';
                            $index++;
                            continue;
                        }
                    }
                    $value += emailornumber[$index];
                    $index++;
                }*/
                $count = null;
                $number = $this->emailornumber;
                if($number[0] == '8') {
                    $number = preg_replace('/^8/', '+7', $number, 1, $count);
                }
                elseif($number[0] == '+') {
                    $number = preg_replace('/^\\+7/', '8', $number, 1, $count);
                }
                return User::findOne(['number'=>$number]);
            }
            else{
                return $user;
            }
        }
        else{
            return $user;
        }
    }
}
