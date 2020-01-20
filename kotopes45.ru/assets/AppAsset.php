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
        'css/site.css?v=205',
        'css/fonts.css?v=200',
        'css/chosen.min.css?v=200',
        "https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css?v=200",
        "https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css?v=200",
        "https://cdn.jsdelivr.net/npm/suggestions-jquery@19.8.0/dist/css/suggestions.min.css?v=200"
    ];
    public $js = [
        'js/adres.js?v=200',
        'https://cdn.jsdelivr.net/npm/suggestions-jquery@19.8.0/dist/js/jquery.suggestions.min.js?v=200',
        'js/cartactions.js?v=200',
        'js/text.js?v=200',
        'js/modal.js?v=200',
        'js/hiddenelem.js?v=200',
        'js/email.js?v=200',
        'js/searchIdentity.js?v=200',
        'js/passwordRecover.js?v=200',
        'js/login.js?v=200',
        'js/registration.js?v=200',
        'js/slickinit.js?v=200',
        'js/openimage.js?v=200',
        'js/likes.js?v=200',
        'js/sort.js?v=200',
        'js/check.js?v=200',
        'js/actionforredirect.js?v=200',
        'js/order.js?v=200',
        'js/feedback.js?v=200',
        'js/filter.js?v=200',
        'js/addlover.js?v=200',
        'js/imageanimation.js?v=200',
        'js/adminkadelete.js?v=200',
        'js/adminproducts.js?v=203',
        'js/chosen.jquery.js?v=200',
        'js/admintableproduct.js?v=200',
        'js/products.js?v=200',
        "https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js?v=200",
        'js/filtersadaptive.js?v=200',
        'js/searchproduct.js?v=200',
        'js/buyproduct.js?v=200',
        'js/gotop.js?v=200',
        'js/makeorderactions.js?v=200',
        'js/account-profile-actions.js?v=200',
        'js/admindate.js?v=200',
        'js/account-favourites-actions.js?v=1'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
