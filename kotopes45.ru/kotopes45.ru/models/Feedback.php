<?php
namespace app\models;

use yii\base\Model;

class Feedback extends Model
{
    public $text;
    public $name;
    public $number;
    public function rules(){
        return[
            ['text', 'required', 'message' => 'Пожалуйста, заполните поле для текста'],
            ['text', 'string', 'max'=>500, 'tooLong' => 'Ваш отзыв слишком длинный, пожалуйста, уложитесь в 500 символов' ],
            ['name', 'validateName'],
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
        if($this->number != null){
            if(!preg_match('/^\+?[0-9]{11,11}$/',$this->number)){
                $this->addError($attribute, 'Введите корректный номер телефона(только цифры и знак +, если он нужен)');
            }
        }
    }
}