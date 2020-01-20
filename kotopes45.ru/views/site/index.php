<?php

/* @var $this yii\web\View */

use yii\bootstrap\Carousel;
use yii\widgets\Pjax;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Котопёс КУРГАН | Официальный сайт';
?>
<div class="site-index">
    <div id="ModalBox7" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Заголовок модального окна -->
                <div class="modal-header regheader2">
                    <h2 class="modal-title row reg" style = "width: 90%">Добавление любимца</h2>
                    <button type="button" class="knopkaimg" data-dismiss="modal" style = "width: 9%;padding-left: 0px;padding-right: 0px;"><img class = "imaga" src="/images/krest.png" alt="закрыть"></button>
                </div>
                <!-- Основное содержимое модального окна -->
                <div class="modal-body row">
                    <?php $form = ActiveForm::begin([
                        'id' => 'addlover-form',
                        'options' => ['enctype' => 'multipart/form-data'],
                        'layout' => 'horizontal',
                        'action' => 'site/index',
                        'fieldConfig' => [
                            'template' => "<div class = \"row\"><div class=\"col-xs-offset-1 col-xs-10 col-sm-offset-1 col-sm-10 col-md-offset-1 col-md-6 col-lg-offset-1 col-lg-6\">{input}</div></div>\n<div class=\"row\"><div class=\"col-xs-offset-1 col-xs-10 col-sm-offset-1 col-sm-10 col-md-offset-1 col-md-10  col-lg-offset-1 col-lg-10\">{error}</div></div>",
                            'labelOptions' => ['class' => 'col-lg-1 control-label'],
                        ],
                    ]); ?>
                    <?= $form->field($newAnimals, 'nameA')->textInput(['placeholder' => 'Введите кличку вашего питомца', 'class'=>'form-control text-left loginform']); ?>
                    <p style="margin-left: 7%">Загрузите его фотографию</p>
                    <?= $form->field($newAnimals, 'imgA')->fileInput(['class'=>'uploadButton', 'style'=>'min-width: 235x;']);?>

                    <div class="form-group">
                        <div class = "row">
                            <div class="col-lg-offset-1 col-lg-10 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1 ">
                                <?= Html::submitButton('ДАЛЕЕ', ['class' => 'knopkareg openmodalreg']) ?>
                                <?php ActiveForm::end(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="mod" value="<?= $modal ?>" />
    <div class = "row" style = "margin: 0px;">
        <div class="col-lg-offset-1 col-lg-10 col-md-12 col-md-offset-0 col-sm-12 col-sm-offset-0 col-xs-12 col-xs-offset-0" style = "padding-right: 0px;padding-left: 0px;">
    <?php ;
    $carousel = array();
    foreach ($hots as $hot){
    array_push($carousel, [
        'content' => '<img class = "car" src="/images/' . $hot->img . '"/>',
        'caption' => '<div class ="glt"><p style = "color:' . $hot->gltextcolor . '">'. $hot->gltext .'</p></div><div class = "t"><p style = "color:' . $hot->textcolor . '">'. $hot->text .'</p></div><p><div class = "knop"><a target="_blank" href="'. $hot->url .'" class="btn indexcarouselbtn btn-primary">Подробнее<span class="glyphicon glyphicon-chevron-right"></a></div></p>',
        'options' => []
    ]);
    }
    echo Carousel::widget([
        'items' => $carousel,
        'options' => ['class' => 'carousel slide', 'data-interval' => '10000000'],
        'controls' => [
            '<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>',
            '<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>'
        ]
    ]);
    ?>
            <div class = "texti">
                <p>У нас вы можете выбрать товар для любого питомца</p>
            </div>
            <div class = "col-lg-12 col-md-12 col-sm-12 col-xs-12  imgi">
                <div class = "col-lg-3 col-md-3 col-sm-10 col-xs-12 imgi1 indeximages" style = "padding: 0;">
                    <a class = "nohovedecoration" href="http://kotopes45.ru/Catalog?typeanimals=%D0%A1%D0%BE%D0%B1%D0%B0%D0%BA%D0%B8">
                        <p class = "imgitext1">Собаки</p>
                    </a>
                </div>
                <div class = "col-lg-3 col-md-12 col-sm-10 col-xs-12 imgi2 indeximages" style = "padding: 0;">
                    <a class = "nohovedecoration" href="http://kotopes45.ru/Catalog?typeanimals=%D0%9A%D0%BE%D1%88%D0%BA%D0%B8">
                        <p class = "imgitext1">Кошки</p>
                    </a>
                </div>
                <div class = "col-lg-3 col-md-12 col-sm-10 col-xs-12 imgi3 indeximages" style = "padding: 0;">
                    <a class = "nohovedecoration" href="http://kotopes45.ru/Catalog?typeanimals=%D0%93%D1%80%D1%8B%D0%B7%D1%83%D0%BD%D1%8B">
                        <p class = "imgitext1">Грызуны</p>
                    </a>
                </div>
            </div>
            <div class = "col-lg-12 col-md-12 col-sm-12 col-xs-12 texti2" style = "padding-left: 0px;padding-right: 0px;">
                <p>Любимцы наших клиентов</p>
                <div class = "back" style = "min-height: 900px;background-image: url('../images/primerbackground.jpg');">
                    <div style = "padding-top:150px;padding-left:16px;padding-right:16px;">
                        <?php
                        Pjax::begin([
                            'id' => 'view-mode-pjax',
                        ])
                        ?>
                        <div class = "owl-carousel owl-theme">
                            <?php for ($s = 0; $s < count($animals); $s+=2) { ?>
                                <div style = "display: inline-block;width: 100%;height: auto;">
                                    <div class = "carouseloneitem" style = "background-image: url('../images/kot.gif');background-size: 72% 72%; background-repeat: no-repeat; background-position: center center;">
                                        <div class="imgi11 bordercarousel slide-item owl-lazy" data-src="../images/animals/<?php echo $animals[$s]->img ?>" style = "max-height:300px;background-repeat: no-repeat; background-size: cover; background-position: center center;">
                                            <div class="backgroundbox">
                                                <p class = "animalstext"><?php echo $animals[$s]->name ?></p>
                                                <p class = "likes animalstext animalsmarg" data-id = "<?php echo $animals[$s]->id?>"><img class = "animalsimg" src="/images/heart.png"/> <?php echo $animals[$s]->countlikes ?></p>
                                                <img class = "animalsimgopen animalsmarg" src="/images/openimage.png" data-img = "/images/animals/<?php echo $animals[$s]->img ?>"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div  class = "carouseloneitem" style ="margin-top: 30px;background-image: url('../images/kot.gif');background-size: 72% 72%; background-repeat: no-repeat; background-position: center center;">
                                        <div class="imgi11 bordercarousel slide-item owl-lazy" data-src="../images/animals/<?php echo $animals[$s+1]->img ?>" style = "max-height:300px;background-repeat: no-repeat; background-size: cover; background-position: center center">
                                            <div class="backgroundbox">
                                                <p class = "animalstext"><?php echo $animals[$s+1]->name ?></p>
                                                <p class = "likes animalstext animalsmarg" data-id = "<?php echo $animals[$s+1]->id?>"><img class = "animalsimg" src="/images/heart.png"/> <?php echo $animals[$s+1]->countlikes ?></p>
                                                <img class = "animalsimgopen animalsmarg" src="/images/openimage.png" data-img = "/images/animals/<?php echo $animals[$s+1]->img ?>"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>

                        </div>
                        <?php Pjax::end(); ?>
                    </div>
                </div>
            </div>
            <div class = "col-lg-12 col-md-12 col-sm-12 col-xs-12 addblock" style = "padding-left: 0px;padding-right: 0px;">
                <button type="button" id = "ModalBox6Open" class = "knopkareg">Добавьте своего!</button>
                <div class="sort">
                    <p style="display: inline" class = "sorttext">СОРТИРОВАТЬ ПО</p>
                    <select name="spjax" id="spjax" class = "selectsort">
                        <option value="1" selected="selected">ДАТЕ ДОБАВЛЕНИЯ</option>
                        <option value="2">ПОПУЛЯРНОСТИ</option>
                    </select>
                </div>
            </div>
            <div class = "texti3 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <p style ="margin-bottom: 26px;">Поиск по каталогу товаров</p>
                <div class = "searchbarmargin">
                    <div class = "searchbar">
                        <div class = "searchbar2">
                            <form id="search-form"  action="site/searchproducts" method="post">
                                <input maxlength = "100" autocomplete="off" name="Search[text]" class = "searchinput" placeholder="Pro Plan Adult Feline с курицей" type="text">
                                <button type="submit" class="seachicon"></button>
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
            </div>
        </div>
    </div>
</div>
