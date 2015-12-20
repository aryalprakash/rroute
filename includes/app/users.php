<?php

function checkUser($email) {
    global $db_con;

    $res = $db_con->query("SELECT `user_id` FROM `users` WHERE `email` = '" . $email . "' LIMIT 1");

    if ($db_con->fetch_array($res))
        return 'false';
    return 'true';
}

function checkPassword($password) {
    global $db_con;

    $res = $db_con->query("SELECT `user_id` FROM `users` WHERE `password` = '" . md5(sha1($password)) . "' AND `user_id` = " . $_SESSION['uid'] . " LIMIT 1");

    if ($db_con->fetch_array($res))
        return 'true';
    return 'false';
}

function registerUser($data) {
    global $db_con;
    //print_r($data);
    if (checkdate(intval($data['month']), intval($data['day']), intval($data['year'])))
        $date = $data['year'] . '-' . $data['month'] . '-' . $data['day'];
    else
        $date = '0000-00-00';
    
    $display_name = $db_con->escape($data['first_name']) . " " . $db_con->escape($data['last_name']);
     //Redirect('http://www.google.com/', false);
   $q = "INSERT INTO `users` (`first_name`, `last_name`, `display_name`, `company_name`, `location`, `email`, `password`, `user_type`, `user_level`, `birthday`, `confirmed`)
	   VALUES ('" . $db_con->escape($data['first_name']) . "', '" . $db_con->escape($data['last_name']) . "', '".$display_name."',  '', '', '" . $db_con->escape($data['email']) . "', '" . md5(sha1($db_con->escape($data['password']))) . "', " . $db_con->escape($data['user_type']) . ", 1, '" . $date . "', 0)";
    //$q = "INSERT INTO users"
    $res = $db_con->query($q);

    
    $user_id = $db_con->insert_id();
    // Redirect('http://www.google.com/', false);
    //if ($res)
    //login($db_con->escape($data['email']), $db_con->escape($data['password']));
   
    if ($res) {
        $confirmation_link = '<a href="'.SITE_URL.'/confirm.php?uid='.md5($user_id).'">'.SITE_URL.'/confirm.php?uid='.md5($user_id).'</a>';

$mail_header = "MIME-Version: 1.0\r\n";
$mail_header.= "Content-type: text/html; charset=UTF-8\r\n";
$mail_header.= "From: Rangeen<info@rangeenroute.com>\r\n";
$mail_header.= "Reply-to: Rangeen<info@rangeenroute.com>\r\n";

$recipient= $db_con->escape($data['email']);;
$subject = 'RangeenRoute: Confirm Your Email';
$message = 'Hello, '.$display_name.'<br><br>';
$message.= 'Your account has been created. Confirm your email: '.$confirmation_link;

$message = '<html><body><p align="left">'.$message.'</p></body></html>';
 
mail($recipient, $subject, $message, $mail_header);
    }

    return $res;
}

function ConfirmEmail($user_id) {
    global $db_con;
    
    $query = 'UPDATE `users` SET `confirmed` = 1 WHERE MD5(`user_id`) = \''.$user_id.'\'';
    $db_con->query($query);
}


function getUserData($user_id) {
    global $db_con;

    $res = $db_con->query("SELECT * FROM `users` WHERE `user_id` = " . $user_id . " LIMIT 1");

    return $db_con->fetch_array($res);
}

