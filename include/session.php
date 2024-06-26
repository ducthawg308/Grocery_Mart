<!-- Các hàm liên quan đến session hay cookies -->
<?php
if(!defined('_CODE')){
    die('Access denied...');
}

//Hàm gán Session
function setSession($key, $value){
    $_SESSION[$key] = $value;
}

//Hàm đọc Session
function getSession($key=''){
    if(empty($key)){
        return $_SESSION;
    }else{
        if(isset($_SESSION[$key])){
            return $_SESSION[$key];
        }
    }
}

//Hàm xóa Session
function removeSession($key=''){
    if(empty($key)){
        session_destroy();
        return true;
    }else{
        if(isset($_SESSION[$key])){
            unset($_SESSION[$key]);
            return true;
        }
    }
}

//Hàm gán Flash data
function setFlashData($key,$value){
    $key = 'flash_'.$key;
    return setSession($key,$value);
}

//Hàm đọc Flash data
function getFlashData($key){
    $key = 'flash_'.$key;
    $data = getSession($key);
    removeSession($key);
    return $data;
}