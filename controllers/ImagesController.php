<?php

namespace app\controllers;
use Yii;
use yii\imagine\Image;

use Imagine\Gd;
use Imagine\Image\Box;
use Imagine\Image\BoxInterface;
use yii\base\DynamicModel;
use kartik\widgets\FileInput;
use yii\helpers\Url;
use app\models\UploadForm;
use yii\web\UploadedFile;

class ImagesController extends \yii\web\Controller
{
    public function actionImagine()
    {
        
        $fileName = 'C:\Users\pablo\Dropbox (GoblinTech)\Test Files\imagenes\Funny-Dog-Names-3.jpg';
        $fileName1 = 'C:\Users\pablo\Dropbox (GoblinTech)\Test Files\imagenes\snow-monkey.jpg';

        $fileName2 = 'C:\Users\pablo\Dropbox (GoblinTech)\Test Files\imagenes\test-personalidad.jpg';
        $fileName3 = 'C:\Users\pablo\Dropbox (GoblinTech)\Test Files\imagenes\IMG_1539.JPG';
        $save_path = Yii::getAlias('@app/web/images/');


        $newWidth = 350;
        $newHeight = 250;
        $img1 = Image::getImagine()->open($fileName)->thumbnail(new Box($newWidth, $newHeight));
        $img1->save($save_path.'crop-photo1.jpg', ['quality' => 80]);


        //$img1a = Image::getImagine()->open($fileName)->thumbnail(new Box($newWidth, $newHeight));
        $img1a = Image::getImagine()->open($fileName); 
        $size = $img1a->getSize();

        if ($size->getWidth() < $size->getHeight() ) {
            //Height based
            static::console_log(['1W es <',$size->getWidth(), $size->getHeight()]);
            $tmp_img = Image::resize($fileName, $newHeight, null, true, true)
            ->save(Yii::getAlias(Yii::getAlias('@app/web/images/tmp.jpg')), ['quality' => 80]);

            $tmp_size = $tmp_img->getSize();
            $correction_index = $tmp_size->getHeight() - $newHeight;
            $y_coordinate = $correction_index / 2;
            Image::crop(Yii::getAlias('@app/web/images/tmp.jpg'), $newWidth, $newHeight, [0,$y_coordinate])
            ->save(Yii::getAlias($save_path.'crop-photo1a.jpg'), ['quality' => 80]);

        } else {
            //Width based
            static::console_log(['1W es >',$size->getWidth(), $size->getHeight(), $size->getWidth()/2]);
            $tmp_img = Image::resize($fileName, null, $newWidth, true, true)
            ->save(Yii::getAlias(Yii::getAlias('@app/web/images/tmp.jpg')), ['quality' => 80]);
            $tmp_size = $tmp_img->getSize();
            $correction_index = $tmp_size->getWidth() - $newWidth;
            $x_coordinate = $correction_index / 2;
            Image::crop(Yii::getAlias('@app/web/images/tmp.jpg'), $newWidth, $newHeight, [ $x_coordinate ,0 ])
            ->save(Yii::getAlias($save_path.'crop-photo1a.jpg'), ['quality' => 80]);
        }




        //Ex 2
        $img2 = Image::getImagine()->open($fileName1)->thumbnail(new Box($newWidth, $newHeight));
        $img2->save($save_path.'crop-photo2.jpg', ['quality' => 80]);
        $img_size = 550;

        //$img2a = Image::getImagine()->open($fileName1)->thumbnail(new Box($newWidth, $newHeight));
        $img2a = Image::getImagine()->open($fileName1); 
        $size = $img2a->getSize();

        if ($size->getWidth() < $size->getHeight() ) {
            static::console_log(['1W es <',$size->getWidth(), $size->getHeight()]);
            $tmp_img = Image::resize($fileName1, $newHeight, null, true, true)
            ->save(Yii::getAlias(Yii::getAlias('@app/web/images/tmp.jpg')), ['quality' => 80]);
            $tmp_size = $tmp_img->getSize();
            $correction_index = $tmp_size->getHeight() - $newHeight;
            $y_coordinate = $correction_index / 2;
            Image::crop(Yii::getAlias('@app/web/images/tmp.jpg'), $newWidth, $newHeight, [0,$y_coordinate])
            ->save(Yii::getAlias($save_path.'crop-photo2a.jpg'), ['quality' => 80]);
        } else {
            static::console_log(['1W es >',$size->getWidth(), $size->getHeight(), $size->getWidth()/2]);
            $tmp_img = Image::resize($fileName1, null, $newWidth, true, true)
            ->save(Yii::getAlias(Yii::getAlias('@app/web/images/tmp.jpg')), ['quality' => 80]);
            $tmp_size = $tmp_img->getSize();
            $correction_index = $tmp_size->getWidth() - $newWidth;
            $x_coordinate = $correction_index / 2;
            Image::crop(Yii::getAlias('@app/web/images/tmp.jpg'), $newWidth, $newHeight, [ $x_coordinate ,0 ])
            ->save(Yii::getAlias($save_path.'crop-photo2a.jpg'), ['quality' => 80]);
        }





        return $this->render('imagine');
    }

