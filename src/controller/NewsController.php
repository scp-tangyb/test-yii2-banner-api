<?php
/**
 * Created by PhpStorm.
 * User: jiaziying
 * Date: 2019-06-26
 * Time: 15:55
 */

namespace backend\controllers;


use jzy\model\news\NewsAddForm;
use jzy\model\news\NewsDeleteForm;
use jzy\model\news\NewsInfoForm;
use jzy\model\news\NewsListForm;
use jzy\model\news\NewsStatusForm;
use jzy\model\news\NewsUpdateForm;
use yii\web\Controller;

class NewsController extends Controller
{
    /**
     * 列表接口
     */
    public function actionList(){
        return (new NewsListForm())->getList();
    }

    /**
     * 详情接口
     */
    public function actionInfo(){
        return (new NewsInfoForm())->getInfo();
    }

    /**
     * 删除接口
     */
    public function actionDelete(){
        return (new NewsDeleteForm())->getDelete();
    }

    /**
     * 上下架接口
     */
    public function actionStatus(){
        return (new NewsStatusForm())->getStatus();
    }

    /**
     * 添加接口
     */
    public function actionAdd(){
        return (new NewsAddForm())->getAdd();
    }

    /**
     * 修改接口
     */
    public function actionUpdate(){
        return (new NewsUpdateForm())->getUpdate();
    }
}