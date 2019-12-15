<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css?v=86',
        'css/fonts.css?v=4',
        'css/chosen.min.css?v=3',
        "https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css?v=1",
        "https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css?v=1"
    ];
    public $js = [
        'js/text.js?v=4',
        'js/modal.js?v=16',
        'js/hiddenelem.js?v=4',
        'js/email.js?v=4',
        'js/searchIdentity.js?v=4',
        'js/passwordRecover.js?v=4',
        'js/login.js?v=4',
        'js/registration.js?v=4',
        'js/slickinit.js?v=14',
        'js/openimage.js?v=13',
        'js/likes.js?v=4',
        'js/sort.js?v=7',
        'js/check.js?v=4',
        'js/actionforredirect.js?v=4',
        'js/order.js?v=4',
        'js/feedback.js?v=4',
        'js/filter.js?v=34',
        'js/addlover.js?v=4',
        'js/imageanimation.js?v=6',
        'js/adminkadelete.js?v=5',
        'js/adminproducts.js?v=19',
        'js/chosen.jquery.js?v=13',
        'js/admintableproduct.js?v=6',
        'js/products.js?v=5',
        "https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js?v=1",
        'js/filtersadaptive.js?v=1',
        'js/searchproduct.js?v=1',
        'js/buyproduct.js?v=1'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
