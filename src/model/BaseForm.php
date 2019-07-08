<?php
/**
 * Created by PhpStorm.
 * User: en
 * Date: 2018/9/7
 * Time: 10:11
 */

namespace jzy\model;

use jzy\exception\BaseException;
use jzy\helper\ErrorHelper;
use Yii;
use yii\base\Model;

class BaseForm extends Model
{
    public $storage_url;

    public function init()
    {
        $requestData = Yii::$app->request->isPost ? Yii::$app->request->post() : Yii::$app->request->get();
        $this->setAttributes($requestData);
        $this->validate();
        $this->storage_url = Yii::$app->params['storage_url'];
        parent::init();
    }

    public function addError($attribute, $error = '')
    {
        if (!empty(ErrorHelper::$errorMap[$error])) {
            throw new BaseException($error, '', $attribute);
        }
        throw new BaseException(ErrorHelper::SYS_ERROR, $error);
    }

}
