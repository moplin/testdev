<?php

use yii\db\Migration;

class m171015_012634_articles extends Migration
{
    public function safeUp()
    {
        $this->createIndex(
            'idx-articles-title',
            'articles',
            'title'
        );
    }

    public function safeDown()
    {
        $this->dropIndexs(
            'idx-articles-title',
            'articles'
        );

    }
}
