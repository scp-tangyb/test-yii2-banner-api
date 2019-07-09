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


class NewsDeleteForm extends BaseForm
{
    public $id;

    public function rules()
    {
        return [
            [['id'], 'required', 'message' => ErrorHelper::PARAMETER_LACK_ERROR],
        ];
    }

    public function getDelete()
    {

        $data = News::findOne(['id'=>$this->id]);
        if($data->status == News::STATUS_Y){
            throw new BaseException(ErrorHelper::STATUS_Y_ERROR);
        }
        $data->is_delete = News::IS_DELETE_Y;
        $data->update_at = time();
        $result = $data->save(false);
        if($result !== false){
            return ;
        }else{
            throw new BaseException(ErrorHelper::SAVE_ERROR);
        }
    }

}