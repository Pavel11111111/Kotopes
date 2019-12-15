<?php
namespace app\models;

use yii\base\Model;

class OrderProduct extends Model
{
    public $text;
    public $address;
    public function rules(){
        return[
            ['text', 'required', 'message' => 'Пожалуйста, заполните поле для текста'],
            ['text', 'string', 'max'=>300, 'tooLong' => 'Текст вашего обращения не должен превышать 300 символов' ],
            ['address', 'required', 'message' => 'Пожалуйста, заполните поле для адреса доставки'],
        ];
    }
}