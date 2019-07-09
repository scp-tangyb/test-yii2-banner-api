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


class NewsUpdateForm extends BaseForm
{
    public $id;
    public $title;
    public $content;
    public $abridge;
    public $source;
    public $image_url;


    public function rules()
    {
        return [
            [['title','content','id','abridge','source','image_url'], 'required', 'message' => ErrorHelper::PARAMETER_LACK_ERROR],
        ];
    }

    public function getUpdate()
    {

        $data = News::findOne(['id'=>$this->id]);
        if($data->status == News::STATUS_Y){
            throw new BaseException(ErrorHelper::STATUS_Y_ERROR);
        }
        $data->title = $this->title;
        $data->content = $this->content;
        $data->abridge = $this->abridge;
        $data->image_url = $this->image_url;
        $data->source = $this->source;
        $data->update_at = time();
        $result = $data->save(false);
        if($result !== false){
            return ;
        }else{
            throw new BaseException(ErrorHelper::SAVE_ERROR);
        }
    }

}