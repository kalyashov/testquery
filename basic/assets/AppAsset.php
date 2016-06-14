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
        'plugins/bootstrap/css/bootstrap.min.css',
        'plugins/highlight/styles/agate.css',
        'css/app-st.css',
        'css/connection-editor.css',
        'css/tuning-styles.css',
        'plugins/codemirror/codemirror.css',
        'plugins/codemirror/show-hint.css',
        'plugins/DataTables/DataTables-1.10.11/css/dataTables.bootstrap.min.css',
        //'plugins/DataTables/Responsive-2.0.2/css/responsive.datatables.min.css',
        'plugins/DataTables/Responsive-2.0.2/css/responsive.bootstrap.min.css',
        //'plugins/DataTables/Buttons-1.1.2/css/buttons.bootstrap.min.css',
        'plugins/DataTables/Buttons-1.1.2/css/buttons.dataTables.min.css',
    ];
    public $js = [
        'js/jquery-2.2.1.min.js',
        'plugins/DataTables/datatables.min.js',
        'plugins/DataTables/DataTables-1.10.11/js/dataTables.bootstrap.min.js',
        'plugins/DataTables/DataTables-1.10.11/js/jquery.dataTables.min.js',
        //'plugins/DataTables/Buttons-1.1.2/js/buttons.bootstrap.min.js',
        'plugins/DataTables/Buttons-1.1.2/js/dataTables.buttons.min.js',
        'plugins/bootstrap/js/bootstrap.min.js',
        'js/tuning-script.js',
        'plugins/chartJs/Chart.js',
        'plugins/backbone/backbone-min.js',
        'plugins/underscore/underscore-min.js',
        'plugins/highlight/highlight.pack.js',
        'plugins/codemirror/codemirror.js',
        'plugins/codemirror/mode/sql.js',
        'plugins/codemirror/show-hint.js',
        'plugins/codemirror/sql-hint.js',

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
