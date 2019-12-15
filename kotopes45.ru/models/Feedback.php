<?php
namespace app\models;

use yii\base\Model;

class Feedback extends Model
{
    public $text;
    public function rules(){
        return[
            ['text', 'required', 'message' => 'Пожалуйста, заполните поле для текста'],
            ['text', 'string', 'max'=>300, 'tooLong' => 'Текст вашего обращения не должен превышать 300 символов' ],
        ];
    }
}