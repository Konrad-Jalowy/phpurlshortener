<?php

include 'db.inc.php';

function is_min($url) {
    return (preg_match("/min\.bz/i", $url)) ? true : false;
}

function gen_code() {
    $charset = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    return substr(str_shuffle($charset), 0, 6);
}

function code_exists($code) {
    $code = mysql_real_escape_string($code);
    $code_exists = mysql_query("SELECT COUNT(`url_id`) FROM `urls` WHERE `code`='$code' LIMIT 1");
    return (mysql_result($code_exists, 0) == 1) ? true : false;
}

function shorten($url, $code) {
    $url = mysql_real_escape_string($url);
    $code = mysql_real_escape_string($code);
    mysql_query("INSERT INTO `urls` VALUES('','$url','$code')");
    return $code;
}

function redirect($code) {
    $code = mysql_real_escape_string($code);
    if (code_exists($code)) {
        $url_query = mysql_query("SELECT `url` FROM `urls` WHERE `code`='$code'");
        $url = mysql_result($url_query, 0, 'url');
        header('Location: ' . $url);
    }
}

?>
