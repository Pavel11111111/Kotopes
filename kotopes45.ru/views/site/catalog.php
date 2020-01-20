<?php

/* @var $this yii\web\View */

$this->title = 'Каталог | Котопёс КУРГАН | Официальный сайт';

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use yii\helpers\Url;
?>


<div class="site-catalog">
    <div id="productinbasket" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Основное содержимое модального окна -->
                <div class="modal-body row otstup" style = "text-align:center;">
                    <img class = "productinbasketimage" src="/images/galka2.jpg">
                    <p class = "productinbaskettext">Товар добавлен</p>
                    <button type = "submit" class = 'knopkacallme productinbasketbutton korzinabutton'>Оформить заказ</button>
                    <p class = "buyclick" data-dismiss="modal" style = "margin-bottom:43px;">Продолжить покупки</p>
                </div>
            </div>
        </div>
    </div>
    <div id="callme" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Заголовок модального окна -->
                <div class="modal-header" style = "position:relative">
                    <p class="callmetext1 reg"style = "width: 90%;">Сообщить о наличии</p>
                    <button type="button" class="knopkaimg" data-dismiss="modal"style="height: 59px;width:9%;margin-top: -5px;"><img class = "imaga" src="/images/krest.png" alt="закрыть"></button>
                </div>
                <!-- Основное содержимое модального окна -->
                <div class="modal-body row otstup">
                    <p class = "callmetext2">Этот товар в данный момент отсутствует на складе. Укажите свое имя и номер телефона, чтобы наш оператор мог связаться с Вами и обсудить детали доставки данного товара.</p>
                    <div class = "otstupModalIdenti">
                        <?php $form = ActiveForm::begin([
                            'id' => 'callme-form',
                            'action' => 'site/callme',
                            'enableAjaxValidation' => true,
                            'validationUrl' => 'site/callmevalidation',
                            'validateOnChange' => false,
                            'validateOnBlur' => false,
                            'fieldConfig' => [
                                'template' => "<div class = \"row\"><div class=\"col-xs-9 col-sm-9 col-md-9 col-lg-9\">{input}</div></div>\n<div class=\"row\"><div class=\"col-xs-3 col-sm-3 col-md-3 col-lg-3\"></div><div class=\" col-xs-10  col-sm-10  col-md-10   col-lg-10\">{error}</div></div>",
                                'labelOptions' => ['class' => 'col-lg-1 control-label'],
                            ],
                        ]); ?>
                        <?= $form->field($callme, 'clientname')->textInput(['value' => $username,'placeholder' => 'ФИО', 'class'=>'form-control text-left ']) ?>
                        <?= $form->field($callme, 'number')->textInput(['value' => Yii::$app->user->identity->number ,'placeholder' => 'Ваш номер телефона', 'class'=>'form-control text-left ']) ?>
                        <?= $form->field($callme, 'variationid')->hiddenInput(['class' => 'hiddenvariationid']) ?>
                        <div class = "row">
                            <div class = "col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <?= Html::submitButton('Отправить', ['class' => 'knopkacallme']) ?>
                            </div>
                        </div>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="buyinoneclick" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Заголовок модального окна -->
                <div class="modal-header" style = "position:relative">
                    <p class="callmetext1 reg"style = "width: 90%;">Быстрая покупка</p>
                    <button type="button" class="knopkaimg" data-dismiss="modal"style="height: 59px;width:9%;margin-top: -5px;"><img class = "imaga" src="/images/krest.png" alt="закрыть"></button>
                </div>
                <!-- Основное содержимое модального окна -->
                <div class="modal-body row otstup">
                    <p class = "callmetext2">Для быстрой покупки введите вашу фамилию, имя и номер телефона. Наш оператор свяжется с Вами, и уточнит подробности заказа.</p>
                    <div class = "otstupModalIdenti">
                        <?php $form = ActiveForm::begin([
                            'id' => 'buyinoneclick-form',
                            'action' => 'site/buyinoneclick',
                            'enableAjaxValidation' => true,
                            'validationUrl' => 'site/buyinoneclickvalidation',
                            'validateOnChange' => false,
                            'validateOnBlur' => false,
                            'fieldConfig' => [
                                'template' => "<div class = \"row\"><div class=\"col-xs-9 col-sm-9 col-md-9 col-lg-9\">{input}</div></div>\n<div class=\"row\"><div class=\"col-xs-3 col-sm-3 col-md-3 col-lg-3\"></div><div class=\" col-xs-10  col-sm-10  col-md-10   col-lg-10\">{error}</div></div>",
                                'labelOptions' => ['class' => 'col-lg-1 control-label'],
                            ],
                        ]); ?>
                        <?= $form->field($buyoneclick, 'clientname')->textInput(['value' => $username, 'placeholder' => 'ФИО', 'class'=>'form-control text-left ']) ?>
                        <?= $form->field($buyoneclick, 'number')->textInput(['value' => Yii::$app->user->identity->number, 'placeholder' => 'Номер телефона', 'class'=>'form-control text-left ']) ?>
                        <?= $form->field($buyoneclick, 'variationid', ['template'=>'<div style = "height: 0px;">{input}</div>'])->hiddenInput(['class' => 'hiddenvariationid']) ?>
                        <?= $form->field($buyoneclick, 'countproduct', ['template'=>'<div style = "height: 0px;">{input}</div>'])->hiddenInput(['class' => 'hiddencountid']) ?>
                        <div class = "row">
                            <div class = "col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <?= Html::submitButton('Заказать', ['class' => 'knopkacallme']) ?>
                            </div>
                        </div>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="opentext" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Заголовок модального окна -->
                <div class="modal-header" style = "padding-right: 57px;padding-left: 57px;">
                    <p class="modal-title row reg productname productnamemod"style = "width: 100%;"></p>
                    <button type="button" class="knopkaimg" data-dismiss="modal"style="position:absolute;top:3%;right:2%;"><img class = "imaga" src="/images/krest.png" alt="закрыть"></button>
                </div>
                <!-- Основное содержимое модального окна -->
                <div class="modal-body row">
                    <p class = "productdescriptionmod"></p>
                </div>
            </div>
        </div>
    </div>
    <input type="button" class="buttontop" value="К началу">
    <div class="otstupc">
        <div class="catalogoffset">
            <div class="breadcrumbc"><a href="" class="linkc allproduct">Все Продукты</a><div style="display:inline;" class="allproductclean"></div><div class="typeproductclean" style="display:inline;"></div></div>
            <div class="sortc">
                <p style="display: inline" class="sorttext">СОРТИРОВАТЬ ПО</p>
                <select  name="spjax" id="spjaxproducts" class="selectsortc">
                    <option value="1" selected="selected">ЦЕНА (СНАЧАЛА ДОРОГИЕ)</option>
                    <option value="2">ЦЕНА (СНАЧАЛА ДЕШЕВЫЕ)</option>
                    <option value="3">ПОПУЛЯРНОСТЬ</option>
                    <option value="4">НАЗВАНИЕ (А-Я)</option>
                    <option value="5">НАЗВАНИЕ (Я-А)</option>
                </select>
            </div>
            <div class = "sortc2">
                <button data-id = "0" class = "openfiltresbutton">Открыть фильтры</button>
            </div>
            <div style="margin-top: 24px;">
                <div class="filterblockc">
                    <div class="level1">
                        <div data-id="0" class="list turn">
                            <p class="filtertextc">Тип животного</p><img src="/images/iconminus.png"
                                                                         class="filterimgc"/>
                        </div>
                        <div data-text="Тип животного">
                            <?php
                            foreach ($typeanimals as $typeanimal) {
                                ?>
                                <div class="list levelup1 filterimgcmargin">
                                    <p class="filtertextc"><?php echo $typeanimal->name ?></p><img
                                            src="/images/strelka.svg" class="filterimgc"/>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                            <?php
                            $oldname = "";
                            foreach ($typeproducts as $typeproduct){
                                $name = $typeproduct->typeanimalsname;
                                if ($name != $oldname){
                                    if ($oldname != ""){?>
                                        </div>
                                        </div>
                                    <?php } ?>
                                    <div class="level2" data-text="<?php echo $name ?>" style="display: none">
                                        <div data-id="0" class="list turn">
                                            <p class="filtertextc">Тип товара</p><img src="/images/iconminus.png" class="filterimgc"/>
                                        </div>
                                    <div data-text="Тип товара">
                                <?php } ?>
                                        <div class="list levelup2 filterimgcmargin" data-id="<?php echo $typeproduct->id ?>"><!--откладываем ид для использования-->
                                            <p class="filtertextc"><?php echo $typeproduct->name ?></p><img src="/images/strelka.svg" id="kormimg" class="filterimgc"/>
                                        </div>
                                <?php $oldname = $name;
                            } ?>
                </div>
            </div>
                        <?php
            $icon = $filternames[0]->typeproductid;
            $counticon = 0;
            foreach ($filternames as $filtername){
                $id = $filtername->typeproductid;
                if($icon != $id){
                    $counticon = 0;
                }
                ?>
                <div class="level3"  data-text="<?php echo $filtername->typeproduct->name . $filtername->typeproduct->typeanimalsname ?>" data-id="<?php echo $id ?>" style="display: none">
                    <?php if( $filtername->name == ""){?>
                        <?php
                        $counticon -= 1;
                        foreach ($filterparams as $filterparam){ ?>
                            <?php if($filterparam->filternameid ==  $filtername->id){ ?>
                                <div class="list opengal" data-id="0">
                                    <p class="filtertextc"><?php echo $filterparam->name ?></p><img src="/images/kvadrafon.jpg" class="filterimgc filterimgc2"/>
                                </div>
                            <?php }
                        }
                    } else{
                        if($counticon < 2){?>
                        <div data-id="0" class="list turn">
                            <p class="filtertextc"><?php echo $filtername->name ?></p><img src="/images/iconminus.png" class="filterimgc"/>
                        </div>
                        <div data-text="<?php echo $filtername->name ?>">
                            <?php }
                        else{ ?>
                            <div data-id="1" class="list turn otherlistturn">
                                <p class="filtertextc"><?php echo $filtername->name ?></p><img
                                        src="/images/iconplus.png" class="filterimgc otherfilterimgc"/>
                            </div>
                            <div style="display: none;" class = "otherfilterslist" data-text="<?php echo $filtername->name ?>">
                                <?php
                                }
                            foreach ($filterparams as $filterparam){ ?>
                                <?php if($filterparam->filternameid ==  $filtername->id){ ?>
                                    <div class="list filterimgcmargin opengal" data-id="0">
                                        <p class="filtertextc"><?php echo $filterparam->name ?></p><img src="/images/kvadrafon.jpg" class="filterimgc filterimgc2"/>
                                    </div>
                                <?php }
                            } ?>
                        </div>
                    <?php }?>
                </div>
            <?php $icon = $filtername->typeproductid;$counticon+=1;} ?>
            <p style = "display: none" class = "resetfilters">СБРОСИТЬ ФИЛЬТР</p>
                </div>
                <div class = "productblockc">
                    <div class = "information">
                        Спасибо за заявку, наш оператор свяжется с вами в ближайшее время!
                    </div>
                    <div class = "searchbarmargin" style = "display: none;">
                    <div class = "searchbar">
                        <div class = "searchbar2" style = "padding-right: 103px;">
                            <form id="search-form"  action="site/searchproducts" method="post">
                                <input maxlength = "100" autocomplete="off" name="Search[text]" class = "searchinput" placeholder="Pro Plan Adult Feline с курицей" type="text">
                                <button type="submit" class="seachicon"></button>
                                <button type="button" class="search-delete-icon"><img style = "max-width: 26px; max-height: 26px;" src="/images/krest.png" alt="закрыть"></button>
                            </form>
                        </div>
                        <div class = "searchbarhistory" style = "height: 151px;display:none;">
                            <div class = "searchbarhistorytitle">
                                История поиска
                            </div>
                            <ul>
                                <?php
                                if(Yii::$app->user->isGuest){
                                    $searchhistory = Yii::$app->session['searchhistory'];
                                }else{
                                    $searchhistory = $this->context->searchHistory->getInfo(Yii::$app->user->id);
                                }
                                $count = 0;
                                if($searchhistory != null){
                                foreach($searchhistory as $search){
                                    if($count == 5){
                                        break;
                                    }
                                ?>
                                <li class = "searchline"><a href = "  <? echo Url::toRoute(['site/catalog', 'search' => $search["searchtext"]]) ?>"><? echo $search["searchtext"] ?></a></li>
                                <?php
                                }
                                }
                                ?>
                            </ul>
                            <button class = "searchbarbuttonclear" type = "button">ОЧИСТИТЬ ЖУРНАЛ</button>
                        </div>
                    </div>
                    </div>
                    <div class = "products">
                        
                    </div>
                </div>
                <div class = "loading-bar">
                        
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
