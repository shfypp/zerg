<?php
/**
 * Created by PhpStorm.
 * User: 22965
 * Date: 2018/9/11
 * Time: 15:39
 */

namespace app\api\model;


use think\Model;

class BannerItem extends Model
{
    protected $visible=['key_word','type','image'];

    public function image(){
        return $this->belongsTo('Image','img_id','id');
    }
}