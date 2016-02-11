<?php
include('includes/config.php');

require_once(DIR_APP . 'projects.php');


$projs = getRecentProjects();
foreach ($projs as $project){

    $seedrating =calculate_mr($project['project_id']);
    if($seedrating=='N/A')
        continue;
    if($project['status']=='1')
        continue;
    $user ='168';//automatically published need to define user
    $query = "UPDATE `projects` SET `status`='1',`accepted_by`=".$user." WHERE `project_id`=" . $project['project_id'];
    $db_con->query($query);
    $project_title = getProjectTitle($project['project_id']);
    $url = SITE_URL . '/home.php?pid=' . $project['project_id'];
    $sent_to = getProjectAuthor($project['project_id']);
    $text = 'Your Project  "' . $project_title . '" has been Published.';
    addNotification($sent_to, $text, 168, $url);//automatically published need to define user

}
$projects = getAllRecentProjects();
foreach ($projects as $project) {
    $seedrating =calculate_mr($project['project_id']);
    if($seedrating=='N/A')
        continue;
    $likes = getLikesCount($project_id);
    $comments = getCommentsCount($project_id);
    $query = 'SELECT `routed_by` FROM `routed_projects` WHERE `project_id` = ' . $project_id;
    $users1 = count($db_con->sql2array($query));
    $query = 'SELECT DISTINCT(`sent_to`) FROM `suggestions` WHERE `project_id` = ' . $project_id;
    $routers1 = count($db_con->sql2array($query));
    $routers = $users1 + $routers1;
    if($likes <=1 && $comments <=1 && $routers <=1)
        continue;

    $trend_value = calculateTrendForProject($project['project_id']);
    if($trend_value<=0)
        continue;
    if (!checkProjectInTrend($project['project_id'])) {
        global $db_con;
        $db_con->query('INSERT INTO `trend`(project_id) VALUES(' . $project['project_id'] . ')');
    }

}
$trended=getAllProjectsInTrend();
if ($trended==null)
    exit;
