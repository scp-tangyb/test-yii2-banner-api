<?php
/**
 * Created by PhpStorm.
 * User: jiaziying
 * Date: 2019-07-08
 * Time: 10:31
 */

namespace jzy\controller;


use backend\banner_api\helper\ApiBackendHelper;
use common\models\ZwBanner;
use yii\web\Controller;

class ApiController extends Controller
{
    public $db;

    public function actionTest()
    {
        echo 'hello world';
        exit;
    }

    /**
     * 列表接口
     */
    public function actionList()
    {

        ZwBanner::setDb($this->db);
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
        foreach ($data as &$value) {
            $value = ApiBackendHelper::bannerGetList($value);
        }
        $ajaxReturn['total'] = $count;
        $ajaxReturn['lists'] = $data;
        return $ajaxReturn;
    }
}