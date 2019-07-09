<?php

namespace jzy\modles;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "zw_news".
 *
 * @property int $id
 * @property string $title 标题
 * @property string $abridge 摘要
 * @property string $content 内容
 * @property string $image_url 图片地址
 * @property string $source 视频来源
 * @property int $status 发布 1未发布 2已发布
 * @property int $create_at
 * @property int $update_at
 * @property int $publish_at
 * @property int $is_delete 是否删除 1未删除 2已删除
 */
class News extends ActiveRecord
{
    //删除
    const IS_DELETE_Y = 2;
    const IS_DELETE_N = 1;

    //发布
    const STATUS_Y = 2;
    const STATUS_N = 1;

    public static $db = 'db';

    public static function setDb($db)
    {
        self::$db = $db;
    }

    public static function getDb()
    {
        return Yii::$app->get(self::$db);
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'zw_news';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['content', 'create_at', 'update_at', 'publish_at'], 'required'],
            [['content'], 'string'],
            [['status', 'create_at', 'update_at', 'publish_at', 'is_delete'], 'integer'],
            [['title'], 'string', 'max' => 50],
            [['abridge'], 'string', 'max' => 100],
            [['image_url'], 'string', 'max' => 200],
            [['source'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'abridge' => 'Abridge',
            'content' => 'Content',
            'image_url' => 'Image Url',
            'source' => 'Source',
            'status' => 'Status',
            'create_at' => 'Create At',
            'update_at' => 'Update At',
            'publish_at' => 'Publish At',
            'is_delete' => 'Is Delete',
        ];
    }
}
