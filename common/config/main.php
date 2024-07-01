<?php

return jeemce\helpers\ArrayHelper::merge(
	(require __DIR__ . '/../../vendor/jeemce/yii2/config/any.php'),
	[
		'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
		'components' => [
			'i18n' => [
				'translations' => [
					'app' => [
						'class' => \yii\i18n\PhpMessageSource::class,
						'basePath' => '@app/common/translations',
					],
				],
			],
		],
	],
);
