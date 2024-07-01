<?php

use frontend\models\Provinsi;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\Html;

$provinsiOptions = Provinsi::options('id', 'name')
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
    <div class="row">
        <div class="col-md-6">
            <?= Select2::widget([
                'name' => 'filter[reg_regencies.province_id]',
                'value' => $searchModel['filter']['reg_regencies.province_id'] ?? null,
                'data' => $provinsiOptions,
                'options' => [
                    'placeholder' => 'Semua Provinsi',
                    'class' => 'form-select',
                ],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
                'pluginEvents' => [
                    'change' => "function() { $(this).closest('form').submit(); }",
                ],
            ]); ?>

        </div>
        <div class="col-md-6">

            <?= Html::input('search', 'search', $searchModel->search, [
                'class' => 'mr-sm-2 form-control',
                'placeholder' => 'Pencarian ...',
            ]) ?>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>