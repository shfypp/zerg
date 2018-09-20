<?php
/**
 * Created by PhpStorm.
 * User: 22965
 * Date: 2018/9/13
 * Time: 15:58
 */

namespace app\api\controller\v1;


use app\api\validate\TokenGet;
use app\api\service\UserToken as UserService;

class Token
{
    /**
     * @param string $code
     * @return array
     * @throws \app\lib\exception\ParameterException
     * @throws \app\lib\exception\TokenException
     * @throws \app\lib\exception\WeChatException
     * @throws \think\Exception
     */
    public function getToken($code = '')
    {
        (new TokenGet())->goCheck();
        $userService = new UserService($code);
        $token = $userService->getToken();
        return ['token' => $token];
    }
}