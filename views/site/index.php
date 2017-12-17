<?php
use yii\widgets\Pjax;

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'My Yii Application';





$events = array();
//Testing
$Event = new \yii2fullcalendar\models\Event();
$Event->id = 1;
$Event->title = 'Testing';
$Event->start = date('Y-m-d\TH:i:s\Z');
$events[] = $Event;

$Event = new \yii2fullcalendar\models\Event();
$Event->id = 2;
$Event->title = 'Wobba Lobba Dub Dub!!';
$Event->start = date('Y-m-d\TH:i:s\Z',strtotime('tomorrow 6am'));
$events[] = $Event;

?>
<div class="site-index">

    <div class="body-content">



<?= \yii2fullcalendar\yii2fullcalendar::widget(array(
    'events'=> $events,
));?>


    </div>


</div>
