<?php

return \yii\helpers\ArrayHelper::merge(
	(require __DIR__ . '/../../vendor/jeemce/yii2/config/app.php'),
	[
		'id' => 'frontend',
		'basePath' => dirname(__DIR__),
		'controllerNamespace' => 'frontend\controllers',
		'params' => \yii\helpers\ArrayHelper::merge(
			(require __DIR__ . '/../../common/config/params.php'),
			(require __DIR__ . '/params.php'),
		),
	],
);
