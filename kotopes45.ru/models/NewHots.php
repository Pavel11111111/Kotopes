<?php

namespace app\models;

use yii\base\Model;
use Yii;
use yii\web\UploadedFile;

class NewHots extends Model
{
    public $id, $gltext, $text, $url, $gltextcolor, $textcolor, $oldid;
    /**
     * @var UploadedFile
     */
    public $img;
    public function rules(){
        return[
            [['gltext', 'text', 'url'], 'default', 'value' => null],
        ];
    }

    public function upload($randomName)
    {
        if ($this->validate()) {
            for (; ;) {
                if (Hots::findByFileName($randomName, $this->img->extension) == null) {
                    $this->img->saveAs('images/' . $randomName . '.' . $this->img->extension);
                    return $randomName;
                } else {
                    $randomName = Yii::$app->security->generateRandomString();
                }
            }
        }
        else{
            return null;
        }
    }

    public function setRecord($fileName){
        $banner = new Hots();
        $banner->img = $fileName;
        $banner->text = $this->text;
        $banner->textcolor = $this->textcolor;
        $banner->gltext = $this->gltext;
        $banner->gltextcolor = $this->gltextcolor;
        $banner->url = $this->url;
        $banner->save();// вернет true или false
    }
}