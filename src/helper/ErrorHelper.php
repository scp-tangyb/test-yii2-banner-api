<?php

namespace jzy\helper;

class ErrorHelper
{
    // 系统
    const SYS_SUCCESS = 200;  // 成功
    const SYS_ERROR   = 11001;// 系统错误,请稍候重试
    const CONFIG_FILE_NOT_EXIST = 11000;//配置文件不存在
    const CONFIG_NOT_EXIST = 11004;//配置未定义

    // 请求
    const  PARAMETER_NOT_EMPTY     = 21001;// 参数%不能为空
    const  PARAMETER_TYPE_ERROR    = 21002;// 参数%数据类型错误
    const  PARAMETER_LACK_ERROR    = 21003;// 参数%不能为空
    const  PARAMETER_CONTENT_ERROR = 21004;// 参数%内容与规定不符
    const  PARAMETER_TOO_LONG      = 21005;// 参数%超出长度
    const  PARAMETER_NOT_EXIST     = 21006;// 参数%不存在
    const  PARAMETER_EXIST         = 21007;// 无效的%
    const  DELETE_ERROR            = 21008;// 删除失败
    const  SAVE_ERROR              = 21009;// 保存失败
    const  REQUEST_FAILD           = 21010;// 无效的请求
    const  NOT_DATA_EXIST          = 21011;// 数据不存在
    const  APPLY_FOR_FAILURE       = 21013;// 申请失败
    const  DATA_EXIST              = 21014;// 数据已存在
    const  AWARD_ALREADY           = 31013;// 奖励已领取
    const  ORDER_NOT_EXIST         = 31110;// 订单不存在
    const  FEEDBACK_MORE           = 31014;// 反馈频繁
    const  USER_NOT_LOGIN          = 14001;// 用户未登录
    const  LOGIN_FAIL              = 14002;// 登录失败(code无效)
    const  LOGIN_ERROR             = 14007;// 登录失败,请稍后重试
    const  REPEAT_SELECT           = 14008;// 请勿重复选择身份
    const  USER_PHONE_NOT_LEGAL    = 14009;// 手机号格式有误
    const  SMS_USER_LIMIT          = 14010;// 您每天最多只能发送10条短信
    const  SMS_SEND_FAIL           = 14011;// 短信发送失败,请稍后重试
    const  SMS_CODE_ERROR          = 14012;// 验证码错误
    const  REGISTER_ERROR          = 14013;// 注册失败
    const  REGISTER_REGISTER       = 14014;// 请勿重复注册
    const  PHONE_EXIST             = 14015;// 手机号已存在
    const  NOT_BIND_PHONE          = 14016;// 未绑定手机号
    const  USER_BANNED             = 14017;// 用户已封禁
    const  FIND_LIST_ERROR         = 14018;// 查询失败，请重试或联系系统管理员

    const STATUS_Y_ERROR           = 14019;// 已经发布不可修改，请下架后重试
    const ADVERT_SAVE_ERROR        = 14020;// 同一位置只存在一个广告，该位置已占用
    const PART_DELETE_ERROR        = 14021;// 分赛区下有赛区资讯，请清空后重试
    const TEACHER_MARK_ERROR       = 14022;// 该老师此赛区已设置，请更换赛区后重试
    const EXCEL_TYPE_ERROR         = 14023;// 错误的文件格式
    const EXCEL_ADD_ERROR          = 14024;// 导入失败，请稍后重试
    const EXCEL_TEACHER_ERROR      = 14025;// 检测到表中有老师重复设置赛区，组别请检查后重试
    const SOURCE_ERROR             = 14026;// 表中未分配试卷少于设置数量，请调整后重试
    const TEACHER_DELETE_ERROR     = 14027;// 此老师有阅卷设置，请删除后重试
    // 用户
    const USER_NOT_EXIST         = 14003;// 用户不存在
    const USER_PASSWORD_ERROR    = 16002; //密码错误
    /**
     * 获取错误信息
     * @param $code
     * @return mixed|string
     */
    public static function getErrorMessage ($code)
    {

        if(isset(self::$errorMap[$code])){
            \Yii::trace($code);
        }else{
            \Yii::error($code);
        }

        return isset(self::$errorMap[$code]) ? self::$errorMap[$code] : '';
    }

    public static $errorMap
        = [
            self::SYS_SUCCESS => '成功' ,
            self::SYS_ERROR   => '系统错误,请稍候重试' ,
            self::CONFIG_FILE_NOT_EXIST => '配置文件不存在',
            self::CONFIG_NOT_EXIST => '配置未定义',

            self::PARAMETER_NOT_EMPTY     => '参数%不能为空' ,
            self::PARAMETER_LACK_ERROR    => '参数%不能为空' ,
            self::PARAMETER_TYPE_ERROR    => '参数%数据类型错误' ,
            self::PARAMETER_CONTENT_ERROR => '参数%内容与规定不符' ,
            self::SAVE_ERROR              => '保存失败' ,
            self::PARAMETER_TOO_LONG      => '参数%超出长度' ,
            self::PARAMETER_EXIST         => '无效的%' ,
            self::PARAMETER_NOT_EXIST     => '参数%不存在' ,
            self::REQUEST_FAILD           => '无效的请求' ,
            self::NOT_DATA_EXIST          => '数据不存在' ,
            self::APPLY_FOR_FAILURE       => '申请失败' ,
            self::DATA_EXIST              => '数据已存在' ,

            self::USER_NOT_LOGIN       => '用户未登录' ,
            self::LOGIN_FAIL           => '登录失败' ,
            self::USER_PASSWORD_ERROR    => '原密码错误',
            self::USER_NOT_EXIST       => '用户不存在' ,
            self::LOGIN_ERROR          => '登录失败,请稍后重试' ,
            self::REPEAT_SELECT        => '请勿重复选择身份' ,
            self::USER_PHONE_NOT_LEGAL => '手机号格式有误' ,
            self::SMS_USER_LIMIT       => '您每天最多只能发送10条短信' ,
            self::SMS_SEND_FAIL        => '短信发送失败,请稍后重试' ,
            self::SMS_CODE_ERROR       => '验证码错误' ,
            self::REGISTER_ERROR       => '注册失败' ,
            self::REGISTER_REGISTER    => '请勿重复注册' ,
            self::PHONE_EXIST          => '手机号已存在' ,
            self::NOT_BIND_PHONE       => '未绑定手机号' ,
            self::USER_BANNED          => '用户已封禁' ,
            self::FIND_LIST_ERROR      => '查询失败，请重试或联系系统管理员',
            self::STATUS_Y_ERROR       => '已经发布不可修改，请下架后重试',
            self::ADVERT_SAVE_ERROR    => '同一位置只存在一个广告，该位置已占用',
            self::PART_DELETE_ERROR    => '该分赛区下有赛区资讯，请清空后重试',
            self::TEACHER_MARK_ERROR   => '该老师此赛区已设置，请更换赛区后重试',
            self::EXCEL_TYPE_ERROR     => '错误的文件格式',
            self::EXCEL_ADD_ERROR      => '导入失败，请稍后重试',
            self::EXCEL_TEACHER_ERROR  => '检测到表中有老师重复设置赛区，组别请检查后重试',
            self::SOURCE_ERROR         => '表中未分配试卷少于设置数量，请调整后重试',
            self::TEACHER_DELETE_ERROR => '此老师有阅卷设置，请删除后重试',

            self::AWARD_ALREADY   => '奖励已领取' ,
            self::FEEDBACK_MORE   => '反馈频繁' ,
            self::ORDER_NOT_EXIST => '订单不存在' ,
        ];
}