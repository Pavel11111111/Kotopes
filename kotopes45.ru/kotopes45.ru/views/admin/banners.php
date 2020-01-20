<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Админка';
?>
<div class = "col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div style = "margin-top: 20px; border: 1px solid darkred">
        <?php $form = ActiveForm::begin([
            'id' => 'newbanner-form',
            'options' => ['enctype' => 'multipart/form-data'],
            'action' => 'newbanner',
            'validateOnChange' => false,
            'validateOnBlur' => false,
            'fieldConfig' => [
                'template' => "<div class = \"row\"><div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12\">{input}</div></div>\n<div class=\"row\"><div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12\">{error}</div></div>",
                'labelOptions' => ['class' => 'col-lg-1 control-label'],
            ],
        ]);?>
        <p class = "text-center">Верхний текст</p>
        <?= $form->field($newbanner, 'gltext')->textInput(['class'=>'form-control text-left' ]) ?>
        <p class = "text-center">Цвет верхнего текста</p>
        <?= $form->field($newbanner, 'gltextcolor')->input('color', ['class'=>'form-control text-left']) ?>
        <p class = "text-center">Нижний текст</p>
        <?= $form->field($newbanner, 'text')->textInput(['class'=>'form-control text-left' ]) ?>
        <p class = "text-center">Цвет нижнего текста</p>
        <?= $form->field($newbanner, 'textcolor')->input('color', ['class'=>'form-control text-left']) ?>
        <p class = "text-center">Изображение</p>
        <?= $form->field($newbanner, 'img')->fileInput(['class'=>'uploadButton']);?>
        <p class = "text-center">Ссылка</p>
        <?= $form->field($newbanner, 'url')->textInput(['class'=>'form-control text-left']) ?>
        <?= Html::submitButton('ДОБАВИТЬ', ['class' => 'knopkafeedback']) ?><br><br>
        <?php
        ActiveForm::end();
        ?>
    </div>
    <?php
    foreach ($banners as $banner){
    ?>
        <div style = "margin-top: 20px; border: 1px solid darkred">
            <?php $form = ActiveForm::begin([
                'action' => 'changebanner',
                'validateOnChange' => false,
                'validateOnBlur' => false,
                'fieldConfig' => [
                    'template' => "<div class = \"row\"><div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12\">{input}</div></div>\n<div class=\"row\"><div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12\">{error}</div></div>",
                    'labelOptions' => ['class' => 'col-lg-1 control-label'],
                ],
            ]);?>
            <?= $form->field($newbanner, 'oldid')->hiddenInput(['class'=>'form-control text-left' , 'value' => $banner->id]) ?>
            <p class = "text-center">Порядковый номер(Не изменять!!!!!)</p>
            <?= $form->field($newbanner, 'id')->textInput(['class'=>'form-control text-left' , 'value' => $banner->id]) ?>
            <p class = "text-center">Верхний текст</p>
            <?= $form->field($newbanner, 'gltext')->textInput(['class'=>'form-control text-left' , 'value' => $banner->gltext]) ?>
            <p class = "text-center">Цвет верхнего текста</p>
            <?= $form->field($newbanner, 'gltextcolor')->input('color', ['class'=>'form-control text-left', 'value' => $banner->gltextcolor]) ?>
            <p class = "text-center">Нижний текст</p>
            <?= $form->field($newbanner, 'text')->textInput(['class'=>'form-control text-left' , 'value' => $banner->text]) ?>
            <p class = "text-center">Цвет нижнего текста</p>
            <?= $form->field($newbanner, 'textcolor')->input('color', ['class'=>'form-control text-left', 'value' => $banner->textcolor]) ?>
            <p class = "text-center">Изображение</p>
            <p class = "text-center"><img style = "max-width: 90%;" src = "/images/<?= $banner->img ?>"/></p>
            <?= $form->field($newbanner, 'img')->fileInput(['class'=>'uploadButton']);?>
            <p class = "text-center">Ссылка</p>
            <?= $form->field($newbanner, 'url')->textInput(['class'=>'form-control text-left' , 'value' => $banner->url]) ?>
        <?= Html::submitButton('ИЗМЕНИТЬ', ['class' => 'knopkafeedback']) ?><br><br>
        <?php
        ActiveForm::end();
        ?>
            <?= Html::submitButton('УДАЛИТЬ', ['class' => 'knopkafeedback delete', 'id' => $banner->id]) ?><br><br>
        </div>
    <?php
    }
    ?>
</div>