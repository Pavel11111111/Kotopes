<?php

namespace app\models;

use yii\base\Model;
use Yii;
class EditUserProfile extends Model
{
    const SCENARIO_CREATE_POST = 'create_post';
    
    public $email;
    public $number;
    public $name;
    public $patronymic;
    public $date;
    public $date2;
    public $date3;
    public $oldpassword;
    public $newpassword;
    public $newpassword2;
    
    public function rules(){
        return[
            ['email', 'required', 'message' => 'Введите адрес эл.почты'],
            ['email','email', 'message' => 'Введите корректный адрес эл.почты'],
            ['email', 'validateEmail'],
            ['email', 'string', 'min'=>3, 'max'=>50, 'tooShort' => 'Длина адреса эл. почты должна быть не меньше 3 символов' , 'tooLong' => 'Длина адреса эл.почты должна быть не больше 50 символов' ],
            ['number', 'required', 'message' => 'Введите номер телефона'],
            ['number', 'validateNumber'],
            [['oldpassword', 'newpassword', 'newpassword2'], 'default', 'value' => false],
            ['newpassword', 'validatePassword'],
            ['name', 'required', 'message' => 'Введите имя пользователя'],
            ['name', 'validateName'],
            ['patronymic', 'required', 'message' => 'Введите фамилию'],
            ['date', 'validateDate'],
            ['date2', 'validateDate'],
            ['date3', 'validateDate'],
        ];
    }

