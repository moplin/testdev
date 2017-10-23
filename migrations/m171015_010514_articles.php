<?php

use yii\db\Migration;

class m171015_010514_articles extends Migration
{
    public function safeUp()
    {
        $this->createTable('articles', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'content' => $this->text(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('articles');

    }
}
