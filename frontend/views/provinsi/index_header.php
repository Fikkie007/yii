<?php

use kartik\form\ActiveForm;
use yii\helpers\Html;
?>
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
    <div>
        <?php $form = ActiveForm::begin([
            'action' => ['index'],
            'method' => 'get',
            'options' => ['class' => 'form-inline']
        ]); ?>

        <?= Html::input('search', 'search', $searchModel->search, [
            'class' => 'mr-sm-2 form-control',
            'placeholder' => 'Pencarian ...',
        ]) ?>

        <?php ActiveForm::end(); ?>
    </div>
</div>