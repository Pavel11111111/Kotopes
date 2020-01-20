<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\Pjax;

$this->title = 'Ваша Корзина | Котопёс КУРГАН | Официальный сайт';
?>
<div class="site-cart">
    <?php
    Pjax::begin([
        'id' => 'cart-pjax',
    ])
    ?>
    <div class = "row cart-row">
        <?php
        if($userbasket != null) {
            ?>
            <div class="col-lg-offset-3 col-lg-5 col-md-offset-3 col-md-6 col-sm-offset-0 col-sm-12 col-xs-offset-0 col-xs-12 cart-custom-width">
                <div class="cart-left-content">
                    <a href="http://kotopes45.ru/Catalog" class="linkbacktoshop"><span
                                class="linkbacktoshopimage"></span>ВЕРНУТЬСЯ В МАГАЗИН</a>
                    <h1 class="cart-title">Ваша Корзина</h1>
                    <ul class="cart-ul-product">
                        <?php
                        $discounts = 0;
                        $prices = 0;
                        foreach ($userbasket as $oneuserbasket) {
                            ?>
                            <li class="cart-li-product">
                                <div class="col-12" style="min-height: 166px;">
                                    <div class="cart-image-product">
                                        <?php
                                        if($oneuserbasket["variation"]["img"] != null){
                                        ?>
                                        <img class="cart-image-size-product" src="/images/products/<?php echo $oneuserbasket["variation"]["img"]; ?>"/>
                                        <?php
                                        }elseif($oneuserbasket["variation"]["product"]["variation"][0]["img"] != null){
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
                                                <h3 class="cart-name-product-h3"><?php echo $oneuserbasket["variation"]["product"]["name"]; ?> (<span style = "text-transform: lowercase;"><?php echo $oneuserbasket["variation"]["name"]; ?></span>)</h3>
                                            </div>
                                        </div>
                                        <div class="cart-item-actions-products">
                                            <div style="display:inline-block;float:left;margin-top: 0px;margin-bottom: 10px;padding-right: 7px;"
                                                 class="productshortdescription cart-padding-adaptive">
                                                <button class="buttonminus buttoncountproduct"
                                                        style="margin-right: 10px;" type="button"><img
                                                            class="imgcountproduct" src="/images/iconminus.png"/>
                                                </button>
                                                <div class="divcountproduct"><input type="text"
                                                                                    value="<?php echo $oneuserbasket["count"]; ?>"
                                                                                    data-id = "<?php echo $oneuserbasket["variation"]["count"]; ?>"
                                                                                    class="inputcountproduct"></div>
                                                <button style="margin-left: 10px;" class="buttonplus buttoncountproduct"
                                                        type="button"><img class="imgcountproduct imgcountproduct2"
                                                                           src="/images/iconplus.png"/>
                                                </button>
                                                <p class = "inputcounterrorblock">На складе нет такого количества товара</p>
                                            </div>
                                            <div class="cart-product-price-details">
                                            <span class="item-price">
                                                <?php echo $oneuserbasket["variation"]["price"] * $oneuserbasket["count"] - $oneuserbasket["variation"]["discount"] * $oneuserbasket["count"]; ?> ₽
                                                <?php $prices += $oneuserbasket["variation"]["price"] * $oneuserbasket["count"]; ?>
                                                <br>
                                                <?php
                                                if ($oneuserbasket["variation"]["discount"] != null) {
                                                    ?>
                                                    <span class="item-price-discount">
                                                    (- <?php echo $oneuserbasket["variation"]["discount"] * $oneuserbasket["count"]; ?> ₽ скидка)
                                                    <?php $discounts += $oneuserbasket["variation"]["discount"] * $oneuserbasket["count"]; ?>
                                                </span>
                                                    <div class="item-price-discount-text">
                                                    Дополнительные скидки применены
                                                </div>
                                                    <?php
                                                }
                                                ?>
                                                <span class="cart-remove-item" data-id = "<?php echo $oneuserbasket["variation"]["id"] ?>">
                                                    УДАЛИТЬ
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                    <div class="cart-custom-margin">
                        <div class="linkbacktoshop2 col-lg-6 col-md-6  col-sm-6 col-xs-6 ">
                            <a href="http://kotopes45.ru/Catalog" class="linkbacktoshop2text">ПРОДОЛЖИТЬ ПОКУПКИ</a>
                        </div>
                        <div class="linkbacktoshop2 rightlink col-lg-6 col-md-6 col-sm-6 col-xs-6  ">
                            <p class = "textforinformation" id = "add-cart-product-in-favourites-done" style = "display:none;">Товары добавлены в избранное <img src="/images/heart3.png"/></p>
                            <a class="linkbacktoshop2text" id = "add-cart-product-in-favourites">ДОБАВИТЬ ВСЁ В ИЗБРАННОЕ
                                <img title="Добавить в избранное" src="/images/heart2.png"/>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4  rightboostrap">
                <div class="cart-right-content">
                    <div class="col-lg-6" style="position: sticky;top: 0px;">
                        <div class="cart-summary">
                            <h2 class="cart-summary-text">Ваша корзина</h2>
                            <div class="cart-payment-options">
                                <ul>
                                    <li>Способы оплаты:</li>
                                    <li>Оплата наличными курьеру</li>
                                    <li>Оплата картой курьеру</li>
                                </ul>
                            </div>
                            <?php
                            if ($discounts != 0) {
                                ?>
                                <div class="cart-summary-discount">
                                    <div style="display: inline; float: left">
                                        Сумма скидки:
                                    </div>
                                    <div style="display: inline; float: right;" class = "discountcookies">
                                        <?php echo $discounts; ?> ₽
                                        <?php $this->params['discounts'] = $discounts ?>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                            <br>
                            <div class="cart-summary-price">
                                <div style="display: inline; float: left">
                                    Цена:
                                </div>
                                <div style="display: inline; float: right;" class = "pricecookies">
                                    <?php echo $prices - $discounts; ?> ₽
                                    <?php $this->params['prices'] = $prices - $discounts ?>
                                </div>
                            </div>
                            <button type="submit" class='knopkacallme productinbasketbutton gotoorder'style='width: 100%;float:left;margin-top:33px;margin-bottom: 0px;'>Оформить
                                    заказ
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }else{
            ?>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center cart-title">
                <h1 style = "margin-bottom: 60px;margin-top: 60px;">Ваша корзина пуста</h1>
                <button onclick="document.location='http://kotopes45.ru/Catalog'"class = "knopkaproduct" type="submit">НАЧАТЬ ПОКУПКИ!</button>
            </div>
        <?php
        }
        ?>
    </div>
    <?php Pjax::end(); ?>
</div>