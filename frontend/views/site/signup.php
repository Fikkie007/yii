<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\SignupForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->params['pageName'] = $this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;

if (YII_DEBUG) {
	$kafer = \Faker\Factory::create(Yii::$app->language);
	$model->name = $kafer->name;
	$model->email = $kafer->email;
	$model->password = $model->password_repeat = '.';
}
?>
<div class="site-signup">
	<h1><?= Html::encode($this->title) ?></h1>

	<p>Please fill out the following fields to signup:</p>

	<div class="row">
		<div class="col-lg-5">
			<?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

				<?= $form->field($model, 'name')->textInput() ?>
				<?= $form->field($model, 'email') ?>

				<?= $form->field($model, 'password')->passwordInput() ?>
				<?= $form->field($model, 'password_repeat')->passwordInput() ?>

				<div class="form-group">
					<?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
				</div>

			<?php ActiveForm::end(); ?>
		</div>
	</div>
</div>
