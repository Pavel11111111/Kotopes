<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Админка';
?>
<div class = "col-xs-12 col-sm-12 col-md-12 col-lg-12 filtersblock">
    <input type="hidden" id="pruductid" value="<?= $product->id?>">
    <p class ="feedtext">Фильтры товара <?= $product->name?></p>
    <select class = "choicefilter" multiple style = "width: 100%;margin-top: 20px;height: 32px;">
        <option value=""></option>
        <?php foreach ($typeanimals as $typeanimal){ $count = false;?>
            <?php foreach ($product->typeanimals as $typeanimal2){
                if($typeanimal->name ==  $typeanimal2->name){
                    $count = true; ?>
                <option selected value="<?php echo $typeanimal->name;?>"><?php echo $typeanimal->name;?></option>
            <?php }}
            if($count == false){ ?>
                <option value="<?php echo $typeanimal->name;?>"><?php echo $typeanimal->name;?></option>
                <?php
            }
            ?>
        <?php }
        ?>
    </select>
    <select class = "choicefilter2" multiple style = "width: 100%;margin-top: 20px;height: 32px;">
    </select>
</div>
<button type="button" class="knopkafeedback changefilter" style="margin-top:45px;">ИЗМЕНИТЬ</button>