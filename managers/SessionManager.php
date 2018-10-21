<?php
class SessionManager
{
    private $salt;
    function __construct()
    {
        $this->$salt = configs::$SESSION_SALT;
    }

    public function generateMySession($id, $expire_time)
    {
        // base64（过期时.id.md5(salt 过期时间 salt id salt)）
        $res = base64_encode($id . '.' . $expire_time . '.' . md5($this->$salt . $id . $this->$salt . $expire_time . $this->$salt));
        return $res;
    }

    /**
     * 过期返回expired，校验失败返回invalid，否则返回用户ID
     */
    public function checkSession($session){
        $arr = base64_decode($session);
        $arr = explode(".",$arr);
        if(md5($this->$salt . $arr[0] . $this->$salt . $arr[1] . $this->$salt) != $arr[2]){ return "invalid";}
        if(time()>$arr[1]){
            return "expired";
        } else{
            return $arr[0];
        }

    }
}

?>