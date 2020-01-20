<?php

namespace app\models\catalog;

use Yii;
use yii\base\Model;

class Checkemail extends Model
{
    public $number;
    public $clientname;
    public $variationid;

    public function rules(){
        return[
            ['number', 'required', 'message' => 'Введите номер телефона'],
            ['number', 'validateNumber'],
            ['clientname', 'required', 'message' => 'Введите ФИО'],
        ];
    }

    public function validateNumber($attribute, $params){

        if(!(preg_match('/^\+?[0-9]{11,11}$/',$this->number))){
            $this->addError($attribute, 'Введите корректный номер телефона(только цифры и знак +, если он нужен)');
        }
    }
    public function sendEmail($variation)
    {
        return  Yii::$app->mailer->compose()
            ->setFrom(["noreplicate146@gmail.com"=>"Зоомагазин Котопёс"])
            ->setTo('mkotopes.online@yandex.ru')
            ->setSubject('Кнопка "Заказать товар"')
            ->setTextBody('Здарова Серый, тут пользователь хочет заказать товар: ' . $variation->product["name"] . ". Вариация товара: " . $variation->name . ". Номер телефона пользователя:" . $this->number)
            ->send();
    }
}