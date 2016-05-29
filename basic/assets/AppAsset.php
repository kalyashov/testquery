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
        'css/main-style.css',
        'css/dashboard.css',
        'css/connection-editor.css',
        'css/tuning.css',
    ];
    public $js = [
        'js/jquery-2.2.1.min.js',
        'js/index.js',
        'plugins/DataTables/datatables.min.js',
        'plugins/bootstrap/js/bootstrap.min.js',
        'js/tuning.js',
        'plugins/chartJs/Chart.min.js',
        'js/dashboard.js',
        'plugins/backbone/backbone-min.js',
        'plugins/underscore/underscore-min.js'

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