    public function actionUpload()
    {
        $model = new UploadForm();

        if (Yii::$app->request->isPost) {
            
            $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');
            

                $path = '\images\cex001';
                $newWidth = 800;
                $newHeight = 600;

            if ($model->upload($path, $newWidth, $newHeight)) {
                // file is uploaded successfully
                
                return;
            }
        }

        //return $this->render('index', ['model' => $model]);
    }


    public function actionIndex()
    {
        
        // $model = new \yii\base\DynamicModel([
        //     'img'
        // ]);
        // $model->addRule(['name','email'], 'required')
        //     ->addRule(['email'], 'email')
        //     ->addRule('address', 'string',['max'=>32]);
        $model = new UploadForm();
        $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');

        Yii::warning('$model', var_export($model,true));

        if($model->load(Yii::$app->request->post())){
            // do somenthing with model
            return $this->redirect(['view']);
        }

        return $this->render('index', [
            'model'=>$model
        ]);


    }

    public function actionTest()
    {



        $fileName0 = 'C:\Users\pablo\Dropbox (GoblinTech)\Test Files\imagenes\cex\Logo Sicurezza.png';
        $fileName1 = 'C:\Users\pablo\Dropbox (GoblinTech)\Test Files\imagenes\cex\logo_diacelecjpeg.jpg';

        $fileName2 = 'C:\Users\pablo\Dropbox (GoblinTech)\Test Files\imagenes\cex\LUNAWOOD posterior.jpg';
        $fileName3 = 'C:\Users\pablo\Dropbox (GoblinTech)\Test Files\imagenes\cex\consola2.jpg';
        $fileName3 = 'C:\Users\pablo\Dropbox (GoblinTech)\Test Files\imagenes\cex\espejo2.jpg';


        
        
        $save_path = '/web/images/cex';
        $newWidth = 500;
        $newHeight = 500;
        
        $img1 = static::fixImage($fileName3, $save_path, $newWidth, $newHeight);


        return $this->render('test');
    }

    private static function fixImage($fileName, $path, $newWidth, $newHeight){
        Yii::info('fixImage($data)::', var_export($fileName,true));
        static::console_log(["fixImage():: image: {$fileName}", "path :: {$path}"]);

        $save_path = Yii::getAlias('@app/'.$path);
        $img = Image::getImagine()->open($fileName)->thumbnail(new Box($newWidth, $newHeight));
        
        $img->save($save_path . 'crop-photo1.jpg', ['quality' => 80]);
        
        
        /* $img_size = 550;

        //$img1a = Image::getImagine()->open($fileName)->thumbnail(new Box($newWidth, $newHeight));
        $img1a = Image::getImagine()->open($fileName); 
        $size = $img1a->getSize();

        if ($size->getWidth() < $img_size ) {
            //Height based
            static::console_log(['1W es <',$size->getWidth(), $size->getHeight()]);

            Image::resize($fileName, 650, null, true, true)
            ->save(Yii::getAlias(Yii::getAlias('@app/web/images/tmp.jpg')), ['quality' => 80]);

            Image::crop(Yii::getAlias('@app/web/images/tmp.jpg'), $newWidth, $newHeight, [0,$size->getHeight()/2])
            ->save(Yii::getAlias($save_path.'crop-photo1a.jpg'), ['quality' => 80]);

        } else {
            //Width based
            static::console_log(['1W es >',$size->getWidth(), $size->getHeight(), $size->getWidth()/2]);

            Image::resize($fileName, null, 650, true, true)
            ->save(Yii::getAlias(Yii::getAlias('@app/web/images/tmp.jpg')), ['quality' => 80]);

            Image::crop(Yii::getAlias('@app/web/images/tmp.jpg'), $newWidth, $newHeight, [ $size->getWidth()/2 ,0 ])
            ->save(Yii::getAlias($save_path.'crop-photo1a.jpg'), ['quality' => 80]);
            
        } */



        return "wooba looba";
    }


    public static function console_log( $data ) {
        $output = $data;
        if ( is_array( $output ) )
            $output = implode( ',', $output);
    
        echo "<script>console.log( 'XDebug Objects: " . $output . "' );</script>";
        return '';
    }

}
