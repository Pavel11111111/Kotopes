<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Админка';
?>
<div class = "col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <p class ="feedtext">Непроверенные</p>
    <?php
    foreach ($animalsinfo as $animal){
        ?>
        <div style = "margin-top: 20px; border: 1px solid darkred">
            <p class = "text-center"><img style="max-width: 90%;"src = "/images/animals/<?php echo $animal->img ?>"/></p>
            <p class ="feedtext"><?php echo $animal->name ?></p>
            <p class = "text-center">(<?php echo $animal->userid?>)</p>
            <?= Html::submitButton('ПРОВЕРЕНО', ['class' => 'knopkafeedback checkanimals', 'id' => $animal->id]) ?><br><br>
            <?= Html::submitButton('УДАЛИТЬ', ['class' => 'knopkafeedback deleteanimals', 'id' => $animal->id]) ?><br><br>
        </div>
        <?php
    }
    ?>
    <p class ="feedtext">Проверенные</p>
    <?php
    foreach ($animalsinfo2 as $animal2){
        ?>
        <div style = "margin-top: 20px; border: 1px solid darkred">
            <p class = "text-center"><img style="max-width: 90%;"src = "/images/animals/<?php echo $animal2->img ?>"/></p>
            <p class ="feedtext"><?php echo $animal2->name ?></p>
            <p class = "text-center">(<?php echo $animal2->userid?>)</p>
            <?= Html::submitButton('УДАЛИТЬ', ['class' => 'knopkafeedback deleteanimals', 'id' => $animal2->id]) ?><br><br>
        </div>
        <?php
    }
    ?>
</div>