    public function validatePassword($attribute, $params){
        $user = User::findOne(Yii::$app->user->id);
        if($this->oldpassword != false || $this->newpassword != false || $this->newpassword2 != false){
            if($this->oldpassword == false){
                $this->addError("oldpassword", 'Введите Ваш старый пароль');
            }elseif($this->newpassword == false){
                $this->addError("newpassword", 'Введите новый пароль');
            }elseif($this->newpassword2 == false){
                $this->addError("newpassword2", 'Повторите новый пароль');
            }else{
                if(!$user->validatePassword($this->oldpassword)){
                    $this->addError("oldpassword", 'Старый пароль введён неверно');
                }else{
                    preg_match_all( '/./ui', $this->newpassword, $matches);
                    if(count($matches[0]) > 20){
                        $this->addError("newpassword", 'Длина пароля должна быть не больше 20 символов');
                    }elseif(count($matches[0]) < 8){
                        $this->addError("newpassword", 'Длина пароля должна быть не меньше 8 символов');
                    }else{
                        if(preg_match('/[0-9]/',$this->newpassword) == 0 || preg_match('/[a-zA-ZА-Яа-я]/ui',$this->newpassword) == 0){
                            $this->addError("newpassword", 'Пароль должен содержать буквы и цифры');
                        }else{
                            $index = 1;
                            $sov = 1;
                            $str_len1 = count($matches[0]);
                            while ($index < $str_len1) {
                                if($sov == 3){
                                    break;
                                }
                                if($this->newpassword[$index] == $this->newpassword[$index-1]){
                                    $sov +=1;
                                }
                                else{
                                    $sov = 1;
                                }
                                $index++;
                            }
                            if($sov == 3){
                                $this->addError("newpassword", 'В пароле не должен 3, или больше раз подряд повторяться один и тот же символ');
                            }else{
                                if($this->newpassword != $this->newpassword2) {
                                    $this->addError("newpassword2", 'Введённые пароли не совпадают');
                                }
                            }
                        }
                    }
                }
            }
        }
    }
    public function validateEmail($attribute, $params){
        $userModel = new User;
        if(Yii::$app->user->identity->email != $this->email){
            if($userModel->findEmail($this->email) != null){
                $this->addError($attribute, 'Пользователь с таким адресом электронной почты уже зарегистрирован');
            }
        }
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
        $userModel = new User;
        if(!preg_match('/^\+?[0-9]{11,11}$/',$this->number)){
            $this->addError($attribute, 'Введите корректный номер телефона(только цифры и знак +, если он нужен)');
        }
        if(Yii::$app->user->identity->number != $this->number){
            if($userModel->findNumber($this->number) != null){
                $this->addError($attribute, 'Пользователь с таким номером телефона уже зарегистрирован');
            }
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
                $this->addError("date", 'заполните поля даты рождения');
            }
        }
        if(!strtotime($this->date3 . '-' . $this->date2 . '-' . $this->date)){
                $this->addError("date3", 'Введена некорректная дата рождения');
                $this->addError("date2", 'Введена некорректная дата рождения');
                $this->addError("date", 'Введена некорректная дата рождения');
        }
        $time = strtotime($this->date3 . '-' . $this->date2 . '-' . $this->date);
        if($time > time()){
            $this->addError("date3", 'Введена некорректная дата рождения');
            $this->addError("date2", 'Введена некорректная дата рождения');
            $this->addError("date", 'Введена некорректная дата рождения');
        }
    }
    
    public function changeUser(){
       $user = User::findOne(Yii::$app->user->id);
       $user->name = $this->name;
       $user->patronymic = $this->patronymic;
       $user->date = $this->date . '-' . $this->date2 . '-' . $this->date3;
       $user->number = $this->number;
       if($this->newpassword != null){
           $user->setPassword($this->newpassword);
       }
       if($user->email != $this->email){
           $user->email = $this->email;
           $random = Yii::$app->security->generateRandomString();
           $user->validate = $random;
           $user->save();
           $text = "Добрый день, для подтверждения вашего аккаунта на сайте Котопёс перейдите по следующей ссылке:http://kotopes45.ru/site/validate?token=" . $random;
            Yii::$app->mailer->compose()
                ->setFrom(["noreplicate146@gmail.com"=>"Зоомагазин Котопёс"])
                ->setTo($this->email)
                ->setSubject('Подтвердите свой аккаунт')
                ->setTextBody($text)
                ->setHtmlBody(
                    '<p style="font-weight: bold;font-size:20px;line-height: 24px;color: #000000;font-family: Helvetica, Arial, Verdana;margin:0 0 32px 0;padding:0;">Подтвердите свой аккаунт на сайте Котопёс</p>' .
                    '<p style="font-size:15px;line-height: 18px;color: #666666;font-weight: normal;font-family: Helvetica, Arial, Verdana;padding: 0;margin: 0 0 18px 0;word-wrap: break-word;word-break:normal;">Уважаемый клиент!</p>' .
                    '<p style="font-size:15px;line-height: 18px;color: #666666;font-weight: normal;font-family: Helvetica, Arial, Verdana;padding: 0;margin: 0;word-wrap: break-word;word-break:normal;">Вы зарегистрировали ' . $this->email . ' как идентификатор вашей учетной записи на сайте Котопёс. <br> После нажатия кнопки процесс аутентификации будет завершен.</p><br>' .
                    '<p style="font-size:15px;line-height: 18px;color: #666666;font-weight: normal;font-family: Helvetica, Arial, Verdana;padding: 0;margin: 0;word-wrap: break-word;word-break:normal;font-size:14px;line-height: 16px;margin: 0 0 11px 0;"><a href="http://kotopes45.ru/site/validate?token=' . $random . '" style="color: #ffffff;text-decoration: none;"><b style = "border: 1px solid #1428a0;border-radius:5px;background:#1428a0;color: #ffffff;padding:11px 29px 11px 29px;display:inline-block;font-weight: normal;text-transform: uppercase;">ПОДТВЕРДИТЬ УЧЁТНУЮ ЗАПИСЬ</b></a> </p><br><br>' .
                    '<p style="font-size:15px;line-height: 18px;color: #666666;font-weight: normal;font-family: Helvetica, Arial, Verdana;padding: 0;margin: 0;word-wrap: break-word;word-break:normal;">Если кнопка в верхней части экрана не работает, скопируйте указанный ниже адрес и вставьте его в новом окне браузера.</p>' .
                    '<p style="font-size:15px;line-height: 18px;color: #666666;font-weight: normal;font-family: Helvetica, Arial, Verdana;padding: 0;margin: 0;word-wrap: break-word;word-break:normal;font-size:12px;line-height: 15px;color: #1428a0;padding:13px 16px 11px 16px;margin:6px 0 21px 0;background: #eef0f9;word-break:break-all;"><a href="http://kotopes45.ru/site/validate?token=' . $random . '" style="text-decoration: none;color: #1428a0;font-size:12px;line-height:15px;color: #1428a0;font-weight: normal;font-family: Helvetica, Arial, Verdana;word-wrap: break-word;word-break:break-all;">http://kotopes45.ru/site/validate?token=' . $random . '</a></p><br><br>' .
                    '<p style="font-size:15px;line-height: 18px;color: #666666;font-weight: normal;font-family: Helvetica, Arial, Verdana;padding: 0;margin: 0;word-wrap: break-word;word-break:normal;"><b>Вы не проходили процесс регистрации на сайте Котопёс?</b><br>Другой пользователь мог зарегистрировать неправильный адрес электронной почты по ошибке. В таком случае просто проигнорируйте это сообщение.</p>'
                )
                ->send();
           return 'emailchanged';
       }
       $user->save();
       return 'emailnochange';
    }
}