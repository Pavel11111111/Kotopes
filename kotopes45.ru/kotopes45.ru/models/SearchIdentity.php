<?php

namespace app\models;

use yii\base\Model;

class SearchIdentity extends Model
{
    public $name;
    public $patronymic;
    public $date;
    public $date2;
    public $date3;

    public function rules()
    {
        return [
            ['name', 'required', 'message' => 'Введите имя пользователя'],
            ['name', 'validateName'],
            ['patronymic', 'required', 'message' => 'Введите фамилию'],
            ['date', 'validateDate'],
            ['date2', 'validateDate'],
            ['date3', 'validateDate'],
        ];
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
                $this->addError("date", '');
            }
        }
        if(!strtotime($this->date3 . '-' . $this->date2 . '-' . $this->date)){
            $this->addError("date3", 'Введена некорректная дата рождения');
        }
        $time = strtotime($this->date3 . '-' . $this->date2 . '-' . $this->date);
        if($time > time()){
            $this->addError("date3", 'Введена некорректная дата рождения');
        }
    }

    public function searchUser(){
        return User::Search($this->name, $this->patronymic, $this->date3 . '-' . $this->date2 . '-' . $this->date);
    }
}