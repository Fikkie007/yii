<?php

namespace frontend\assets;

class AppAsset extends \jeemce\AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
    ];
    public $js = [
    ];
    public $depends = [
        \yii\web\YiiAsset::class,
        \yii\bootstrap5\BootstrapAsset::class,
        \yii\bootstrap5\BootstrapIconAsset::class,
        \yii\bootstrap5\BootstrapPluginAsset::class,
        \jeemce\assets\sweetalert2\SweetAlert2Asset::class,
        \jeemce\assets\main\JeemceMainAsset::class,
    ];
}
