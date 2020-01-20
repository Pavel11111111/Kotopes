<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Админка';
?>
<div class = "col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <p class ="feedtext">Товары новости <?= $date->date ?></p>
    <form enctype="multipart/form-data" class = "variations" method="POST">
        <div class="blocks">
            <?php
                $counter = 0;
                foreach($date->informationtextlists as $textlist){
            ?>
                <div class="block" style = "margin-top: 20px; border: 1px solid darkred">
                    <p class = "text-center banuser">Тест перед названием</p>
                    <input type="text" name="Informationtextlist[<?= $counter ?>][text]" class="form-control text-left namevariation" style = "margin-bottom:44px;" value = "<?= $textlist->text ?>">
                    <p class = "text-center banuser">Название товара для новости</p>
                    <input type="text" name="Informationtextlist[<?= $counter ?>][link]" class="form-control text-left namevariation" style = "margin-bottom:44px;" value = "<?= $textlist->link ?>">
                    <input type ="hidden" name = "Informationtextlist[<?= $counter ?>][id]" value = "<?= $textlist->id ?>">
                    <button type="button" id = "<?= $textlist->id ?>" class="knopkafeedback deletenewstext" style="margin-top:0px;">УДАЛИТЬ</button>
                </div>
            <?php
                $counter += 1;
                }
            ?>
            <p class ="feedtext">ДОБАВЛЕНИЕ НОВЫХ ТОВАРОВ</p>
            <div class="block" style = "margin-top: 20px; border: 1px solid darkred">
                <p class = "text-center banuser">Текст перед названием</p>
                <input type="text" name="Informationtextlist[<?= $counter ?>][text]" class="form-control text-left namevariation" style = "margin-bottom:44px;">
                <p class = "text-center banuser">Название товара для новости</p>
                <input type="text" name="Informationtextlist[<?= $counter ?>][link]" class="form-control text-left namevariation" style = "margin-bottom:44px;">
                <input type ="hidden" name = "Informationtextlist[<?= $counter ?>][id]" value = "0">
            </div>
        </div>

        <button type="button" class="knopkafeedback addnewstextlist" style="margin-top:45px;">ДОБАВИТЬ</button><br>

        <?= Html::submitButton('ЗАКОНЧИТЬ РЕДАКТИРОВАНИЕ', ['style' => 'margin-top:45px;','class' => 'knopkafeedback newnewstextlist']) ?>
    </form>
    <br>
</div>