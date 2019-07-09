<?php
/**
 * Created by PhpStorm.
 * User: jiaziying
 * Date: 2019-07-08
 * Time: 10:31
 */

namespace jzy\controller;


use jzy\model\banner\BannerAddForm;
use jzy\model\banner\BannerDeleteForm;
use jzy\model\banner\BannerInfoForm;
use jzy\model\banner\BannerListForm;
use jzy\model\banner\BannerStatusForm;
use jzy\model\banner\BannerUpdateForm;
use yii\web\Controller;

class BannerController extends Controller
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


    /**
     * 详情接口
     */
    public function actionInfo()
    {
        return (new BannerInfoForm())->getInfo();
    }

    /**
     * 添加接口
     */
    public function actionAdd()
    {
        return (new BannerAddForm())->getAdd();
    }

    /**
     * 修改接口
     */
    public function actionUpdate()
    {
        return (new BannerUpdateForm())->getUpdate();
    }

    /**
     * 删除接口
     */
    public function actionDelete()
    {
        return (new BannerDeleteForm())->getDelete();
    }

    /**
     * 上下架接口
     *
     */
    public function actionStatus(){
        return (new BannerStatusForm())->getStatus();
    }
}