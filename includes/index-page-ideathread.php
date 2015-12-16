<?php
include_once('config.php');
include_once('app/users.php');
include_once('app/projects.php');
include_once('pagination.php');

$mysql_hostname = "localhost";
$mysql_user = "rangeen_isvet";
$mysql_password = "Livlafluv48!";
$mysql_database = "rangeen_community";

$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) or die("Opps some thing went wrong");
mysql_select_db($mysql_database, $bd) or die("Error on database connection");
//
////for pagination
//$count = getIdeas('count');//added 12-9
//if(isset($_GET['page'])){
//     $page=preg_replace("#[^0-9]#","",$_GET['page']);
//
//}else{
//     $page = 1;
//}
//$perPage=2;
//$lastPage=ceil($count/$perPage);
//
//if($page<1){
//     $page=1;
//}else if($page>$lastPage){
//     $page=$lastPage;
//}
//
//$limit ="LIMIT".($page-1)*$perPage.",$perPage";
//if ($lastPage != 1) {
//
//    if ($page != $lastPage) {
//        $next = $page + 1;
//        $pagination ='<a href="index.php?page=' . $next . '">Next</a>';
//    }
//    if ($page != 1) {
//        $prev = $page - 1;
//        $pagination = '<a href="index.php?page=' . $prev . '">Previous</a>';
//    }
//
//}


//$ideas = getIdeas('all');//added
//print_r($ideas);
$per_page = 10;         // number of results to show per page
$result = mysql_query("SELECT * FROM ideathreads ORDER BY created_on DESC");
$total_results = mysql_num_rows($result);
$total_pages = ceil($total_results / $per_page);//total pages we going to have
//-------------if page is setcheck------------------//
$show_page=1;
$page=1;
if (isset($_GET['page'])) {
    $show_page = $_GET['page']; //current page
    if ($show_page > 0 && $show_page <= $total_pages) {
        $start = ($show_page - 1) * $per_page;
        $end = $start + $per_page;
    } else {
        // error - show first set of results
        $start = 0;
        $end = $per_page;
    }
}
else {
    // if page isn't set, show first set of results
    $start = 0;
    $end = $per_page;
}
// display pagination
if(!isset($_GET['page']))$page=1;
else
    $page = intval($_GET['page']);

$tpages=$total_pages;
if ($page <= 0)
    $page = 1;
global $project_exists;//aded to remove error random line code
//if ($ideas) {
//
//     foreach ($ideas as $idea) {

for ($i = $start; $i < $end; $i++)
 {

// make sure that PHP doesn't try to show results that don't exist
if ($i == $total_results) {
    break;
}
	$title = mysql_result($result, $i, 'ideathread_title');//$idea['ideathread_title'];
	$description = mysql_result($result, $i, 'description');//$idea['description'];
	$time = TimeAgo(date('Y-m-d', strtotime(mysql_result($result, $i, 'created_on'))));
	$ideathread_id = mysql_result($result, $i, 'ideathread_id');//$idea['ideathread_id'];
	$status = mysql_result($result, $i, 'status');//$idea['status'];
	$source= mysql_result($result, $i, 'source_url');//$idea['source_url'];

	$source_details = parse_url($source);
			if($source_details['host'] == 'rangeenroute.com' || $source_details['host'] == 'www.rangeenroute.com'){
				if($source_details['path'] == '/home.php' ){
					parse_str($source_details['query'], $output);

					if($output['pid']){
						$project_exists = true;
						list($url, $project_id) = explode("=", $source);

					}
				}
			}

	if(mysql_result($result, $i, 'thumbnail_img')){
	$thumbnail=mysql_result($result, $i, 'thumbnail_img');//$idea['thumbnail_img'];
	}else{
	$thumbnail = '/uploads/avatars/nophoto.jpg';
	}
	$author = mysql_result($result, $i, 'original_creator');//$idea['original_creator'];
	$user = getUserData(mysql_result($result, $i, 'created_by'));
	$name = $user['display_name'];

	if($user['photo']){
	$userphoto = $user['photo'];
	}else{
	$userphoto = 'nophoto.jpg';
	}

	$likes = getIdeaLikes($ideathread_id);
	$comments = countIdeaComments($ideathread_id);


        if (strlen($title) < 20)
            $short_title = $title;
        else
            $short_title = substr($title, 0, 19) . '...';

        ?>

        <div class="user-list-idea" style="margin-left: 10px;">



        	<div class="thumb-img view-more" style="float: left">

        		<a href="#" ><img src="<?php echo $thumbnail; ?>" height="100%" width="100%"></a>


        	</div>
        	<div class="idea-preview" >
        		<div class="seventy left" style="margin-bottom: -15px;">
        			<a class="view-more" href="#" style="text-decoration: none;"><h1 class="idea-title"><?php echo $title; ?></h1></a>
        			<span class="hueued"><?php echo $time ?></span> &nbsp; &nbsp;<span class="hueued"></span>
        			<p class="idea-description"><?php echo $description; ?></p>
        		</div>
        		<div class="thirty right" style="">
	        		<div style="width: 50%; float: left" class=""view-more">
	        			<div class="idea-stats"><a href="#">
	        			<img src="./images/icons/star.jpg" /></a><div class="stat-no"><?php if($project_exists){echo calculateRating($project_id);}?></div></div>
	        			<div class="idea-stats"><a href="#">
	        			<img src="./images/icons/ranking.png" /></a><div class="stat-no"><?php if($project_exists){echo getRankForProject($project_id);}?></div></div>
	        			<div class="idea-stats"><a href="#">
	        			<img src="./images/icons/like.png" /></a><div class="stat-no"><?php echo $likes ?></div></div>
	        			<div class="idea-stats"><a href="#">
	        			<img src="./images/icons/comment.jpg"/></a><div class="stat-no"><?php echo $comments ?></div></div>

        			</div>
        			<div style=" float: right">

        				<div class="thumb view-more"><a href="#">
        				<img src="uploads/avatars/thumbs/<?php echo $userphoto ?>" title="Posted by <?php echo $name ?>">
        				</a></div>
        				<div class="thumb view-more"><img src="./uploads/avatars/nophoto.jpg" title="Created by <?php echo $author ?>"></div>
        			</div>
        		</div>

        	</div>
   </div>
        <div class="line index"></div><?php } ?>

