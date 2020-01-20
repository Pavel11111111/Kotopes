<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Админка';
?>
<div class = "col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <p class ="feedtext">Вариации товара <?= $productname?></p>
    <form enctype="multipart/form-data" class = "variations" method="POST">
        <div class="blocks">
            <div class="block" style = "margin-top: 20px; border: 1px solid darkred">
                <p class = "text-center banuser">Фотография</p>
                <input type="file" name="Product[0][image]" class="uploadButton filevariation">
                <p class = "text-center banuser">Разновидность</p>
                <input type="text" name="Product[0][name]" class="form-control text-left namevariation">
                <p class = "text-center banuser">Цена</p>
                <input type="text" name="Product[0][price]" class="form-control text-left pricevariation">
                <p class = "text-center banuser">Скидка</p>
                <input type="text" name="Product[0][sale]" class="form-control text-left salevariation">
                <p class = "text-center banuser">Количество на складе</p>
                <input type="text" name="Product[0][count]" class="form-control text-left countvariation">
                 <p class = "text-center banuser">Место в списке</p>
                <input type="text" name="Product[0][place]" class="form-control text-left placevariation">
            </div>
        </div>

        <button type="button" class="knopkafeedback addvariation" style="margin-top:45px;">ДОБАВИТЬ</button><br>

        <?= Html::submitButton('ПРОДОЛЖИТЬ', ['style' => 'margin-top:45px;','class' => 'knopkafeedback newvariation']) ?>
    </form>
    <br>
</div>