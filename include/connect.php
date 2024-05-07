<!-- Kết nối với Database -->
<?php
if(!defined('_CODE')){
    die('Access denied...');
}

try{
    if(class_exists('PDO')){
        $dns = 'mysql:dbname='._DB.';host='._HOST;

        $options = [
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8', //Set utf8
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION //Tạo thông báo khi gặp lỗi
        ];

        $conn = new PDO($dns, _USER, _PASS, $options);
    }
}catch(Exception $exception){
    echo $exception -> getMessage();
    die();
}