<?php

namespace jzy\exception;

use jzy\helper\ErrorHelper;
use yii\web\ErrorHandler;
use Yii;
use yii\web\Response;


class Handle extends ErrorHandler
{
    protected function renderException ($exception)
    {
        if(Yii::$app->has('response')){
            $response          = Yii::$app->getResponse();
            $response->isSent  = false;
            $response->stream  = null;
            $response->data    = null;
            $response->content = null;
        }else{
            $response = new Response();
        }

        if($exception instanceof BaseException){
            $response->statusCode = 200;
            $code                 = $exception->getCode();
        }else{
            $response->setStatusCodeByException($exception);
            $code = 500;
        }

        $msg = $exception->getMessage();
        if(!$msg){
            $msg = str_replace('%' , $exception->getMessage() , ErrorHelper::$errorMap[$code]);
        }

        $response->data = [
            'code' => $code ,
            'msg'  => $msg,
            'data' => new \ArrayObject() ,
        ];
        $response->format = yii\web\Response::FORMAT_JSON;

        $response->send();
    }
}