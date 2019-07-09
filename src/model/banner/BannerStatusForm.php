<?php
/**
 * Created by PhpStorm.
 * User: jiaziying
 * Date: 2019-06-25
 * Time: 18:05
 */

namespace jzy\model\banner;


use jzy\model\BaseForm;
use jzy\exception\BaseException;
use jzy\helper\ErrorHelper;
use jzy\modles\Banner;


class BannerStatusForm extends BaseForm
{
    public $id;

    public function rules()
    {
        return [
            [['id'], 'required', 'message' => ErrorHelper::PARAMETER_LACK_ERROR],
        ];
    }


    public function getStatus(){
        $time = time();
        $data = Banner::findOne(['id'=>$this->id]);
        if($data->status == Banner::STATUS_N){
            $data->status = Banner::STATUS_Y;
            $data->publish_at = $time;
        }else{
            $data->status = Banner::STATUS_N;
        }
        $data->update_at = $time;
        $result = $data->save(false);
        // 写入reids
        if($data->status == Banner::STATUS_Y){
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
            'image' => $url . $data['image'],//图片地址
            'jump' => $data['jump'],//是否跳转 1 是 2 否
            'jump_id' => $data['jump_id'],//
            'sort'=>$data['sort']
        ];

        if ($data->type == 1) {
            $key = 'banner_list_home';
        }
        if ($data->type == 2 ) {
            $key = 'banner_list_lesson';
        }
        if ($data->type == 3 ) {
            $key = 'banner_list_pard';
        }

        $value = json_encode($value);
        if($type ==1){
            \Yii::$app->redis->hset($key,$data['id'],$value);
        }else if($type ==2){
            \Yii::$app->redis->hdel($key,$data['id']);
        }

    }
}