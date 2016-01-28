<?php
require_once('../includes/config.php');
require_once(DIR_APP . 'projects.php');
require_once(DIR_APP . 'users.php');
if (isset($_POST['title'])) {
    //	$_POST['filename'] = $filename;
    $message = addBlogPost($_POST);
    if(isset($message)){
        echo '<span style="color: rgb(255, 79, 3);font-size: 16px;">' . $message . '</span>';
        header("location:../admin.php");
        exit;
    }
}

?>