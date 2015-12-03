<?php
require_once('../config.php');
require_once(DIR_APP.'users.php');

echo $user = checkUser($_REQUEST['email']);

/*if ($user) 'false';
else echo 'true';*/

?>