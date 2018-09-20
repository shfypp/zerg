<?php
/**
 * Created by PhpStorm.
 * User: 22965
 * Date: 2018/9/10
 * Time: 17:05
 */

namespace app\api\controller\v1;


use app\api\validate\IDMustBePositiveInt;
use app\api\model\Banner as BannerModel;
use app\lib\exception\BannerMissException;

class Banner
{
    public function index($version)
    {
        return $version . ".Banner/index";
    }

    /**
     * @param $id
     * @return BannerModel
     * @throws BannerMissException
     * @throws \app\lib\exception\ParameterException
     */
    public function getBanner($id)
    {
        (new IDMustBePositiveInt())->goCheck();

        $banner = BannerModel::getBannerById($id);
        if (!$banner) throw new BannerMissException();

        return $banner;
    }
}