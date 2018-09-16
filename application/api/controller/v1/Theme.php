<?php
/**
 * Created by PhpStorm.
 * User: 22965
 * Date: 2018/9/12
 * Time: 12:05
 */

namespace app\api\controller\v1;


use app\api\model\Theme as ThemeModel;
use app\api\validate\IDCollection;
use app\api\validate\IDMustBePositiveInt;
use app\lib\exception\ThemeMissException;

class Theme
{

    /**
     * 获取Theme简单列表
     * url /theme?ids=1,2,3,...
     * @param string $ids
     * @return ThemeModel[]|false
     * @throws ThemeMissException
     * @throws \app\lib\exception\ParameterException
     * @throws \think\exception\DbException
     */
    public function getSimpleList($ids = '')
    {
        (new IDCollection())->goCheck();
        $ids = explode(',', $ids);

        $themes = ThemeModel::all($ids, 'topic_img,head_img,products.img', false);
        if (!$themes) throw new ThemeMissException();
        return $themes;
    }

    /**
     * 获取Theme详情
     * @param $id
     * @return ThemeModel
     * @throws ThemeMissException
     * @throws \app\lib\exception\ParameterException
     * @throws \think\exception\DbException
     */
    public function getComplexOne($id){
        (new IDMustBePositiveInt())->goCheck();
        $theme = ThemeModel::get($id, 'topic_img,head_img,products.img', false);
        if (!$theme) throw new ThemeMissException();
        return $theme;
    }
}