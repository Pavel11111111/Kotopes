<?php
namespace app\models;

use yii\base\Model;

class OrderProduct extends Model
{
    public $text;
    public $name;
    public $number;
    public function rules(){
        return[
            ['text', 'required', 'message' => 'Пожалуйста, заполните поле для текста'],
            ['text', 'string', 'max'=>300, 'tooLong' => 'Текст вашего обращения не должен превышать 300 символов' ],
            ['name', 'required', 'message' => 'Введите имя'],
            ['name', 'validateName'],
            ['number', 'required', 'message' => 'Введите номер телефона'],
            ['number', 'validateNumber'],
        ];
    }
    
    public function validateName($attribute, $params){
        if(preg_match('/^[а-яА-Яa-zA-Z ]*$/ui',$this->name) == 0){
            $this->addError("name", 'Имена не могут содержать специальных символов и цифр');
        }
    }
    
    public function validateNumber($attribute, $params){
        ///^\+?[0-9]{min,max}$/
        if(!preg_match('/^\+?[0-9]{11,11}$/',$this->number)){
            $this->addError($attribute, 'Введите корректный номер телефона(только цифры и знак +, если он нужен)');
        }
    }
}