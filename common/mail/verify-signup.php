<?php

use yii\helpers\Html;

/**
 * @var \jeemce\AppView $this
 * @var \common\models\User $model
 */

$verifyLink = Yii::$app->urlManager->createAbsoluteUrl([
	'site/verify-signup',
	'token' => $model->verification_token,
]);
?>
<div class="verify-signup">
	<p>Hello <?= Html::encode($model->name) ?>,</p>

	<p>Follow the link below to verify your email:</p>

	<p><?= Html::a(Html::encode($verifyLink), $verifyLink) ?></p>
</div>