function updateUser($data) {
    global $db_con;

    if (checkdate(intval($data['month']), intval($data['day']), intval($data['year'])))
        $date = $data['year'] . '-' . $data['month'] . '-' . $data['day'];
    else
        $date = '0000-00-00';

    if (!empty($_POST['photo'])) {
        if (!empty($_POST['photo_updated'])) {
            if (copy('js/file-uploading/server/php/files/' . $_POST['photo'], 'uploads/avatars/' . $_POST['photo']) && copy('js/file-uploading/server/php/files/thumbnail/' . $_POST['photo'], 'uploads/avatars/thumbs/' . $_POST['photo'])) {
                $photo = $_POST['photo'];
                unlink('js/file-uploading/server/php/files/' . $_POST['photo']);
                unlink('js/file-uploading/server/php/files/thumbnail/' . $_POST['photo']);
            } else
                $photo = '';
        } else
            $photo = $_POST['photo'];
    } else
        $photo = '';

    $q = "UPDATE `users` SET
		`first_name` = '" . $db_con->escape($data['first_name']) . "',
		`last_name` = '" . $db_con->escape($data['last_name']) . "',
		`birthday` = '" . $date . "',
		`gender` = " . $data['gender'] . ",
		`college` = '" . $db_con->escape($data['college']) . "',
		`high_school` = '" . $db_con->escape($data['high_school']) . "',
		`school` = '" . $db_con->escape($data['school']) . "',
		`company_name` = '" . $db_con->escape($data['company_name']) . "',
		`position` = '" . $db_con->escape($data['position']) . "',
		`location` = '" . $db_con->escape($data['location']) . "',
		`hometown` = '" . $db_con->escape($data['hometown']) . "',
		`mailing_address` = '" . $db_con->escape($data['mailing_address']) . "',
		`alt_email` = '" . $db_con->escape($data['alt_email']) . "',
		`social_network` = '" . $db_con->escape($data['social_network']) . "',
		`phone` = '" . $db_con->escape($data['phone']) . "',

		`about_me` = '" . $db_con->escape($data['about_me']) . "',
		`photo` = '" . $photo . "'
		 WHERE `user_id` = " . $data['user_id'];

    #removed https://www.youtube.com/playlist?list=PLfdtiltiRHWEbLm0ErHe7HgEOVIO26R_o
    return $db_con->query($q);
}

function updateAccount($data) {        
    global $db_con;
    
    

    if (isset($data['keep_preferred_only']))
        $keep_preferred_only = 1;
    else
        $keep_preferred_only = 0;

    if (isset($data['keep_preferred_nickname']))
        $keep_preferred_nickname = 1;
    else
        $keep_preferred_nickname = 0;

    if (!empty($data['password']))
        $pass_query = ", `password` = '" . md5(sha1($data['password'])) . "', `password_updated_on` = '" . date('Y-m-d H:i:s', time()) . "' ";
    else
        $pass_query = '';
    
    
    if ($keep_preferred_only && !$keep_preferred_nickname)
        $display_name = $db_con->escape($data['preferred_name']);
    
    if ($keep_preferred_nickname)
        $display_name = $db_con->escape($data['first_name']).' '.$db_con->escape($data['last_name']).' ('.$db_con->escape($data['preferred_name']).')';
    
    if (!$keep_preferred_only && !$keep_preferred_nickname)
        $display_name = $db_con->escape($data['first_name']).' '.$db_con->escape($data['last_name']);
    


    $q = "UPDATE `users` SET
		`first_name` = '" . $db_con->escape($data['first_name']) . "',
		`last_name` = '" . $db_con->escape($data['last_name']) . "',
		`alt_email` = '" . $db_con->escape($data['alt_email']) . "',
		`preferred_name` = '" . $db_con->escape($data['preferred_name']) . "',
                `display_name` = '".$display_name."',    
		`keep_preferred_only` = " . $keep_preferred_only . ",
		`keep_preferred_nickname` = " . $keep_preferred_nickname .
            $pass_query . "
		  WHERE `user_id` = " . $_SESSION['uid'];


    return $db_con->query($q);
}

function addDeveloper($data) {
    global $db_con;

    $insert = "INSERT INTO `developers`(`name`, `email`, `specialization`)
 		VALUES ('" . $db_con->escape($data['name']) . "', '" . $db_con->escape($data['email']) . "', '" . $db_con->escape($data['spec']) . "')";

    $db_con->query($insert);

    return $db_con->insert_id();
}

function checkRouter($user_id, $routed_by) {
    global $db_con;

    $q = "SELECT `status` FROM `routers` WHERE `user_id` = " . $user_id . " AND `routed_by` = " . $routed_by . " LIMIT 1";
    $res = $db_con->query($q);
    $router = $db_con->fetch_array($res);

    if ($router)
        return $router['status'];
    return -1;
}

