<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\bootstrap\ActiveForm;
use app\models\Signup;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=320, initial-scale=1">
    <?php echo Html::csrfMetaTags();?>
    <title><?= Html::encode($this->title)?></title>
    <?php $this->head() ?>
    <link rel="shortcut icon" href="/images/kotopes.ico" type="image/x-icon" />
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
   <div id="InformationBox" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Заголовок модального окна -->
                <div class="modal-header regheader">
                    <h2 class="modal-title row reg" style = "width: 90%;padding-left: 1%;font-size:32px;">На сайт добавлено</h2>
                    <button type="button" class="knopkaimg" data-dismiss="modal" style = "width: 9%;padding-left: 0px;padding-right: 0px;"><img style = "vertical-align:top;" class = "imaga" src="/images/krest.png" alt="закрыть"></button>
                </div>
                <!-- Основное содержимое модального окна -->
                <div class="modal-body row otstup">
                    <?php 
                    foreach($this->context->news as $onenews){
                    ?>
                        <div style ="width: 100%;text-align:center;font-size:20px;">
                            <p><?= $onenews->date ?></p>
                        </div>
                        <div style = "width: 100%;font-size:20px;">
                            <ul>
                            <?php 
                            $i = 0;
                            foreach($onenews->informationtextlists as $onetext){
                            ?>
                                <?php
                                if($i != 0 && $onetext->text == null){
                                ?>
                                    <li style = "list-style-type: none;">
                                        <p style = "display: inline;"><?= $onetext->text ?> </p><br><a style = "display: inline;" href = "http://kotopes45.ru/Catalog?search=<?=  $onetext->link  ?>"><?= $onetext->link ?></a>
                                    </li>
                                <?php
                                }else{
                                ?>
                                    <li>
                                        <p style = "display: inline;"><?= $onetext->text ?> </p><br><a style = "display: inline;" href = "http://kotopes45.ru/Catalog?search=<?=  $onetext->link  ?>"><?= $onetext->link ?></a>
                                    </li>
                                <?php
                                }
                                ?>
                            <?php
                            $i++;
                            }
                            ?>
                            </ul>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <!-- Футер модального окна -->
                <div class="modal-footer">
                    <div id = "addproductmodalready" style = "display:none;">
                        <div style ="width: 100%;text-align:center;font-size:20px;">
                            Спасибо, следите за обновлениями, и возможно, этот товар скоро появится на сайте.
                        </div>
                    </div>
                    <div id = "addproductmodal">
                        <div style ="width: 100%;text-align:center;font-size:20px;">
                            Какой товар Вы хотите видеть следующим?    
                        </div>
                        <div style ="width: 100%;text-align:center;">
                            <textarea id = "sendinformationbyproducttext" style = "width: 100%;max-width: 100%;min-width: 100%; height: 70px;min-height:70px;border: 1px solid black;"></textarea>  
                            <button type = "button" id = "sendinfomationbyproduct" class = 'knopkainput' style = "display:inline-block;margin-top: 13px;">Отправить</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div id="SearchModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Заголовок модального окна -->
                <div class="modal-header" style = "line-height:8px;">
                    <h2 class="SearchModalText reg"style = "width: 90%;">Поиск по каталогу товаров</h2>
                    <button type="button" class="knopkaimg" data-dismiss="modal"style="height: 27px;width:9%;"><img class = "imaga" src="/images/krest.png" alt="закрыть"></button>
                </div>
                <!-- Основное содержимое модального окна -->
                <div class="modal-body row otstup">
                    <div class = "searchbarmargin" style = "margin-bottom: 40px;">
                    <div class = "searchbar">
                        <div class = "searchbar2">
                            <form id="search-form2"  action="site/searchproducts" method="post">
                                <input  maxlength = "100" autocomplete="off" name="Search[text]" class = "searchinput" placeholder="Pro Plan Adult Feline с курицей" type="text">
                                <button type="submit" class="seachicon"></button>
                            </form>
                        </div>
                        <div class = "searchbarhistory" style = "display:none;">
                            <div class = "searchbarhistorytitle">
                                История поиска
                            </div>
                            <ul>
                                <?php
                                if(Yii::$app->user->isGuest){
                                    $searchhistory = Yii::$app->session['searchhistory'];
                                }else{
                                    $searchhistory = $this->context->searchHistory->getInfo(Yii::$app->user->id);
                                }
                                $count = 0;
                                if($searchhistory != null){
                                foreach($searchhistory as $search){
                                    if($count == 5){
                                        break;
                                    }
                                ?>
                                <li class = "searchline"><a href = "  <? echo Url::toRoute(['site/catalog', 'search' => $search["searchtext"]]) ?>"><? echo $search["searchtext"] ?></a></li>
                                <?php
                                }
                                }
                                ?>
                            </ul>
                            <button class = "searchbarbuttonclear" type = "button">ОЧИСТИТЬ ЖУРНАЛ</button>
                        </div>
                    </div>
                </div>
                </div>

            </div>
        </div>
    </div>
    
   <!--вход в аккаунт -->
    <div id="ModalBox1" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Заголовок модального окна -->
                <div class="modal-header regheader">
                    <h2 class="modal-title row reg" style = "width: 90%">Вход в аккаунт</h2>
                    <button type="button" class="knopkaimg" data-dismiss="modal" style = "width: 9%;padding-left: 0px;padding-right: 0px;"><img class = "imaga" src="/images/krest.png" alt="закрыть"></button>
                </div>
                <!-- Основное содержимое модального окна -->
                <div class="modal-body row otstup">
                    <?php $form = ActiveForm::begin([
                        'id' => 'login-form',
                        'layout' => 'horizontal',
                        'action' => 'site/index',
                        'enableAjaxValidation' => true,
                        'validationUrl' => 'site/validlogin',
                        'validateOnChange' => false,
                        'validateOnBlur' => false,
                        'fieldConfig' => [
                            'template' => "<div class = \"row\"><div class=\"col-xs-1 col-sm-1 col-md-1 col-lg-1\"></div><div class=\"col-xs-10 col-sm-10 col-md-10 col-lg-10\">{input}</div></div>\n<div class=\"row\"><div class=\"col-xs-1 col-sm-1 col-md-1 col-lg-1\"></div><div class=\"col-xs-6 col-sm-6 col-md-6 col-lg-6\">{error}</div></div>",
                            'labelOptions' => ['class' => 'col-lg-1 control-label'],
                        ],
                    ]); ?>
                    <?= $form->field($this->context->login, 'emailornumber')->textInput(['placeholder' => 'Эл. почта или номер тел.', 'class'=>'form-control text-left loginform']) ?>

                    <?= $form->field($this->context->login, 'password')->passwordInput(['placeholder' => 'Пароль', 'class'=>'form-control text-left loginform']) ?>
                </div>
                <!-- Футер модального окна -->
                <div class="modal-footer">
                    <div class="form-group">
                        <div class = "row clknop">
                            <div class="col-lg-offset-3 col-lg-6 col-md-6 col-md-offset-3 col-sm-12 col-xs-12" style = "text-align:center">
                                <?= Html::submitButton('ВХОД', ['class' => 'knopkainput','style' => "display:inline-block;"]) ?>
                                <?php ActiveForm::end(); ?>
                            </div>
                        </div>
                    </div>
                        <div class = "row modaltext">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                                <p><a id = "modalcloseopen" href="" class = "modaltextcolor">Найти идентификатор или сбросить пароль?</a><br>или <a id = "modalcloseopen2" href="" class = "modaltextcolor">Регистрация</a></p>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>




    <!--Регистрация -->
    <div id="ModalBox2" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Заголовок модального окна -->
                <div class="modal-header regheader">
                    <h2 class="modal-title row reg"style = "width: 90%">Регистрация</h2>
                    <button type="button" class="knopkaimg" data-dismiss="modal" style = "width: 9%;padding-left: 0px;padding-right: 0px;"><img class = "imaga" src="/images/krest.png" alt="закрыть"></button>
                </div>
                <!-- Основное содержимое модального окна -->
                <div class="modal-body row">
                    <?php $form = ActiveForm::begin([
                        'id' => 'signup-form',
                        'layout' => 'horizontal',
                        'action' => 'site/index',
                        'enableAjaxValidation' => true,
                        'validationUrl' => 'site/valid',
                        'validateOnChange' => false,
                        'validateOnBlur' => false,
                        'fieldConfig' => [
                            'template' => "<div class = \"row\"><div class=\"col-xs-offset-1 col-xs-10 col-sm-offset-1 col-sm-10 col-md-offset-1 col-md-10  col-lg-offset-1 col-lg-10\">{input}</div></div>\n<div class=\"row\"><div class=\"col-xs-offset-1 col-xs-10 col-sm-offset-1 col-sm-10 col-md-offset-1 col-md-10  col-lg-offset-1 col-lg-10\">{error}</div></div>",
                            'labelOptions' => ['class' => 'col-lg-1 control-label'],
                        ],
                    ]); ?>
                    <?= $form->field($this->context->signup, 'email')->textInput(['placeholder' => 'Электронная почта', 'class'=>'form-control text-left loginform']) ?>

                    <?= $form->field($this->context->signup, 'number')->textInput(['placeholder' => 'Номер телефона', 'class'=>'form-control text-left loginform']) ?>

                    <?= $form->field($this->context->signup, 'password')->passwordInput(['placeholder' => 'Пароль', 'class'=>'form-control text-left loginform', 'id'=>'openpod']) ?>
                    <div class="row" style = "display: none" id="hidpod">
                    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10" style="background-color: #F5F6FF; border: solid 1px #ACB3D8; margin-left: 9%; margin-bottom: 30px;">
                        <p style="font-family: Arial,sans-serif;font-size: 18px; font-weight: bold; color: #333333;">Пароль</p><br>
                        <p style="font-family: Arial,sans-serif;font-size: 16px; color: #333333;">Минимальное количество символов: 8. Максимальное количество символов: 20. Используйте буквы и цифры. Один и тот же символ не должен повторяться более трёх раз подряд.</p>
                    </div>
                    </div>
                    <?= $form->field($this->context->signup, 'password2')->passwordInput(['placeholder' => 'Подтвердите пароль', 'class'=>'form-control text-left loginform']) ?>

                    <?= $form->field($this->context->signup, 'name')->textInput(['placeholder' => 'Имя', 'class'=>'form-control text-left loginform', 'maxlength'=>25]) ?>

                    <?= $form->field($this->context->signup, 'patronymic')->textInput(['placeholder' => 'Фамилия', 'class'=>'form-control text-left loginform', 'maxlength'=>50]) ?>

                    <?= $form->field($this->context->signup, 'date')->textInput(['placeholder' => 'День', 'class'=>'form-control text-left loginform openpod2']) ?>

                    <?= $form->field($this->context->signup, 'date2')->dropDownList(['01' => 'Январь','02' =>'Февраль','03' =>'Март','04' =>'Апрель','05' =>'Май','06' =>'Июнь','07' =>'Июль','08' =>'Август','09' =>'Сентябрь','10' =>'Октябрь','11' =>'Ноябрь','12' =>'Декабрь'],
                        ['class'=>'form-control text-left loginform openpod2', 'style' => 'padding-left:6px;']) ?>

                    <?= $form->field($this->context->signup, 'date3')->textInput(['placeholder' => 'Год', 'class'=>'form-control text-left loginform openpod2']) ?>
                    <div class="row" style = "display: none" id="hidpod2">
                        <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10" style="background-color: #F5F6FF; border: solid 1px #ACB3D8; margin-left: 9%; margin-bottom: 30px;">
                            <p style="font-family: Arial,sans-serif;font-size: 18px; font-weight: bold; color: #333333;">Дата рождения</p><br>
                            <p style="font-family: Arial,sans-serif;font-size: 16px; color: #333333;">Дата рождения позволит подтвердить вашу личность в случае утери адреса электронной почты. Кроме того, она используется для проверки возраста, необходимой для получения услуги заказа товаров на дом.</p>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class = "row">
                            <div class="col-lg-offset-1 col-lg-10 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1 ">
                                <?= Html::submitButton('ДАЛЕЕ', ['class' => 'knopkareg openmodalreg']) ?>
                                <?php ActiveForm::end(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Уведомление о письме -->
    <div id="ModalBox4" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Основное содержимое модального окна -->
                <div class="modal-body row textmodal4">
                    <div class="col-lg-offset-1 col-lg-11 col-md-11 col-md-offset-1 col-sm-12 col-xs-12 ">
                        <p style = "display:inline-block;width:90%;font-size: 22px; font-weight: 700; margin-bottom: .3em;">Электронное письмо отправлено</p>
                        <button type="button" class="knopkaimg" data-dismiss="modal" style = "width: 9%;padding-left: 0px;padding-right: 0px;"><img class = "imaga" src="/images/krest.png" alt="закрыть"></button>
                        <p  style = "font-size: 16px">Чтобы завершить создание учетной записи, перейдите по ссылке,<br>отправленной на указанный ниже адрес электронной почты.</p>

                        <div class = "textblock">
                            <p style = "font-size: 16px" class = "emailtext"><?= $this->context->email;?></p>
                        </div>
                        <div class = "textblock2 hiddenemail">
                            <p style = "font-size: 16px;margin-bottom:4px">Не удаётся найти сообщение электронной почты?</p>
                            <a class = "linkmodal4" id = "email">Отправить электронное письмо с подтверждением повторно</a>
                        </div>
                        <div class = "textblock2 hiddenemail2" style = "display: none">
                            <p style = "font-size: 16px">Подтверждение отправлено на ваш адрес электронной почты. Если вы не можете найти его, проверьте папку “Спам”.</p>
                        </div>
                        <div class = "textblock2 hiddenemail3">
                            <p style = "font-size: 16px;margin-bottom:4px">Неправильный адрес электронной почты?</p>
                            <a class = "linkmodal4" id = "email2">Изменение адреса электронной почты</a>
                        </div>
                        <div class = "textblock2 hiddenemail4" style = "display: none">
                            <p style = "font-size: 16px">Пожалуйста, введите новый адрес эл.почты:</p>
                            <input type="text" class = "loginform emailinput" style="width: 90%">
                            <p style = "font-size: 6px; color: red;display: none" class = "texterror"></p>
                            <button class = "knopkaidenti emailbutton" style="margin-top:20px;">ИЗМЕНЕНИЕ АДРЕСА ЭЛЕКТРОННОЙ ПОЧТЫ</button>
                        </div>
                        <div class = "textblock2 hiddenemail5" style = "display: none">
                            <p style = "font-size: 16px">Письмо с подтверждением отправлено на указанный Email.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!--Нахождение сброс пароля-->
    <div id="ModalBox3" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Заголовок модального окна -->
                <div class="modal-header" style="height: 106px;">
                    <button style="display: block; position: absolute;right: 3%;" type="button" class="knopkaimg" data-dismiss="modal"><img class = "imaga" src="/images/krest.png" alt="закрыть"></button>
                    <div class = "marginmodalbox3header" style="margin-top: 48px;">
                        <div class = "texti1">
                            <div class = "ott">
                                <a class = "linki2 activ2" id="myLinkModal" href="">Найти идентификатор</a>
                            </div>
                            <a class = "linki2" id="myLinkModal2" href="">Сбросить&nbsp;пароль</a>
                        </div>
                    </div>
                </div>
                <!-- Основное содержимое модального окна -->
                <div class="modal-body row">
                    <div class = "row" id = "hidModal11" style = "display: none">
                        <p class = "modalInfo" style="font-weight: 700;font-size:22px;">Проверьте информацию ниже</p>
                        <p  class = "modalInfo" style ="margin-top: 30px;margin-bottom: 10px;padding-bottom:10px;border-bottom: 1px solid #ccc;">Были найдены следующие идентификаторы:</p>
                        <p class = "identitytextfind modalInfo"></p>
                        <button class = "knopkaidenti modalcloseopen3 knopkaidentiotstup" style="margin-top:20px;">ВОЙТИ</button>
                            <p class = "modalInfo" style = "margin-top:30px">Чтобы создать новую учётную запись, нажмите кнопку ниже</p>
                            <p><a id = "modalcloseopen4" href="" class = "modaltextcolor modalInfo">Создать учётную запись</a>
                    </div>
                    <div class="row" id = "hidModal1">
                        <p class = "modalInfo">Забыли идентификатор? <br> Введите свои данные ниже.</p>
                        <div class = "otstupModalIdenti">
                        <?php $form = ActiveForm::begin([
                            'id' => 'searchIdentity-form',
                            'layout' => 'horizontal',
                            'action' => 'site/index',
                            'enableAjaxValidation' => true,
                            'validateOnChange' => false,
                            'validateOnBlur' => false,
                            'fieldConfig' => [
                                'template' => "<div class = \"row\"><div class=\"col-xs-1 col-sm-1 col-md-1 col-lg-1\"></div><div class=\"col-xs-9 col-sm-9 col-md-9 col-lg-9\">{input}</div></div>\n<div class=\"row\"><div class=\"col-xs-3 col-sm-3 col-md-3 col-lg-3\"></div><div class=\"col-xs-offset-1 col-xs-10 col-sm-offset-1 col-sm-10 col-md-offset-1 col-md-10  col-lg-offset-1 col-lg-10\">{error}</div></div>",
                                'labelOptions' => ['class' => 'col-lg-1 control-label'],
                            ],
                        ]); ?>
                        <?= $form->field($this->context->searchIdentity, 'name')->textInput(['placeholder' => 'Имя', 'class'=>'form-control text-left loginform']) ?>

                        <?= $form->field($this->context->searchIdentity, 'patronymic')->textInput(['placeholder' => 'Фамилия', 'class'=>'form-control text-left loginform']) ?>

                        <?= $form->field($this->context->searchIdentity, 'date')->textInput(['placeholder' => 'День', 'class'=>'form-control text-left loginform']) ?>

                        <?= $form->field($this->context->searchIdentity, 'date2')->dropDownList(['01' => 'Январь','02' =>'Февраль','03' =>'Март','04' =>'Апрель','05' =>'Май','06' =>'Июнь','07' =>'Июль','08' =>'Август','09' =>'Сентябрь','10' =>'Октябрь','11' =>'Ноябрь','12' =>'Декабрь'],
                            ['class'=>'form-control text-left loginform', 'style' => 'padding-left:6px;']) ?>

                        <?= $form->field($this->context->searchIdentity, 'date3')->textInput(['placeholder' => 'Год', 'class'=>'form-control text-left loginform']) ?>
                        </div>
                        <div class="form-group">
                            <div class="knopkaidentiotstup">
                                    <?= Html::submitButton('НАЙТИ ИДЕНТИФИКАТОР', ['class' => 'knopkaidenti']) ?>
                            </div>
                        </div>
                        <?php ActiveForm::end(); ?>
                    </div>
                    <div class="row" id = "hidModal2" style="display:none">
                        <div class = "hiddenrecover">
                        <p class = "modalInfo">Забыли пароль? <br> Введите свои данные ниже.</p>
                        <div class = "otstupModalIdenti">
                            <?php $form = ActiveForm::begin([
                                'id' => 'passwordRecover-form',
                                'layout' => 'horizontal',
                                'action' => 'site/index',
                                'enableAjaxValidation' => true,
                                'validationUrl' => 'site/validrecover',
                                'validateOnChange' => false,
                                'validateOnBlur' => false,
                                'fieldConfig' => [
                                    'template' => "<div class = \"row\"><div class=\"col-xs-1 col-sm-1 col-md-1 col-lg-1\"></div><div class=\"col-xs-9 col-sm-9 col-md-9 col-lg-9\">{input}</div></div>\n<div class=\"row\"><div class=\"col-xs-offset-1 col-xs-10 col-sm-offset-1 col-sm-10 col-md-offset-1 col-md-10  col-lg-offset-1 col-lg-10\">{error}</div></div>",
                                    'labelOptions' => ['class' => 'col-lg-1 control-label'],
                                ],
                            ]); ?>
                            <?= $form->field($this->context->passwordRecover, 'email')->textInput(['placeholder' => 'Электронная почта', 'class'=>'form-control text-left loginform']) ?>
                        </div>
                        <div class="form-group">
                            <div class="knopkaidentiotstup">
                                <?= Html::submitButton('ДАЛЕЕ', ['class' => 'knopkaidenti']) ?>
                            </div>
                        </div>
                        <?php ActiveForm::end(); ?>
                        </div>
                        <div class = "textblock2 hiddenrecover2" style = "display: none">
                            <p style = "font-size: 16px;margin-left: 79px;">Письмо отправлено на ваш адрес электронной почты. <br>Если вы не можете найти его, проверьте папку “Спам”.</p>
                        </div>
                    </div>
                </div>
            </div>
                <!-- Футер модального окна -->
                <div class="modal-footer">
                </div>
        </div>
    </div>

    <div id="ModalBox5" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header regheader" style="text-align: center">
                    <h2 class="modal-title row reg" style = "width: 90%">Ошибка</h2>
                    <button type="button" class="knopkaimg" data-dismiss="modal" style = "width: 9%;padding-left: 0px;padding-right: 0px;"><img class = "imaga" src="/images/krest.png" alt="закрыть"></button>
                </div>
                <div class="modal-body row modaltext">
                    <p>Для использования этой функции пожалуйста<br> <a id="modalcloseopen5" href="" class="modaltextcolor">Зарегистрируйтесь</a> или <a id="modalcloseopen6" href="" class="modaltextcolor">Войдите в свой аккаунт</a> </p>
                </div>
                <!-- Футер модального окна -->
            </div>
        </div>
    </div>

    <div id="ModalBox6" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header regheader" style="text-align: center">
                    <h2 class="modal-title row reg" style = "width: 90%">Ошибка</h2>
                    <button type="button" class="knopkaimg" data-dismiss="modal" style = "width: 9%;padding-left: 0px;padding-right: 0px;"><img class = "imaga" src="/images/krest.png" alt="закрыть"></button>
                </div>
                <div class="modal-body row modaltext">
                    <p>Для использования этой функции пожалуйста<br> <a data-dismiss="modal" class = "dropdown-menulink3">Подтвердите свой email</a> </p>
                </div>
                <!-- Футер модального окна -->
            </div>
        </div>
    </div>
    <input type="hidden" id="user" value="<?= Yii::$app->user->isGuest ?>" />
    <input type="hidden" id="user2" value="<?= Yii::$app->user->identity->validate ?>" />
    <?php
    NavBar::begin([
        'headerContent' => 
        '<img style = "padding-top:17px;margin-left: 7px;"class = "navbar-toggle-elements htext1 searchIcon" src="/images/lupa.png" caption="Поиск по сайту">
        <img src="/images/korz.png" style= "padding-top: 16px;margin-left: 14px;width: 30px;height: 42px;" class = "korzinabutton navbar-toggle-elements" alt="Корзина"><div class ="items2 navbar-toggle-elements"><p>'.  $this->context->basketvalue  .'</p></div>
        <a style="line-height: 60px;"class = "hizo12 navbar-toggle-elements" href="/HomePage"><img style = "max-height: 62px;max-width: 200px;width:100%;"src="/images/kotopes.png" alt=""></a>',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-static-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-left'],
        'items' => [
            ['label' => 'ГЛАВНАЯ', 'url' => ['/site/index']],
            ['label' => 'КАТАЛОГ', 'url' => ['/site/catalog']],
            ['label' => 'ДОСТАВКА И ОПЛАТА', 'url' => ['/site/delivery']],
            ['label' => 'О НАС', 'url' => ['/site/about']],
            '<li class="hizo1">'
            . Html::a(Html::img('/images/kotopes.png'), ['/site/index'])
            .'</li>'
            .'<li class="hizo2 htext1 searchIcon">'
            . '<img src="/images/lupa.png" caption = "Поиск по сайту">'
            .'</li>'
            .'<div class = "hid2">'
            .'</div>'
            .'<li class="hizo2 htext1 hid korzinabutton">'
            . Html::img('/images/korz.png')
            . '<div class ="items"><p>' . $this->context->basketvalue . '</p></div>'
            .'</li>'
            .'<li class="hizo2 htext1 elem chel hid" id = "chel">',
            Yii::$app->user->isGuest ? (
                 Html::img('/images/chel.png', ['alt' => 'Вход'])
                 . '<div class ="drop" id = "drop_chel"><ul style ="list-style-type:none; padding:0px;"><li id = "modal1"><p style = "cursor:pointer">Войти</p></li><li id = "modal2"><p style = "cursor:pointer">Зарегистрироваться</p></li></ul></div>'
                 .'</li>'
            ) : (
                Yii::$app->user->identity->validate != 1 ? (
                    Html::img('/images/chel2.png', ['alt' => 'Выход'])
                    . '<div class ="drop" id = "drop_chel"><ul style ="list-style-type:none; padding:0px;"><li><p class = "dropdown-menutext">Здравствуйте ' . Yii::$app->user->identity->name . '</p></li><li style="margin-bottom: 5px;">'
                    . '<a class = "dropdown-menulink3">Подтвердите свой email</a></li><li>'
                    . Html::beginForm(['/site/logout'], 'post')
                    . Html::submitButton(
                    'Выйти',
                    ['class' => 'dropdown-menutext dropdown-menulink btn btn-link']
                    )
                    . Html::endForm() . '</li><div style ="border-bottom:1px solid #ddd; width:165px;margin:10px auto;"></div><li class = "droplist"><a class = "dropdown-menulink2" href = "">Заказы</a></li><li class = "droplist"><a  class = "dropdown-menulink2" href = "' . Url::toRoute(['account/profile']) . '">Профиль</a></li><li class = "droplist" style="margin-bottom: 10px;"><a  class = "dropdown-menulink2" href = "' . Url::toRoute(['account/favourites']) . '">Избранное</a></li></ul></div>'
                    .'</li>'
                ) : (
                    Html::img('/images/chel2.png', ['alt' => 'Выход'])
                    . '<div class ="drop" id = "drop_chel"><ul style ="list-style-type:none; padding:0px;"><li><p class = "dropdown-menutext">Здравствуйте ' . Yii::$app->user->identity->name . '</p></li><li style="margin-bottom: 5px;">'
                    . Html::beginForm(['/site/logout'], 'post')
                    . Html::submitButton(
                        'Выйти',
                        ['class' => 'dropdown-menutext dropdown-menulink btn btn-link']
                    )
                    . Html::endForm() . '</li><div style ="border-bottom:1px solid #ddd; width:165px;margin:10px auto;"></div><li class = "droplist"><a class = "dropdown-menulink2" href = "">Заказы</a></li><li class = "droplist"><a  class = "dropdown-menulink2" href = "' . Url::toRoute(['account/profile']) . '">Профиль</a></li><li class = "droplist" style="margin-bottom: 10px;"><a  class = "dropdown-menulink2" href = "' . Url::toRoute(['account/favourites']) . '">Избранное</a></li></ul></div>'
                    .'</li>'
                    )

            ),
            '<li class="htext1 hid">'
            . Html::a('ОБРАТНАЯ СВЯЗЬ', ['site/feedback'], ['class' => 'check'])
            .'</li>'
            . '<li class="htext1 hid">'
            . Html::a('ЗАКАЗАТЬ ТОВАР', ['site/order'], ['class' => 'check'])
            .'</li>',
            Yii::$app->user->isGuest ? (
                 '<li class="htext1" id = "modal1"><p  class = "dropdown-menu-hidden-text" style ="cursor:pointer; margin-bottom: 0px; height: 100%;">Войти</p></li><li class="htext1" id = "modal2"><p class = "dropdown-menu-hidden-text" style = "cursor:pointer; margin-bottom: 0px; height: 100%;">Зарегистрироваться</p></li>'
            ) : (
                Yii::$app->user->identity->validate != 1 ? (
                    '<li class="htext1"><div class = "dropdown-menu-hidden-text" style ="margin: 0 auto;border-bottom:1px solid #ddd; width:165px;height: 3px;"></div></li><li class="htext1 htext2"><p class = "dropdown-menu-hidden-text">Здравствуйте ' . Yii::$app->user->identity->name . '</p></li>'
                    . '<li class="htext1"><a class = "dropdown-menulink3 dropdown-menu-hidden-text htext3">Подтвердите свой email</a></li>'
                    . '<li class="htext1">'
                    . Html::beginForm(['/site/logout'], 'post')
                    . Html::submitButton(
                    'Выйти',
                    ['class' => 'dropdown-menutext dropdown-menulink btn btn-link dropdown-menu-hidden-text', 'style' => 'height: 100%; width: 100%;']
                    )
                    . Html::endForm() . '</li><li class = "htext1"><div class = "dropdown-menu-hidden-text" style ="margin: 0 auto;border-bottom:1px solid #ddd; width:165px;height: 3px;"></div></li><li class = "htext1"><a class = "dropdown-menulink2 dropdown-menu-hidden-text" href = "">Заказы</a></li><li class = "htext1"><a  class = "dropdown-menulink2 dropdown-menu-hidden-text" href = "' . Url::toRoute(['account/profile']) . '">Профиль</a></li><li class = "htext1" style="margin-bottom: 10px;"><a  class = "dropdown-menulink2 dropdown-menu-hidden-text" href = "' . Url::toRoute(['account/favourites']) . '">Избранное</a></li>'
                    .'</li>'
                ) : (
                    '<li style = "height: 20px;"><div class = "dropdown-menu-hidden-text" style ="margin: 0 auto;border-bottom:1px solid #ddd; width:165px;height: 3px;"></div></li><li class="htext1 htext2"><p class = "dropdown-menu-hidden-text">Здравствуйте ' . Yii::$app->user->identity->name . '</p></li>'
                    . '<li class="htext1" style = "height: 30px;">'
                    . Html::beginForm(['/site/logout'], 'post')
                    . Html::submitButton(
                        'Выйти',
                        ['class' => 'dropdown-menutext dropdown-menulink btn btn-link dropdown-menu-hidden-text', 'style' => 'height: 100%; width: 100%;']
                    )
                    . Html::endForm() . '</li><li style = "height: 20px;"><div class = "dropdown-menu-hidden-text" style ="margin: 0 auto;border-bottom:1px solid #ddd; width:165px;height: 3px;"></div></li><li class = "htext1"><a class = "dropdown-menulink2 dropdown-menu-hidden-text" href = "">Заказы</a></li><li class = "htext1"><a  class = "dropdown-menulink2 dropdown-menu-hidden-text" href = "' . Url::toRoute(['account/profile']) . '">Профиль</a></li><li class = "htext1" style="margin-bottom: 10px;"><a  class = "dropdown-menulink2 dropdown-menu-hidden-text" href = "' . Url::toRoute(['account/favourites']) . '">Избранное</a></li>'
                    .'</li>'
                    )

            ),
            '</li>'
        ],
    ]);


    NavBar::end();
    ?>

    <div class="container">
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container-fluid">
        <div class="footerblock col-lg-offset-1 col-lg-10  col-md-offset-1 col-md-10 col-sm-12 col-xs-12">
            <p class="companyname pull-left">&copy; Котопёс <?= date('Y') ?></p>
            <div class="textfooter"><p class = "numberin">По всем вопросам:</p> <p class = "number">8-992-425-23-48</p><a target="_blank" href="viber://chat?number=%2B79128365270"><img alt="viber" class = "imgfootersocial" src="/images/viber.png"/></a><a target="_blank" href="https://wa.me/79128365270"><img class = "imgfootersocial2" src="/images/whatsapp.png"/></a></div>
            <p class="pull-right textf"><a href="" class = "backtotop">К началу &#8657;</a></p>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
