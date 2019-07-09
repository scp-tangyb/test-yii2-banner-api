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


class BannerUpdateForm extends BaseForm
{
    public $id;
    public $title;
    public $image;
    public $type;
    public $jump;
    public $jump_id;
    public $sort;

    public function rules()
    {
        return [
            [['jump_id'], 'default', 'value' => null],
            [['title','image','type','jump','sort','id'], 'required', 'message' => ErrorHelper::PARAMETER_LACK_ERROR],
        ];
    }

    public function getUpdate(){

        $data = Banner::findOne(['id'=>$this->id]);
        if($data->status == Banner::STATUS_Y){
            throw new BaseException(ErrorHelper::STATUS_Y_ERROR);
        }
        $data->title = $this->title;
        $data->image = $this->image;
        $data->type = $this->type;
        $data->jump = $this->jump;
        if($this->jump_id){
            $data->jump_id = $this->jump_id;
        }
        $data->sort = $this->sort;
        $data->update_at = time();
        $result = $data->save(false);
        if($result !== false){
            return ;
        }else{
            throw new BaseException(ErrorHelper::SAVE_ERROR);
        }
    }
}