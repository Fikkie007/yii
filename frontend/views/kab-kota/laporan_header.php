<?php

use frontend\models\Provinsi;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\helpers\Url;

$provinsiOptions = Provinsi::options('id', 'name')
?>
<div class="d-flex justify-content-between mb-3">
    <div>
        <?= Html::a('Export', [Url::to('excel')]) ?>
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