function AddRouter($user_id, $routed_by) {
    global $db_con;

    $insert = "INSERT INTO `routers`(`user_id`, `routed_by`)
		VALUES (" . $db_con->escape($user_id) . ", " . $db_con->escape($routed_by) . ")";

    $db_con->query($insert);

    $user = getUserData($routed_by);
    $text = $user['first_name'] . ' ' . $user['last_name'] . ' wants to be a router with you. <a href="#" class="accept-route" data-routedby="' . $routed_by . '" data-user="' . $user_id . '">Accept</a> <a href="#" class="decline-route" data-routedby="' . $routed_by . '" data-user="' . $user_id . '">Decline</a>';

    addNotification($db_con->escape($user_id), $text, $db_con->escape($routed_by));

    return $db_con->insert_id();
}

function DeleteRouter($user_id, $routed_by) {
    global $db_con;

    $delete = "DELETE FROM `routers` WHERE `user_id` = " . $user_id . " AND `routed_by` = " . $routed_by;

    $db_con->query($delete);
}

function getRoutersForUser($routed_by, $search_str = '') {
    global $db_con;

    if (empty($search_str))
        $query = 'SELECT `user_id` FROM `routers` WHERE `routed_by` = ' . $routed_by . ' AND `status` = 1 ORDER BY router_id';
    else
        $query = 'SELECT r.user_id FROM routers as r, users as u WHERE r.user_id = u.user_id AND (u.first_name LIKE "%' . $db_con->escape($search_str) . '%" OR u.last_name LIKE "%' . $db_con->escape($search_str) . '%") AND r.routed_by = ' . $routed_by . ' AND r.status = 1 ORDER BY router_id';
        
    return $db_con->sql2array($query);
}


function getPrivacySettings($user_id) {
    global $db_con;

    $query = 'SELECT * FROM `privacy_settings` WHERE `user_id` = ' . $user_id;
    $res = $db_con->query($query);
    return $db_con->fetch_array($res);
}

function updatePrivacySettings($data, $user_id) {
    global $db_con;

    $privacy = getPrivacySettings($user_id);

    if (empty($privacy))
        $q = 'INSERT INTO `privacy_settings` (`user_id`, `selected_option`, `limit_activity`, `router_available`) VALUES(
		' . $user_id . ', ' . $data['privacy_type'] . ', ' . $data['limit_authority'] . ', ' . $data['router_available'] . ')';

    else {
        $q = 'UPDATE `privacy_settings` SET `selected_option` = ' . $data['privacy_type'] . ',
		`limit_activity` = ' . $data['limit_authority'] . ',
		`router_available` = ' . $data['router_available'] . ' WHERE `user_id` = ' . $user_id;
    }

    $db_con->query($q);
}

function loadRecipients($term) {
    global $db_con;

    $qstring = "SELECT `first_name`, `last_name`, `user_id` FROM `users` WHERE (`first_name` LIKE '%" . $term . "%' OR `last_name` LIKE '%" . $term . "%') AND `user_id` <> " . $_SESSION['uid'];
    $result = $db_con->query($qstring); //query the database for entries containing the term

    while ($row = $db_con->fetch_array($result, MYSQL_ASSOC)) {//loop through the retrieved values
        $row['value'] = $db_con->escape($row['first_name']) . ' ' . $db_con->escape($row['last_name']);
        $row['id'] = (int) $row['user_id'];
        $row_set[] = $row; //build an array
    }

    echo json_encode($row_set); //format the array into json data
}

function sendMessage($data) {
    global $db_con;

    $q = 'INSERT INTO `messages` (`sender`, `recipient`, `message`) VALUES(
		' . $_SESSION['uid'] . ', ' . $data['user_id'] . ', \'' . $db_con->escape($data['message']) . '\')';

    return $db_con->query($q);
}

function sendReply($data) {
    global $db_con;

    $q = 'INSERT INTO `messages` (`sender`, `recipient`, `message`, `reply_on`) VALUES(
		' . $_SESSION['uid'] . ', ' . $data['user_id'] . ', \'' . $db_con->escape($data['message']) . '\', ' . $data['reply_on'] . ')';

    return $db_con->query($q);
}

function getInboxMessages($user_id) {
    global $db_con;

    $query = 'SELECT * FROM `messages` WHERE `recipient` = ' . $user_id . ' ORDER BY `message_id` DESC';

    return $db_con->sql2array($query);
}

