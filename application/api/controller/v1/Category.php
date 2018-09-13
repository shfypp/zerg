<?php
/**
 * Created by PhpStorm.
 * User: 22965
 * Date: 2018/9/13
 * Time: 10:58
 */

namespace app\api\controller\v1;

use app\api\model\Category as CategoryModel;
use app\lib\exception\CategoryMissException;

class Category
{
    public function getAllCategories(){
        $categories=CategoryModel::all([],'topicImg');
        if (!$categories) throw new CategoryMissException();
        return $categories;
    }

}