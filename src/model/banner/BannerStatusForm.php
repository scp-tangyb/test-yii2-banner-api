<?php
/**
 * Created by PhpStorm.
 * User: jiaziying
 * Date: 2019-06-25
 * Time: 18:05
 */

namespace backend\models\banner;

use common\components\form\BackendBaseForm;
use common\components\helper\RedisKey;
use common\exception\BussinessException;
use common\helper\ErrorHelper;
use common\models\ZwBanner;

class BannerStatusForm extends BackendBaseForm
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
        $data = ZwBanner::findOne(['id'=>$this->id]);
        if($data->status == ZwBanner::STATUS_N){
            $data->status = ZwBanner::STATUS_Y;
            $data->publish_at = $time;
        }else{
            $data->status = ZwBanner::STATUS_N;
        }
        $data->update_at = $time;
        $result = $data->save(false);
        // 写入reids
        if($data->status == ZwBanner::STATUS_Y){
            self::getValue($data,1);
        }else{
            self::getValue($data,2);
        }

        if($result !== false){
            return ;
        }else{
            throw new BussinessException(ErrorHelper::SAVE_ERROR);
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
            \Yii::$app->redis->hset(RedisKey::build([$key])['key'],$data['id'],$value);
        }else if($type ==2){
            \Yii::$app->redis->hdel(RedisKey::build([$key])['key'],$data['id']);
        }

    }
}