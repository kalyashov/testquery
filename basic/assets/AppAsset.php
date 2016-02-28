<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/site.css',
        'extensions/DataTables/datatables.min.css',
        //'css/bootstrap-3.3.6-dist/css/bootstrap.min.css',
        //'css/bootstrap-combined.min.css',
    ];
    public $js = [
        'js/jquery-2.2.1.min.js',
        'js/site_index.js',
        //'js/bootstrap-3.3.6-dist/css/bootstrap.min.js',
        'extensions/DataTables/datatables.min.js',

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
