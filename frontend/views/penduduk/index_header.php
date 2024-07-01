<?php

use frontend\models\KabKota;
use frontend\models\Provinsi;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\Html;

$provinsiOptions = Provinsi::options('id', 'name');
$kabKotaOptions = KabKota::options('id', 'name');
?>

<?php $form = ActiveForm::begin([
    'action' => ['index'],
    'method' => 'get',
    // 'options' => ['class' => 'form-inline']
]); ?>

<div class="d-flex justify-content-between mb-3">
    <div>
        <?= Html::a(
            '<i class="bi bi-plus me-1"></i> Tambah Data',
            ['form'],
            [
                'data-pjax' => 0,
                'onclick' => 'modalFormAjax(this,event)',
                'class' => 'btn btn-success',
            ]
        ) ?>
    </div>
    <div class="row g-3 align-items-center">
        <div class="col-12 col-md-4">
            <?= Select2::widget([
                'name' => 'filter[penduduk.province_id]',
                'value' => $searchModel['filter']['penduduk.province_id'] ?? null,
                'data' => $provinsiOptions,
                'options' => [
                    'placeholder' => 'Semua Provinsi',
                    'class' => 'form-select',
                ],
                'pluginOptions' => [
                    'allowClear' => true,
                    'width' => '100%', // Adjust as needed
                ],
                'pluginEvents' => [
                    'change' => "function() { $(this).closest('form').submit(); }",
                ],
            ]); ?>
        </div>
        <div class="col-12 col-md-4">
            <?= Select2::widget([
                'name' => 'filter[penduduk.regency_id]',
                'value' => $searchModel['filter']['penduduk.regency_id'] ?? null,
                'data' => $kabKotaOptions,
                'options' => [
                    'placeholder' => 'Semua Kabupaten dan Kota',
                    'class' => 'form-select',
                ],
                'pluginOptions' => [
                    'allowClear' => true,
                    'width' => '100%', // Adjust as needed
                ],
                'pluginEvents' => [
                    'change' => "function() { $(this).closest('form').submit(); }",
                ],
            ]); ?>
        </div>
        <div class="col-12 col-md-4">
            <?= Html::input('search', 'search', $searchModel->search, [
                'class' => 'mr-sm-2 form-control',
                'placeholder' => 'Pencarian ...',
            ]) ?>
        </div>
    </div>
</div>


<?php ActiveForm::end(); ?>