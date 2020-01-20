<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Админка';
?>
<div class = "col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <p class ="feedtext">Вариации товара <?= $product?></p>
    <form enctype="multipart/form-data" class = "variations" method="POST">
        <div class="blocks">
            <?php
            $count = 0;
            foreach ($variations as $variation){
            ?>
            <div class="block <?= $count ?>" style = "margin-top: 20px; border: 1px solid darkred">
                <input type="hidden" name="Product[<?= $count ?>][hidden]" value="<?= $variation->id ?>">
                <p class = "text-center banuser">Фотография</p>
                <input type="file" name="Product[<?= $count ?>][image]" class="uploadButton filevariation">
                <p class = "text-center"><img style = "max-width: 90%;" src = "/images/products/<?= $variation->img ?>"/></p>
                <?php 
                if($variation->img != null){
                ?>
                <p class = "text-center banuser">Удалить фото?</p>
                <p class = "text-center"><input value = "delete" type="checkbox" name="Product[<?= $count ?>][deleteimage]" class="uploadButton filevariation"></p>
                <?php
                }
                ?>
                <p class = "text-center banuser">Разновидность</p>
                <input type="text" name="Product[<?= $count ?>][name]" value = "<?= $variation->name ?>" class="form-control text-left namevariation">
                <p class = "text-center banuser">Цена</p>
                <input type="text" name="Product[<?= $count ?>][price]" value = "<?= $variation->price ?>" class="form-control text-left pricevariation">
                <p class = "text-center banuser">Скидка</p>
                <input type="text" name="Product[<?= $count ?>][sale]" value = "<?= $variation->discount ?>" class="form-control text-left salevariation">
                <p class = "text-center banuser">Количество на складе</p>
                <input type="text" name="Product[<?= $count ?>][count]" value = "<?= $variation->count ?>" class="form-control text-left countvariation">
                <p class = "text-center banuser">Место в списке</p>
                <input type="text" name="Product[<?= $count ?>][place]" value = "<?= $variation->place ?>" class="form-control text-left placevariation">
                <button type="button" class="knopkafeedback deletevariation" id = "<?= $variation->id ?>" style="margin-top:45px;">Удалить</button><br><br>
            </div>
            <?php
                $count += 1;
            }
            ?>
        </div>

        <button type="button" class="knopkafeedback addvariation" style="margin-top:45px;">ДОБАВИТЬ</button><br>

        <?= Html::submitButton('ЗАВЕРШИТЬ РЕДАКТИРОВАНИЕ', ['style' => 'margin-top:45px;','class' => 'knopkafeedback newvariation']) ?>
    </form>
    <br>
</div>