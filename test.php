<?php
require_once __DIR__ . "/Env.php";
Class test{
    function __construct()
    {
        $um = Env::get_um();
        $res = $um->isUserExistByOpenId(5);
        if($res == false){echo "false";}
        echo $res;
        //echo($um->addUser(1,1,1,"abc"));
    }
}
$t = new test;

?>