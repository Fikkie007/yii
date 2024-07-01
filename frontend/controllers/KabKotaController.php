<?php

namespace frontend\controllers;

use frontend\models\KabKota;
use frontend\models\Provinsi;
use jeemce\controllers\AppCrudTrait;
use jeemce\helpers\ArrayHelper;
use kartik\form\ActiveForm;
use Yii;
use yii\base\DynamicModel;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;

/**
 * {@inheritdoc}
 */
class KabKotaController extends  \jeemce\controllers\SiteController
{

    use AppCrudTrait;

    private $modelClass = KabKota::class;

    /**
     * Displays Kabupaten and Kota.
     *
     * @return mixed
     */

    public function actionIndex()
    {
        $searchModel = new DynamicModel(array_merge([
            'search',
            'filter' => [
                'province_id' => null,
            ]
        ], $this->request->queryParams));

        $searchQuery = $this->modelClass::find()
            ->joinWith('provinsi')
            ->andFilterWhere($searchModel->filter)
            ->andFilterWhere([
                'or',
                ['LOWER(reg_regencies.name)' => strtolower($searchModel->search)],
                ['LOWER(reg_provinces.name)' => strtolower($searchModel->search)],
            ]);

        $dataProvider = new ActiveDataProvider([
            'query' => $searchQuery,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('index', get_defined_vars());
    }

    public function actionLaporan()
    {
        $searchModel = new DynamicModel(array_merge([
            'search',
            'filter' => [
                'province_id' => null,
            ]
        ], $this->request->queryParams));

        $searchQuery = $this->modelClass::find()
            ->joinWith('provinsi')
            ->andFilterWhere($searchModel->filter)
            ->andFilterWhere([
                'or',
                ['LOWER(reg_regencies.name)' => strtolower($searchModel->search)],
                ['LOWER(reg_provinces.name)' => strtolower($searchModel->search)],
            ]);

        $dataProvider = new ActiveDataProvider([
            'query' => $searchQuery,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('laporan', get_defined_vars());
    }

    public function actionExcel()
    {
        $searchModel = new DynamicModel(array_merge([
            'search',
            'filter' => [
                'province_id' => null,
            ]
        ], $this->request->queryParams));

        $searchQuery = $this->modelClass::find()
            ->joinWith('provinsi')
            ->andFilterWhere($searchModel->filter)
            ->andFilterWhere([
                'or',
                ['LOWER(reg_regencies.name)' => strtolower($searchModel->search)],
                ['LOWER(reg_provinces.name)' => strtolower($searchModel->search)],
            ]);

        $models = $searchQuery->all();

        return $this->render(
            'excel.php',
            get_defined_vars()
        );
    }

    public function actionForm($id = null)
    {
        if (isset($id)) {
            $model = $this->modelClass::findOne($id);
        } else {
            $model = new $this->modelClass;
            $total = $this->modelClass::find()->count();
            $model->id = $total + 1;
        }

        if ($this->request->isPost) {
            $model->load($this->request->post());

            if ($this->request->isAjax) {
                return $this->asJson(ActiveForm::validate($model));
            }

            if (!$model->save()) {
                Yii::$app->session->setFlash('saveFail', implode(PHP_EOL, ArrayHelper::flat($model->errors)));
            }

            Yii::$app->session->setFlash('saveDone', 'Data berhasil disimpan.');
            return $this->redirect(Url::current(['index']));
        }

        return $this->renderAjaxAny([
            'form.php',
        ], get_defined_vars());
    }

    protected function findModel($params)
    {
        if (($model = $this->modelClass::findOne($params))) return $model;
        throw new NotFoundHttpException(Yii::t('yii', 'Page not found.'));
    }
}
