<?php

namespace app\controllers;
use yii2tech\sitemap\File;

class PruebasController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionSitemap()
    {


        $siteMapFile = new File();

        $siteMapFile->writeUrl(['/'], ['priority' => '1', 'changeFrequency' => File::CHECK_FREQUENCY_MONTHLY]);
        $siteMapFile->writeUrl(['site/index'], ['priority' => '0.9']);
        $siteMapFile->writeUrl(['site/about'], ['priority' => '0.8', 'changeFrequency' => File::CHECK_FREQUENCY_WEEKLY]);
        $siteMapFile->writeUrl(['site/signup'], ['priority' => '0.7', 'lastModified' => '2015-05-07']);
        $siteMapFile->writeUrl(['site/contact']);
        
        $siteMapFile->close();

        return $this->render('sitemap');
    }
}