foreach ($trended as $project) {
    $cycle = getTrendCycle($project['project_id']);

    $hr = '';
    $dt = time();
    $times = new DateTime("@$dt");
    $time=$times->format('Y-m-d H:i:s');
    //echo gettype($time);
    $trend_value = calculateTrendForProject($project['project_id']);
    echo 'trend.value='.$trend_value;
    $regression = @calculateRegression($project['project_id'], $time, $trend_value);
    echo 'regression'.$regression.'</br>';
    if ($cycle == 0) {
        $hr = ' `h1` = ' . $trend_value . ', `h1_time = ' . "$time" . ', `r1` = ' . $regression;
        $c = 1;
        $query = 'UPDATE `trend` SET `h1`='.$trend_value.',`h1_time`='.'\''.$time.'\''.',`r1`='.$regression.',`cycle`='.$c.' WHERE `project_id` = ' . $project['project_id'];

    } else if ($cycle == 1) {
        $hr = ' `h2` = ' . $trend_value . ', `h2_time` = ' ." $time" . ', `r2` = ' . $regression;
        $c = 2;
        $query = 'UPDATE `trend` SET `h2`='.$trend_value.',`h2_time`='.'\''.$time.'\''.',`r2`='.$regression.',`cycle`='.$c.' WHERE `project_id` = ' . $project['project_id'];

    } else if ($cycle == 2) {
        $hr = ' `h3` = ' . $trend_value . ', `h3_time` = ' . "$time" . ', `r3` = ' . $regression;
        $c = 3;
        $query = 'UPDATE `trend` SET `h3`='.$trend_value.',`h3_time`='.'\''.$time.'\''.',`r3`='.$regression.',`cycle`='.$c.' WHERE `project_id` = ' . $project['project_id'];

    } else if ($cycle == 3) {
        $hr = ' `h4` = ' . $trend_value . ', `h4_time` = ' ." $time" . ', `r4` = ' . $regression;
        $c = 4;
        $query = 'UPDATE `trend` SET `h4`='.$trend_value.',`h4_time`='.'\''.$time.'\''.',`r4`='.$regression.',`cycle`='.$c.' WHERE `project_id` = ' . $project['project_id'];

    } else if ($cycle == 4) {
        $hr = ' `h5` = ' . $trend_value . ',`h5_time` = ' ." $time" . ', `r5` = ' . $regression;
        $c = 5;
        $query = 'UPDATE `trend` SET `h5`='.$trend_value.',`h5_time`='.'\''.$time.'\''.',`r5`='.$regression.',`cycle`='.$c.' WHERE `project_id` = ' . $project['project_id'];

    } else if ($cycle == 5) {
        $hr = ' `h6` = ' . $trend_value . ', `h6_time` = ' . "$time" . ', `r6` = ' . $regression;
        $c = 6;
        $query = 'UPDATE `trend` SET `h6`='.$trend_value.',`h6_time`='.'\''.$time.'\''.',`r6`='.$regression.',`cycle`='.$c.' WHERE `project_id` = ' . $project['project_id'];

    } else if ($cycle == 6) {
        $hr = ' `h7` = ' . $trend_value . ', `h7_time` = ' . "$time" . ', `r7` = ' . $regression;
        $c = 7;
        $query = 'UPDATE `trend` SET `h7`='.$trend_value.',`h7_time`='.'\''.$time.'\''.',`r7`='.$regression.',`cycle`='.$c.' WHERE `project_id` = ' . $project['project_id'];
    } else if ($cycle == 7) {
        $hr = ' `h8` = ' . $trend_value . ', `h8_time` = ' . "$time ". ', `r8` = ' . $regression;
        $c = 8;
        $query = 'UPDATE `trend` SET `h8`='.$trend_value.',`h8_time`='.'\''.$time.'\''.',`r8`='.$regression.',`cycle`='.$c.' WHERE `project_id` = ' . $project['project_id'];
    } else if ($cycle == 8) {
        $hr = ' `h9` = ' . $trend_value . ', `h9_time` = ' . "$time" . ', `r9` = ' . $regression;
        $c = 9;
        $query = 'UPDATE `trend` SET `h9`='.$trend_value.',`h9_time`='.'\''.$time.'\''.',`r9`='.$regression.',`cycle`='.$c.' WHERE `project_id` = ' . $project['project_id'];

    } else if ($cycle == 9) {
        $hr = ' `h10` = ' . $trend_value . ', `h10_time` = ' ." $time" . ', `r10` = ' . $regression;
        $c = 10;
        $query = 'UPDATE `trend` SET `h10`='.$trend_value.',`h10_time`='.'\''.$time.'\''.',`r10`='.$regression.',`cycle`='.$c.' WHERE `project_id` = ' . $project['project_id'];

    } else if ($cycle == 10) {
        $hr = ' `h11` = ' . $trend_value . ', `h11_time` = ' . "$time" . ', `r11` = ' . $regression;
        $c = 11;
        $query = 'UPDATE `trend` SET `h11`='.$trend_value.',`h11_time`='.'\''.$time.'\''.',`r11`='.$regression.',`cycle`='.$c.' WHERE `project_id` = ' . $project['project_id'];

    } else if ($cycle == 11) {
        $hr = ' `h1` = ' . $trend_value . ', `h1_time` = ' . "$time" . ', `r1` = ' . $regression;
        $c = 1;
        $query = 'UPDATE `trend` SET `h1`='.$trend_value.',`h1_time`='.'\''.$time.'\''.',`r1`='.$regression.',`cycle`='.$c.' WHERE `project_id` = ' . $project['project_id'];
    }
    echo $hr,$c;
    //$query = 'UPDATE `trend` SET ' . $hr . ', `cycle` = ' . $c . ' WHERE `project_id` = ' . $project['project_id'];
    print_r($query);echo '</br>';

    // echo $query.'<br>';

    $db_con->query($query);
}
?>
<?php
/**
 * Created by PhpStorm.
 * User: sentiking
 * Date: 2016-02-11
 * Time: 12:11 PM
 */