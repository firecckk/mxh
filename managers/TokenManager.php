<?php
/**
 * Useless ... ...
 */
class TokenManager {
    private $salt;
    public function __construct(){
        $this->$salt = configs::$TOKEN_SALT;
    }

    public function generateToken($id, $expire_time){
        $res = base64_encode($id . '.' . $expire_time . '.' . md5( $id . $expire_time . $this->$salt . id));
    }

    /*
    public function checkToken($session){
        $arr = base64_decode($session);
        $arr = explode(".",$arr);
        if(md5($this->$salt . $arr[0] . $this->$salt . $arr[1] . $this->$salt) != $arr[2]){ return "invalid";}
        if(time()>$arr[1]){
            return "expired";
        } else{
            return $arr[0];
        }*/
}
?>