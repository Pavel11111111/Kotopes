<?php

/* @var $this yii\web\View */

$this->title = 'Оформить заказ | Котопёс КУРГАН | Официальный сайт';

use yii\helpers\Html;
use yii\widgets\ActiveForm; 
use yii\widgets\Pjax;
?>

<div class="site-cart">
    <div class = "row cart-row">
        <div class="col-lg-offset-3 col-lg-5 col-md-offset-3 col-md-6 col-sm-offset-0 col-sm-12 col-xs-offset-0 col-xs-12 cart-custom-width">
            <div class="cart-left-content">
                <div class = "col-sm-12">
                    <div class = "col-sm-12 col-md-7">
                        <h1 class="cart-title">Оформить заказ</h1>
                        <div class = "headline">
                            КОНТАКТНЫЕ ДАННЫЕ
                        </div>
                        <?php $form = ActiveForm::begin([
                            'id' => 'makeorder-form',
                            'options' => ['enctype' => 'multipart/form-data'],
                            'action' => 'site/makeorder',
                            'enableAjaxValidation' => true,
                            'validationUrl' => 'site/validmakeorder',
                            'validateOnChange' => false,
                            'fieldConfig' => [
                                'template' => "{input}{error}<br>",
                                'labelOptions' => ['class' => 'col-lg-1 control-label'],
                            ],
                        ]); ?>
                        <p class = "makeorderformtext">Имя</p>
                        <?= $form->field($makeorderform, 'name')->textInput(['value' => Yii::$app->user->identity->name, 'class'=>'form-control text-left makeorderforminput']); ?>
                        <p class = "makeorderformtext">Мобильный телефон</p>
                        <?= $form->field($makeorderform, 'number')->textInput(['value' => Yii::$app->user->identity->number, 'class'=>'form-control text-left makeorderforminput']); ?>
                        <div class = "headline">
                            АДРЕС ДОСТАВКИ
                        </div>
                        <?= $form->field($makeorderform, 'address')->textInput(['value' => Yii::$app->user->identity->defaultadress, 'class'=>'form-control text-left makeorderforminput makeorderforminputaddres', 'id'=>'address']) ?>
                        <div class = "headline">
                            КОММЕНТАРИЙ К ЗАКАЗУ
                        </div>
                        <?= $form->field($makeorderform, 'comment')->textArea(['class'=>'form-control text-left makeorderforminput makeorderforminputaddres', 'style' =>'max-width: 100%;min-width: 100%;min-height: 100px;}', 'placeholder' => 'Здесь, если нужно, вы можете дать указания для нашего курьера, например: "Во дворе злая собака, позвоните в колокольчик"']); ?>
                        <div class = "headline">
                            СПОСОБ ОПЛАТЫ
                        </div>
                        <?= $form->field($makeorderform, 'paymenttype') ->radioList(['Наличными курьеру' => 'Наличными курьеру','Картой курьеру' => 'Картой курьеру'], [
                                'item' => function($index, $label, $name, $checked, $value) {

                                    $return = '<label class="modal-radio">';
                                    $return .= '<input type="radio" name="' . $name . '" value="' . $value . '" tabindex="3">';
                                    $return .= '<i></i>';
                                    $return .= '<span>   ' . ucwords($label) . '</span>';
                                    $return .= '</label>';
                                    $return .= '<br><br>';
                                    return $return;
                                }
                            ]);?>
                        <div class = "headline">
                            ДАТА И ВРЕМЯ ДОСТАВКИ
                        </div>
                        <?php
                        $olddatetime = null;
                        $display = 'none';
                        foreach($dates as $key => $date){
                            $datetime = explode(" ", $date->datetime);
                            if($datetime[1] == '22:00:00'){
                                $datetime2[1] = '23:00:00';
                            }else{
                                 $datetime2 = explode(" ", $dates[$key+1]->datetime);
                            }
                            if($datetime[0] != $olddatetime){
                                if($olddatetime != null){
                                    echo '</div>';
                                }
                                if($dates[$key]->status == 1 && $dates[$key + 1]->status == 1 && $dates[$key + 2]->status == 1){
                                    echo '<button disabled class = "makeorderdatetimebutton makeorderdatebutton makeorderdatetimebuttonclose" type = "button" data-id = "' . $datetime[0] . '">' . $datetime[0] . '</button>';
                                }else{
                                    echo '<button class = "makeorderdatetimebutton makeorderdatebutton" type = "button" data-id = "' . $datetime[0] . '">' . $datetime[0] . '</button>';
                                }
                                echo '<div class = "makeordertimesblock">';
                            }
                            if($date->status == 1){
                                echo '<button disabled style = "display:none;" class = "makeorderdatetimebuttonclose makeorderdatetimebutton makeordertimebutton" type = "button" data-id = "' . $datetime[0] . '">' . $datetime[1] . ' - ' . $datetime2[1] . '</button>';
                            }else{
                                echo '<button style = "display:none;" class = "makeorderdatetimebutton makeordertimebutton" type = "button" data-value = "' . $date->id . '" data-id = "' . $datetime[0] . '">' . $datetime[1] . ' - ' . $datetime2[1] . '</button>';
                            }
                            $olddatetime = $datetime[0];
                        }
                        ?>
                        </div>
                        <div class = "countproducterrorblock">
                            <p class = "makeorderformtext">Приносим свои извинения, товар Pro plan остался на складе в количестве 1 штука, кто-то заказал его раньше Вас. Сумма заказа автоматически пересчитана, а количество изменено, до 1, продолжить оформление заказа?</p>
                            <br>
                            <button type = "button" class = "knopkainput" style = "max-width: 40%;min-width: 40%;height: 93px;float: left;" id = "counterroryes">Да</button>
                            <button type = "button" class = "knopkainput" style = "max-width: 40%;min-width: 40%;height: 93px;float: right;" id = "counterrorno">Нет, вернуться в корзину</button>
                        </div>
                        <?= $form->field($makeorderform, 'datetime')->hiddenInput(['style' => 'height:0px;margin:0px;']); ?>
                        <div class = "cart-summary-price body-summary-price" style = "display:none">
                            <div style = "display: inline; float: left;">Цена доставки:</div>
                            <div class = "deliverysummary" style = "display: inline; float: right;"></div>
                            <?= $form->field($makeorderform, 'delivery')->hiddenInput(['style' => 'height:0px;margin:0px;']); ?>
                            <?= $form->field($makeorderform, 'summary')->hiddenInput(['style' => 'height:0px;margin:0px;']); ?>
                            <div style="display: inline; float: left;">Итоговая цена:</div>
                            <div class = "pricesummary" style = "display: inline; float: right;"></div>
                        </div>
                        <div class="form-group">
                            <div class = "row">
                                <div class="col-lg-offset-0 col-lg-12 col-md-12 col-md-offset-0 col-sm-12 col-sm-offset-0 col-xs-12 col-xs-offset-0">
                                    <?= Html::submitButton('ДОСТАВИТЬ!', ['class' => 'makeorderfinalbutton']) ?>
                                    <?php ActiveForm::end(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
         <div class="col-lg-4  rightboostrap">
                <div class="cart-right-content">
                    <div class="col-lg-6 cart-right-auto-width" style="position: sticky;top: 0px;">
                        <?php
                            Pjax::begin([
                                'id' => 'makeOrder-pjax',
                            ])
                        ?>
                        <div class="cart-summary">
                            <h2 class="cart-summary-text" style = "display: block;">Ваша корзина</h2>
                            <a class="makeorder-summary-text-link" href = "http://kotopes45.ru/Cart">Редактировать</a>
                            <div style = "border-top: 1px solid #e7e7e8;">
                                <div style = "margin-bottom: 16px">
                                    <?php
                                    $discounts = 0;
                                    $prices = 0;
                                    foreach ($userbasket as $oneuserbasket) {
                                    ?>
                                        <div class = "makeordershortproduct">
                                            <div class="col-xs-2 col-sm-1 col-md-2">
                                                <?php
                                                if($oneuserbasket["variation"]["img"] != null){
                                                ?>
                                                    <img class="makeorder-image-size-product" src="/images/products/<?php echo $oneuserbasket["variation"]["img"]; ?>"/>
                                                <?php
                                                }elseif($oneuserbasket["variation"]["product"]["variation"][0]["img"] != null){
                                                ?>
                                                    <img class="makeorder-image-size-product" src="/images/products/<?php echo $oneuserbasket["variation"]["product"]["variation"][0]["img"]; ?>"/>
                                                <?php
                                                }else{
                                                ?>
                                                    <img class="makeorder-image-size-product" src="/images/products/noimage.jpg" />
                                                <?php
                                                }
                                                ?>
                                            </div>
                                            <div class = "col-xs-10 col-sm-11 col-md-10">
                                                <div class="clearfix row" style = "margin-bottom: 8px;padding-left: 15px;">
                                                    <div class = "col-xs-6">
                                                        <div class = "makeordernameproduct">
                                                            <?php echo $oneuserbasket["count"]; ?> x <?php echo $oneuserbasket["variation"]["product"]["name"]; ?>
                                                        </div>
                                                        <div class = "makeorderattributesproduct" style = "text-transform: lowercase;">
                                                            <?php echo $oneuserbasket["variation"]["name"]; ?>
                                                        </div>
                                                    </div>
                                                    <div class = "col-xs-6">
                                                        <div class = "makeorderpriceproduct">
                                                             <?php echo $oneuserbasket["variation"]["price"] * $oneuserbasket["count"] - $oneuserbasket["variation"]["discount"] * $oneuserbasket["count"]; ?> ₽
                                                             <?php $prices += $oneuserbasket["variation"]["price"] * $oneuserbasket["count"]; ?>
                                                             <?php $discounts += $oneuserbasket["variation"]["discount"] * $oneuserbasket["count"]; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <?php
                            if ($discounts != 0) {
                                ?>
                                <div class="cart-summary-discount">
                                    <div style="display: inline; float: left">
                                        Сумма скидки:
                                    </div>
                                    <div class = "discountjs" style="display: inline; float: right;">
                                        <?php echo $discounts; ?> ₽
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                            <br>
                            <div class="cart-summary-price" style = "margin-bottom: 50px;">
                                <div style="display: inline; float: left">
                                    Цена:
                                </div>
                                <div class = "price" style="display: inline; float: right;"><?php echo $prices; ?> ₽</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php Pjax::end(); ?>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center cart-title" style="display: none;">
        <h1 style = "margin-bottom: 60px;margin-top: 60px;">Спасибо за заказ!</h1><br>
        <p style = "font-size: 28px;">В указанное время наш курьер доставит его вам.</p>
    </div>
    </div>
</div>