<?php
$this->title = 'Заказ товара | Котопёс КУРГАН | Официальный сайт';

use yii\helpers\Html;
use yii\widgets\ActiveForm; ?>
<div class="site-feedback">
    <div class ="row" style ="margin:0px;">
        <div style = "display: none;"class = "showtext col-lg-12 col-md-12 col-sm-12 col-xs-12 fots">
            <p class ="feedtext">Заявка принята, с вами свяжутся в ближайшее время</p>
            <div class = "col-lg-offset-1 col-lg-10 col-md-10 col-md-offset-1 col-sm-12 col-sm-offset-0 col-xs-12 col-xs-offset-0 otstuptextforinformation textforinformation">
                <img style = "display:block;margin:0 auto;width: 60%;border-radius: 41%;" src = "/images/xatiko.jpg">
                <p style = "text-align: center">Во время ожидания, вы можете заказать любой другой товар из нашего <?= Html::a('каталога', ['site/catalog'])?></p>
            </div>
        </div>
        <div class = "hidtext  col-lg-offset-2 col-lg-8 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12 col-xs-offset-0">
            <div class = "col-lg-offset-1 col-lg-10 col-md-10 col-md-offset-1 col-sm-12 col-sm-offset-0 col-xs-12 col-xs-offset-0 otstuptextforinformation textforinformation">
                <p style = "text-align: center">Если вы не нашли какого-либо товара на нашем сайте, вы можете воспользоваться этой формой, заполнив поля для названия товара, или группы товаров, а также указав адрес по которому этот товар необходимо доставить.</p>
            </div>
            <div class = "col-lg-12 col-md-12 col-sm-12 col-xs-12 fots">
                <p class ="feedtext">Заполните форму, чтобы заказать товар, отсутствующий в интернет-магазине</p>
                <?php $form = ActiveForm::begin([
                    'id' => 'order-form',
                    'action' => 'site/order',
                    'enableAjaxValidation' => true,
                    'validationUrl' => 'site/validorder',
                    'validateOnChange' => false,
                    'validateOnBlur' => false,
                    'fieldConfig' => [
                        'template' => "<div class = \"row\"><div class=\"col-xs-0 col-sm-0 col-md-1 col-lg-1\"></div><div class=\"col-xs-12 col-sm-12 col-md-10 col-lg-10\">{input}</div></div>\n<div class=\"row\"><div class=\"col-xs-0 col-sm-0 col-md-1 col-lg-1\"></div><div class=\"col-xs-12 col-sm-12 col-md-6 col-lg-6\">{error}</div></div>",
                        'labelOptions' => ['class' => 'col-lg-1 control-label'],
                    ],
                ]); ?>
                <?= $form->field($orderproduct, 'text')->textarea(['placeholder' => 'Введите название товара, или группы товаров', 'class'=>'form-control text-left feedform', 'maxlength'=>300]) ?>
                <?= $form->field($orderproduct, 'address')->textInput(['class'=>'form-control text-left orderform','placeholder' => 'Адрес доставки', 'id'=>'address']) ?>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                <link href="https://cdn.jsdelivr.net/npm/suggestions-jquery@19.8.0/dist/css/suggestions.min.css" rel="stylesheet" />
                <script src="https://cdn.jsdelivr.net/npm/suggestions-jquery@19.8.0/dist/js/jquery.suggestions.min.js"></script>
                <script>
                    $("#address").suggestions({
                        token: "3d5c843d6894b736565fb3f314196295a90ae7dd",
                        type: "ADDRESS",
                        constraints: {
                            locations: { kladr_id: "4500000000000" },
                        },
                        // в списке подсказок не показываем область и город
                        restrict_value: true
                    });
                </script>
                <?= Html::submitButton('ОТПРАВИТЬ', ['class' => 'knopkafeedback']) ?>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>