function facebookLogin($uid, $oauth_provider, $username, $email) {
    global $db_con;

    $q = "SELECT `user_id`, `register_type` FROM `users` WHERE `email` = '" . $email . "'";
    $res = $db_con->query($q);
    $user = $db_con->fetch_array($res);
    
    $u_name = explode(' ', $username);
    $f_name = $u_name[0];
    $l_name = $u_name[1];

    if (!empty($user) && $user['register_type'] == 1) {
        echo '<center>User with this email already created!<br>This email was used to register user on Sign up page.<br>You can not login with this Facebook account. Use login form please.</center>';
    } else if (!empty($user) && $user['register_type'] == 2) {
        $_SESSION['logged_in'] = 1;
        $_SESSION['uid'] = $user['user_id'];
    } else {
        $q = "INSERT INTO `users` (`first_name`, `last_name`, `display_name`, `company_name`, `location`, `email`, `password`, `user_type`, `user_level`, `birthday`, `register_type`)
		VALUES ('" . $f_name . "', '".$l_name."', '".$username."', '', '', '" . $email . "', '', 1, 1, '', 2)";
        $res = $db_con->query($q);
        $_SESSION['logged_in'] = 1;
        $_SESSION['uid'] = $db_con->insert_id();
    }
}

function getVerified() {
    global $db_con;

    if (empty($_FILES))
        return 'Please select file to upload';

    if (move_uploaded_file($_FILES['verify_file']['tmp_name'], 'uploads/documents/' . $_FILES["verify_file"]['name'])) {

        $user = getUserData($_SESSION['uid']);

        $mail_header = "MIME-Version: 1.0\r\n";
        $mail_header.= "Content-type: text/html; charset=UTF-8\r\n";
        $mail_header.= "From: Rangeen Route <from@rangeen.com>\r\n";
        $mail_header.= "Reply-to: Rangeen Route <reply@rangeen.com>\r\n";

        $recipient = 'isvetlichniy@gmail.com';
        $subject = 'Verification documents received';
        $message = '<a href="' . SITE_URL . '/user.php?uid=' . $_SESSION['uid'] . '">' . $user['first_name'] . ' ' . $user['last_name'] . '</a> sent document. <br>';
        $message.= '<a href="' . SITE_URL . '/uploads/documents/' . $_FILES["verify_file"]['name'] . '">Download</a>';
        $message = '<html><body><p align="left">' . $message . '</p></body></html>';

        mail($recipient, $subject, $message, $mail_header);
        mail('dahal004@umn.edu', $subject, $message, $mail_header);

        $q = "UPDATE `users` SET `verify_file` = '" . $_FILES["verify_file"]['name'] . "' WHERE `user_id` = " . $_SESSION['uid'];
        $db_con->query($q);

        return 'Your verification document has been sent.';
    } else {
        return "File uploading error!";
    }
}

function addNotification($sent_to, $text, $created_by,$url='') {
    global $db_con;
    
    $insert = "INSERT INTO `notifications` SET
               `sent_to` = " . $sent_to . ",
               `text` = '" . $text . "',
               `url`='".$url."',
               `created_by` = " . $created_by;

    $db_con->query($insert);
}

function getBalance($user_id) {
    global $db_con;
    $query = 'SELECT `balance` FROM `users` WHERE `user_id` = ' . $user_id;
    $res = $db_con->query($query);
    $user = $db_con->fetch_array($res);
    return $user['balance'];
}


function updateBalance($user_id, $balance) {
    global $db_con;
    $query = 'UPDATE `users` SET `balance` = '.$balance.' WHERE user_id = '.$user_id;
    $db_con->query($query);
}

