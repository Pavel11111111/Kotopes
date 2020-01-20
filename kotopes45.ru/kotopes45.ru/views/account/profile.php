<?php

/* @var $this yii\web\View */

$this->title = 'Профиль | Котопёс КУРГАН | Официальный сайт';

use yii\helpers\Html;
use yii\helpers\Url; 
use yii\widgets\ActiveForm; 
?>
<div class="account-profile">
    <div class = "account-layout">
        <div class = "account-layout-center-container">
            <ul class = "col-md-12 account-layout-ul">
                <li class = "account-layout-link col-xs-6 col-sm-6 col-md-6">
                    <a href = "<?php echo Url::toRoute(['account/index', 'profile' => Yii::$app->user->id]); ?>">Заказы</a>
                </li>
                <li class = "account-layout-active-link account-layout-link col-xs-6 col-sm-6 col-md-6">
                    <a href = "<?php echo Url::toRoute(['account/profile']); ?>">Профиль</a>
                </li>
                <li class = "account-layout-link col-xs-6 col-sm-6 col-md-6">
                    <a href = "<?php echo Url::toRoute(['account/favourites', 'profile' => Yii::$app->user->id]); ?>">Избранное</a>
                </li>
            </ul>
        </div>
    </div>
    <div class = "information">
        Данные вашего аккаунта успешно изменены
    </div>
    <div class = "col-lg-offset-3 col-lg-6 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-12 col-xs-offset-0">
        <div class = "account-profile-main-container row">
            <div class = "profile-container">
                <div class = "profile-header">
                    <h1><?php echo Yii::$app->user->identity->name ?> <br><?php echo Yii::$app->user->identity->patronymic ?></h1>
                </div>
                <div class = "profile-address">
                    <div class = "profile-address-header">
                        <h2 class = "profile-address-header-title">Адрес доставки</h2>
                        <?php
                        if (Yii::$app->user->identity->defaultadress == null){
                        ?>
                            <a class = "profile-address-header-action">ДОБАВИТЬ</a>
                        <?php
                        }else{
                        ?>
                            <a style = "display:none;" class = "profile-address-header-action">ДОБАВИТЬ</a>
                        <?php
                        }
                        ?>
                    </div>
                    <div class = "profile-address-list">
                        <div class = "row address-add-hidden" style = "display:none;">
                            <div class = "address-form">
                                <label class = "profile-address-label">Найти адрес</label>
                                <input value = "<?= Yii::$app->user->identity->defaultadress ?>"id = "address" class = "makeorderforminput">
                                <div class = "address-form-actions">
                                    <a class = "address-cancel">ОТМЕНИТЬ</a>
                                    <button class = "button-disabled add-address-button">Сохранить</button>
                                </div>
                            </div>
                        </div>
                        <?php
                            if (Yii::$app->user->identity->defaultadress == null){
                        ?>
                        <div class = "profile-address-detail">
                        <?php
                            }else{
                        ?>
                        <div class = "profile-address-detail profile-address-detail-completed">
                        <?php
                            }
                        ?>
                            <?php
                            if (Yii::$app->user->identity->defaultadress == null){
                            ?>
                            <p class = "profile-address-information">Адрес доставки не был добавлен</p>
                            <?php
                            }else{
                            ?>
                                <p class = "profile-address-information">
                                    <?php echo Yii::$app->user->identity->defaultadress ?>
                                </p>
                                <ul class = "profile-address-actions">
                                    <li>
                                        <a id = "edit-address" href = "">Редактировать</a>
                                    </li>
                                    <li>
                                        <a id = "delete-address" href = "">Удалить адрес</a>
                                    </li>
                                </ul>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class = "profile-user-data">
                    <h2 class = "profile-user-data-header-title">Личные данные</h2>
                    <?php $form = ActiveForm::begin([
                        'id' => 'editsignup-form',
                        'action' => 'account/profile',
                        'enableAjaxValidation' => true,
                        'validationUrl' => 'account/editsignupvalidate',
                        'validateOnChange' => false,
                        'validateOnBlur' => false,
                        'fieldConfig' => [
                            'template' => "{input}{error}<br>",
                            'labelOptions' => ['class' => 'col-lg-1 control-label'],
                        ],
                    ]); ?>
                    <p class = "makeorderformtext" style = "margin-top: 33px;">Адрес электронной почты</p>
                    <?= $form->field($editsignup, 'email')->textInput(['value' => Yii::$app->user->identity->email, 'class'=>'form-control text-left makeorderforminput']); ?>
                    <p class = "makeorderformtext" style = "margin-top: 33px;">Номер телефона</p>
                    <?= $form->field($editsignup, 'number')->textInput(['value' => Yii::$app->user->identity->number, 'class'=>'form-control text-left makeorderforminput']); ?>
                    <p class = "makeorderformtext" style = "margin-top: 33px;">Пароль</p>
                    <p class = "passwordchangelink" data-id="0">Изменить пароль</p>
                    <div class = "passwordblockhidden">
                        <p class = "makeorderformtext" style = "margin-top: 33px;">Старый пароль</p>
                        <?= $form->field($editsignup, 'oldpassword')->passwordInput(['class'=>'form-control text-left makeorderforminput']); ?>
                        <p class = "makeorderformtext" style = "margin-top: 33px;">Новый пароль</p>
                        <?= $form->field($editsignup, 'newpassword')->passwordInput(['class'=>'form-control text-left makeorderforminput']); ?>
                        <p class = "makeorderformtext" style = "margin-top: 33px;">Подтвердите пароль</p>
                        <?= $form->field($editsignup, 'newpassword2')->passwordInput(['class'=>'form-control text-left makeorderforminput']); ?>
                        <div style="background-color: #F5F6FF; border: solid 1px #ACB3D8; margin-bottom: 30px;width:100%;padding-left: 15px;padding-right: 15px;">
                            <p style="font-family: Arial,sans-serif;font-size: 18px; font-weight: bold; color: #333333;">Пароль</p><br>
                            <p style="font-family: Arial,sans-serif;font-size: 16px; color: #333333;">Минимальное количество символов: 8. Максимальное количество символов: 20. Используйте буквы и цифры. Один и тот же символ не должен повторяться более трёх раз подряд.</p>
                        </div>
                    </div>
                    <p class = "makeorderformtext" style = "margin-top: 33px;">Имя</p>
                    <?= $form->field($editsignup, 'name')->textInput(['maxlength'=>25, 'value' => Yii::$app->user->identity->name, 'class'=>'form-control text-left makeorderforminput']); ?>
                    <p class = "makeorderformtext" style = "margin-top: 33px;">Фамилия</p>
                    <?= $form->field($editsignup, 'patronymic')->textInput(['maxlength'=>50, 'value' => Yii::$app->user->identity->patronymic, 'class'=>'form-control text-left makeorderforminput']); ?>
                    <p class = "makeorderformtext" style = "margin-top: 33px;">Дата рождения</p>
                    <div class = "profile-user-data-date">
                        <?php
                            $userdate = explode("-", Yii::$app->user->identity->date);
                        ?>
                        <?= $form->field($editsignup, 'date3', ['template' => '<div style = "width: 100%"><p>День</p></div><div style = "width: 100%;">{input}</div><div style = "width: 100%">{error}</div>'])->textInput(['value' => $userdate[2], 'class'=>'form-control text-left makeorderforminput']); ?>
                        <?= $form->field($editsignup, 'date2', ['template' => '<div style = "width: 100%"><p>Месяц</p></div><div style = "width: 100%;">{input}</div><div style = "width: 100%">{error}</div>'])->dropDownList(['01' => 'Январь','02' =>'Февраль','03' =>'Март','04' =>'Апрель','05' =>'Май','06' =>'Июнь','07' =>'Июль','08' =>'Август','09' =>'Сентябрь','10' =>'Октябрь','11' =>'Ноябрь','12' =>'Декабрь'],
                        ['class'=>'form-control text-left makeorderforminput', 'value' => $userdate[1]]) ?>
                        <?= $form->field($editsignup, 'date', ['template' => '<div style = "width: 100%"><p>Год</p></div><div style = "width: 100%;">{input}</div><div style = "width: 100%">{error}</div>'])->textInput(['value' => $userdate[0], 'class'=>'form-control text-left makeorderforminput']); ?>
                    </div>
                    <?= Html::submitButton('СОХРАНИТЬ', ['style' => 'margin-top: 35px;margin-bottom:20px;' ,'class' => 'knopkareg openmodalreg']) ?>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>