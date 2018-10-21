<?php
require_once __DIR__ . '/configs.php';

Init_mysql(configs::$MYSQL_HOST_ADDRESS, configs::$MYSQL_HOST_PORT, configs::$MYSQL_USERNAME, configs::$MYSQL_PASSWORD, configs::$MYSQL_DATABASE);

function Init_mysql($add,$port,$user,$psw,$db)
{
    $con = mysqli_connect($add.":".$port,$user, $psw) or die('mysql connection failed\n' . ':' . mysqli_error($con));
    echo ("mysql connection successed\n");
    $commands = array(
        'set default_storage_engine=InnoDB;',
        'set character_set_client = UTF8;', 
        'set character_set_connection = UTF8;',
        'set character_set_database = UTF8;',
        'set character_set_results = UTF8;',
        'set character_set_server = UTF8;',
        'CREATE TABLE `'. $db .'`.`users` (
            `user_id` int(11) NOT NULL AUTO_INCREMENT,
            `union_id` text NULL,
            `open_id` text NULL,
            `session_id` text NULL,
            `mysession` text(20) NULL,
            `name` varchar(20) NOT NULL,
            `mail` varchar(50) NULL,
            `phone` varchar(11) NULL,
            `others` text NULL,
            PRIMARY KEY (`user_id`)
          ) ENGINE=InnoDB;'
    );
    foreach ($commands as $cmd) {
        if (mysqli_query($con, $cmd)) {
            echo ($cmd . "\t -- " . 'successed' . "<br>");
        } else {
            die($cmd . "\t ++ " . 'failed : '. mysqli_error($con) . "<br>");
        }
    }
    mysqli_close($con);
}



//$db = new DB($MYSQL_HOST_ADDRESS, $MYSQL_HOST_PORT, $MYSQL_USERNAME, $MYSQL_PASSWORD, $MYSQL_DATABASE, 'utf8');

?>