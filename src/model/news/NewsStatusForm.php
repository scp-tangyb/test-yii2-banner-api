<?php
/**
 * Created by PhpStorm.
 * User: jiaziying
 * Date: 2019-06-26
 * Time: 14:25
 */

namespace jzy\model\news;


use jzy\model\BaseForm;
use jzy\exception\BaseException;
use jzy\helper\ErrorHelper;
use jzy\modles\News;


class NewsStatusForm extends BaseForm
{
    public $id;

    public function rules()
    {
        return [
            [['id'], 'required', 'message' => ErrorHelper::PARAMETER_LACK_ERROR],
        ];
    }

    public function getStatus()
    {
        $time = time();
        $data = News::findOne(['id'=>$this->id]);
        if($data->status == News::STATUS_N){
            $data->status =News::STATUS_Y;
            $data->publish_at =$time;
        }else{
            $data->status =News::STATUS_N;
        }
        $data->update_at = $time;
        $result = $data->save(false);
        if($data->status == News::STATUS_Y){
            self::getValue($data,1);
        }else{
            self::getValue($data,2);
        }
        if($result !== false){
            return ;
        }else{
            throw new BaseException(ErrorHelper::SAVE_ERROR);
        }
    }

    public static function getValue($data,$type)
    {
        $url = \Yii::$app->params['kaoshialiyun'];
        $value = [
            'id' => $data['id'],
            'title' => $data['title'],//标题
            'image_url' => $url . $data['image_url'],//图片地址
            'abridge'=>$data['abridge'],
            'content'=>$data['content'],
            'source'=>$data['source'],
            'publish_at'=>$data['publish_at'],
        ];
        $key = 'news_list';
        $key_set = 'news_list_set';
        $value = json_encode($value);
        $redis = \Yii::$app->redis;
        if($type ==1){
            $redis->hset($key,$data['id'],$value);
            $redis->zadd(($key_set,$data['id'],$value);
        }else if($type ==2){
            $redis->hdel($key,$data['id']);
            $redis->zrem($key_set,$value);
        }

    }

}