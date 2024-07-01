<?php

use yii\helpers\Html;

/**
 * @var \jeemce\AppView $this
 * @var \common\models\User $model
 */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl([
	'site/reset-password',
	'token' => $model->password_reset_token,
]);
?>
<div class="reset-password">
	<p>Hello <?= Html::encode($model->name) ?>,</p>

	<p>Follow the link below to reset your password:</p>

	<p><?= Html::a(Html::encode($resetLink), $resetLink) ?></p>
</div>
