<?php
/**
 * Created by PhpStorm.
 * User: jiaziying
 * Date: 2019-06-26
 * Time: 16:25
 */

namespace jzy\model\news;


use jzy\model\BaseForm;
use jzy\exception\BaseException;
use jzy\helper\ErrorHelper;
use jzy\modles\News;
use jzy\helper\ApiBackendHelper;

class NewsListForm extends BaseForm
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
        $list = News::find()
            ->select('id,title,content,source,create_at,publish_at,status')
            ->where(['is_delete' => News::IS_DELETE_N]);
        $count = $list->count();
        $data = $list->offset($offset)
            ->limit($this->page_size)
            ->orderBy('id desc')
            ->asArray()
            ->all();
        if ($list !== false) {
            foreach ($data as &$value){
                $value = ApiBackendHelper::newsGitList($value);
            }
            $ajaxReturn['total'] = $count;
            $ajaxReturn['lists'] = $data;
            return $ajaxReturn;
        } else {
            throw new BaseException(ErrorHelper::FIND_LIST_ERROR);
        }


    }

}