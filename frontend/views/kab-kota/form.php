<?php

use frontend\models\Provinsi;
use kartik\form\ActiveForm;
use yii\helpers\Html;

$provinsiOptions = Provinsi::options('id', 'name');
?>

<?php $form = ActiveForm::begin(['id' => 'form-elem']) ?>

<div class="modal-header">
    <h5 class="modal-title">Form</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<div class="modal-body">
    <div class="row">
        <div class="col">
            <?= $form->field($model, 'name')->textInput() ?>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <?= $form->field($model, 'province_id')->dropDownList($provinsiOptions, ['prompt' => 'Pilih Provinsi']) ?>
        </div>
    </div>
</div>

<div class="modal-footer">
    <?= Html::resetButton('Batal', ['form', 'class' => 'btn btn-secondary', 'data-bs-dismiss' => 'modal']) ?>
    <?= Html::submitButton('Simpan', ['form', 'class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end() ?>