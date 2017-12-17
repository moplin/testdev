<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "eventos".
 *
 * @property integer $id
 * @property string $titulo
 * @property string $start
 * @property string $end
 */
class Eventos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eventos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['titulo', 'start', 'end'], 'required'],
            [['titulo'], 'string'],
            [['start', 'end'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'titulo' => 'Titulo',
            'start' => 'Start',
            'end' => 'End',
        ];
    }
}
