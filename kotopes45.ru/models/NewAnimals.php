<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class NewAnimals extends Model
{
    public $nameA;
    /**
     * @var UploadedFile
     */
    public $imgA;
    public function rules(){
        return[
            ['nameA', 'required', 'message' => 'Пожалуйста, введите кличку вашего питомца'],
            ['nameA', 'string', 'max'=>17, 'tooLong' => 'Кличка не должна превышать 17 символов, если она больше, то пожалуйста, воспользуйтесь сокращённой версией'],
            ['imgA', 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg',  'wrongExtension' => 'Допустимые форматы файлов .png, .jpg', 'uploadRequired' => 'Загрузите фотографию вашего питомца'],
        ];
    }

    public function upload($randomName)
    {
        if ($this->validate()) {
            for(;;) {
                if (Animals::findByFileName($randomName,  $this->imgA->extension) == null) {
                    $this->imgA->saveAs('images/animals/' . $randomName . '.' . $this->imgA->extension);
                    return $randomName;
                }
                else{
                    $randomName = Yii::$app->security->generateRandomString();
                }
            }
        }
        else {
            return null;
        }
    }

    public function create($fileName){
        $animals = new Animals();
        $animals->dateinsert = date('Y-m-d H:i:s');
        $animals->img = $fileName;
        $animals->name = $this->nameA;
        $animals->countlikes = 0;
        $animals->userid = Yii::$app->user->identity->id;
        $animals->save();
    }
}