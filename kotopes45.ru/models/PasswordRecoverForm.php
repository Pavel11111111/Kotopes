<?php

namespace app\models;

use yii\base\Model;
use yii\base\InvalidParamException;

/**
 * Password reset form
 */
class PasswordRecoverForm extends Model
{

    public $password;
    public $password2;
    /**
     * @var \app\models\User
     */
    private $_user;

    /**
     * Creates a form model given a token.
     *
     * @param string $token
     * @param array $config name-value pairs that will be used to initialize the object properties
     * @throws \yii\base\InvalidParamException if token is empty or not valid
     */
    public function __construct($token, $config = [])
    {

        if (empty($token) || !is_string($token)) {
            throw new InvalidParamException('Нет токена для сброса пароля.');
        }

        $this->_user = User::findByPasswordResetToken($token);

        if (!$this->_user) {
            throw new InvalidParamException('Неверный токен для сброса пароля.');
        }

        parent::__construct($config);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['password', 'required', 'message' => 'Введите пароль'],
            ['password', 'string', 'min'=>8, 'max'=>20, 'tooShort' => 'Длина пароля должна быть не меньше 8 символов' , 'tooLong' => 'Длина пароля должна быть не больше 20 символов'],
            ['password', 'validatePassword3'],
            ['password2', 'required', 'message' => 'Подтвердите пароль'],
            ['password2', 'validatePassword2'],
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
    public function validatePassword2($attribute, $params)
    {
        if ($this->password != $this->password2) {
            $this->addError($attribute, 'Введённые пароли не совпадают');
        }
    }

    public function resetPassword()
    {
        $user = $this->_user;
        $user->setPassword($this->password);
        $user->removePasswordResetToken();
        return $user->save(false);
    }

}