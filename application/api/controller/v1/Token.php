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
    public function getToken($code = '')
    {
        (new TokenGet())->goCheck();
        $userService = new UserService($code);
        $token = $userService->getToken();
        return ['token' => $token];
    }
}