<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;
use yii\imagine\Image;
use Imagine\Gd;
use Imagine\Image\Box;
use Imagine\Image\BoxInterface;


class UploadForm extends Model
{
    /**
     * @var UploadedFile[]
     */
    public $imageFiles;

    public function rules()
    {
        return [
            [['imageFiles'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'maxFiles' => 4],
        ];
    }
    
    public function upload($path, $newWidth, $newHeight)
    {
        if ($this->validate()) { 
            foreach ($this->imageFiles as $file) {

                //preparamos
                $unique_name = uniqid('', true);
                $full_path = Yii::getAlias('@app')."\web".$path;

                //Creamos el directorio si no existe con un archvo limpio
                if (!file_exists($full_path.'/index.html')) {
                    FileHelper::createDirectory($full_path, $mode = 0775, $recursive = true);
                    touch($full_path.'/index.html');
                    $file->saveAs($full_path.'/org_' . $unique_name . '.' . $file->extension);
                }
                
                $file->saveAs($full_path.'/org_' . $unique_name . '.' . $file->extension);
                
                $img = static::fixImage($file, $unique_name.'.'.$file->extension, $full_path, $newWidth, $newHeight);

            }
            return true;
        } else {
            return false;
        }
    }


    private static function fixImage($file, $name, $path, $newWidth, $newHeight){
        
        Yii::warning('fixImage()::$file::', var_export($file,true));
        Yii::warning('fixImage()::$name::', var_export($name,true));

        $img = Image::getImagine()->open($path.'\org_'.$name);
        $size = $img->getSize();


        if ($size->getWidth() <= $size->getHeight() ) {
            //Height based
            Yii::warning('fixImage()::Height based::', var_export($size->getHeight(),true));
            
            Image::resize($path.'\org_'.$name, $newWidth, null, true, true)
            ->save(Yii::getAlias(Yii::getAlias('@app/web/images/tmp/tmp_'.$name)), ['quality' => 80]);

            Image::crop(Yii::getAlias('@app/web/images/tmp/tmp_'.$name), $newWidth, $newHeight, [0,0])
            ->save(Yii::getAlias($path."/".$name), ['quality' => 80]);

        } else {
            //Width based
            Yii::warning('fixImage()::Width based::', var_export($size->getWidth(),true));
            
            Image::resize($path.'\org_'.$name, null, $newHeight, true, true)
            ->save(Yii::getAlias(Yii::getAlias('@app/web/images/tmp/tmp_'.$name)), ['quality' => 80]);

            Image::crop(Yii::getAlias('@app/web/images/tmp/tmp_'.$name), $newWidth, $newHeight, [ 0 ,0 ])
            ->save(Yii::getAlias($path."\\".$name), ['quality' => 80]);
            
        }


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