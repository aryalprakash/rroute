<?php
include('includes/header.php');

require_once(DIR_APP . 'projects.php');
require_once(DIR_APP . 'users.php');


//print_r($_POST);

$user_id =getProjectAuthor($_POST['pid']);
$date =$_POST['month'].'/'.$_POST['year'];
global $db_con;
//checkBalance($user);
if(empty($_POST['fin_pro'])&&empty($_POST['user_choice'])) {
    $reward_type = $_POST['eq_pc'];
}else{
    if(empty($_POST['fin_pro'])) {
        $reward_type = $_POST['user_choice'];
    }
    else{
        $reward_type =$_POST['fin_pro'];
    }

}



$query = "INSERT INTO `payment_process`(`transaction_id`, `type`, `reward_type`,`description`, `amount` , `user_id` , `balance` , `project_id`, `created_by`,`card_no`,`ccv`,`zip`,`expiry_date`)
		 VALUES ( '" . $db_con->escape($_POST['stripeToken']) . "' , '".$db_con->escape($_POST['type'])."', '".$db_con->escape($reward_type)."', 'Description' , '" . $db_con->escape($_POST['amount']) . "' , '" . $user_id. "' , '0' , '" . $db_con->escape($_POST['pid']) . "' , '" . $db_con->escape($_POST['user_id']) . "','" . $db_con->escape($_POST['cardname']) . "','" . $db_con->escape($_POST['cvc']) . "','" . $db_con->escape($_POST['zip_code']) . "','".$date."')";
$db_con->query($query);
$id = $db_con->insert_id();

//$query1 = "UPDATE `users` SET balance=" . $balance . " WHERE user_id=" . $user['user_id'];
//$db_con->query($query1);

updateFundStatusProject($_POST['pid']);
updateFundableStatus($_POST['pid']);
updateFundingsStatus($_POST['pid'],$_POST['amount'],$_POST['type'],$reward_type);
//return $id;
echo "Payment Succesfull!";
redirect('home.php');
exit;
