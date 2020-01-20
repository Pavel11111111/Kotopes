<?php
$this->title = 'Заказ товара | Котопёс КУРГАН | Официальный сайт';

use yii\helpers\Html;
use yii\widgets\ActiveForm; ?>
<div class="site-feedback">
    <div class ="row" style ="margin:0px;">
        <div style = "display: none;"class = "showtext col-lg-12 col-md-12 col-sm-12 col-xs-12 fots">
            <p class ="feedtext">Заявка принята, с вами свяжутся в ближайшее время</p>
            <div class = "col-lg-offset-1 col-lg-10 col-md-10 col-md-offset-1 col-sm-12 col-sm-offset-0 col-xs-12 col-xs-offset-0 otstuptextforinformation textforinformation">
                <img class = "orderandfeedbackimage" src = "/images/xatiko.jpg">
                <p style = "text-align: center">Во время ожидания, вы можете заказать любой другой товар из нашего <?= Html::a('каталога', ['site/catalog'])?></p>
            </div>
        </div>
        <div class = "hidtext  col-lg-offset-2 col-lg-8 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12 col-xs-offset-0">
            <div class = "col-lg-offset-1 col-lg-10 col-md-10 col-md-offset-1 col-sm-12 col-sm-offset-0 col-xs-12 col-xs-offset-0 otstuptextforinformation textforinformation">
                <p style = "text-align: center">Eсли Вы не нашли нужный товар на нашем сайте, Вы можете воспользоваться этой формой, указав название товара и Ваши контактные данные. Мы найдём этот товар у наших поставщиков и сообщим Вам его стоимость и сроки поставки.
<br>Кстати, любой товар, который Вы заказываете без наличия в интернет-магазине будет со скидкой, как благодарность за Ваше ожидание.</p>
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
                        'labelOptions' => ['class' => 'col-lg-12 control-label'],
                    ],
                ]); ?>
                <div class = "row">
                <div class = "col-xs-offset-0 col-sm-offset-0 col-md-offset-1 col-lg-offset-1 col-xs-12 col-sm-12 col-md-10 col-lg-10">
                    <label class = "orderandfeedbacklabel">Введите название товара или группы товаров&nbsp;*</label>
                </div>
                </div>
                <?= $form->field($orderproduct, 'text')->textarea(['class'=>'form-control text-left feedform', 'maxlength'=>300]) ?>
                <div class = "row" style = "margin-bottom: 40px;">
                    <div class = "col-xs-offset-0 col-sm-offset-0 col-md-offset-1 col-lg-offset-1 col-xs-12 col-sm-12 col-md-10 col-lg-10">
                        <div style = "max-width: 1000px;">
                            <div style = "width: 45%;display:inline-block;">
                                <label class = "orderandfeedbacklabel">Ваше имя&nbsp;*</label>
                                <?= $form->field($orderproduct, 'name', ['template' => '<div style = "width: 100%">{input}</div><div style = "width: 100%">{error}</div>'])->textInput(['value' => Yii::$app->user->identity->name . ' ' . Yii::$app->user->identity->patronymic,'class'=>'form-control text-left orderform', 'maxlength'=>100]) ?>
                            </div>
                            <div style = "width: 45%;display:inline-block;float:right;">
                                <label class = "orderandfeedbacklabel">Номер телефона&nbsp;*</label>
                                <?= $form->field($orderproduct, 'number', ['template' => '<div style = "width: 100%">{input}</div><div style = "width: 100%">{error}</div>'])->textInput(['value' => Yii::$app->user->identity->number,'class'=>'form-control text-left orderform', 'maxlength'=>100]) ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?= Html::submitButton('ОТПРАВИТЬ', ['class' => 'knopkafeedback']) ?>
                <?php ActiveForm::end(); ?>
                <p class = 'orderandfeedbackremark'>* — обязательное поле</p>
            </div>
        </div>
    </div>
</div>