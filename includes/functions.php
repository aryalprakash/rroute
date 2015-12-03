<?php
require_once('config.php');

function login ($email, $password, $remember = ''){
 	global $db_con;

    $pass = md5(sha1($db_con->escape($password)));

 	$query = "SELECT `user_id` FROM `users` WHERE `email` = '". $db_con->escape($email) ."' AND `password` = '". $pass ."' AND `confirmed` = 1";
 	$res = $db_con->query($query);
  	$array = $db_con->fetch_array($res);

  	if ($array) {
  		$_SESSION['logged_in'] = 1;
  		$_SESSION['uid'] = $array['user_id'];

  		if (!empty($remember))
  			setcookie("uid", $array['user_id'], (time()+ 3600*24*7), "/");
  		}

    return $array['user_id'];
	}


function logout() {

	$_SESSION['logged_in'] = 0;
	$_SESSION['uid'] = 0;
	$_SESSION['first_name'] = NULL;
	$_SESSION['last_name'] = NULL;
        
	setcookie('uid', 0);
        
        session_unset();
        session_destroy();

	}

function redirect ($url){
	echo "<script> window.location='".$url."'; </script>";
	}

function current_page() {
	  $page = preg_replace('/\.php$/', '', $_SERVER['REQUEST_URI']);;
	  return preg_replace('/\//', '', $page);
	}

function load_userdata ($user_id) {
	if ($user_id) {
		global $db_con;
		$query = "SELECT * FROM `users` WHERE `user_id` = ". $user_id;

	 	$res = $db_con->query($query);
  		$array = $db_con->fetch_array($res);

  		if ($array) {
  			$_SESSION['first_name'] = $array['first_name'];
  			$_SESSION['last_name'] = $array['last_name'];
                        $_SESSION['display_name'] = $array['display_name'];
  			}
		}
	}

function split_date($date) {
	$array = array();

	if ($date && $date != '0000-00-00') {

		$array['year'] = date('Y', strtotime($date));
		$array['month'] = date('m', strtotime($date));
		$array['day'] = date('d', strtotime($date));
	}
	else {
		$array['year'] = NULL;
		$array['month'] = NULL;
		$array['day'] = NULL;
		}

	return $array;
	}


function TimeAgo($datefrom, $dateto = -1) {
$datefrom = strtotime($datefrom);

	if ($datefrom <= 0) {
		return;
	}
	if ($dateto == -1) {
		$dateto = time();
	}
	$difference = $dateto - $datefrom;
	if ($difference < 60) {
		$interval = "s";
	} elseif ($difference >= 60 && $difference < 60 * 60) {
		$interval = "n";
	} elseif ($difference >= 60 * 60 && $difference < 60 * 60 * 24) {
		$interval = "h";
	} elseif ($difference >= 60 * 60 * 24 && $difference < 60 * 60 * 24 * 7) {
		$interval = "d";
	} elseif ($difference >= 60 * 60 * 24 * 7 && $difference <
			60 * 60 * 24 * 30) {
		$interval = "ww";
	} elseif ($difference >= 60 * 60 * 24 * 30 && $difference <
			60 * 60 * 24 * 365) {
		$interval = "m";
	} elseif ($difference >= 60 * 60 * 24 * 365) {
		$interval = "y";
	}
	switch ($interval) {
		case "m":
			$months_difference = floor($difference / 60 / 60 / 24 /
					29);
			while (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom) + ($months_difference), date("j", $dateto), date("Y", $datefrom)) < $dateto) {
				$months_difference++;
			}
			$datediff = $months_difference;
			if ($datediff == 12) {
				$datediff--;
			}
			$res = ($datediff == 1) ? "$datediff month ago" : "$datediff months ago";
			//$res .= '<br/><span class="date_grey">(' . date('d.m.Y', $datefrom) . ')</span>';
			break;
		case "y":
			$datediff = floor($difference / 60 / 60 / 24 / 365);
			$res = ($datediff == 1) ? "$datediff year ago" : "$datediff years ago";
			//$res .= '&nbsp;<span class="date_grey">(' . date('d.m.Y', $datefrom) . ')</span>';
			break;
		case "d":
			$datediff = floor($difference / 60 / 60 / 24);
			$res = ($datediff == 1) ? "$datediff day ago" : "$datediff days ago";
			$res .= '&nbsp;<span class="date_grey">(' . date('d.m.Y', $datefrom) . ')</span>';
			break;
		case "ww":
			$datediff = floor($difference / 60 / 60 / 24 / 7);
			$res = ($datediff == 1) ? "$datediff week ago" : "$datediff weeks ago";
			//$res .= '&nbsp;<span class="date_grey">(' . date('d.m.Y', $datefrom) . ')</span>';
			break;
		case "h":
			$datediff = floor($difference / 60 / 60);
			$res = ($datediff == 1) ? "$datediff hour ago" : "$datediff hours ago";
			break;
		case "n":
			$datediff = floor($difference / 60);
			$res = ($datediff == 1) ? "$datediff minute ago" :
					"$datediff minutes ago";
			break;
		case "s":
			$datediff = $difference;
			$res = ($datediff == 1) ? "$datediff second ago" :
					"$datediff secondes ago";
			break;
	}
	return $res;
}

function daysDifference($date){
    $now = time(); // or your date as well
     $your_date = strtotime($date);
     $datediff = $now - $your_date;
     return floor($datediff/(60*60*24));
}

?>