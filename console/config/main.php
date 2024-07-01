<?php

return jeemce\helpers\ArrayHelper::merge(
    (require __DIR__ . '/../../vendor/jeemce/yii2/config/cli.php'),
    [
        'id' => 'console',
        'basePath' => dirname(__DIR__),
        'controllerNamespace' => 'console\controllers',
        'bootstrap' => [
            'jeemce', // HARUS
        ],
        'modules' => [
            'jeemce' => jeemce\Module::class, // HARUS
        ],
        'params' => \jeemce\helpers\ArrayHelper::merge(
            (require __DIR__ . '/../../common/config/params.php'),
            (require __DIR__ . '/params.php'),
        ),
    ],
);
