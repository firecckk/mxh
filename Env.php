<?php
require_once __DIR__ . "/configs.php";
require_once __DIR__ . "/lib/log.php";
require_once __DIR__ . "/lib/db.php";
require_once __DIR__ . "/managers/UserManager.php";
require_once __DIR__ . "/managers/SessionManager.php";

class Env
{
    private static $db = false; //单态database对象
    private static $um = false; //单态usermanager对象
    private static $sm = false; //单态sessionmanager对象

    public static function mlog($data)
    {
        $log_path = configs::$LOG_OUTPUT;
        logOutPut($log_path, $data);
    }

    public static function get_db()
    {
        if (self::$db == false) {
            self :: $db = new DB(
                configs::$MYSQL_HOST_ADDRESS,
                configs::$MYSQL_HOST_PORT,
                configs::$MYSQL_USERNAME,
                configs::$MYSQL_PASSWORD,
                configs::$MYSQL_DATABASE,
                "utf8"
            );
        }
        return self::$db;
    }

    public static function get_um(){
        if (self::$um == false){
            self::$um = new UserManager();
        }
        return self::$um;
    }

    public static function get_sm(){
        if ($sm == false){
            self :: $sm = new SessionManager();
        }
        return self::$sm;
    }
}
?>