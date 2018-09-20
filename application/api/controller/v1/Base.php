<?php
/**
 * Created by PhpStorm.
 * User: yuanchao
 * Date: 2018/9/20
 * Time: 9:40
 */

namespace app\api\controller\v1;


use app\api\service\UserToken as UserTokenService;
use app\lib\exception\ForbiddenException;
use app\lib\exception\TokenException;
use think\Controller;

class Base extends Controller
{

    /**
     * 前置方法 检查权限
     * @return bool
     * @throws ForbiddenException
     * @throws TokenException
     * @throws \think\Exception
     */
    protected function checkPrimaryScope()
    {
        return UserTokenService::needPrimaryScope();
    }

    /**
     * 前置方法 检查权限
     * @return bool
     * @throws ForbiddenException
     * @throws TokenException
     * @throws \think\Exception
     */
    protected function checkExclusiveScope()
    {
        return UserTokenService::needExclusiveScope();
    }
}