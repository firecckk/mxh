<?php
class configs{
    #WeiXin api
    public static $WX_url = 'https://api.weixin.qq.com/sns/jscode2session?appid=';
    public static $WX_get_encrypted_data_url = '';
    public static $APPID = 'appid';
    public static $APPSECRET = '';

    # Please fill all the essentials of your server
    public static $SITE_NAME = 'SITE_NAME';
    public static $SITE_DIR = __DIR__;
    public static $LOG_OUTPUT = __DIR__ . '/log/';

    #   Mysql configs
    public static $MYSQL_HOST_ADDRESS = '127.0.0.1';
    public static $MYSQL_HOST_PORT = "3306";
    public static $MYSQL_USERNAME = 'user';
    public static $MYSQL_PASSWORD = '5@ftyP@55w0rd.';
    public static $MYSQL_DATABASE = 'user';

    # Encrypts
    public static $SESSION_SALT = 'ThisIsTheSalt4MXH';
    //public static $TOKEN_SALT = 'ThisIsTheTokenSalt';
}
?>