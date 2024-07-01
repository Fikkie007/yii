<?php

use kartik\form\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

?>
<div class="d-flex justify-content-between mb-3">
    <div>
        <?= Html::a('Export', [Url::to('excel')]) ?>
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