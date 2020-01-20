<?php

/* @var $this yii\web\View */

$this->title = 'Избранное | Котопёс КУРГАН | Официальный сайт';

use yii\helpers\Url; 
use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>
<div class="account-favourites">
    <div id="callme" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Заголовок модального окна -->
                <div class="modal-header" style = "position:relative">
                    <p class="callmetext1 reg"style = "width: 90%;">Сообщить о наличии</p>
                    <button type="button" class="knopkaimg" data-dismiss="modal"style="height: 59px;width:9%;margin-top: -5px;"><img class = "imaga" src="/images/krest.png" alt="закрыть"></button>
                </div>
                <!-- Основное содержимое модального окна -->
                <div class="modal-body row otstup">
                    <p class = "callmetext2">Этот товар в данный момент отсутствует на складе. Укажите свое имя и номер телефона, чтобы наш оператор мог связаться с Вами и обсудить детали доставки данного товара.</p>
                    <div class = "otstupModalIdenti">
                        <?php $form = ActiveForm::begin([
                            'id' => 'callme-form',
                            'action' => 'site/callme',
                            'enableAjaxValidation' => true,
                            'validationUrl' => 'site/callmevalidation',
                            'validateOnChange' => false,
                            'validateOnBlur' => false,
                            'fieldConfig' => [
                                'template' => "<div class = \"row\"><div class=\"col-xs-9 col-sm-9 col-md-9 col-lg-9\">{input}</div></div>\n<div class=\"row\"><div class=\"col-xs-3 col-sm-3 col-md-3 col-lg-3\"></div><div class=\" col-xs-10  col-sm-10  col-md-10   col-lg-10\">{error}</div></div>",
                                'labelOptions' => ['class' => 'col-lg-1 control-label'],
                            ],
                        ]); ?>
                        <?= $form->field($callme, 'clientname')->textInput(['value' => Yii::$app->user->identity->name . ' ' . Yii::$app->user->identity->patronymic ,'placeholder' => 'ФИО', 'class'=>'form-control text-left ']) ?>
                        <?= $form->field($callme, 'number')->textInput(['value' => Yii::$app->user->identity->number ,'placeholder' => 'Ваш номер телефона', 'class'=>'form-control text-left ']) ?>
                        <?= $form->field($callme, 'variationid')->hiddenInput(['class' => 'hiddenvariationid']) ?>
                        <div class = "row">
                            <div class = "col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <?= Html::submitButton('Отправить', ['class' => 'knopkacallme']) ?>
                            </div>
                        </div>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="productinbasket" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Основное содержимое модального окна -->
                <div class="modal-body row otstup" style = "text-align:center;">
                    <img class = "productinbasketimage" src="/images/galka2.jpg">
                    <p class = "productinbaskettext">Товар добавлен</p>
                    <button type = "submit" class = 'knopkacallme productinbasketbutton korzinabutton'>Оформить заказ</button>
                    <p class = "buyclick" data-dismiss="modal" style = "margin-bottom:43px;">Назад к избранному</p>
                </div>
            </div>
        </div>
    </div>
    <div id="productalreadyinbasket" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Основное содержимое модального окна -->
                <div class="modal-body row otstup" style = "text-align:center;">
                    <p class = "productinbaskettext">Товар уже у вас в корзине</p>
                    <button type = "submit" class = 'knopkacallme productinbasketbutton korzinabutton'>Перейти в корзину</button>
                    <p class = "buyclick" data-dismiss="modal" style = "margin-bottom:43px;">Назад к избранному</p>
                </div>
            </div>
        </div>
    </div>
    <div class = "account-layout">
        <div class = "account-layout-center-container">
            <ul class = "col-md-12 account-layout-ul">
                <li class = "account-layout-link col-xs-6 col-sm-6 col-md-6">
                    <a href = "<?php echo Url::toRoute(['account/index', 'profile' => Yii::$app->user->id]); ?>">Заказы</a>
                </li>
                <li class = "account-layout-link col-xs-6 col-sm-6 col-md-6">
                    <a href = "<?php echo Url::toRoute(['account/profile']); ?>">Профиль</a>
                </li>
                <li class = "account-layout-active-link account-layout-link col-xs-6 col-sm-6 col-md-6">
                    <a href = "<?php echo Url::toRoute(['account/favourites', 'profile' => Yii::$app->user->id]); ?>">Избранное</a>
                </li>
            </ul>
        </div>
    </div>
    <div class = "account-favourites-container">
        <div class = "favourites-container">
            <?php
            if($favourites != null){
            ?>
            <div class = "favourites-list">
                <div class = "favourites-list-section">
                    <div class = "row">
                        <div class = "favourites-list-header col-xs-12">
                            <h1 class = "favourites-header">Товары в избранном</h1>
                        </div>
                    </div>
                    <div class = "favourites-list-action col-md-12">
                        <div style = "display:inline-block">
                            <a class = "favourites-list-remove">Удалить товары из избранного</a>
                        </div>
                        <div class = "favourites-list-button-adaptive">
                            <p class="textforinformation" id="add-cart-product-in-favourites-done" style="display:none;">Товары добавлены в корзину</p>
                            <button class = "favourites-list-add-in-cart-button">ДОБАВИТЬ ВСЕ ТОВАРЫ В КОРЗИНУ</button>
                        </div>
                        <div style = "display: inline-block; width: 100%;margin-top:24px;">
                            <ul class="cart-ul-product">
                                <?php
                                foreach ($favourites as $onefavourites) {
                                    ?>
                                    <li class="cart-li-product">
                                        <div class="col-12" style="min-height: 166px;">
                                            <div class="cart-image-product" style = "left:0px;">
                                                <?php
                                                if($onefavourites["variation"]["img"] != null){
                                                ?>
                                                <img class="cart-image-size-product" src="/images/products/<?php echo $onefavourites["variation"]["img"]; ?>"/>
                                                <?php
                                                }elseif($onefavourites["variation"]["product"]["variation"][0]["img"] != null){
                                                ?>
                                                <img class="cart-image-size-product" src="/images/products/<?php echo $oneuserbasket["variation"]["product"]["variation"][0]["img"]; ?>"/>
                                                <?php
                                                }else{
                                                ?>
                                                <img class="cart-image-size-product" src="/images/products/noimage.jpg" />
                                                <?php
                                                }
                                                ?>
                                            </div>
                                            <div class="cart-paddingimage-product">
                                                <div class="cart-details-product">
                                                    <div class="cart-name-product">
                                                        <h3 class="cart-name-product-h3"><?php echo $onefavourites["variation"]["product"]["name"]; ?> (<span style = "text-transform: lowercase;"><?php echo $onefavourites["variation"]["name"]; ?></span>)</h3>
                                                    </div>
                                                </div>
                                                <div class="cart-item-actions-products">
                                                    <div class="cart-product-price-details">
                                                    <span class="item-price">
                                                        <?php echo $onefavourites["variation"]["price"] - $onefavourites["variation"]["discount"]; ?> ₽
 
                                                        <br>
                                                        <?php
                                                        if ($onefavourites["variation"]["discount"] != null) {
                                                        ?>
                                                            <span class="item-price-discount">
                                                            (- <?php echo $onefavourites["variation"]["discount"] ?> ₽ скидка)
                                                            </span>
                                                            <br>
                                                            <?php
                                                            if ($onefavourites["variation"]["count"] == 0){
                                                            ?>
                                                                <div style = "font-size: 12px;height: 25px;color: #cf2727;">НЕТ В НАЛИЧИИ</div>
                                                            <?php
                                                            }
                                                            ?>
                                                        <?php
                                                        }
                                                        ?>
                                                        <span class="favourites-remove-item" data-id = "<?php echo $onefavourites["variation"]["id"] ?>">
                                                            УДАЛИТЬ
                                                        </span>
                                                        <br>
                                                        <?php
                                                        if ($onefavourites["variation"]["count"] == 0){
                                                        ?>
                                                            <span class = "favourites-add-inform-item favourites-inform-item" data-id = "<?php echo $onefavourites["variation"]["id"] ?>">
                                                                ЗАКАЗАТЬ ТОВАР
                                                            </span>
                                                        <?php
                                                        }else{
                                                        ?>
                                                            <span class = "favourites-add-inform-item favourites-add-item" data-id = "<?php echo $onefavourites["variation"]["id"] ?>">
                                                                ДОБАВИТЬ В КОРЗИНУ
                                                            </span>
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            }else{
            ?>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center cart-title">
                <h1 style="margin-bottom: 46px;font-size:28px;">У вас пока нет товаров в избранном, но вы можете добавить их в каталоге, нажав на сердечко в плитке товара</h1>
                <button onclick="document.location='http://kotopes45.ru/Catalog'" class="knopkaproduct" type="submit">ПЕРЕЙТИ В КАТАЛОГ</button>
            </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>