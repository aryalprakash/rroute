<?php
//include_once ('includes/config.php');
//
//$title=$_POST["title"];
//if(!empty($title)) {
//    global $db_con;
//    $query = "SELECT `user_id`,`display_name` FROM `users`WHERE `display_name` LIKE '%" . $title . "%' ORDER BY `display_name` ASC";
//    $result = $db_con->query($query);
//    $row = $db_con->fetch_array($result);
//    $found = $db_con->num_rows($result);
//
//
//    if ($found > 0) {
//        while ($row = $db_con->fetch_array($result)) {
//            echo "<li class='click-user' data-id='" . $row['user_id'] . "'>" . $row['display_name'] . "</br></li>";
//            //echo $row['display_name'];
//
//            // <a href=>($row[user_id];</a></li>";
//        }
//    } else {
//        echo "<li>No User found.<li>";
//    }
//}
//
//// ajax search
//?>