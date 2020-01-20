<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Админка';
?>
<div class = "col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div style="text-align: center">
    <table class = "table-wrap">
        <thead>
            <tr><th>id</th><th>Имя</th><th>Фамилия</th><th>Дата рождения</th><th>email</th><th>Номер телефона</th><th>Забанить</th></tr>
        </thead>
    <?php
    foreach ($users as $user){
    ?>
        <tr><td data-label="id"><?= $user->id ?></td><td data-label="Имя"><?= $user->name ?></td><td data-label="Фамилия"><?= $user->patronymic ?></td><td data-label="Дата рождения"><?= $user->date ?></td><td data-label="email"><?= $user->email ?></td><td data-label="Номер телефона"><?= $user->number ?></td><td data-label="Забанить"><?php
                if(Yii::$app->authManager->getRolesByUser($user->id)["banned"] == null){
                    echo Html::submitButton('ЗАБАНИТЬ', ['class' => 'banuser', 'id' => $user->id, 'data-info' => 0]);
                }else{
                    echo Html::submitButton('РАЗБАНИТЬ', ['class' => 'banuser', 'id' => $user->id, 'data-info' => 1]);
                } ?></td></tr>
    <?php
    }
    ?>
    </table>
    </div>
</div>