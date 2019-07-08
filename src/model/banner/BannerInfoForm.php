<?php
/**
 * Created by PhpStorm.
 * User: jiaziying
 * Date: 2019-06-25
 * Time: 18:05
 */

namespace jzy\models\banner;


use jzy\model\BaseForm;
use jzy\exception\BaseException;
use jzy\helper\ErrorHelper;
use jzy\models\ZwBanner;

class BannerInfoForm extends BaseForm
{
    public $id;

    public function rules()
    {
        return [
            [['id'], 'required', 'message' => ErrorHelper::PARAMETER_LACK_ERROR],
        ];
    }

    public function getInfo(){
        $list = ZwBanner::find()
            ->select('id,title,image,sort,type,jump,jump_id')
            ->where(['id' => $this->id])
            ->asArray()
            ->one();
        if ($list !== false) {
            return $list;
        } else {
            throw new BaseException(ErrorHelper::FIND_LIST_ERROR);
        }
    }
}