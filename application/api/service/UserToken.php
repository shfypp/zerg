<?php
/**
 * Created by PhpStorm.
 * User: 22965
 * Date: 2018/9/13
 * Time: 16:11
 */

namespace app\api\service;


use app\api\model\User as UserModel;
use app\lib\enum\ScopeEnum;
use app\lib\exception\TokenException;
use app\lib\exception\WeChatException;
use think\Exception;

class UserToken extends Token
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

    /**
     * @return string
     * @throws Exception
     * @throws TokenException
     * @throws WeChatException
     */
    public function getToken()
    {
        $result = sf_curl_get($this->wxLoginUrl);
        $wxResult = json_decode($result, true);
        if (empty($wxResult)) throw new Exception('获取session_key及openID时异常，微信内部错误');
        if (array_key_exists('errcode',$wxResult)) throw new WeChatException([
            'msg'=>$wxResult['errmsg'],
            'errorCode'=>$wxResult['errcode'],
        ]);
        $token=$this->grantToken($wxResult);
        return $token;
    }


    /**
     * 获取当前用户的UID
     * @return mixed
     * @throws Exception
     * @throws TokenException
     */
    public static function getCurrentUid(){
        return self::getCurrentTokenValue('uid');
    }

    private function grantToken($wxResult){
        //获取openId
        $openid=$wxResult['openid'];
        //查看数据库该openId是否已存在
        //如果不存在 增加1条user记录
        $user=UserModel::getByOpenid($openid);
        if ($user){
            $uid=$user->id;
        }else{
            $user=UserModel::create(['openid'=>$openid]);
            $uid=$user->id;
        }
        //生成Token 写入缓存
        $token_data=json_encode($this->getTokenData($wxResult,$uid));
        $token_key=self::generateToken();
        $token_expire=config('setting.token_expire');

        $c_result=cache($token_key,$token_data,$token_expire);
        if (!$c_result) throw new TokenException([
            'msg'=>'服务器缓存错误',
            'errorCode'=>10005,
        ]);
        //返回Token
        return $token_key;
    }

    private function getTokenData($wxResult,$uid){
        $catch_data=$wxResult;
        $catch_data['uid']=$uid;
        $catch_data['scope']=ScopeEnum::User;
        return $catch_data;
    }

}