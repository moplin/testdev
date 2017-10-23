<?php
use kartik\widgets\FileInput;
use kartik\widgets\ActiveForm;
use yii\helpers\Url;
use yii\bootstrap\Modal;


?>
<h1>images/index</h1>



<?php
Modal::begin([
    'header'=>'Carga de imágenes',
    'toggleButton' => [
        'label'=>'Cargar imágenes', 'class'=>'btn btn-default'
    ],
]);
$form1 = ActiveForm::begin([
    'options'=>['enctype'=>'multipart/form-data'] // important
]);
        echo FileInput::widget([
            'model' => $model,
            'attribute' => 'imageFiles[]',
            'name' => 'imageFiles[]',
            'options'=>[
                'multiple'=>true
            ],
            'pluginOptions' => [
                'uploadUrl' => Url::to(['/images/upload']),
                'uploadExtraData' => [
                    'album_id' => 20,
                    'cat_id' => 'Nature'
                ],
                'maxFileCount' => 20
            ]
        ]);


?>

<?php

        ActiveForm::end();
        Modal::end();

?>

