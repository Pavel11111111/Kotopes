<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = 'Админка';
?>
<div class = "col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <p class ="feedtext">Новый товар</p>
    <textarea id="productname" style = "resize: vertical;width:45%;"placeholder="Название товара"></textarea>
    <textarea id="productdescription" style = "resize: vertical;width:45%;float:right;"placeholder="Описание товара"></textarea><br>
    <?= Html::submitButton('ПРОДОЛЖИТЬ', ['style' => 'margin-top:45px;','class' => 'knopkafeedback newproduct']) ?>
    <div style = "text-align: center">
    <table class = "table-wrap">
        <thead>
            <tr><th>Название товара</th><th>Описание</th><th>Сохранить</th><th>Удалить</th></ht><th>Вариации</th><th>Фильтры</th></tr>
        </thead>
        <?php
        foreach ($products as $product){
            ?>
        <form method="POST" class ="productform" id = "<?= $product->id ?>">
            <tr><td data-label="Название товара" style = "min-width: 329px;" ><textarea style="resize: vertical;height: 200px;" name="Product[<?= $product->id ?>][name]" class="form-control text-left namevariation"><?= $product->name ?></textarea></td>
                <td data-label="Описание" style = "min-width: 329px;"><textarea  style="resize: vertical;height: 200px;"  name="Product[<?= $product->id ?>][description]" class="form-control text-left namevariation" style = "resize: vertical;width: 100%;"><?= $product->description ?></textarea></td>
                <td data-label="Сохранить"><button class = "changeproduct" type="submit">СОХРАНИТЬ ИЗМЕНЕНИЯ</button></td>
                <td data-label="Удалить"><button type="button" class = "deleteproduct" id = "<?= $product->id ?>">УДАЛИТЬ ТОВАР</button></td>
                <td data-label="Вариации"><a class = "backtotable" href = "<?= Url::to(['admin/changevariation',  'productid' => $product->id]) ?>">Изменить вариации</a></td>
                <td data-label="Фильтры"><a class = "backtotable" href = "<?= Url::to(['admin/changefilters',  'productid' => $product->id]) ?>">Изменить фильтры</a></td>
            </tr>
        </form>
            <?php
        }
        ?>
    </table>
    </div>
</div>