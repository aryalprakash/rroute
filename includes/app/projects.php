<?php

function getCategories() {
    global $db_con;

    $res = $db_con->sql2array("SELECT * FROM `project_categories`");

    return $res;
}

/*function getDevelopers() {
    global $db_con;

    $res = $db_con->sql2array("SELECT * FROM `developers`");

    return $res;
}*/

function addProject($data) {
    global $db_con;

    $query = "INSERT INTO `projects`(`project_title`, `project_category`, `project_location`, `created_by`)
  			 VALUES ('" . $db_con->escape($data['project_title']) . "', " . $db_con->escape($data['project_category']) . ", '" . $db_con->escape($data['project_location']) . "', " . $_SESSION['uid'] . ")";

    $db_con->query($query);

    $id = $db_con->insert_id();
    
    if ($_POST['developers']) {
        $developers = implode(',', $_POST['developers']);
        $query = "INSERT INTO `assigned_developers` (`project_id`, `developers`) VALUES (" . $id . ", '" . $developers . "')";
        $db_con->query($query);
    }
    
    
    return $id;
}

function addIdea($data){
	$target_dir = "uploads/images/ideathreads/";
	$target_file = $target_dir . basename($_FILES["thumbnailImg"]["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	move_uploaded_file($_FILES["thumbnailImg"]["tmp_name"], $target_file);



		

    global $db_con;
    
    $query = "INSERT INTO `ideathreads`(`ideathread_title`,`description`,`source_url`,`original_creator`,`created_by`,`status`,`thumbnail_img`)
                VALUES('".$db_con->escape($data['ideathread_title'])."','".$db_con->escape($data['description'])."','".$db_con->escape($data['source_url'])."','".$db_con->escape($data['original_creator'])."'," . $_SESSION['uid'] . ",'notapproved','".$target_file."')";

    $db_con->query($query);
    $message = 'Status: Received, In-Review';
    return $message;
    
 
}

function updateProject($data, $id, $step) {

    global $db_con;

    if ($step == 2) {
        $query = "UPDATE `projects`
  				 SET `project_title` = '" . $db_con->escape($data['project_title']) . "',
  				 `project_category` = " . $db_con->escape($data['project_category']) . ",
  				 `project_location` = '" . $db_con->escape($data['project_location']) . "'
  				 WHERE `project_id`= " . $id;
        $db_con->query($query);
        
        if ($_POST['developers']) { 
            $developers = implode(',', $_POST['developers']);
            $query = "UPDATE `assigned_developers` SET `developers` = '" . $developers . "' WHERE `project_id` = " . $id;
            $db_con->query($query);
        }
        
    } else if ($step == 3) {
    
        if (!empty($data['uploaded_video'])) {
            if (@copy('js/file-uploading/server/php/files/' . $data['uploaded_video'], 'uploads/videos/' . $data['uploaded_video'])) {
                @unlink('js/file-uploading/server/php/files/' . $data['uploaded_video']);

                $query = "INSERT INTO `featured_videos`(`project_id`, `user_id`, `file_name`) VALUES (" . $id . ", " . $_SESSION['uid'] . ", '" . $data['uploaded_video'] . "')  ON DUPLICATE KEY UPDATE `file_name` =  '" . $data['uploaded_video'] . "'";
                $db_con->query($query);

                $video_id = $db_con->insert_id();
               
            }
            else{
            	$query = "INSERT INTO `featured_videos`(`project_id`, `user_id`, `file_name`) VALUES (" . $id . ", " . $_SESSION['uid'] . ", '" . $data['uploaded_video'] . "')  ON DUPLICATE KEY UPDATE `file_name` =  '" . $data['uploaded_video'] . "' ";
                $db_con->query($query);

                $video_id = $db_con->insert_id();
            }
        }

        if (!empty($data['uploaded_image'])) {
            if (@copy('js/file-uploading/server/php/files/' . $data['uploaded_image'], 'uploads/images/' . $data['uploaded_image']) && copy('js/file-uploading/server/php/files/thumbnail/' . $data['uploaded_image'], 'uploads/images/thumbs/' . $data['uploaded_image'])) {
                @unlink('js/file-uploading/server/php/files/' . $data['uploaded_image']);

                $query = "INSERT INTO `featured_images`(`project_id`, `user_id`, `file_name`) VALUES (" . $id . ", " . $_SESSION['uid'] . ", '" . $data['uploaded_image'] . "') ON DUPLICATE KEY UPDATE `file_name` =  '" . $data['uploaded_image'] . "' ";
                $db_con->query($query);

                $image_id = $db_con->insert_id();
                
            }
            else{
            	$query = "INSERT INTO `featured_images`(`project_id`, `user_id`, `file_name`) VALUES (" . $id . ", " . $_SESSION['uid'] . ", '" . $data['uploaded_image'] . "')  ON DUPLICATE KEY UPDATE `file_name` =  '" . $data['uploaded_image'] . "' ";
                $db_con->query($query);

                $image_id = $db_con->insert_id();
            }
        }

        if (!empty($data['featuring_text'])) {
             $query = "INSERT INTO `featured_descriptions`(`project_id`, `user_id`, `content`) VALUES (" . $id . ", " . $_SESSION['uid'] . ", '" . $data['featuring_text'] . "') ON DUPLICATE KEY UPDATE `content` =  '" . $data['featuring_text'] . "' ";
            //$query = "UPDATE `featured_descriptions` SET `content` = '" .$data['featuring_text']. "' WHERE `project_id` = " . $id;
            $db_con->query($query);

            $description_id = $db_con->insert_id();
        }

        if (!empty($data['featuring_item'][0])) {
            if ($data['featuring_item'][0] == 'video')
                $featuring_id = $video_id;
            else if ($data['featuring_item'][0] == 'picture')
                $featuring_id = $image_id;
            else if ($data['featuring_item'][0] == 'post')
                $featuring_id = $description_id;
                
              

            $update = "UPDATE `projects` SET `featuring_type` = '" . $data['featuring_item'][0] . "', `featuring_id` = " . $featuring_id . " WHERE `project_id` = " . $id;
           // $update = "UPDATE `projects` SET `featuring_type` = 'picture', `featuring_id` =  85 WHERE `project_id` = " . $id;
            $db_con->query($update);
        }

        //print_r($_POST);
    }
    else if ($step == 4) {
        $update = "UPDATE `projects` SET `thematic_type` = '" . $data['thematic_type'] . "', `thematic_id` = " . $data['thematic_post'][0] . " WHERE `project_id` = " . $id;
        $db_con->query($update);
    } else if ($step == 5) {
        $update = "UPDATE `projects` SET `details` = '" . $data['details'] . "' WHERE `project_id` = " . $id;
        $db_con->query($update);

        if (!empty($data['uploaded_video'])) {
            if (@copy('js/file-uploading/server/php/files/' . $data['uploaded_video'], 'uploads/videos/' . $data['uploaded_video'])) {
                @unlink('js/file-uploading/server/php/files/' . $data['uploaded_video']);

                $query = "DELETE FROM `videos`  WHERE `project_id` = " . $id;
                $db_con->query($query);

                $query = "INSERT INTO `videos`(`project_id`, `user_id`, `file_name`) VALUES (" . $id . ", " . $_SESSION['uid'] . ", '" . $data['uploaded_video'] . "')";
                $db_con->query($query);
            }
        }

        if (!empty($data['uploaded_picture'])) {

            //$query = "DELETE FROM `images`  WHERE `project_id` = " . $id;
            //$db_con->query($query);

            foreach ($data['uploaded_picture'] as $picture) {

                if (@copy('js/file-uploading/server/php/files/' . $picture, 'uploads/images/' . $picture)) {
                    @unlink('js/file-uploading/server/php/files/' . $picture);

                    $query = "INSERT INTO `images`(`project_id`, `user_id`, `file_name`) VALUES (" . $id . ", " . $_SESSION['uid'] . ", '" . $picture . "')";
                    $db_con->query($query);
                }
            }
        }
    } else if ($step == 6) {


        if (!empty($data['last_step'])) {
        	if(!empty($data['uploaded_product_image'])){
        		$query = "INSERT INTO `images`(`project_id`, `user_id`, `file_name`, `type`) VALUES (" . $id . ", " . $_SESSION['uid'] . ", '" . $data['uploaded_product_image'] . "', 'final_product')";
        		$db_con->query($query);
        	}
            $query = "UPDATE `projects` SET `monetize` = '" . $data['project_monetize'] . "', `startup_amount` = '" . $data['startup_amount'] . "', `reward` = '" . $data['reward'] . "', `privacy` = '" . $data['privacy'] . "', `equity_pc` = '" . $data['equity_pc'] . "', `per_product_cost` = '" . $data['per_product_cost'] . "', `about_amount` = '" . htmlentities($data['about_amount'], ENT_QUOTES) . "', `risk_amount` = '" . htmlentities($data['risk_amount'], ENT_QUOTES) . "' WHERE `project_id` = " . $id;
            $db_con->query($query);
        } else {
            $query = "UPDATE `projects` SET `status` = 0 WHERE `project_id`=" . $id;
            $db_con->query($query);
            redirect('user.php');
        }
    }
}

function getProjectById($project_id) {
    global $db_con;
    $pid= $project_id;
    $res = $db_con->query("SELECT * FROM `projects` WHERE (`project_id` = $pid) LIMIT 1");

    return $db_con->fetch_array($res);
}

function getAssignedDeveloper($project_id) {
    global $db_con;

    $res = $db_con->query("SELECT `developer_id` FROM `assigned_developers` WHERE `project_id` = " . $project_id . " LIMIT 1");
    $array = $db_con->fetch_array($res);
    return $array['developer_id'];
}

function getLastActiveProject() {
    global $db_con;
    
    $query = "SELECT * FROM `projects` WHERE `status` = 1 AND `created_by` = " . $_SESSION['uid'] . "  LIMIT 1";
    $res = $db_con->query($query);
    
    return $db_con->fetch_array($res);
}

function getFeaturedImage($project_id) {
    global $db_con;

    $query = 'SELECT * FROM `featured_images` WHERE `project_id` = ' . $project_id;
    $res = $db_con->query($query);

    return $db_con->fetch_array($res);
}

function getFeaturedDescription($project_id) {
    global $db_con;

    $query = 'SELECT * FROM `featured_descriptions` WHERE `project_id` = ' . $project_id;
    $res = $db_con->query($query);

    return $db_con->fetch_array($res);
}

function getProjectCategoryById($category_id) {
    global $db_con;

    $query = 'SELECT `category_name` FROM `project_categories` WHERE `category_id` = ' . $category_id;
    $res = $db_con->query($query);
    $category = $db_con->fetch_array($res);

    return $category['category_name'];
}

function getFeaturingVideo($project_id) {
    global $db_con;

    $query = 'SELECT `file_name` FROM `featured_videos` WHERE `project_id` = ' . $project_id . ' ORDER BY video_id DESC LIMIT 1';
    $res = $db_con->query($query);
    $image = $db_con->fetch_array($res);

    return $image['file_name'];
}

function getFeaturingImage($project_id) {
    global $db_con;

    $query = 'SELECT `file_name` FROM `featured_images` WHERE `project_id` = ' . $project_id . ' ORDER BY image_id DESC LIMIT 1';
    $res = $db_con->query($query);
    $image = $db_con->fetch_array($res);

    return $image['file_name'];
}

function getFeaturingText($project_id) {
    global $db_con;

    $query = 'SELECT `content` FROM `featured_descriptions` WHERE `project_id` = ' . $project_id . ' ORDER BY description_id DESC LIMIT 1';
    $res = $db_con->query($query);
    $category = $db_con->fetch_array($res);

    return $category['content'];
}

function getVideo($project_id) {
    global $db_con;

    $query = 'SELECT `file_name` FROM `videos` WHERE `project_id` = ' . $project_id . ' ORDER BY video_id DESC LIMIT 1';
    $res = $db_con->query($query);
    $image = $db_con->fetch_array($res);

    return $image['file_name'];
}

function getImages($project_id) {
    global $db_con;

    $query = 'SELECT `file_name` FROM `images` WHERE `project_id` = ' . $project_id . ' ORDER BY image_id ASC';

    return $db_con->sql2array($query);
}


function searchProjects($search) {
    global $db_con;

    $query = "SELECT `project_id`, `project_title`, `created_on`, `created_by` FROM `projects` WHERE `status` = 1 AND ( `project_title` LIKE '%".$search."%'  OR `details` LIKE '%".$search."%')  ORDER BY `project_id` DESC";
    
    return $db_con->sql2array($query);
}
//added for searching all ideas 2015-12-16
function searchIdeathreads($search) {
    global $db_con;

    $query = "SELECT `ideathread_id`, `ideathread_title`, `created_on`, `created_by` FROM `ideathreads` WHERE `status` = 'approved' AND ( `ideathread_title` LIKE '%".$search."%'  OR `description` LIKE '%".$search."%')  ORDER BY `ideathread_id` DESC";
    return $db_con->sql2array($query);


}

function getThumbnailImage($ideathread_id) {
    global $db_con;

    $query = 'SELECT `thumbnail_img` FROM `ideathreads` WHERE `ideathread_id` ='.$ideathread_id.'';
    $res =$db_con->query($query);
    $image = $db_con->fetch_array($res);
    return $image['thumbnail_img'];

}
//--------------------
function searchUser($search){
    global $db_con;

    $query = "SELECT `user_id`, `display_name`, `photo`, `location`,`email` FROM `users` WHERE ( `display_name` LIKE '%".$search."%' OR `email` LIKE '%".$search."%' ) ORDER BY `user_id` DESC";

    return $db_con->sql2array($query);
}

//function getAllRecentProjects($id,$limit = '')
function getAllRecentProjects($id) {
    global $db_con;
    $uid = $id;
    $query = 'SELECT `project_id`, `project_title`, `created_on`, `created_by` FROM `projects` WHERE (`status`=1,`created_by` =$uid) ORDER BY `project_id` DESC';

    return $db_con->sql2array($query);
}

function getAllUserProjects($created_by) {
    global $db_con;

    $query = 'SELECT `project_id`, `project_title`, `created_on`,`created_by` FROM `projects` WHERE `created_by`=' . $created_by . ' ORDER BY `project_id` DESC';

    return $db_con->sql2array($query);
}

function getFeaturingItem($project_id) {
    global $db_con;

    $query = 'SELECT `featuring_type`, `featuring_id` FROM `projects` WHERE project_id=' . $project_id;
    $res = $db_con->query($query);
    $featuring = $db_con->fetch_array($res);

    if ($featuring['featuring_type'] == 'post')
        return false;
    else
        return $featuring;
}

function checkRoutedProject($project_id, $user_id) {
    global $db_con;

    $res = $db_con->query("SELECT `project_id` FROM `routed_projects` WHERE `project_id` = " . $project_id . " AND `routed_by` = " . $user_id . " LIMIT 1");

    if ($db_con->fetch_array($res))
        return true;
    return false;
}

function getRoutersForProject($project_id, $user_id){
    global $db_con;

    $res = "SELECT `routed_to`, `router_id` FROM `routed_projects` WHERE `project_id` = ". $project_id. " AND `routed_by` = ".$user_id;

//    $q = 'SELECT * FROM `comments` WHERE `project_id` = ' . $project_id;
//    print_r($db_con->sql2array($res));
    return $db_con->sql2array($res);
}

function AddProjectRouter($project_id, $routed_by, $routed_to) {
    global $db_con;

    $insert = "INSERT INTO `routed_projects`(`project_id`, `routed_by`, `routed_to`)
		VALUES (" . $db_con->escape($project_id) . ", " . $db_con->escape($routed_by) . ", " . $db_con->escape($routed_to) .")";

    $db_con->query($insert);
    return $db_con->insert_id();
}

function RemoveProjectRouter($project_id, $routed_by) {
    global $db_con;

    $q = "DELETE FROM `routed_projects` WHERE `project_id` = " . $project_id . " AND `routed_by` = " . $routed_by;

    $res = $db_con->query($q);

    return $res;
}

function RemoveRouterId($router_id){
    global $db_con;
    $q ="DELETE FROM `routed_projects` WHERE `router_id` = ".$router_id ;
    $res = $db_con->query($q);

    return $res;
}

function checkLikedProject($project_id, $user_id) {
    global $db_con;

    $res = $db_con->query("SELECT `project_id` FROM `liked_projects` WHERE `project_id` = " . $project_id . " AND `liked_by` = " . $user_id . " LIMIT 1");

    if ($db_con->fetch_array($res))
        return true;
    return false;
}

function checkLikedIdea($ideathread_id, $user_id) {

    global $db_con;

    $res = $db_con->query("SELECT `ideathread_id` FROM `liked_ideas` WHERE `ideathread_id` = " . $ideathread_id . " AND `liked_by` = " . $user_id . " LIMIT 1");	
    if ($db_con->fetch_array($res))
        return true;
    return false;
}

function AddProjectLike($project_id, $routed_by) {
    global $db_con;

    $insert = "INSERT INTO `liked_projects`(`project_id`, `liked_by`)
		VALUES (" . $db_con->escape($project_id) . ", " . $db_con->escape($routed_by) . ")";

    $db_con->query($insert);

    return $db_con->insert_id();
}

function AddIdeaLike($ideathread_id, $routed_by) {
    global $db_con;

    $insert = "INSERT INTO `liked_ideas`(`ideathread_id`, `liked_by`)
		VALUES (" . $db_con->escape($ideathread_id) . ", " . $db_con->escape($routed_by) . ")";
		

    $db_con->query($insert);

    return $db_con->insert_id();
}


function RemoveProjectLike($project_id, $routed_by) {
    global $db_con;

    $q = "DELETE FROM `liked_projects` WHERE `project_id` = " . $project_id . " AND `liked_by` = " . $routed_by;

    $res = $db_con->query($q);

    return $res;
}

function RemoveIdeaLike($ideathread_id, $routed_by) {
    global $db_con;

    $q = "DELETE FROM `liked_ideas` WHERE `ideathread_id` = " . $ideathread_id . " AND `liked_by` = " . $routed_by;

    $res = $db_con->query($q);

    return $res;
}


function loadProjects($term) {
    global $db_con;

    $qstring = "SELECT `project_title`, `project_id` FROM `projects` WHERE `project_title` LIKE '%" . $term . "%' AND `created_by` = " . $_SESSION['uid'];
    $result = $db_con->query($qstring); //query the database for entries containing the term

    while ($row = $db_con->fetch_array($result, MYSQL_ASSOC)) {//loop through the retrieved values
        $row['value'] = $db_con->escape($row['project_title']);
        $row['id'] = (int) $row['project_id'];
        $row_set[] = $row; //build an array
    }

    echo json_encode($row_set); //format the array into json data
}

function getCountries() {
    global $db_con;

    $query = 'SELECT * FROM `countries`';

    return $db_con->sql2array($query);
}

function createCampaign($data) {
    global $db_con;
    
    $type = $data['thematic_type'];
    
    if (empty($type))
        $type = 'video';
    
    $query = "INSERT INTO `advertisement` SET
			 `project_id` = " . $data['project_id'] . ",
			 `thematic_id` = " . $data['thematic_post'][0] . ",
			 `thematic_type` = '" . $type . "',
			 `headline` = '" . $db_con->escape($data['headline']) . "',
			 `slogan` = '" . $db_con->escape($data['slogan']) . "',
			 `territory` = '" . implode(',', $data['country']) . "',
			 `age_min` = '" . $data['min_age'] . "',
			 `age_max` = '" . $data['max_age'] . "',
			 `gender` = '" . $data['gender'] . "',
			 `currency` = '" . $data['currency'] . "',
			 `amount` = " . $db_con->escape($data['amount']) . ",
			 `time` = " . $data['time'] . ",
			 `schedule` = " . $data['schedule'] . ",
			 `link` = '" . $db_con->escape($data['link']) . "',
                          `created_by` = ".$_SESSION['uid'];

    return $db_con->query($query);
}


function editCampaign($data, $id) {
    global $db_con;
    
    $type = $data['thematic_type'];
    
    if (empty($type))
        $type = 'video';
    
    $query = "UPDATE `advertisement` SET
			 
			 `thematic_type` = '" . $type . "',
			 `headline` = '" . $db_con->escape($data['headline']) . "',
			 `slogan` = '" . $db_con->escape($data['slogan']) . "',
			 `territory` = '" . implode(',', $data['country']) . "',
			 `age_min` = '" . $data['min_age'] . "',
			 `age_max` = '" . $data['max_age'] . "',
			 `gender` = '" . $data['gender'] . "',
			 `currency` = '" . $data['currency'] . "',
			 `amount` = " . $db_con->escape($data['amount']) . ",
			 `time` = " . $data['time'] . ",
			 `schedule` = " . $data['schedule'] . ",
			 `link` = '" . $db_con->escape($data['link']) . "' 
                             WHERE `ad_id` = ". $id;
                                 
    return $db_con->query($query);
}

function getUserRateForProject($project_id, $user_id) {
    global $db_con;

    $query = 'SELECT `value` FROM `rating` WHERE `project_id` = ' . $project_id . ' AND `user_id` = ' . $user_id;

    $res = $db_con->query($query);



    $rate = $db_con->fetch_array($res);

    if (!isset($rate))
        return false;
    return $rate['value'];
}

function rateProject($project_id, $user_id, $value) {
    global $db_con;
    $rate = getUserRateForProject($project_id, $user_id);
    if (!isset($rate)) {
        $query = 'INSERT INTO `rating` SET
				  `project_id` = ' . $project_id . ',
				  `user_id` = ' . $user_id . ',
				  `value` = ' . $value . '
				  ';
    } else {
        $query = 'UPDATE `rating` SET `value` = ' . $value . ' WHERE `project_id` = ' . $project_id . ' AND `user_id` = ' . $user_id;
    }

    $id = $db_con->query($query);
    
    $query = 'UPDATE `projects` SET `avr_rating` = (SELECT AVG(value) FROM `rating` WHERE `project_id` = '.$project_id.') WHERE `project_id` = '.$project_id;
    $db_con->query($query);

    return $id;
}

function getRating($project_id) {
    global $db_con;

    $q = 'SELECT AVG(value) as r FROM `rating` WHERE `project_id` = ' . $project_id;
    $res = $db_con->query($q);
    $rate = $db_con->fetch_array($res);

    return $rate['r'];
}

function addComment($project_id, $user_id, $text) {
    global $db_con;

    $q = "INSERT INTO `comments` SET
		  `project_id` = " . $project_id . ",
		  `created_by` = " . $user_id . ",
		  `text` = '" . $text . "'
		  ";

    return $res = $db_con->query($q);
}

function addIdeaComment($ideathread_id, $user_id, $text) {
    global $db_con;

    $q = "INSERT INTO `ideathread_comments` SET
		  `ideathread_id` = " . $ideathread_id . ",
		  `created_by` = " . $user_id . ",
		  `text` = '" . $text . "'
		  ";

    return $res = $db_con->query($q);
}

function countComments($project_id){
	global $db_con;

    	$q = 'SELECT COUNT(`comment_id`) as c  FROM `comments` WHERE `project_id` = ' . $project_id;
    	$res = $db_con->query($q);
    $comments = $db_con->fetch_array($res);

    $comments_count = $comments['c'];
    return $comments_count;

}

function countIdeaComments($ideathread_id){
	global $db_con;

    	$q = 'SELECT COUNT(`comment_id`) as c  FROM `ideathread_comments` WHERE `ideathread_id` = ' . $ideathread_id;
    	$res = $db_con->query($q);
    $comments = $db_con->fetch_array($res);

    $comments_count = $comments['c'];
    if($comments_count > 0)
    	return $comments_count;
    else return '';

}

function getLikes($project_id) {
    global $db_con;

    $q = 'SELECT COUNT(`like_id`) as c FROM `liked_projects` WHERE `project_id` = ' . $project_id;
    $res = $db_con->query($q);
    $likes = $db_con->fetch_array($res);

    $likes_count = $likes['c'];

    $qs = 'SELECT COUNT(`like_id`) as ac FROM `liked_projects` WHERE `project_id` = ' . $project_id . ' AND `liked_by` = ' . $_SESSION['uid'];
    $result = $db_con->query($qs);
    $own_likes = $db_con->fetch_array($result);

    $own_likes_count = $own_likes['ac'];
    
    

    // if ($own_likes_count == $likes_count && $likes_count == 1)
       // return 'You like this project';
    // else if ($own_likes_count == 0 && $likes_count == 1)
       //  return '1 like';
    // else if ($own_likes_count == 0 && $likes_count > 1)
       // return $likes_count . ' likes';
    // else if ($own_likes_count == 1 && $likes_count > 1)
      // { 
       // $likesSub = $likes_count - 1;
       // return 'You and '.$likesSub . ' others liked this';
      // }
    // else
       //  return 'No likes';
       
       if($likes_count == 0){
        return '';
    }
    else
        return $likes_count;
}

function getIdeaLikes($ideathread_id) {
    global $db_con;

    $q = 'SELECT COUNT(`like_id`) as c FROM `liked_ideas` WHERE `ideathread_id` = ' . $ideathread_id;
    $res = $db_con->query($q);
    
    $likes = $db_con->fetch_array($res);

    $likes_count = $likes['c'];

    //$qs = 'SELECT COUNT(`like_id`) as ac FROM `liked_ideas` WHERE `ideathread_id` = ' . $ideathread_id . ' AND `liked_by` = ' . $_SESSION['uid'];
    //$result = $db_con->query($qs);
    //$own_likes = $db_con->fetch_array($result);

    //$own_likes_count = $own_likes['ac'];
    
    

    // if ($own_likes_count == $likes_count && $likes_count == 1)
       // return 'You like this project';
    // else if ($own_likes_count == 0 && $likes_count == 1)
       //  return '1 like';
    // else if ($own_likes_count == 0 && $likes_count > 1)
       // return $likes_count . ' likes';
    // else if ($own_likes_count == 1 && $likes_count > 1)
      // { 
       // $likesSub = $likes_count - 1;
       // return 'You and '.$likesSub . ' others liked this';
      // }
    // else
       //  return 'No likes';
       
       if($likes_count == 0){
        return '';
    }
    else
        return $likes_count;
}



function getComments($project_id) {
    global $db_con;

    $q = 'SELECT * FROM `comments` WHERE `project_id` = ' . $project_id;

    return $db_con->sql2array($q);
}

function getIdeaComments($ideathread_id) {
    global $db_con;

    $q = 'SELECT * FROM `ideathread_comments` WHERE `ideathread_id` = ' . $ideathread_id;
    
    $a = $db_con->sql2array($q);

    return $a;
}

function reportProject($project_id, $copyright, $spam, $violent, $abusive, $impersonation, $harassment) {
    $project = getProjectById($project_id);

    $mail_header = "MIME-Version: 1.0\r\n";
    $mail_header.= "Content-type: text/html; charset=UTF-8\r\n";
    $mail_header.= "From: Rangeenroute <from@rangeen.com>\r\n";
    $mail_header.= "Reply-to: Rangeenroute <reply@rangeen.com>\r\n";

    $recipient = 'isvetlichniy@gmail.com';
    $subject = 'Project Issue Reported';
    $message = 'Project <a href="' . SITE_URL . '/home.php?pid=' . $project['project_id'] . '">' . $project['project_title'] . '</a> has issue related to:';

    if ($copyright == 'true')
        $message.= '<br>Copyright/Privacy/Legal infringement';
    if ($spam == 'true')
        $message.= '<br>Spam/Deceptive';
    if ($violent == 'true')
        $message.= '<br>Violent';
    if ($abusive == 'true')
        $message.= '<br>Abusive';
    if ($impersonation == 'true')
        $message.= '<br>Impersonation';
    if ($harassment == 'true')
        $message.= '<br>Harassment';

    $message = '<html><body><p align="left">' . $message . '</p></body></html>';

    mail($recipient, $subject, $message, $mail_header);
    mail('dahal004@umn.edu', $subject, $message, $mail_header);
}

function deleteComment($comment_id) {
    global $db_con;

    $q = 'DELETE FROM `comments` WHERE `comment_id` = ' . $comment_id;

    $db_con->query($q);
}

function deleteIdeaComment($comment_id) {
    global $db_con;

    $q = 'DELETE FROM `ideathread_comments` WHERE `comment_id` = ' . $comment_id;

    $db_con->query($q);
}

function sendReport($data) {

    $options = $data['report_items'];

    $mail_header = "MIME-Version: 1.0\r\n";
    $mail_header.= "Content-type: text/html; charset=UTF-8\r\n";
    $mail_header.= "From: Rangeenroute <from@rangeen.com>\r\n";
    $mail_header.= "Reply-to: Rangeenroute <reply@rangeen.com>\r\n";

    $recipient = 'isvetlichniy@gmail.com';
    $subject = 'System Issue Reported';
    $message = '<b>Reports</b>';

    if (@in_array('profile', $options) && !empty($data['profile-report-text'])) {
        $message.= '<br>Report section: Profile';
        $message.= '<br>Description: ' . $data['profile-report-text'] . '<br>';
    }

    if (@in_array('project', $options) && !empty($data['project-report-text'])) {
        $message.= '<br>Report section: Project';
        $message.= '<br>Description: ' . $data['project-report-text'] . '<br>';
    }

    if (@in_array('router', $options) && !empty($data['route-report-text'])) {
        $message.= '<br>Report section: Router';
        $message.= '<br>Description: ' . $data['router-report-text'] . '<br>';
    }

    if (@in_array('finance', $options) && !empty($data['finance-report-text'])) {
        $message.= '<br>Report section: Finance';
        $message.= '<br>Description: ' . $data['finance-report-text'] . '<br>';
    }

    if (@in_array('store', $options) && !empty($data['store-report-text'])) {
        $message.= '<br>Report section: Store';
        $message.= '<br>Description: ' . $data['store-report-text'] . '<br>';
    }

    if (@in_array('settings', $options) && !empty($data['settings-report-text'])) {
        $message.= '<br>Report section: Settings';
        $message.= '<br>Description: ' . $data['settings-report-text'] . '<br>';
    }

    $message = '<html><body><p align="left">' . $message . '</p></body></html>';

    mail($recipient, $subject, $message, $mail_header);
    mail('dahal004@umn.edu', $subject, $message, $mail_header);
}


function getProjectTitle($project_id) {
      global $db_con;

    $q = 'SELECT `project_title` FROM `projects` WHERE `project_id` = ' . $project_id;
    $res = $db_con->query($q);
    $project = $db_con->fetch_array($res);

    return $project['project_title'];

}

function getIdeaTitle($ideathread_id) {
      global $db_con;

    $q = 'SELECT `ideathread_title` FROM `ideathreads` WHERE `ideathread_id` = ' . $ideathread_id;
    $res = $db_con->query($q);
    $ideathread = $db_con->fetch_array($res);

    return $ideathread['ideathread_title'];

}

function getProjectAuthor($project_id) {
      global $db_con;

    $q = 'SELECT `created_by` FROM `projects` WHERE `project_id` = ' . $project_id;
    $res = $db_con->query($q);
    $project = $db_con->fetch_array($res);

    return $project['created_by'];

}

function getIdeaAuthor($ideathread_id) {
      global $db_con;

    $q = 'SELECT `created_by` FROM `ideathreads` WHERE `ideathread_id` = ' . $ideathread_id;
    $res = $db_con->query($q);
    $ideathread = $db_con->fetch_array($res);

    return $ideathread['created_by'];

}


function getRoutedProjects($user_id) {
    global $db_con;

    $q = 'SELECT `project_id` FROM `routed_projects` WHERE `routed_by` = ' . $user_id;

    return $db_con->sql2array($q);
}


function getCommentedProjects($user_id) {
    global $db_con;

    $q = 'SELECT DISTINCT `project_id` FROM `comments` WHERE `created_by` = ' . $user_id;

    return $db_con->sql2array($q);
}


function getLikedProjects($user_id) {
    global $db_con;

    $q = 'SELECT `project_id` FROM `liked_projects` WHERE `liked_by` = ' . $user_id;

    return $db_con->sql2array($q);
}

function getRatedProjects($user_id) {
    global $db_con;

    $q = 'SELECT `project_id` FROM `rating` WHERE `user_id` = ' . $user_id;

    return $db_con->sql2array($q);
}



function getAllActivityProjects ($user_id) {
    global $db_con;
    
    $query = "SELECT `project_id`, `created_on` FROM `projects` WHERE `created_by` = ".$user_id."
    UNION DISTINCT 
    SELECT `project_id`, `created_on` FROM `liked_projects` WHERE `liked_by` = ".$user_id."
    UNION DISTINCT 
    SELECT `project_id`, `created_on` FROM `routed_projects` WHERE `routed_by` = ".$user_id."
    UNION DISTINCT 
    SELECT `project_id`, `created_on` FROM `comments` WHERE `created_by` = ".$user_id."    
    ORDER BY `created_on` DESC";

    //$query = "CONCAT(SELECT `project_id`, `created_on` FROM `projects` WHERE `created_by` = ".$user_id.", 'created')
    ///UNION DISTINCT 
    //CONCAT(SELECT `project_id`, `created_on` FROM `liked_projects` WHERE `liked_by` = ".$user_id.", 'liked')
    //UNION DISTINCT 
    //CONCAT(SELECT `project_id`, `created_on` FROM `routed_projects` WHERE `routed_by` = ".$user_id.", 'routed')
    //UNION DISTINCT 
    //CONCAT(SELECT `project_id`, `created_on` FROM `comments` WHERE `created_by` = ".$user_id.", 'commented')    
    //ORDER BY `created_on` DESC";

    return $db_con->sql2array($query);
}

function getAllRoutersProjects($user_id) {
   global $db_con;
   
   $query = 'SELECT projects.* FROM  `projects` LEFT JOIN `routers` ON projects.created_by = routers.user_id WHERE routers.routed_by = '.$user_id.'  ORDER BY projects.created_on DESC';
   
   return $db_con->sql2array($query);
}


function checkSuggestion($project_id, $sent_to, $sent_by) {
    global $db_con;
    
    $query = 'SELECT `project_id` FROM `suggestions` WHERE `project_id` = '.$project_id.' AND `sent_to` = '.$sent_to.' AND `sent_by` = '.$sent_by;
    
    $res = $db_con->query($query);
    $project = $db_con->fetch_array($res);
    
    if ($project) return true;
    
    return false;
}

function addSuggestion($project_id, $sent_to, $sent_by) {
    global $db_con;
    
    $query = 'INSERT INTO `suggestions` SET `project_id` = '.$project_id.', `sent_to` = '.$sent_to.', `sent_by` = '.$_SESSION['uid'];    
    $db_con->query($query);    
}

function deleteSuggestion($project_id, $sent_to, $sent_by) {
    global $db_con;
    
    $query = 'DELETE FROM `suggestions` WHERE `project_id` = '.$project_id.' AND `sent_to` = '.$sent_to.' AND `sent_by` = '.$sent_by;    
    $db_con->query($query);    
}

function getAllSuggestedProjects($user_id) {
   global $db_con;
   
   $query = 'SELECT projects.* FROM  `projects` LEFT JOIN `suggestions` ON projects.project_id = suggestions.project_id WHERE suggestions.sent_to = '.$user_id.'  ORDER BY suggestions.created_on DESC';
   
   return $db_con->sql2array($query);
}


function getRankForProject($project_id) {
   require_once(DIR_INCLUDE . 'libs/php-ranker-master/Ranker.php');
   
    global $db_con;
    
    $query = 'SELECT `project_id`, `project_title`, `avr_rating` FROM `projects`';
    $res = $db_con->query($query);     
   
    $objectsToRank = array();    
    while($projects = $db_con->fetch_object($res))            
        $objectsToRank[] = (object)$projects;

            
   $ranker = new Ranker();
   $ranker
   ->useStrategy('competition')      // Use the dense ranking strategy
   ->orderBy('avr_rating')         // Property to base ranking on, Default is 'score'
   ->storeRankingIn('ranked')  // Default is 'ranking'
   ->rank($objectsToRank);  

    //print_r($objectsToRank);
   
   foreach($objectsToRank as $obj) {
       $id = $obj->project_id;
       if ($id == $project_id) {           
           if (empty($obj->ranked)) 
               return 'N/A';
           else 
               return $obj->ranked;
       }
   }
  
   return 'N/A';
}


function search($array, $key, $value)
{
    $results = array();
    search_r($array, $key, $value, $results);
    return $results;
}

function search_r($array, $key, $value, &$results)
{
    if (!is_array($array)) {
        return;
    }

    if (isset($array[$key]) && $array[$key] == $value) {
        $results[] = $array;
    }

    foreach ($array as $subarray) {
        search_r($subarray, $key, $value, $results);
    }
}

function getLikesCount($project_id) {
    global $db_con;
    
    $query = 'SELECT COUNT(project_id) as c FROM `liked_projects` WHERE `project_id` ='.$project_id;
    $res = $db_con->query($query);
    $project = $db_con->fetch_array($res);
    
    return $project['c'];
}

function getCommentsCount($project_id) {
    global $db_con;
    
    $query = 'SELECT COUNT(project_id) as c FROM `comments` WHERE `project_id` ='.$project_id;
    $res = $db_con->query($query);
    $project = $db_con->fetch_array($res);
    
    return $project['c'];
}

function getIdeaCommentsCount($ideathread_id) {
    global $db_con;
    
    $query = 'SELECT COUNT(ideathread_id) as c FROM `ideacomments` WHERE `ideathread_id` ='.$ideathread_id;
    $res = $db_con->query($query);
    $project = $db_con->fetch_array($res);
    
    return $project['c'];
}



/*rating functions*/

function getScroreForProject($project_id) {
    global $db_con;
    $query = 'SELECT * FROM `seed_rating_score` WHERE `project_id` = '.$project_id;
    $res = $db_con->query($query);
    
    return $db_con->fetch_array($res);
}

function calculate_median($arr) {
    sort($arr);
    $count = count($arr); //total numbers in array
    $middleval = floor(($count-1)/2); // find the middle value, or the lowest middle value
    if($count % 2) { // odd number, middle is the median
        $median = $arr[$middleval];
    } else { // even number, calculate avg of 2 medians
        $low = $arr[$middleval];
        $high = $arr[$middleval+1];
        $median = (($low+$high)/2);
    }
    return $median;
}

function calculate_mr($project_id) {
   $score = getScroreForProject($project_id);
   
   if (!$score)
       return 'N/A';
   
   //if (in_array(''))
   
   $feasibility = explode(',', $score['feasibility']);
   $uniqueness = explode(',', $score['uniqueness']);
   $growth_quality = explode(',', $score['growth_quality']);
   $startup_easeness = explode(',', $score['startup_easeness']);
   $process_clarity = explode(',', $score['process_clarity']);
   $risk_factor = explode(',', $score['risk_factor']);
   $time_consumption = explode(',', $score['time_consumption']);
   $redundancy_featured = explode(',', $score['redundancy_featured']);
   $impact = explode(',', $score['impact']);
   $profile = explode(',', $score['profile']);
   
   $means = array();
   for($i = 0; $i < 5; $i++){
       $means[] = ($feasibility[$i] + $uniqueness[$i] + $growth_quality[$i] + $startup_easeness[$i] + $process_clarity[$i] + $risk_factor[$i] + $time_consumption[$i] + $redundancy_featured[$i] + $impact[$i] + $profile[$i]) / 10;
   }
   
   if ($means[0] < 0 || $means[1] < 0 || $means[2] < 0 || $means[3] < 0 || $means[4] < 0 )
       return 'N/A';
   
   return round(array_sum($means) / 5, 2);
}

function getTotalRatingsForProject($project_id) {
    global $db_con;
    
    $query = 'SELECT COUNT(project_id) as c FROM `rating` WHERE `project_id` ='.$project_id;
    $res = $db_con->query($query);
    $project = $db_con->fetch_array($res);
    
    return $project['c'];
}


function getTotalRatingVaueForProject($project_id) {
    global $db_con;
    
    $query = 'SELECT SUM(value) as c FROM `rating` WHERE `project_id` ='.$project_id;
    $res = $db_con->query($query);
    $project = $db_con->fetch_array($res);
    
    return round($project['c'], 2);
}


function getTotalRatings() {
    global $db_con;
    
    $query = 'SELECT SUM(value) as c FROM `rating`';
    $res = $db_con->query($query);
    $project = $db_con->fetch_array($res);
    
    return $project['c'];
}


function calculateRating($project_id) {
    global $db_con;
    
    $query = 'SELECT `project_id` FROM `projects`';
    $projects = $db_con->sql2array($query);
    
    $rates = array();        
    foreach( $projects as $project) {
      $rates[] = getTotalRatingsForProject($project['project_id']);  
    }
    
   $mn = calculate_median($rates);
   
   $project_count = count($projects);   
   $m = round((getTotalRatings() / $project_count), 3);
      
   $mr = calculate_mr($project_id);
   
   $nr = getTotalRatingVaueForProject($project_id);
   
   if ($mr == 'N/A')
       return $mr;
   
   return @round((($m * $mn + $nr * $mr)/($mn + $nr)), 2);
   
}


function getPercentLineForRating($project_id, $start, $end) {
    global $db_con;
    
    $query = 'SELECT COUNT(rate_id) as c FROM `rating` WHERE `project_id` = '.$project_id.' AND (`value` > '.$start.' AND `value` <='.$end.')';
    
    $res = $db_con->query($query);
    $project = $db_con->fetch_array($res);
    
    $count = $project['c'];
    
    $total = getTotalRatingsForProject($project_id);
    
    return round(($count * 100 / $total), 2);
}


function getPercentLineGender($project_id, $gender) {
    global $db_con;
    
    $query = 'SELECT COUNT(rating.rate_id) as c FROM `rating` LEFT JOIN `users` ON rating.user_id = users.user_id WHERE rating.project_id = '.$project_id.' AND users.gender = '.$gender;
    
    $res = $db_con->query($query);
    $project = $db_con->fetch_array($res);
    
    $count = $project['c'];
    
    $total = getTotalRatingsForProject($project_id);
    
    return round(($count * 100 / $total), 2);
}


function getRatingGender($project_id, $gender) {
    global $db_con;
    
    $query = 'SELECT SUM(rating.value) as c FROM `rating` LEFT JOIN `users` ON rating.user_id = users.user_id WHERE rating.project_id = '.$project_id.' AND users.gender = '.$gender;
    
    $res = $db_con->query($query);
    $project = $db_con->fetch_array($res);
    
    $count = $project['c'];       
    
    
    $query = 'SELECT COUNT(rating.rate_id) as c FROM `rating` LEFT JOIN `users` ON rating.user_id = users.user_id WHERE rating.project_id = '.$project_id.' AND users.gender = '.$gender;
    
    $res = $db_con->query($query);
    $project = $db_con->fetch_array($res);
    
    $count2 = $project['c'];
    
    
    return round($count / $count2, 2);
}


function getPercentLineAge($project_id, $age_start, $age_end) {
    global $db_con;
    
    $query = 'SELECT COUNT(rating.rate_id) as c FROM `rating` LEFT JOIN `users` ON rating.user_id = users.user_id WHERE rating.project_id = '.$project_id.' AND (users.birthday <= now() - INTERVAL '.$age_start.' YEAR AND users.birthday > now() - INTERVAL '.$age_end.' YEAR)';
    
    $res = $db_con->query($query);
    $project = $db_con->fetch_array($res);
    
    $count = $project['c'];
    
    $total = getTotalRatingsForProject($project_id);
    
    return round(($count * 100 / $total), 2);
}


function getRatingAge($project_id, $age_start, $age_end) {
    global $db_con;
    
    $query = 'SELECT SUM(rating.value) as c FROM `rating` LEFT JOIN `users` ON rating.user_id = users.user_id WHERE rating.project_id = '.$project_id.' AND (users.birthday <= now() - INTERVAL '.$age_start.' YEAR AND users.birthday > now() - INTERVAL '.$age_end.' YEAR)';
    
    $res = $db_con->query($query);
    $project = $db_con->fetch_array($res);
    
    $count = $project['c'];   
    
    
    $query = 'SELECT COUNT(rating.rate_id) as c FROM `rating` LEFT JOIN `users` ON rating.user_id = users.user_id WHERE rating.project_id = '.$project_id.' AND (users.birthday <= now() - INTERVAL '.$age_start.' YEAR AND users.birthday > now() - INTERVAL '.$age_end.' YEAR)';
    
    $res = $db_con->query($query);
    $project = $db_con->fetch_array($res);
    
    $count2 = $project['c'];
    
    return round(($count / $count2), 2);
}


function generalRatingData($project_id) {
    
    return round((getTotalRatingVaueForProject($project_id) / getTotalRatingsForProject($project_id)), 2);
}


function calculateTrendForProject($project_id) {
    global $db_con;
    
    $project =  getProjectById($project_id);
    
    $likes = getLikesCount($project_id);
    $ratings = getTotalRatingsForProject($project_id);
    
    /*Like + Rating*/
    $j = ($likes + $ratings) - 2;
    
    
    /*comments*/
    $comments = getCommentsCount($project_id); 
    
    $query = 'SELECT DISTINCT(created_by) FROM `comments` WHERE `project_id` = '.$project_id;
    $unique_commenter = count($db_con->sql2array($query));
    
    $k = $unique_commenter / $comments ; 
    
    /*Route*/
    $query = 'SELECT `routed_by` FROM `routed_projects` WHERE `project_id` = '.$project_id;
    $users1 = count($db_con->sql2array($query));
    
    $query = 'SELECT `project_id` FROM `suggestions` WHERE `project_id` = '.$project_id;
    $users2 = count($db_con->sql2array($query));
    
    $users = $users1 + $users2; 
    
     $query = 'SELECT DISTINCT(`sent_to`) FROM `suggestions` WHERE `project_id` = '.$project_id;
     $routers1 = count($db_con->sql2array($query));
     
     $routers = $users1 + $routers1;
    
     $l = $users / $routers;
     
     
     /*Time period*/
     /*Functional period */
     $contant = strtotime('2015-03-01');
     $m = strtotime($project['created_on']) - $contant;
     
     /*Event period*/
     $n = time() - strtotime($project['created_on']);
     
     
     /*Raw score*/
     $r = $j * $k * $l;
     if (abs($r) >=  1) $r = abs($r);
     else $r = 1; 
     
     
     /*Trending score*/
     $update_cycle = 11 * 60 * 60;
     $events = $likes + $ratings; 
     
     $t = ($m/$update_cycle) * ($events / $n) * log($r);
     
     return $t;
     
}

function checkProjectInTrend($project_id) {
    global $db_con;
    
    $query = 'SELECT `project_id` FROM `trend` WHERE `project_id` = '.$project_id;
    $res = $db_con->query($query);
    if(!$db_con->fetch_array($res))
        return false;
    
    return true;
    
}

function getTrendCycle($project_id) {
    global $db_con;
    
    $query = 'SELECT `cycle` FROM `trend` WHERE `project_id` = '.$project_id;
    $res = $db_con->query($query);
    $cycle = $db_con->fetch_array($res);
        return $cycle['cycle'];
}



function stats_standard_deviation(array $a, $sample = false) {
        $n = count($a);
        if ($n === 0) {
            trigger_error("The array has zero elements", E_USER_WARNING);
            return false;
        }
        if ($sample && $n === 1) {
            trigger_error("The array has only 1 element", E_USER_WARNING);
            return false;
        }
        $mean = array_sum($a) / $n;
        $carry = 0.0;
        foreach ($a as $val) {
            $d = ((double) $val) - $mean;
            $carry += $d * $d;
        };
        if ($sample) {
           --$n;
        }
        return sqrt($carry / $n);
    }
    
    
function Corr($x, $y){

$length= count($x);
$mean1=array_sum($x) / $length;
$mean2=array_sum($y) / $length;

$a=0;
$b=0;
$axb=0;
$a2=0;
$b2=0;

for($i=0;$i<$length;$i++)
{
$a=$x[$i]-$mean1;
$b=$y[$i]-$mean2;
$axb=$axb+($a*$b);
$a2=$a2+ pow($a,2);
$b2=$b2+ pow($b,2);
}

$corr= $axb / sqrt($a2*$b2);

return $corr;
}


function getTrendsArray($project_id) {
    global $db_con;
    
    $res_array = array();
    
    $query = 'SELECT h1, h2, h3, h4, h5, h6, h7, h8, h9, h10, h11 FROM `trend` WHERE project_id = '.$project_id;
    $res = $db_con->query($query);
    $array = $db_con->fetch_array($res);
    
    $res_array[] = $array['h1'];
    $res_array[] = $array['h2'];
    $res_array[] = $array['h3'];
    $res_array[] = $array['h4'];
    $res_array[] = $array['h5'];
    $res_array[] = $array['h6'];
    $res_array[] = $array['h7'];
    $res_array[] = $array['h8'];
    $res_array[] = $array['h9'];
    $res_array[] = $array['h10'];
    $res_array[] = $array['h11'];
    
    return $res_array;
}


function getTrendsTimeArray($project_id) {
    global $db_con;
    
    $res_array = array();
    
    $query = 'SELECT h1_time, h2_time, h3_time, h4_time, h5_time, h6_time, h7_time, h8_time, h9_time, h10_time, h11_time FROM `trend` WHERE project_id = '.$project_id;
    $res = $db_con->query($query);
    $array = $db_con->fetch_array($res);
    
    $res_array[] = $array['h1_time'];
    $res_array[] = $array['h2_time'];
    $res_array[] = $array['h3_time'];
    $res_array[] = $array['h4_time'];
    $res_array[] = $array['h5_time'];
    $res_array[] = $array['h6_time'];
    $res_array[] = $array['h7_time'];
    $res_array[] = $array['h8_time'];
    $res_array[] = $array['h9_time'];
    $res_array[] = $array['h10_time'];
    $res_array[] = $array['h11_time'];
    
    return $res_array;
}


function calculateRegression($project_id, $time, $trend_value) {
            
    $trends = getTrendsTimeArray($project_id);
    $times = getTrendsTimeArray($project_id);
    
    $sx = stats_standard_deviation($times);
    $sy = stats_standard_deviation($trends);
    
    //$r = Corr($x, $y);//removed to check error can be uncomment later.
    $r = 2;//random value need to remove
    $b = $r * ($sy / $sx);
    
    $a = $trend_value - $b * $time;
    
    return $b * $time + $a;
}


function getProjectsInTrend() {
    global $db_con;
    
    /* $query = 'SELECT `project_id` FROM `trend` WHERE `h11` >= `r11` AND h11 <> 0 ORDER BY h11 DESC'; */
    $query = 'SELECT `project_id` FROM `trend` WHERE `h1` >= `r1` ';
    
    return $db_con->sql2array($query);
}



function getCampaigns($user_id) {
    global $db_con;
    
    $query = 'SELECT * FROM `advertisement` WHERE `created_by` = '.$user_id; 
    
    return $db_con->sql2array($query);
}


function getAdThematic($type, $id) {
    global $db_con;
    
    if ($type == 'video')
        return '<img alt="" src="images/video_preview'.$id.'.jpg">';
    
    else if ($type == 'description'){
        $query = 'SELECT * FROM `featured_descriptions` WHERE `description_id` = '.$id;    
        $res = $db_con->query($query);
        $description = $db_con->fetch_array($res);
        
        return '<label class="post_description" style="width: 206px;">'.substr($description['content'], 0, 200).'</label>';
    }
    
    else if ($type == 'image'){
        $query = 'SELECT * FROM `featured_images` WHERE `image_id` = '.$id;    
        $res = $db_con->query($query);
        $description = $db_con->fetch_array($res);
        
        return '<img alt="" src='.SITE_URL.'"/uploads/images/thumbs/01092013046'.$description['file_name'].'">';
    }
}


function getAllRecentProjectsWithFilter($data) {
    global $db_con;       
    
    $search_str = '';
    
    if (isset($data['project_category']) && $data['project_category'] != -1 )
        $search_str.= ' AND `project_category` = '.$data['project_category'];
    
    if (isset($data['search_rating']) && $data['search_rating'] != -1)
        $search_str.= ' AND (`avr_rating` >= '.$data['search_rating'].' AND `avr_rating` < '.($data['search_rating']+1).')';
    
    if (isset($data['search_sort']) &&  $data['search_sort'] != -1) {
        if ($data['search_sort'] == 1)
            $order = 'ORDER BY `project_id` DESC';
        else if ($data['search_sort'] == 2)
            $order = 'ORDER BY `project_title` ASC'; 
        else if ($data['search_sort'] == 3)
            $order = 'ORDER BY `avr_rating` ASC'; 
            
    }
    else 
        $order = 'ORDER BY `project_id` ASC';

    $query = 'SELECT `project_id`, `project_title`, `created_on`, `created_by` FROM `projects` WHERE `status` = 1 '.$search_str.' '.$order;

    return $db_con->sql2array($query);
}

function getConnectedProjects($user_id) {
    global $db_con;
    
    $query = 'SELECT `project_id` FROM `routed_projects` WHERE `routed_by` = '.$user_id;
    
    return $db_con->sql2array($query);
}

function deleteAd($ad_id) {
    global $db_con;
    
    $query = 'DELETE FROM `advertisement` WHERE `ad_id` = '.$ad_id;
    
    $db_con->query($query);
}

function startAd($ad_id, $status) {
    global $db_con;
    
    if ($status == 0)
        $new_status = 1;
    else
        $new_status = 0;
    
    $query = 'UPDATE `advertisement` SET `status` = '.$new_status.' WHERE `ad_id` = '.$ad_id;
    
    $db_con->query($query);
}


function getCampaign($id) {
    global $db_con;
    
     $query = 'SELECT * FROM `advertisement` WHERE `ad_id` = '.$id;    
     $res = $db_con->query($query);
     
     return $db_con->fetch_array($res);
}


function checkMonetize($project_id) {
    global $db_con;
    
    $project = getProjectById($project_id);
    
    $query = "SELECT `project_id` FROM `payments` WHERE `type` = 'Royalty' AND `created_by` = ".$_SESSION['uid']." AND `project_id` = ".$project_id;
    $res = $db_con->query($query);
    $txn = $db_con->fetch_array($res);
    
    $monetize = intval($project['monetize']);
    if ($monetize > 0 && !$txn && $project['created_by'] != $_SESSION['uid'])         
        return true;
    
    else         
        return false;    
}

function getDevelopers($project_id){
    global $db_con;
    
     $query = 'SELECT * FROM `assigned_developers` WHERE `project_id` = '.$project_id;    
     $res = $db_con->query($query);
     
     return $db_con->fetch_array($res);
}

function getIdeas($user){
	global $db_con;

	if($user =='all'){
	$query = "SELECT * FROM `ideathreads` WHERE `status` = 'approved' ORDER BY `interactions` DESC LIMIT 0 ,10";
    	 $a = $db_con->sql2array($query);
	}
//    else if($user='count') {
//        $q = "SELECT COUNT(`ideathread_id`) as c FROM `ideathreads`";
//        $res = $db_con->query($q);
//
//        $notifs = $db_con->fetch_array($res);
//
//        $notifs_count = $notifs['c'];
//
//        if ($notifs_count == 0)
//            return '';
//        else
//            return $notifs_count;
//    }
    else{
        //$query = "SELECT * FROM `ideathreads` WHERE `created_by` = '" .$user. "'";
        $use =$user;
        $query = "SELECT * FROM `ideathreads` WHERE (`created_by` = $use)";
        $a = $db_con->sql2array($query);
    }

     return $a;
}

function getIdeaById($ideathread_id) {
    global $db_con;

    $res = $db_con->query("SELECT * FROM `ideathreads` WHERE `ideathread_id` = " . $ideathread_id . " LIMIT 1");

    return $db_con->fetch_array($res);
}

function deleteIdea($ideathread_id){
	global $db_con;
	$query = 'DELETE FROM `ideathreads` WHERE `ideathread_id` = '.$ideathread_id;
    
    	return $db_con->query($query);
	
}

function plusInteraction($ideathread_id){
	global $db_con;
	
	$res = $db_con->query("SELECT `interactions` FROM `ideathreads` WHERE `ideathread_id` = " . $ideathread_id );
	
	$array = $db_con->fetch_array($res);
    	$count =  $array['interactions']+1;
    	
    	
    	$sql = 'UPDATE `ideathreads` SET `interactions`= '. $count .' WHERE `ideathread_id` = '. $ideathread_id ;
    	
    	$db_con->query($sql);
}

function minusInteraction($ideathread_id){
	global $db_con;
	
	$res = $db_con->query("SELECT `interactions` FROM `ideathreads` WHERE `ideathread_id` = " . $ideathread_id );
	
	$array = $db_con->fetch_array($res);
    	$count =  $array['interactions']-1;
    	
    	
    	$sql = 'UPDATE `ideathreads` SET `interactions`= '. $count .' WHERE `ideathread_id` = '. $ideathread_id ;
    	
    	$db_con->query($sql);
}

function getProductImage($project_id){
	global $db_con;
	$query = 'SELECT * FROM `images` WHERE `project_id` = ' . $project_id .' AND `type` = "final_product"';
    $res = $db_con->query($query);

    return $db_con->fetch_array($res);

}

?>