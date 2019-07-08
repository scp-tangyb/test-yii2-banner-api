<?php

namespace  jzy\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "zw_banner".
 *
 * @property int $id
 * @property string $title 标题
 * @property string $image 图片地址
 * @property int $sort 排序
 * @property int $type banner位置
 * @property int $jump 是否跳转 1 是 2 否
 * @property string $jump_id 跳转id
 * @property int $status 发布状态 1未发布 2已发布
 * @property int $create_at
 * @property int $update_at
 * @property int $publish_at 发布时间
 * @property int $is_delete 是否删除 1 未删除 2已删除
 */
class ZwBanner extends ActiveRecord
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
        return 'zw_banner';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sort', 'type', 'jump', 'create_at', 'update_at', 'publish_at'], 'required'],
            [['sort', 'type', 'jump', 'status', 'create_at', 'update_at', 'publish_at', 'is_delete'], 'integer'],
            [['title'], 'string', 'max' => 30],
            [['image'], 'string', 'max' => 200],
            [['jump_id'], 'string', 'max' => 20],
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
            'image' => 'Image',
            'sort' => 'Sort',
            'type' => 'Type',
            'jump' => 'Jump',
            'jump_id' => 'Jump ID',
            'status' => 'Status',
            'create_at' => 'Create At',
            'update_at' => 'Update At',
            'publish_at' => 'Publish At',
            'is_delete' => 'Is Delete',
        ];
    }
}