function addTransaction($userId, $amount, $project_title, $project_id, $authorId) {
    global $db_con;
    
	$balance = getBalance($userId);
	$balance = intval($balance)-intval($amount);
	$amountToSave = 0 - $amount;
	$description = 'payment for ' .$project_title;
    $insertPayment = "INSERT INTO `payments` SET
               `transaction_id` = 'inner-transaction',
               `type` = 'payment',
               `description` = '".$description."',
			   `amount` = ".$amountToSave.",
			   `user_id` = ".$userId.",
			   `balance` = ".$balance.",
			   `project_id` = ".$project_id.",
			   `created_by` = ".$userId;

    $db_con->query($insertPayment);
	updateBalance($userId, $balance);
	
	$balance = getBalance($authorId);
	$balance = intval($balance)+intval($amount);
	$amountToSave = $amount;
    $description = 'royalty for ' .$project_title;
	$insertRoyalty = "INSERT INTO `payments` SET
               `transaction_id` = 'inner-transaction',
               `type` = 'royalty',
               `description` = '".$description."',
			   `amount` = ".$amountToSave.",
			   `user_id` = ".$authorId.",
			   `balance` = ".$balance.",
			   `project_id` = ".$project_id.",
			   `created_by` = ".$userId;

    $db_con->query($insertRoyalty);	
	updateBalance($authorId, $balance);
}



function addInteraction($created_by, $action, $author, $type, $id) {
    global $db_con;
   
    $insertInt = "INSERT INTO `interactions` SET
               `action` = '". $action ."',
               `author` = ". $author. ",
               `type` = '". $type. "',
               `id` = ". $id. ",
               `created_by` = " . $created_by;
               

    $db_con->query($insertInt);
}


function getNotifications($user_id) {
    global $db_con;

    $q = 'SELECT * FROM `notifications` WHERE `sent_to` = ' . $user_id . ' ORDER BY `created_on` DESC';

    return $db_con->sql2array($q);
}

function getInteractions($user_id) {
  global $db_con;



        $q = 'SELECT * FROM `interactions` WHERE `created_by` = ' . $user_id . ' ORDER BY `created_on` DESC';

        return $db_con->sql2array($q);

}

function getUserNameById($user_id) {
    global $db_con;

    $query = 'SELECT `first_name`, `last_name`  FROM `users` WHERE `user_id` = ' . $user_id;
    $res = $db_con->query($query);

    $user = $db_con->fetch_array($res);

    return $user['first_name'] . '&nbsp;' . $user['last_name'];
}



function isMyRouter($user_id) {
    global $db_con;

    if ($user_id == $_SESSION['uid'])
        return 0;

    $query = 'SELECT `user_id` FROM `routers` WHERE `routed_by` = ' . $user_id;
    $res = $db_con->query($query);

    $user = $db_con->fetch_array($res);

    return $user['user_id'];
}

function getFootnoteByAuthor($user_id, $created_by) {
    global $db_con;

    $query = 'SELECT `user_id` FROM `footnotes` WHERE `user_id` = ' . $user_id . ' AND `created_by` = ' . $created_by;
    $res = $db_con->query($query);

    $user = $db_con->fetch_array($res);
    return $user['user_id'];
}

function addFootNote($data) {
    global $db_con;

    $q = "INSERT INTO `footnotes` SET 
            `user_id` = " . $data['user_id'] . ", `text` = '" . $db_con->escape($data['footnote']) . "', `created_by` = " . $_SESSION['uid'];

    $res = $db_con->query($q);
}

function getFootnotes($user_id) {
    global $db_con;

    $query = 'SELECT * FROM `footnotes` WHERE `user_id` = ' . $user_id;
    return $db_con->sql2array($query);
}

function acceptRoute($routed_by, $user_id, $notify_id) {
    global $db_con;

    $q = 'UPDATE `routers` SET `status` = 1 WHERE `user_id` = ' . $user_id . ' AND `routed_by` = ' . $routed_by;
    $db_con->query($q);

    $q = 'DELETE FROM `notifications` WHERE `notify_id` = ' . $notify_id;
    $db_con->query($q);

    $author = getUserNameById($user_id);
    $text = $author . ' accepted your route';
    addNotification($routed_by, $text, $user_id);
}

function declineRoute($routed_by, $user_id, $notify_id) {
    global $db_con;

    $q = 'DELETE FROM `routers` WHERE `user_id` = ' . $user_id . ' AND `routed_by` = ' . $routed_by;
    $db_con->query($q);

    $q = 'DELETE FROM `notifications` WHERE `notify_id` = ' . $notify_id;
    $db_con->query($q);

    $author = getUserNameById($user_id);
    $text = $author . ' declined your route';
    addNotification($routed_by, $text, $user_id);
}

