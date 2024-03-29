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


class BannerDeleteForm extends BaseForm
{
    public $id;

    public function rules()
    {
        return [
            [['id'], 'required', 'message' => ErrorHelper::PARAMETER_LACK_ERROR],
        ];
    }


    public function getDelete(){

        $data = Banner::findOne(['id'=>$this->id]);
        if($data->status == Banner::STATUS_Y){
            throw new BaseException(ErrorHelper::STATUS_Y_ERROR);
        }
        $data->is_delete = Banner::IS_DELETE_Y;
        $data->update_at = time();
        $result = $data->save(false);
        if($result !== false){
            return ;
        }else{
            throw new BaseException(ErrorHelper::SAVE_ERROR);
        }
    }
}