<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Админка';
?>
<div class = "col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <p class = "feedtext">1.0 Уровень</p>
    <div style = "margin-top: 20px; border: 1px solid darkred">
        <input type="text" id="newlevelonepost" class="form-control text-left formfilter">
        <button type="button" class="knopkafeedback newlevelone" style="margin-top:20px;">ДОБАВИТЬ</button><br><br>
    <?php foreach ($levelones as $levelone){
    ?>
        <input type="text" id="<?php echo $levelone->id;?>" class="form-control text-left formfilter" value = "<?php echo $levelone->name;?>">
        <?= Html::submitButton('ИЗМЕНИТЬ', ['style' => 'margin-top:20px;', 'class' => 'knopkafeedback changelevelone', 'data-id' => $levelone->id]) ?><br><br>
        <?= Html::submitButton('УДАЛИТЬ', ['class' => 'knopkafeedback deletelevelone', 'id' => $levelone->id]) ?><br><br>
    <?php
    }
    ?>
    </div>
    <p class = "feedtext">2.0 Уровень</p>
    <div style = "margin-top: 20px; border: 1px solid darkred">
        <input type="text" id="newleveltwopost" class="form-control text-left formfilter">
        <select id="newleveltwopost2" class = "selectfilter">
            <?php foreach ($levelones as $levelone){?>
                <option value="<?php echo $levelone->id;?>"><?php echo $levelone->name;?></option>
            <?php }
            ?>
        </select><br>
        <?= Html::submitButton('ДОБАВИТЬ', ['style' => 'margin-top:20px;','class' => 'knopkafeedback newleveltwo']) ?><br><br>
        <details>
            <summary>Все фильтры</summary>
        <?php foreach ($leveltwos as $leveltwo){
            ?>
            <input type="text" data-leveltwo ="<?php echo $leveltwo->id;?>" class="form-control text-left formfilter" value = "<?php echo $leveltwo->name;?>">
            <select data-leveltwo = "<?php echo $leveltwo->id;?>" class = "selectfilter">
                <option value="0" selected="selected"><?php echo $leveltwo->typeanimalsname;?></option>
                <?php foreach ($levelones as $levelone){
                    if ($leveltwo->typeanimalsname != $levelone->name){?>
                        <option value="<?php echo $levelone->id;?>"><?php echo $levelone->name;?></option>
                <?php }}
                ?>
            </select><br>
            <?= Html::submitButton('ИЗМЕНИТЬ', ['style' => 'margin-top:20px;', 'class' => 'knopkafeedback changeleveltwo', 'data-id' => $leveltwo->id]) ?><br><br>
            <?= Html::submitButton('УДАЛИТЬ', ['class' => 'knopkafeedback deleteleveltwo', 'id' => $leveltwo->id]) ?><br><br>
            <?php
        }
        ?>
        </details>
    </div>
    <p class = "feedtext">3.0 Уровень</p>
    <div style = "margin-top: 20px; border: 1px solid darkred">
        <input type="text" id="newleveltreepost" class="form-control text-left formfilter">
        <select id="newleveltreepost2" class = "selectfilter">
            <?php foreach ($leveltwos as $leveltwo){?>
                <option value="<?php echo $leveltwo->id;?>"><?php echo $leveltwo->typeanimalsname;?> -> <?php echo $leveltwo->name;?></option>
            <?php }
            ?>
        </select><br>
        <?= Html::submitButton('ДОБАВИТЬ', ['style' => 'margin-top:20px;','class' => 'knopkafeedback newleveltree']) ?><br><br>
        <details>
            <summary>Все фильтры</summary>
        <?php foreach ($leveltrees as $leveltree){
            if ($leveltree-> name == "" ){continue;} ?>
            <input type="text" data-leveltree ="<?php echo $leveltree->id;?>" class="form-control text-left formfilter" value = "<?php echo $leveltree->name;?>">
            <select data-leveltree = "<?php echo $leveltree->id;?>" class = "selectfilter">
                <?php foreach ($leveltwos as $leveltwo){
                    if($leveltwo->id == $leveltree->typeproductid){?>
                        <option selected="selected"value="<?php echo $leveltwo->id;?>"><?php echo $leveltwo->typeanimalsname;?> -> <?php echo $leveltwo->name;?></option>
                        <?php }else{ ?>
                        <option  value="<?php echo $leveltwo->id;?>"><?php echo $leveltwo->typeanimalsname;?> -> <?php echo $leveltwo->name;?></option>
                    <?php } ?>
                <?php }
                ?>
            </select><br>
            <?= Html::submitButton('ИЗМЕНИТЬ', ['style' => 'margin-top:20px;', 'class' => 'knopkafeedback changeleveltree', 'data-id' => $leveltree->id]) ?><br><br>
            <?= Html::submitButton('УДАЛИТЬ', ['class' => 'knopkafeedback deleteleveltree', 'id' => $leveltree->id]) ?><br><br>
            <?php
        }
        ?>
        </details>
    </div>
    <p class = "feedtext">3.1 Уровень</p>
    <div style = "margin-top: 20px; border: 1px solid darkred">
        <input type="text" id="newleveltree2post" class="form-control text-left formfilter">
        <select id="newleveltree2post2" class = "selectfilter">
            <?php foreach ($leveltwos as $leveltwo){?>
                <?php foreach ($leveltrees as $leveltree){
                    if($leveltree->typeproductid == $leveltwo->id){?>
                <option value="<?php echo $leveltree->id;?>"><?php echo $leveltwo->typeanimalsname;?> -> <?php echo $leveltwo->name;?> -> <?php echo $leveltree->name;?></option>
                        <?php }?>
                <?php }
                ?>
            <?php }
            ?>
        </select><br>
        <?= Html::submitButton('ДОБАВИТЬ', ['style' => 'margin-top:20px;','class' => 'knopkafeedback newleveltree2']) ?><br><br>
        <details>
            <summary>Все фильтры</summary>
        <?php foreach ($leveltrees2 as $leveltree2){ //перебираем конечный фильтр?>
            <input type="text" data-leveltree2 ="<?php echo $leveltree2->id;?>" class="form-control text-left formfilter" value = "<?php echo $leveltree2->name;?>">
            <select data-leveltree2 = "<?php echo $leveltree2->id;?>" class = "selectfilter">
                <?php foreach ($leveltwos as $leveltwo){
                    foreach ($leveltrees as $leveltree) {
                        if($leveltree->typeproductid == $leveltwo->id) {
                            if ($leveltree->id == $leveltree2->filternameid) { ?>
                                <option selected="selected" value="<?php echo $leveltree->id; ?>"><?php echo $leveltwo->typeanimalsname; ?> -> <?php echo $leveltwo->name; ?> -> <?php echo $leveltree->name; ?></option>
                            <?php } else { ?>
                                <option value="<?php echo $leveltree->id; ?>"><?php echo $leveltwo->typeanimalsname; ?> -> <?php echo $leveltwo->name; ?> -> <?php echo $leveltree->name; ?></option>
                            <?php }
                        }
                    }?>
                <?php }
                ?>
            </select><br>
            <?= Html::submitButton('ИЗМЕНИТЬ', ['style' => 'margin-top:20px;', 'class' => 'knopkafeedback changeleveltree2', 'data-id' => $leveltree2->id]) ?><br><br>
            <?= Html::submitButton('УДАЛИТЬ', ['class' => 'knopkafeedback deleteleveltree2', 'id' => $leveltree2->id]) ?><br><br>
            <?php
        }
        ?>
        </details>
    </div>
</div>