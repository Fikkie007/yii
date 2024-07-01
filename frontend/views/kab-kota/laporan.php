<?php

use yii\grid\GridView;
?>

<?= $this->render('laporan_header', get_defined_vars()); ?>

<?php \yii\widgets\Pjax::begin(['options' => ['class' => 'card card-sticky']]) ?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        [
            'class' => jeemce\grid\SerialColumn::class
        ],
        'name',
        'totalPenduduk'
    ],
]) ?>
<?php \yii\widgets\Pjax::end() ?>