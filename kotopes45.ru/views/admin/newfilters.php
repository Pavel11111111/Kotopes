<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Админка';
?>
<div class = "col-xs-12 col-sm-12 col-md-12 col-lg-12 filtersblock">
    <p class ="feedtext">Фильтры товара <?= $productname?></p>
    <select class = "choicefilter" multiple style = "width: 100%;margin-top: 20px;height: 32px;">
        <option value=""></option>
        <?php foreach ($typeanimals as $typeanimal){?>
            <option value="<?php echo $typeanimal->name;?>"><?php echo $typeanimal->name;?></option>
        <?php }
        ?>
    </select>
</div>
<button type="button" class="knopkafeedback newfilter" style="margin-top:45px;">ГОТОВО</button>