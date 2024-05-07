<!-- Các hằng số của project -->
<?php
const _MODULE = 'home';
const _ACTION = 'dashboard';
const _CODE = true;

// Thiết lập HOST
define('_WEB_HOST','http://'. $_SERVER['HTTP_HOST']. '/Grocery_Mart');
define('_WEB_HOST_ASSETS',_WEB_HOST. '/assets');

// Thiết lập Path
define('_WEB_PATH', __DIR__);
define('_WEB_PATH_ASSETS', _WEB_PATH. '/assets');

// Thông tin kết nối CSDL
const _HOST = 'localhost';
const _DB = 'web_ban_hang';
const _USER = 'root';
const _PASS = '';