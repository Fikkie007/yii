<?php

use yii\grid\GridView;
?>

<?= $this->render('index_header', get_defined_vars()); ?>

<?php \yii\widgets\Pjax::begin(['options' => ['class' => 'card card-sticky']]) ?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        [
            'class' => jeemce\grid\SerialColumn::class
        ],
        'nik',
        'nama',
        'umur',
        'alamat',
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