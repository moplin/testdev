<?php


use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\Url;
use yii\bootstrap\Modal;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>

    <link href="/js/nailthumb/jquery.nailthumb.1.1.css" type="text/css" rel="stylesheet" />
    <style type="text/css" media="screen">
        .square-thumb {
            width: 150px;
            height: 150px;
        }
        .btn-fix {
            color: white !important;
            padding: 13px 12px !important;
            text-decoration: none !important;
        }
        .btn-fix:hover {
            color: yellow !important;
        }
    </style>
    <?php $this->head() ?>

</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'My Company',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Home', 'url' => ['/site/index']],
            ['label' => 'About', 'url' => ['/site/about']],
            ['label' => 'Contact', 'url' => ['/site/contact']],
            Yii::$app->user->isGuest ? (
                //['label' => 'Login', 'url' => ['/site/login']]

                '<li>'. Html::button('Login', [
                    'value' => '/site/login', 
                    'class' => 'btn btn-link btn-fix', 
                    'id' => 'modalButton']) .'</li>'

            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>

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

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
<script type="text/javascript" src="/js/nailthumb/jquery.nailthumb.1.1.js"></script>
<script type="text/javascript">
        jQuery(document).ready(function() {
            jQuery('.nailthumb-container').nailthumb();
        });
    </script>

</body>
</html>
<?php $this->endPage() ?>
