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


class NewsInfoForm extends BaseForm
{

    public $id;

    public function rules()
    {
        return [
            [['id'], 'required', 'message' => ErrorHelper::PARAMETER_LACK_ERROR],
        ];
    }

    public function getInfo()
    {
        $list = News::find()
            ->select('id,source,image_url,title,abridge,content')
            ->where(['id'=>$this->id])
            ->asArray()
            ->one();
        if ($list !== false) {
            return $list;
        } else {
            throw new BaseException(ErrorHelper::FIND_LIST_ERROR);
        }


    }

}