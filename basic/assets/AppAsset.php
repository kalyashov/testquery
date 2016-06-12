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
        'plugins/DataTables/datatables.min.css',
        'plugins/bootstrap/css/bootstrap.min.css',
        'plugins/highlight/styles/default.css',
        'css/main2.css',
        'css/connection-editor.css',
        'css/tuning-styles.css',
    ];
    public $js = [
        'js/jquery-2.2.1.min.js',
        'plugins/DataTables/datatables.min.js',
        'plugins/bootstrap/js/bootstrap.min.js',
        'js/tuning-script.js',
        'plugins/chartJs/Chart.js',
        'plugins/backbone/backbone-min.js',
        'plugins/underscore/underscore-min.js',
        'plugins/highlight/highlight.pack.js',

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
