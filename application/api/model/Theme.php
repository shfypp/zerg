<?php
/**
 * Created by PhpStorm.
 * User: 22965
 * Date: 2018/9/12
 * Time: 12:04
 */

namespace app\api\model;


class Theme extends Base
{
    protected $hidden=['delete_time','update_time','head_img_id','topic_img_id'];

    public function topicImg(){
        return $this->belongsTo('Image','topic_img_id','id');
    }

    public function headImg(){
        return $this->belongsTo('Image','head_img_id','id');
    }

    public function products(){
        return $this->belongsToMany('Product','theme_product','product_id','theme_id');
    }
}