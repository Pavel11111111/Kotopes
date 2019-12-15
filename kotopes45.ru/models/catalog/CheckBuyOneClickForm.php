<?php

namespace app\models\catalog;

use Yii;
use yii\base\Model;

class CheckBuyOneClickForm extends Model
{
    public $number;
    public $variationid;
    public $clientname;
    public $countproduct;
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
            ->setSubject('Быстрая покупка')
            ->setTextBody('Здарова Серый, тут пользователь хочет купить товар: ' . $variation->product["name"] . ". Вариация товара: " . $variation->name . ". Количество товара: " . $this->countproduct . ".Данные о пользователе: номер телефона: " . $this->number . ". Имя: " . $this->clientname)
            ->send();
    }
}