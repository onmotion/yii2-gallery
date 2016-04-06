<?php

use yii\db\Migration;
use yii\db\Schema;

class m160406_120743_onmotion_yii2_gallery extends Migration
{
    public function up()
    {
        $this->createTable('g_gallery', [
            'gallery_id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . '(50) NOT NULL',
            'descr' => Schema::TYPE_TEXT,
            'date' => Schema::TYPE_DATETIME,
        ]);
        $this->createTable('g_photo', [
            'photo_id' => Schema::TYPE_PK,
            'gallery_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'name' => Schema::TYPE_STRING . '(255) NOT NULL',
        ]);
    }

    public function down()
    {
        $this->dropTable('g_gallery');
        $this->dropTable('g_photo');
    }

}
