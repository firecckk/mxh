<?php
##  inputs verfication
## is_username($pswd)
##
##
function is_username($pswd){
    #$preg='/^[\w\_]{6,20}$/u';
    $preg = '/^[a-zA-Z_]{5,19}$/';
    if(preg_match($preg,$pswd)) {return(true);} else return(false);
}
function is_json($string) {
    json_decode($string);
    return (json_last_error() == JSON_ERROR_NONE);
   }
?>