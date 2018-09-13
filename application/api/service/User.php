<?php
/**
 * Created by PhpStorm.
 * User: 22965
 * Date: 2018/9/13
 * Time: 16:11
 */

namespace app\api\service;


use app\lib\exception\WeChatException;
use app\api\model\User as UserModel;
class User
{
    protected $code;
    protected $wxAppId;
    protected $wxAppSecret;
    protected $wxLoginUrl;

    function __construct($code)
    {
        $this->code = $code;
        $this->wxAppId = config('wx.app_id');
        $this->wxAppSecret = config('wx.app_secret');
        $this->wxLoginUrl = sprintf(config('wx.login_url'), $this->wxAppId, $this->wxAppSecret, $this->code);
    }

    public function getToken()
    {
        $result = sf_curl_get($this->wxLoginUrl);
        $wxResult = json_decode($result, true);
        if (empty($wxResult)) throw new \Exception('获取session_key及openID时异常，微信内部错误');
        if (array_key_exists('errcode',$wxResult)) throw new WeChatException([
            'msg'=>$wxResult['errmsg'],
            'errorCode'=>$wxResult['errcode'],
        ]);
        return $result;
    }

    private function grantToken($wxResult){
        //获取openId
        //查看数据库该openId是否已存在
        //如果不存在 增加1条user记录
        //生成Token 写入缓存
        //返回Token
        $openid=$wxResult['openid'];
        $user=UserModel::getByOpenId($openid);
        if ($user){
            $uid=$user->id;
        }else{
            $user=UserModel::create(['openid'=>$openid]);
            $uid=$user->id;
        }
    }

}