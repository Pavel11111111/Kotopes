<?php
$this->title = 'Обратная связь | Котопёс КУРГАН | Официальный сайт';

use yii\helpers\Html;
use yii\widgets\ActiveForm; ?>

<div class="site-feedback">
    <div class ="row" style ="margin:0px;">
        <div style = "display: none;"class = "showtext col-lg-12 col-md-12 col-sm-12 col-xs-12 fots">
            <p class ="feedtext">Спасибо Вам! Каждый отзыв помогает нам становится лучше.</p>
            <div class = "col-lg-offset-1 col-lg-10 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-12 col-xs-offset-0 otstuptextforinformation textforinformation">
                <img style = "display:block;margin:0 auto;width: 60%;border-radius: 60%;" src = "/images/kotek.jpg">
            </div>
        </div>
        <div class = "hidtext col-lg-offset-2 col-lg-8 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12 col-xs-offset-0">
            <div class = "col-lg-12 col-md-12 col-sm-12 col-xs-12 fots">
                <p class ="feedtext">У Вас есть идея или замечание как улучшить работу интернет-магазина?</p>
                <?php $form = ActiveForm::begin([
                    'id' => 'feedback-form',
                    'action' => 'site/feedback',
                    'enableAjaxValidation' => true,
                    'validationUrl' => 'site/validfeedback',
                    'validateOnChange' => false,
                    'validateOnBlur' => false,
                    'fieldConfig' => [
                        'template' => "<div class = \"row\"><div class=\"col-xs-0 col-sm-1 col-md-1 col-lg-1\"></div><div class=\"col-xs-12 col-sm-10 col-md-10 col-lg-10\">{input}</div></div>\n<div class=\"row\"><div class=\"col-xs-0 col-sm-1 col-md-1 col-lg-1\"></div><div class=\"col-xs-12 col-sm-10 col-md-10 col-lg-10\">{error}</div></div>",
                        'labelOptions' => ['class' => 'col-lg-1 control-label'],
                    ],
                ]); ?>
                <?= $form->field($feedbacktext, 'text')->textarea(['placeholder' => 'Пожалуйста, напишите нам об этом', 'class'=>'form-control text-left feedform', 'maxlength'=>300]) ?>
                <?= Html::submitButton('ОТПРАВИТЬ', ['class' => 'knopkafeedback']) ?>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
