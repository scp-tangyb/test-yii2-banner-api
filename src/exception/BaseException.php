<?php
/**
 * Created by PhpStorm.
 * User: yiyz
 * Date: 2018/2/26
 * Time: 上午11:59
 */

namespace jzy\exception;

use jzy\helper\ErrorHelper;
use yii\base\Exception;
use Throwable;

class BaseException extends Exception
{
    public function __construct ($code = 0 , $message = '' , $attribute = "" , Throwable $previous = null)
    {
        if($attribute){
            $message = str_replace('%' , $attribute , ErrorHelper::$errorMap[$code]);
        }
        parent::__construct($message , $code , $previous);

    }
}