<?php
$this->title = 'Восстановление пароля | Котопёс КУРГАН | Официальный сайт';

use yii\helpers\Html;
use yii\widgets\ActiveForm; ?>
 <div class = "hidtext col-lg-offset-2 col-lg-8 col-md-6 col-md-offset-3 col-sm-12 col-sm-offset-0 col-xs-12 col-xs-offset-0">
            <div class = "col-lg-12 col-md-12 col-sm-12 col-xs-12 fots">
                <p class ="feedtext">Введите новый пароль</p>
                <?php $form = ActiveForm::begin([
                    'id' => 'reset-form',
                    'validateOnChange' => false,
                    'validateOnBlur' => false,
                    'fieldConfig' => [
                        'template' => "<div class = \"row\"><div class=\"col-xs-0 col-sm-3 col-md-3 col-lg-3\"></div><div class=\"col-xs-12 col-sm-6 col-md-6 col-lg-6\">{input}</div></div>\n<div class=\"row\"><div class=\"col-xs-3 col-sm-3 col-md-3 col-lg-3\"></div><div class=\"col-xs-6 col-sm-6 col-md-6 col-lg-6\">{error}</div></div>",
                        'labelOptions' => ['class' => 'col-lg-1 control-label'],
                    ],
                ]); ?>
                <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Пароль', 'class'=>'form-control text-left']) ?>
                <?= $form->field($model, 'password2')->passwordInput(['placeholder' => 'Подтвердите пароль', 'class'=>'form-control text-left']) ?>
                <?= Html::submitButton('ОТПРАВИТЬ', ['class' => 'knopkafeedback']) ?>
                <?php ActiveForm::end(); ?>
            </div>
 </div>