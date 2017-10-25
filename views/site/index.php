<?php
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="body-content">
    <?php


    Modal::begin([
        'header' => false,
        'id' => 'modal',
        'size' => 'modal-md'
    ]);
        echo "<div id='modalContent'>";
        echo "</div>";
    Modal::end();

?>

<div class="company-form">
<p>
<?php //Html::button('<i class="glyphicon glyphicon-plus"></i> LOGINMODAL', [
    //'value' => Url::to('site/login'), 
    ////'class' => 'btn btn-add-al', 
    //'id' => 'modalButton']) ?></p>

<br>
<br>
<br>

<script>
    $( document ).ready(function() {
        console.log( "ready!" );
        $(function () {
            $('#modalButton').click(function () {
                $('#modal').modal('show')
                    .find('#modalContent')
                    .load($(this).attr('value'));
            });
        });
    });
</script>

    </div>
</div>
