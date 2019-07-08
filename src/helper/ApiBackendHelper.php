<?php
/**
 * Created by PhpStorm.
 * User: jiaziying
 * Date: 2019-04-28
 * Time: 16:20
 */

namespace jzy\helper;


/**
 * Api输出模型,只用来约束接口输出
 * Class ApiBackHelper
 * @package common\helper
 */
class ApiBackendHelper
{
//    /**
//     * ad 列表
//     * @param $data
//     * @return mixed
//     */
//    public static function adGetList($data)
//    {
//        $url = \Yii::$app->params['aliyun']['oss_url'];
//        $data['img_url'] = $url . $data['img_url'];
//        $data['create_at'] = date('Y-m-d H:i:s', $data['create_at']);
//        return $data;
//    }

    /**
     * banner 列表
     * @param $data
     * @return mixed
     */
    public static function bannerGetList($data)
    {
        $url = \Yii::$app->params['kaoshialiyun'];
        $data['create_at'] = date('Y-m-d H:i:s', $data['create_at']);
        $data['publish_at'] = $data['status'] == 1 ? '未发布' : date('Y-m-d H:i:s', $data['publish_at']);
        $data['image'] = $data['image'] == '' ? '未添加' : $url . $data['image'];
        return $data;
    }

    /**
     * pc - 国防列表
     * @param $data
     * @return array
     */
    public static function countryClassGetList($data)
    {
        $url = \Yii::$app->params['kaoshialiyun'];
        // todo
        $void_url = $url . $data['image_url'];

//        $voids_url = TextHelper::getCoverByVideo($data['void_url']);
        return [
            'id' => $data['id'],
            'image_url' => $void_url,
            'title' => $data['title']
//            'cover'=>$voids_url
        ];
    }

    /**
     * pc - 国防详情
     * @param $data
     * @return array
     */
    public static function countryGetInfo($data)
    {
        $url = \Yii::$app->params['kaoshialiyun'];
//        $void_url = $data['url'] == null ?$url . $data['void_url']:$data['url'];
        return [
            'id' => $data['id'],
            'url' => $data['url'] == null ? '未使用' : $data['url'],
            'void_url' => $data['void_url'] == null ? '未使用' : $data['void_url'],
            'image_url' => $url . $data['image_url'],
            'publish_at' => date('Y-m-d H:i:s', $data['publish_at']),
            'source' => $data['source'],
            'remark' => $data['remark'],
            'title' => $data['title']
        ];
    }

    /**
     * 后台 -新闻列表
     * @param $data
     * @return mixed
     */
    public static function newsGitList($data)
    {
        $data['publish_at'] = $data['status'] == 1 ? '未发布' : date('Y-m-d H:i:s', $data['publish_at']);
        $data['create_at'] = date('Y-m-d H:i:s', $data['create_at']);
        return $data;
    }

    /**
     * 后台 - 广告列表
     * @param $data
     * @return mixed
     */
    public static function advertGetList($data)
    {
        $url = \Yii::$app->params['kaoshialiyun'];
        $data['create_at'] = date('Y-m-d H:i:s', $data['create_at']);
        $data['publish_at'] = $data['status'] == 1 ? '未发布' : date('Y-m-d H:i:s', $data['publish_at']);
        $data['image'] = $data['image'] == '' ? '未添加' : $url . $data['image'];
        return $data;
    }

    /**
     * 后台 -国防小课堂列表
     */
    public static function classGetList($data)
    {
        $data['create_at'] = date('Y-m-d H:i:s', $data['create_at']);
        $data['publish_at'] = $data['status'] == 1 ? '未发布' : date('Y-m-d H:i:s', $data['publish_at']);
        return $data;
    }

    /**
     * pc =banner列表
     */
    public static function pcBannerList($data)
    {
        $url = \Yii::$app->params['kaoshialiyun'];
        $data['image'] = $url . $data['image'];
        return [
            'id' => $data['id'],
            'title' => $data['title'],//标题
            'image' =>$data['image'],//图片地址
            'jump' => $data['jump'],//是否跳转 1 是 2 否
            'jump_id' => $data['jump_id']
        ];
    }


    /**
     * pc =广告列表
     */
    public static function pcAdvertList($data)
    {
        $url = \Yii::$app->params['kaoshialiyun'];
        $data['image'] = $url . $data['image'];
        return $data;
    }

    /**
     * pc --新闻列表
     */
    public static function pcNewsList($data)
    {
        $url = \Yii::$app->params['kaoshialiyun'];
        return [
            'id' => $data['id'],
            'title' => $data['title'],//标题
            'image_url' => $url . $data['image_url'],//图片地址
            'abridge' => $data['abridge']
           ];
    }

    /**
     *后台资讯列表
     *
     */
    public static function informationGitList($data)
    {
        $url = \Yii::$app->params['kaoshialiyun'];
        $data['create_at'] = date('Y-m-d H:i:s', $data['create_at']);
        $data['publish_at'] = $data['status'] == 1 ? '未发布' : date('Y-m-d H:i:s', $data['publish_at']);
        $data['image_url'] = $url . $data['image_url'];
        return $data;
    }

    /**
     * 后台 赛区列表
     * @param $data
     * @return mixed
     */
    public static function partGitList($data)
    {
        $data['create_at'] = date('Y-m-d H:i:s', $data['create_at']);
        return $data;
    }


    public static function teacherGetList($data, $school)
    {

        return [

        ];
    }

}