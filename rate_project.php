<?php
include('includes/header.php');
require_once(DIR_APP . 'projects.php');
require_once(DIR_APP . 'users.php');

if (empty($_SESSION['logged_in']))
    redirect('index.php');
if(userRole($_SESSION['uid'])=='User')
    redirect('home.php');

?>

    <div class="inner-page-wrapper">

        <div class="upload inner-page content">

            <?php include(DIR_INCLUDE . 'left_nav.php'); ?>


            <div class="main-content">

<?php
$projects = getAllProjects();

if ($projects) {?>

    <table class="adminlist-table" id ="t02" cellpadding="0"cellspacing ="0">
        <tbody >
        <caption class="post-title"><b style="color:#4a77a4; height:10px;">Project Lists</b></caption>
            <tr>
                <th>No.</th>
                <th>Rate</th>
                <th>Project Title </th>
                <th>Author</th>
                <th>Published</th>

            </tr>
            <?php
            foreach ($projects as $ix=>$project){
                if ($project['status']=='0')
                    $status= "Pending";
                elseif($project['status']=='1')
                    $status= "Accepted";
                else $status ="Rejected";
            $user =getUserData($project['created_by']); ?>
            <tr id ="projectlist_<?php echo $project['project_id']; ?>">
                <td><?php echo ($ix+1);?></td>
                <td>
                    <?php
                    $rate = getAdminRatedStatus($project['project_id'], $_SESSION['uid']);
                    $value=getAdminRateForProject($project['project_id'], $_SESSION['uid']);
                    if($project['seed_rating']==0)
                        $seed='N/A';
                    else $seed =$project['seed_rating'];
                    if ($rate=='1') {
                        ?>
                        <input type="button" class="admin_rate_project_<?php echo $project['project_id']  ?>-rated" id="admin_rate_project"
                           data-id="<?php echo $project['project_id'] ?>" value="Rated" title="<?php echo 'Seed Rating: '.$seed; ?>"style="color:#FF4F03;opacity: 0.6" disabled/>
                        <?php
                    } else {
                        $rate = 0;
                        ?>
                        <input type="button" href="#" class="admin_rate_project_<?php echo $project['project_id']  ?>" id="admin_rate_project"
                           data-id="<?php echo $project['project_id'] ?>" value="Rate" title="<?php echo 'Seed Rating: '.$seed; ?>"style="color:#5577A9"/>
                    <?php } ?>
                </td>
                <td><a href="<?php echo SITE_URL."/project_details.php?pid=".$project['project_id']; ?>"><?php echo substr($project['project_title'],0,40);//this page need to restrict ?> </a>

                    <div class="admin-rate-area admin-rate-area-<?php echo $project['project_id'] ?>">

                           <?php echo''.($ix+1).'.'.substr($project['project_title'],0,30);?></br></legend>
                            <div class="divline"></div>

                        <p class="listheight">Feasibility:      <input type="number"min="0" max="10" id="fes_value_<?php echo $project['project_id']; ?>" class="admin_rating_value"value="<?php if($value!=false) echo $value['feasibility']; else echo '';?>" placeholder="0-10"></p>
                        <p class="listheight"> Uniqueness:       <input type="number"min="0"step="1"max="10"id="uni_value_<?php echo $project['project_id']; ?>" class="admin_rating_value"value="<?php //if($value!=false) echo $value['uniqness']; else echo '';?>" ></p>
                        <p class="listheight"> Growth Quality:   <input type="number"min="0"step="1"max="10" id="gro_value_<?php echo $project['project_id']; ?>" class="admin_rating_value" value="<?php //if($value!=false) echo $value['growth_quality']; else echo '';?>"></p>
                        <p class="listheight">  Startup Easeness: <input type="number"min="0"step="1"max="10" id="sta_value_<?php echo $project['project_id']; ?>" class="admin_rating_value" value="<?php// if($value!=false) echo $value['startup_easeness'];else echo '';?>"></p>
                        <p class="listheight">  Process Clarity:  <input type="number"min="0"step="1"max="10" id="pro_value_<?php echo $project['project_id']; ?>" class="admin_rating_value" value="<?php //if($value!=false) echo $value['process_clarity'];else echo '';?>"></p>
                        <p class="listheight">   Risk Factor:      <input type="number"min="0"step="1"max="10" id="ris_value_<?php echo $project['project_id']; ?>" class="admin_rating_value" value="<?php// if($value!=false) echo $value['risk_factor'];else echo '';?>"></p>
                        <p class="listheight">   Time consumption: <input type="number"min="0"step="1"max="10" id="tim_value_<?php echo $project['project_id']; ?>" class="admin_rating_value" value="<?php //if($value!=false) echo $value['time_consumption'];else echo '';?>"></p>
                        <p class="listheight">  Redundancy:       <input type="number"min="0"step="1"max="10" id="red_value_<?php echo $project['project_id']; ?>" class="admin_rating_value" value="<?php //if($value!=false) echo $value['redundancy_featured'];else echo '';?>"></p>
                        <p class="listheight">  Impact:          <input type="number"min="0"step="1"max="10" id="imp_value_<?php echo $project['project_id']; ?>" class="admin_rating_value" value="<?php //if($value!=false) echo $value['impact'];else echo '';?>"></p>
                        <p class="listheight">   Profile:           <input type="number"min="0"step="1"max="10" id="prf_value_<?php echo $project['project_id']; ?>" class="admin_rating_value" value="<?php //if($value!=false) echo $value['profile'];else echo '';?>"></p>

                            <a href="#" class="project-action-btn" id="admin_save_rate_project"
                               data-id="<?php echo $project['project_id'] ?>"
                               data-user="<?php echo $_SESSION['uid']; ?> "style="color:#fff">Rate</a>
                        </div>

                </td>
                <td><a href="<?php echo SITE_URL."/user.php?uid=".$user['user_id']; ?>"><?php echo ucwords($user['display_name']); ?><?php if ($user['verified']=='1') { ?><img src="images/4.png" alt=""  title="Verified."class="ver-admin-page"><?php } ?></a></td>
                <td id ="projectstatus_<?php echo $project['project_id']; ?>"><?php if ($project['status']=='0') echo "No"; else echo "Yes";  ?></td>
   </tr>

            <?php }?>
        </tbody>

    </table>

       <div class=" index line"></div>


<?php
}
?>


            </div> <!-- main-content -->


        </div> <!-- uplload inner-page content -->

        <?php include(DIR_INCLUDE . 'right_side.php'); ?>

    </div> <!-- inner-page-wrapper -->

<?php include(DIR_INCLUDE . 'footer.php'); ?>