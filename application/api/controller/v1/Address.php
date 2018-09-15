<?php
/**
 * Created by PhpStorm.
 * User: 22965
 * Date: 2018/9/15
 * Time: 16:03
 */

namespace app\api\controller\v1;


use app\api\model\User as UserModel;
use app\api\service\UserToken as UserTokenService;
use app\api\validate\AddressNew;
use app\lib\exception\SuccessMessage;
use app\lib\exception\UserMissException;

class Address
{
    /**
     * 新增 更新 Address
     * @return SuccessMessage
     * @throws UserMissException
     * @throws \app\lib\exception\ParameterException
     * @throws \app\lib\exception\TokenException
     * @throws \think\Exception
     * @throws \think\exception\DbException
     */
    public function createOrUpdateAddress()
    {
        $addressNew=new AddressNew();
        $addressNew->goCheck();
        //根据用户携带的token获取uid
        $uid = UserTokenService::getCurrentUid();
        //根据uid判断用户是否存在 不存在 抛出异常
        $user = UserModel::get($uid);
        if (!$user) throw new UserMissException();
        //获取客户端提交的地址信息
        $dataArray = $addressNew->getDataByRule(input('post.'));
        //新增或更新地址信息
        if (!$user->address) {
            $user->address()->save($dataArray);
        } else {
            $user->address->save($dataArray);
        }
        return new SuccessMessage();
    }
}