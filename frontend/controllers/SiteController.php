<?php

namespace frontend\controllers;

use Yii;
use common\models\LoginForm;
use frontend\models\ContactForm;
use jeemce\helpers\ArrayHelper;
use jeemce\models\UserLoginForm;
use jeemce\models\UserResetPassword;
use jeemce\models\UserResetPasswordSendmail;
use jeemce\models\UserSignupForm;
use jeemce\models\UserSignupVerify;
use jeemce\models\UserSignupVerifyResend;

/**
 * {@inheritdoc}
 */
class SiteController extends \jeemce\controllers\SiteController
{
	/**
	 * {@inheritdoc}
	 */
	public function behaviors()
	{
		return [
			'access' => [
				'class' => \yii\filters\AccessControl::class,
				'only' => ['logout', 'signup'],
				'rules' => [
					[
						'actions' => ['signup'],
						'allow' => true,
						'roles' => ['?'],
					],
					[
						'actions' => ['logout'],
						'allow' => true,
						'roles' => ['@'],
					],
				],
			],
		];
	}

	/**
	 * Displays homepage.
	 *
	 * @return mixed
	 */
	public function actionIndex()
	{
		return $this->render('index');
	}

	/**
	 * Logs in a user.
	 *
	 * @return mixed
	 */
	public function actionLogin()
	{
		if (!Yii::$app->user->isGuest) {
			return $this->goHome();
		}

		$model = new UserLoginForm;
		if ($model->load(Yii::$app->request->post()) && $model->login()) {
			return $this->goBack();
		}

		$model->password = '';

		return $this->render('login', [
			'model' => $model,
		]);
	}

	/**
	 * Logs out the current user.
	 *
	 * @return mixed
	 */
	public function actionLogout()
	{
		Yii::$app->user->logout();

		return $this->goHome();
	}

	/**
	 * Displays contact page.
	 *
	 * @return mixed
	 */
	public function actionContact()
	{
		$model = new ContactForm();
		if ($model->load(Yii::$app->request->post()) && $model->validate()) {
			if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
				Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
			} else {
				Yii::$app->session->setFlash('error', 'There was an error sending your message.');
			}

			return $this->refresh();
		}

		return $this->render('contact', [
			'model' => $model,
		]);
	}

	public function actionAbout()
	{
		return $this->render('about');
	}

	/**
	 * Signs user up.
	 *
	 * @return mixed
	 */
	public function actionSignup()
	{
		$model = new UserSignupForm;
		$model->on(UserSignupForm::EVENT_BEFORE_VALIDATE, function () use ($model) {
			if (empty($model->username) && !empty($model->email)) {
				$model->username = $model->email;
			}
		});

		if ($this->request->isPost && $model->load(Yii::$app->request->post())) {
			if ($model->submit()) {
				Yii::$app->session->setFlash('saveDone', [
					'timer' => null,
					'text' => 'Thank you for registration. Please check your inbox for verification email.',
				]);
				return $this->goHome();
			}
		}

		$model->password = $model->password_repeat = '';

		return $this->render('signup', get_defined_vars());
	}

	/**
	 * Requests password reset.
	 *
	 * @return mixed
	 */
	public function actionResetPasswordSendmail()
	{
		$model = new UserResetPasswordSendmail;
		if ($this->request->isPost && $model->load(Yii::$app->request->post())) {
			if ($model->submit()) {
				Yii::$app->session->setFlash('saveDone', [
					'timer' => null,
					'text' => 'Check your email for further instructions.',
				]);
				return $this->goHome();
			}
			Yii::$app->session->setFlash('saveFail', 'Sorry, we are unable to reset password for the provided email address.');
		}

		return $this->render('reset-password-sendmail', [
			'model' => $model,
		]);
	}

	/**
	 * Resets password.
	 *
	 * @param string $token
	 * @return mixed
	 */
	public function actionResetPassword($token)
	{
		$model = new UserResetPassword($token);

		if ($model->load(Yii::$app->request->post())) {
			if ($model->submit()) {
				Yii::$app->session->setFlash('success', 'New password saved.');
				return $this->goHome();
			}

			Yii::$app->session->setFlash('saveFail', ArrayHelper::flatJoin($model->errors));
		}

		return $this->render('resetPassword', [
			'model' => $model,
		]);
	}

	public function actionVerifySignup($token)
	{
		$model = new UserSignupVerify($token);

		if (($userModel = $model->submit()) && Yii::$app->user->login($userModel)) {
			Yii::$app->session->setFlash('saveDone', [
				'timer' => null,
				'text' => 'Your email has been confirmed!',
			]);
		}

		if (!empty($model->errors)) {
			Yii::$app->session->setFlash('saveFail', ArrayHelper::flatJoin($model->errors));
		}

		return $this->goHome();
	}

	public function actionVerifySignupResend()
	{
		$model = new UserSignupVerifyResend;
		if ($model->load(Yii::$app->request->post())) {
			if ($model->submit()) {
				Yii::$app->session->setFlash('saveDone', [
					'timer' => null,
					'text' => 'Check your email for further instructions.',
				]);
				return $this->goHome();
			}

			Yii::$app->session->setFlash('saveFail', ArrayHelper::flatJoin($model->errors));
		}

		return $this->render('verify-signup-resend', get_defined_vars());
	}
}
