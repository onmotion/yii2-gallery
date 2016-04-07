<?php

namespace onmotion\gallery\models;

use yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "g_gallery".
 *
 * @property string $gallery_id
 * @property string $name
 * @property string $descr
 * @property string $date
 */
class Gallery extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'g_gallery';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descr'], 'string'],
            [['date'], 'safe'],
            [['name'], 'required'],
            [['name'], 'string', 'max' => 30],
            [['name'], 'unique', 'message' => 'Галерея с таким именем уже существует.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'gallery_id' => 'ID',
            'name' => 'Gallery name',
            'descr' => 'Description',
            'date' => 'Date',
        ];
    }
    public function getGalleryPhotos()
    {
        return $this->hasMany(GalleryPhoto::className(), ['gallery_id' => 'gallery_id'])->limit(4);
    }
}
