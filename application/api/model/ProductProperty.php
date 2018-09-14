<?php
/**
 * Created by PhpStorm.
 * User: 22965
 * Date: 2018/9/12
 * Time: 12:04
 */

namespace app\api\model;


class ProductProperty extends Base
{
    protected $hidden = ['delete_time', 'update_time', 'product_id'];
}