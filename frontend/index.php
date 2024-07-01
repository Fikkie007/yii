<?php

require __DIR__ . '/../vendor/autoload.php';

(new Symfony\Component\Dotenv\Dotenv)->usePutenv(true)->load(__DIR__ . '/../.env');

defined('YII_DEBUG') or define('YII_DEBUG', intval($_ENV['YII_DEBUG'] ?? 0) == 1);
defined('YII_ENV') or define('YII_ENV', $_ENV['YII_ENV'] ?? 'prod');

require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';
require __DIR__ . '/../common/config/bootstrap.php';
require __DIR__ . '/config/bootstrap.php';

$config = yii\helpers\ArrayHelper::merge(
    require __DIR__ . '/../common/config/main.php',
    require __DIR__ . '/config/main.php',
);

(new jeemce\App($config))->run();
