<?php
session_start();

if (empty($_SERVER['REMOTE_ADDR']) || $_SERVER['REMOTE_ADDR'] == '127.0.0.1' || $_SERVER['REMOTE_ADDR'] == '::1') {
	define('SITE_URL', 'http://localhost/github/rangeenroute');
}
else {
	define('SITE_URL', 'https://www.rangeenroute.com');
	}

defined('DIR_ROOT') || define('DIR_ROOT', realpath(dirname(__FILE__) . '/../') . '/');
defined('DIR_INCLUDE') || define('DIR_INCLUDE', realpath(dirname(__FILE__)) . '/');
defined('DIR_LIBS') || define('DIR_LIBS', realpath(dirname(__FILE__) . '/libs/') . '/');
defined('DIR_APP') || define('DIR_APP', realpath(dirname(__FILE__) . '/app/') . '/');
defined('DIR_UPLOAD') || define('DIR_UPLOAD', realpath(dirname(__FILE__) . '/../uploads/') . '/');

if (empty($_SERVER['REMOTE_ADDR']) || $_SERVER['REMOTE_ADDR'] == '127.0.0.1') {
    define('MYSQL_HOST', 'localhost');
    define('MYSQL_DATABASE', 'rangeen_community');//change rangeen to rangeen_community
    define('MYSQL_USER', 'root');
    define('MYSQL_PASSWORD', '');


    error_reporting(E_ALL);
    error_reporting(E_ALL ^ E_NOTICE);
} else {
    define('MYSQL_HOST', 'localhost');
    define('MYSQL_USER', 'rangeen_isvet');//rangeen_isvet
    define('MYSQL_PASSWORD', 'Livlafluv48!');//Livlafluv48!
    define('MYSQL_DATABASE', 'rangeen_community');
}


require_once(DIR_LIBS . 'mysql/dbFunctions.php');
$db_con = new CDatabase(MYSQL_DATABASE, MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD);


require_once(DIR_INCLUDE . 'functions.php');

define ('CURRENT_PAGE', current_page());

if (empty($_SESSION['logged_in']) && !empty($_COOKIE['uid'])) {
	$_SESSION['logged_in'] = 1;
  	$_SESSION['uid'] = $_COOKIE['uid'];
	load_userdata ($_COOKIE['uid']);
	}

if (!empty($_SESSION['logged_in']) && empty($_SESSION['display_name']))
 	load_userdata ($_SESSION['uid']);

//echo md5(sha1('hello123'));
?>