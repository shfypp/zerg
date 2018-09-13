<?php
/**
 * Created by PhpStorm.
 * User: 22965
 * Date: 2018/9/12
 * Time: 12:11
 */

namespace app\api\model;


class Category extends Base
{
    protected $hidden=['delete_time','update_time','topic_img_id'];

    public function topicImg(){
        return $this->belongsTo('Image','topic_img_id','id');
    }
}