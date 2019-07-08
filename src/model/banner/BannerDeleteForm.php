<?php
/**
 * Created by PhpStorm.
 * User: jiaziying
 * Date: 2019-06-25
 * Time: 18:05
 */

namespace backend\models\banner;


use common\components\form\BackendBaseForm;
use common\exception\BussinessException;
use common\helper\ErrorHelper;
use common\models\ZwBanner;

class BannerDeleteForm extends BackendBaseForm
{
    public $id;

    public function rules()
    {
        return [
            [['id'], 'required', 'message' => ErrorHelper::PARAMETER_LACK_ERROR],
        ];
    }


    public function getDelete(){

        $data = ZwBanner::findOne(['id'=>$this->id]);
        if($data->status == ZwBanner::STATUS_Y){
            throw new BussinessException(ErrorHelper::STATUS_Y_ERROR);
        }
        $data->is_delete = ZwBanner::IS_DELETE_Y;
        $data->update_at = time();
        $result = $data->save(false);
        if($result !== false){
            return ;
        }else{
            throw new BussinessException(ErrorHelper::SAVE_ERROR);
        }
    }
}