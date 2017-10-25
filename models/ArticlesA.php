<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "articles_a".
 *
 * @property integer $id
 * @property string $title_en
 * @property string $title_es
 */
class ArticlesA extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'articles_a';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['title_en', 'title_es'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title_en' => 'Title En',
            'title_es' => 'Title Es',
        ];
    }
}
