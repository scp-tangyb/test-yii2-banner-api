<?php
/**
 * Created by PhpStorm.
 * User: jiaziying
 * Date: 2019-07-08
 * Time: 10:31
 */

namespace jzy\controller;


use jzy\model\banner\BannerListForm;
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

       return (new BannerListForm())->getList();
    }
}