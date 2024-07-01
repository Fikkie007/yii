<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;
?>

<?= $this->render('index_header', get_defined_vars()); ?>

<?php Pjax::begin(['options' => ['class' => 'card card-sticky']]) ?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        [
            'class' => jeemce\grid\SerialColumn::class
        ],
        'name',
        'provinsi.name',
        [
            'class' => \jeemce\grid\ActionColumn::class,
            'buttons' => [
                'form' => [
                    'icon' => '<i class="bi bi-pencil"></i>',
                    'options' => ['onclick' => 'modalFormAjax(this,event)', 'data-pjax' => 0],
                ],
            ],
        ],
    ],
]) ?>
<?php \yii\widgets\Pjax::end() ?>

<?= Html::a('Laporan', ['laporan'], ['class' => 'd-flex justify-content-end']) ?>