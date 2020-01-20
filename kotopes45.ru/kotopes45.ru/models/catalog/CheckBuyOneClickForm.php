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
            ->setHtmlBody(
                'Здарова Серый, тут пользователь хочет купить товар: ' . $variation->product["name"] . ". Вариация товара: " . $variation->name . ". Количество товара: " . $this->countproduct . 
                ".Данные о пользователе: номер телефона: " . $this->number . ". Имя: " . $this->clientname . "<br> ID пользователя:" . Yii::$app->user->id . 
                '<br><p style="font-size:15px;line-height: 18px;color: #666666;font-weight: normal;font-family: Helvetica, Arial, Verdana;padding: 0;margin: 0;word-wrap: break-word;word-break:normal;font-size:14px;line-height: 16px;margin: 0 0 11px 0;"><a href="http://kotopes45.ru/admin/restoreproduct?product=' . $this->variationid . '&count=' . $this->countproduct . '" style="color: #ffffff;text-decoration: none;"><b style = "border: 1px solid #1428a0;border-radius:5px;background:#1428a0;color: #ffffff;padding:11px 29px 11px 29px;display:inline-block;font-weight: normal;text-transform: uppercase;">отменить заказ</b></a> </p><br><br>'
            )
            ->send();
    }
}