function getAllPayments($user_id) {
    global $db_con;

    $query = 'SELECT * FROM `payments` WHERE `type` <> \'Registration\' AND `user_id` = ' . $user_id . ' ORDER BY `created_on` DESC';

    return $db_con->sql2array($query);
}

function getAmountForDate($date, $user_id) {
    global $db_con;

    $query = "SELECT `balance` FROM `payments`  WHERE DATE(created_on) = '" . $date . "' AND `user_id` = " . $user_id . " ORDER BY `payment_id` DESC LIMIT 1";

    $res = $db_con->query($query);
    $balance = $db_con->fetch_array($res);
    return $balance['balance'];
}

function resetPassword($email) {
    global $db_con;

    $query = "SELECT `email`, `first_name`, `last_name` FROM `users`  WHERE `email` = '" . $db_con->escape($email) . "'";

    $res = $db_con->query($query);
    if (!$res || empty($email))
        return 'Sorry. The email you entered has not been registered yet.';

    $user = $db_con->fetch_array($res);
    $firstName = $user['first_name'];
    $lastName = $user['last_name'];

    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < 10; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }

    $recipient = $email;
    $subject = 'Rangeenroute Password Recovery';
    $message = '<p>Hi, '.$firstName.' '.$lastName.'<br/><br/>We received a notice that you forgot your password. You can use this passcode to login: '. $randomString. '<br/> Please reset it once you logged in.<br/>
If you did not initiate this passcode request, you can safely ignore this email.<br/><br/>
Thanks,<br/>
Rangeenroute team</p>';

    $mail_header = "MIME-Version: 1.0\r\n";
    $mail_header.= "Content-type: text/html; charset=UTF-8\r\n";
    $mail_header.= "From: Rangeenroute <noreply@rangeenroute.com>\r\n";    

    if (mail($recipient, $subject, $message, $mail_header)) {
        $query = "UPDATE `users` SET `password` = '" . md5(sha1($randomString)) . "' WHERE `email` = '" . $email . "'";
        $db_con->query($query);
        return 'Thank you. We have sent a login password to your email. Please do login with that sent password and remember to change it.';
    } else
        return 'Unknown error';
}


function getAllUsers(){
     global $db_con;
     
     $query = 'SELECT `user_id`, `first_name`, `last_name` FROM `users` WHERE `confirmed` = 1';
     
     return $db_con->sql2array($query);
}





function countNotifications($user_id){
	global $db_con;
	$q = 'SELECT COUNT(`notify_id`) as c FROM `notifications` WHERE `sent_to` = ' . $user_id. ' AND `status` = "not-read"';
    	$res = $db_con->query($q);
    
    $notifs = $db_con->fetch_array($res);

    $notifs_count = $notifs['c'];
    
    if ($notifs_count == 0)
    	return '';
    else	
    return $notifs_count;

}

function readNotifications($user_id){
	global $db_con;
	$status = "read";
	$query = "UPDATE `notifications` SET `status` = '$status' WHERE sent_to =" .$user_id  ;
	$db_con->query($query);
}
function getUserNameBySearch($title,$user_id)
{if(!empty($title)) {
    global $db_con;
    $query = "SELECT `first_name`,`last_name`,`user_id`,`display_name` FROM `users` WHERE user_id !=$user_id AND (`display_name` LIKE '%" . $title . "%' OR `first_name` LIKE '%" . $title . "%' OR `last_name` LIKE '%" . $title . "%') ORDER BY `display_name` ASC";
    $result = $db_con->query($query);
    $row = $db_con->fetch_array($result);
    $found = $db_con->num_rows($result);


    if ($found > 0) {
        while ($row = $db_con->fetch_array($result)) {
            echo "<li class='click-user' data-id='" . $row['user_id'] . "'>" . $row['display_name'] . "</br></li>";
            //echo $row['display_name'];

            // <a href=>($row[user_id];</a></li>";
        }
    } else {
        echo "<li>No User found.<li>";
    }
}}
?>