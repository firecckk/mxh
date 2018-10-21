<?php
Class UserManager {
    public $db;

    public function __construct(){
        $this->$db = Env::get_db();
    }

    public function isUserExistById($id){
        $res = $this->$db->getRow("select * from users where user_id=". $id .";");
        if($res == null){return false;}
        return true;
    }

    /**
     * 如果用户存在返回user_id,否则false
     */
    public function isUserExistByOpenId($oid){
        $res = $this->$db->getRow("select * from users where open_id=". $oid .";");
        if($res == null){return false;}
        return $res["user_id"];
    }

    public function isUserExistByUnionId(){
        
    }

    /**
     * 返回用户ID
     */
    public function addUser($union_id = 0, $open_id, $name){
        $arr = [
            'union_id' => $union_id,
            'open_id' => $open_id,
            'name' => $name];
        $id = $this->$db->insert("users", $arr);
        return $id;
    }
}
?>