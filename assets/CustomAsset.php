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
class CustomAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $js = [
        'js/vendor/modernizr-2.8.3-respond-1.4.2.min.js',
        'js/custom.js',
      	'js/jquery.js',
      	'js/jquery.magnific-popup.min.js',
      	'js/jquery.stellar.min.js',
      	'js/owl.carousel.min.js',
      	'js/smoothscroll.js',
      	'js/wow.min.js',
    ];
    public $jsOptions = [
        'position' => \yii\web\View::POS_HEAD,
    ];
}
