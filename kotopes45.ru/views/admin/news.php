<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = 'Админка';
?>
<div class = "col-xs-12 col-sm-12 col-md-12 col-lg-12">
       <div id="InformationBox" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Заголовок модального окна -->
                <div class="modal-header regheader">
                    <h2 class="modal-title row reg" style = "width: 90%;padding-left: 1%;font-size:32px;">На сайт добавлено</h2>
                    <button type="button" class="knopkaimg" data-dismiss="modal" style = "width: 9%;padding-left: 0px;padding-right: 0px;"><img style = "vertical-align:top;" class = "imaga" src="/images/krest.png" alt="закрыть"></button>
                </div>
                <!-- Основное содержимое модального окна -->
                <div class="modal-body row otstup">
                    <?php 
                    foreach($news as $onenews){
                    ?>
                        <div style ="width: 100%;text-align:center;font-size:20px;">
                            <p><?= $onenews->date ?></p>
                        </div>
                        <div style = "width: 100%;font-size:20px;">
                            <ul>
                            <?php 
                            $i = 0;
                            foreach($onenews->informationtextlists as $onetext){
                            ?>
                                <?php
                                if($i != 0 && $onetext->text == null){
                                ?>
                                    <li style = "list-style-type: none;">
                                        <p style = "display: inline;"><?= $onetext->text ?> </p><br><a style = "display: inline;" href = "http://kotopes45.ru/Catalog?search=<?=  $onetext->link  ?>"><?= $onetext->link ?></a>
                                    </li>
                                <?php
                                }else{
                                ?>
                                    <li>
                                        <p style = "display: inline;"><?= $onetext->text ?> </p><br><a style = "display: inline;" href = "http://kotopes45.ru/Catalog?search=<?=  $onetext->link  ?>"><?= $onetext->link ?></a>
                                    </li>
                                <?php
                                }
                                ?>
                            <?php
                            $i++;
                            }
                            ?>
                            </ul>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <!-- Футер модального окна -->
                <div class="modal-footer">
                    <div id = "addproductmodalready" style = "display:none;">
                        <div style ="width: 100%;text-align:center;font-size:20px;">
                            Спасибо, следите за обновлениями, и возможно, этот товар скоро появится на сайте.
                        </div>
                    </div>
                    <div id = "addproductmodal">
                        <div style ="width: 100%;text-align:center;font-size:20px;">
                            Какой товар Вы хотите видеть следующим?    
                        </div>
                        <div style ="width: 100%;text-align:center;">
                            <textarea id = "sendinformationbyproducttext" style = "width: 100%;max-width: 100%;min-width: 100%; height: 70px;min-height:70px;border: 1px solid black;"></textarea>  
                            <button type = "button" id = "sendinfomationbyproduct" class = 'knopkainput' style = "display:inline-block;margin-top: 13px;">Отправить</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="button" class="buttontop opennewsmodalasadmin" value="Посмотреть результат" style = "left:-79px">
    <p class ="feedtext">Новая новость</p>
    <?php $form = ActiveForm::begin([
        'id' => 'dates-form',
        'action' => 'http://kotopes45.ru/admin/news',
        'fieldConfig' => [
            'template' => "{input}{error}",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>
    <?= $form->field($informationdate, 'date')->textArea(['placeholder' => 'Введите дату публикации', 'style'=>'resize: vertical;width:100%;']) ?>
    <?= Html::submitButton('ПРОДОЛЖИТЬ', ['style' => 'margin-top:45px;','class' => 'knopkafeedback newproduct']) ?>
    <?php ActiveForm::end(); ?>
    <div style = "text-align: center">
    <table class = "table-wrap">
        <thead>
            <tr><th>Дата для новости</th><th>Сохранить</th><th>Удалить</th><th>Продукты новости</th></tr>
        </thead>
        <?php
        foreach ($informationdatelist as $oneinformationdate){
        ?>
            <?php $form = ActiveForm::begin([
                'id' => 'datesedit-form',
                'action' => 'http://kotopes45.ru/admin/changenews',
                'fieldConfig' => [
                    'template' => "{input}{error}",
                    'labelOptions' => ['class' => 'col-lg-1 control-label'],
                ],
            ]); ?>
                <tr><td data-label="Дата для новости" style = "min-width: 329px;" ><?= $form->field($informationdate, 'date')->textArea(['value' => $oneinformationdate->date, 'style'=>'resize: vertical;height: 200px;', 'class' => "form-control text-left"]) ?> </td>
                    <input type = "hidden" name="Informationdateslist[id]" value = "<?= $oneinformationdate->id ?>">
                    <td data-label="Сохранить"><button class = "changeproduct" type="submit">СОХРАНИТЬ ИЗМЕНЕНИЯ</button></td>
                    <td data-label="Удалить"><button type="button" class = "deletenews" id = "<?= $oneinformationdate->id ?>">УДАЛИТЬ</button></td>
                    <td data-label="Продукты новости"><a class = "backtotable" href = "<?= Url::to(['admin/newstext',  'dateid' => $oneinformationdate->id]) ?>">Изменить список продуктов</a></td>
                </tr>
            <?php ActiveForm::end(); ?>
        <?php
        }
        ?>
    </table>
    </div>
</div>