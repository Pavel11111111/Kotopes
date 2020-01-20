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
class PasswordRecover extends Model
{
    public $email;

    public function rules(){
        return[
            ['email', 'required', 'message' => 'Введите адрес эл.почты'],
            ['email','email', 'message' => 'Введите корректный адрес эл.почты'],
            ['email', 'exist',
                'targetClass' => '\app\models\User',
                'message' => 'Пользователь с таким адресом электронной почты не найден'
            ],
        ];
    }
    public function sendEmail()
    {
        /* @var $user User */
        $user = User::findOne([
            'email' => $this->email,
        ]);

        if (!$user) {
            return false;
        }

        if (!User::isPasswordResetTokenValid($user->recover)) {
            $user->generatePasswordResetToken();
            if (!$user->save()) {
                return false;
            }
        }
        $resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->recover]);
        $text = "Добрый день, для сброса пароля перейдите пожалуйста по следующей ссылке:" . $resetLink;
        return  Yii::$app->mailer->compose()
                ->setFrom(["noreplicate146@gmail.com"=>"Зоомагазин Котопёс"])
                ->setTo($user->email)
                ->setSubject('Восстановление пароля')
                ->setTextBody($text)
                ->setHtmlBody(
                    '<p style="font-weight: bold;font-size:20px;line-height: 24px;color: #000000;font-family: Helvetica, Arial, Verdana;margin:0 0 32px 0;padding:0;">Сбросьте пароль</p>'.
                    '<p style="font-size:15px;line-height: 18px;color: #666666;font-weight: normal;font-family: Helvetica, Arial, Verdana;padding: 0;margin: 0 0 18px 0;word-wrap: break-word;word-break:normal;">Уважаемый клиент!</p>'.
                    '<p style="font-size:15px;line-height: 18px;color: #666666;font-weight: normal;font-family: Helvetica, Arial, Verdana;padding: 0;margin: 0;word-wrap: break-word;word-break:normal;">Вы начали процедуру сброса пароля на сайте Котопёс. Сообщение для сброса пароля отправлено на электронную почту. Чтобы завершить процедуру сброса, нажмите кнопку ниже.</p><br>'.
                    '<p style="font-size:15px;line-height: 18px;color: #666666;font-weight: normal;font-family: Helvetica, Arial, Verdana;padding: 0;margin: 0;word-wrap: break-word;word-break:normal;font-size:14px;line-height: 16px;margin: 0 0 11px 0;"><a href="'. $resetLink. '" style="color: #ffffff;text-decoration: none;"><b style = "border: 1px solid #1428a0;border-radius:5px;background:#1428a0;color: #ffffff;padding:11px 29px 11px 29px;display:inline-block;font-weight: normal;text-transform: uppercase;">СБРОСИТЬ ПАРОЛЬ</b></a> </p><br><br>'.
                    '<p style="font-size:15px;line-height: 18px;color: #666666;font-weight: normal;font-family: Helvetica, Arial, Verdana;padding: 0;margin: 0;word-wrap: break-word;word-break:normal;">Если кнопка в верхней части экрана не работает, скопируйте указанный ниже адрес и вставьте его в новом окне браузера.</p>'.
                    '<p style="font-size:15px;line-height: 18px;color: #666666;font-weight: normal;font-family: Helvetica, Arial, Verdana;padding: 0;margin: 0;word-wrap: break-word;word-break:normal;font-size:12px;line-height: 15px;color: #1428a0;padding:13px 16px 11px 16px;margin:6px 0 21px 0;background: #eef0f9;word-break:break-all;"><a href="'. $resetLink. '" style="text-decoration: none;color: #1428a0;font-size:12px;line-height:15px;color: #1428a0;font-weight: normal;font-family: Helvetica, Arial, Verdana;word-wrap: break-word;word-break:break-all;">'. $resetLink. '</a></p><br><br>'.
                    '<p style="font-size:15px;line-height: 18px;color: #666666;font-weight: normal;font-family: Helvetica, Arial, Verdana;padding: 0;margin: 0;word-wrap: break-word;word-break:normal;">Вы не проходили процесс сброса пароля на сайте Котопёс? В таком случае просто проигнорируйте это сообщение.</p>'
                )
                ->send();
    }
   /* public function find($attribute, $params){
        $user = new User();
        $user = $user->findEmail($this->email);
        if($user == null){
            $this->addError($attribute, 'Пользователь с таким адресом электронной почты не найден');
        }
    }*/
}