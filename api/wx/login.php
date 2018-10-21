<?php
require_once __DIR__ . "/../../Env.php";
include_once "wxBizDataCrypt.php";

switch ($_GET['type']) {
    case code:
        loginByCode($_GET['code'], $_GET['encrypteddata'], $_GET['iv']);
        break;
    case session:
        loginBySession($_GET['session']);
        break;
}
/**
 * Login By Code
 * 
 */
function loginByCode($code, $encryptedData, $iv)
{
    //获取Session_key 和 open_id
    $info = getInfoFromWXServer(configs::$APPID, configs::$APPSECRET, configs::$code);
    $json = json_decode($info);
    $arr = get_object_vars($json);
    if (!array_key_exists("openid", $arr)) {
        die($info);
    }
    $openid = $arr['openid'];
    $session_key = $arr['session_key'];
    $nick_name;

    $return_msg = [];

    //解密encryptData 得到 union_id
    $pc = new WXBizDataCrypt($appid, $sessionKey);
    $errCode = $pc->decryptData($encryptedData, $iv, $data);
    if ($errCode == 0) {
        print($data . "\n");
        $j = json_decode($data);
        $a = get_object_vars($json);
        $nick_name = $a["nickName"];
    } else {
        print($errCode . "\n");
    }
    
    //查看用户是否存在
    $um = Env::get_um();
    $userid = $um->isUserExistByOpenId($openid);
    if ($userid == false) {
        //注册用户
        $userid = $um->addUser(0, $openid, $nick_name);
        $return_msg["userType"] = "new";
    } else {
        $return_msg["userType"] = "old";
    }

    //生成新session
    $sm = Env::get_sm();
    $mysession = $sm->generateMySession($userid);
    $return_msg["mySession"] = $mysession;

    //返回json
    echo (json_encode($return_msg));
}

/**
 * Login By Session
 * 
 */
function loginBySession($session)
{
    $um = Env::get_um();
    $sm = Env::get_sm();
    $return_msg = [];

    $ck = $sm->checkSession();
    if ($ck == "expired") {
        $return_msg["status"] = "expired session";
    } else if ($ck == "invalid") {
        $return_msg["status"] = "invalid session";
    } else {
        if ($um->isUserExistById($ck) == false) {
            $return_msg["status"] = "user does not exist";
        } else {
            $return_msg["status"] = "ok";
        }
    }
    echo $APPID;
}

function getInfoFromWXServer($appid, $appsecret, $code)
{
    $url = 'https://api.weixin.qq.com/sns/jscode2session?appid=' . $appid . '&secret=' . $appsecret . '&js_code=' . $code . '&grant_type=authorization_code';
    $curl = curl_init();
    // 使用curl_setopt()设置要获取的URL地址
    curl_setopt($curl, CURLOPT_URL, $url);
    // 设置是否输出header
    curl_setopt($curl, CURLOPT_HEADER, false);
    // 设置是否输出结果
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    // 设置是否检查服务器端的证书
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    // 使用curl_exec()将CURL返回的结果转换成正常数据并保存到一个变量
    $data = curl_exec($curl);
    // 使用 curl_close() 关闭CURL会话
    curl_close($curl);
    return $data;
}


?>