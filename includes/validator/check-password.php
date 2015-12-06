<?php
session_start();
require_once('../config.php');
require_once(DIR_APP.'users.php');

echo $user = checkPassword($_REQUEST['current_password']);

/*if ($user) 'false';
else echo 'true';*/
?>