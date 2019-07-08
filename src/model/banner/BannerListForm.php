<?php
/**
 * Created by PhpStorm.
 * User: jiaziying
 * Date: 2019-06-25
 * Time: 18:05
 */

namespace jzy\models\banner;


use jzy\helper\ApiBackendHelper;
use jzy\model\BaseForm;
use jzy\exception\BaseException;
use jzy\helper\ErrorHelper;
use jzy\models\ZwBanner;


class BannerListForm extends BaseForm
{
    public $page = 1;
    public $page_size = 10;

    public function rules()
    {
        return [
            [['page', 'page_size'], 'required', 'message' => ErrorHelper::PARAMETER_LACK_ERROR],
        ];
    }

    public function getList()
    {
        $offset = ($this->page - 1) * $this->page_size;
        $list = ZwBanner::find()
            ->select('id,title,image,sort,type,jump,jump_id,status,create_at,publish_at')
            ->where(['is_delete' => ZwBanner::IS_DELETE_N]);
        $count = $list->count();
        $data = $list->offset($offset)
            ->limit($this->page_size)
            ->orderBy('id desc')
            ->asArray()
            ->all();
        if ($list !== false) {
            foreach ($data as &$value){
                $value = ApiBackendHelper::bannerGetList($value);
            }
            $ajaxReturn['total'] = $count;
            $ajaxReturn['lists'] = $data;
            return $ajaxReturn;
        } else {
            throw new BaseException(ErrorHelper::FIND_LIST_ERROR);
        }


    }
}