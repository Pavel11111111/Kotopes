<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\bootstrap\ActiveForm;
use app\models\Signup;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php echo Html::csrfMetaTags();?>
        <title><?= Html::encode($this->title)?></title>
        <?php $this->head() ?>
        <link rel="shortcut icon" href="/images/kotopes.ico" type="image/x-icon" />
    </head>
    <body>
    <?php $this->beginBody() ?>

    <div class="wrap">
        <?php
        NavBar::begin([
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar navbar-static-top',
            ],
        ]);
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav  navbar-left'],
            'items' => [
                ['label' => 'БАННЕРЫ', 'url' => Yii::$app->urlManager->createUrl(['admin/banners'])],
                ['label' => 'ФОТО ЗВЕРЕЙ', 'url' => ['/admin/animals']],
                ['label' => 'ПОЛЬЗОВАТЕЛИ', 'url' => ['/admin/users']],
                ['label' => 'НОВОСТИ', 'url' => ['/admin/news']],
                '<li class="hizo1">'
                . Html::a(Html::img('/images/kotopes.png'), ['/admin/adminpage'])
                .'</li>'
                .'<li class="hizo2 htext1 elem chel hid" id = "chel">',
                Html::img('/images/chel2.png', ['alt' => 'Выход'])
                . '<div class ="drop" id = "drop_chel"><ul style ="list-style-type:none; padding:0px;"><li><p class = "dropdown-menutext">Здравствуйте ' . Yii::$app->user->identity->name . '</p></li><li style="margin-bottom: 5px;">'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Выйти',
                    ['class' => 'dropdown-menutext dropdown-menulink btn btn-link']
                )
                . Html::endForm() . '</li></div>'
                .'</li>'
                . '<li class="htext1 ">'
                . Html::a('ПРОДУКТЫ', ['admin/product'], ['class' => 'check'])
                .'</li>'
                . '<li class="htext1 ">'
                . Html::a('ФИЛЬТРЫ ПРОДУКТОВ', ['admin/filters'], ['class' => 'check'])
                .'</li>'
                . '<li class="htext1 ">'
                . Html::a('ВРЕМЯ', ['admin/times'], ['class' => 'check'])
                .'</li>'
                . '<li class="htext1 htext2">'
                .'<p class="htext1 hid dropdown-menu-hidden-text">Здравствуйте ' . Yii::$app->user->identity->name . '</p>'
                .'</li>'
                . '<li class="htext1 ">'
                . Html::beginForm(['/site/logout'], 'post',['style' => 'height: 100%'])
                . Html::submitButton(
                    'Выйти',
                    ['class' => 'dropdown-menutext dropdown-menulink btn btn-link dropdown-menu-hidden-text', 'style' => 'height: 100%; width: 100%;']
                )
                . Html::endForm()
                .'</li>'
                /*Yii::$app->user->isGuest ? (
                    ['label' => 'Login', 'url' => ['/site/login']]
                ) : (
                    '<li>'
                    . Html::beginForm(['/site/logout'], 'post')
                    . Html::submitButton(
                        'Logout (' . Yii::$app->user->identity->username . ')',
                        ['class' => 'btn btn-link logout']
                    )
                    . Html::endForm()
                    . '</li>'
                )*/
            ],
        ]);


        NavBar::end();
        ?>
        <div class="container">
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </div>

    <footer class="footer">

    </footer>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>