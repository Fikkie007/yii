<?php

use frontend\models\KabKota;
use frontend\models\Penduduk;
use frontend\models\Provinsi;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\helpers\Url;

$provinsiOptions = Provinsi::options('id', 'name');
$kabKotaOptions = KabKota::options('id', 'name');
?>


<?php $form = ActiveForm::begin(['id' => 'form-elem']) ?>

<div class="modal-header">
    <h5 class="modal-title">Form</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<div class="modal-body">
    <div class="row">
        <div class="col">
            <?= $form->field($model, 'nik')->input('number') ?>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <?= $form->field($model, 'nama')->textInput() ?>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <?= $form->field($model, 'alamat')->textInput() ?>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <?= $form->field($model, 'tanggal_lahir')->input('date') ?>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <?= $form->field($model, 'gender')->dropDownList(Penduduk::genderOpts) ?>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <?= $form->field($model, 'province_id')->widget(Select2::className(), [
                'data' => $provinsiOptions
            ]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <?= $form->field($model, 'regency_id')->widget(Select2::className(), [
                'data' => $kabKotaOptions
            ]) ?>
        </div>
    </div>

</div>

<div class="modal-footer">
    <?= Html::resetButton('Batal', ['form', 'class' => 'btn btn-secondary', 'data-bs-dismiss' => 'modal']) ?>
    <?= Html::submitButton('Simpan', ['form', 'class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end() ?>