<?php
require_once('../includes/config.php');
require_once(DIR_APP . 'projects.php');
require_once(DIR_APP . 'users.php');
if (isset($_POST['title'])) {
    //	$_POST['filename'] = $filename;
    $message = addBlogPostAdmin($_POST);
    if(isset($message)){
        echo '<span style="color: rgb(255, 79, 3);font-size: 16px;">' . $message . '</span>';
    }

    header("Refresh:3;URL=../admin.php");
    exit;
}
elseif (isset($_POST['name'])) {
    //	$_POST['filename'] = $filename;
    $message = addInvestor($_POST);
    if(isset($message)){
        echo '<span style="color: rgb(255, 79, 3);font-size: 16px;">' . $message . '</span>';
    }

    header("Refresh:3;URL=../admin.php");
    exit;
}

?>