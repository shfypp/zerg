<?php
/**
 * Created by PhpStorm.
 * User: 22965
 * Date: 2018/9/13
 * Time: 16:09
 */

namespace app\api\model;


class User extends Base
{
    protected $hidden=['delete_time','update_time','create_time'];

    public function address()
    {
        return $this->hasOne('UserAddress', 'user_id', 'id');
    }
}