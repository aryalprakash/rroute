
<?php
include_once('../includes/config.php');
include_once('../includes/app/projects.php');
include_once('../includes/app/users.php');

$projects = getAllProjects();
$project_id='';
if ($projects) {?>

    <table class="adminlist-table" id ="t02" cellpadding="0"cellspacing ="0">
        <tbody >
        <caption class="post-title"><b style="color:#4a77a4; height:10px;">Project Lists</b></caption>
            <tr>
                <th>No.</th>
                <th>Raters</th>
                <th>Ratings</th>
                <th>Project Title </th>
                <th>Author</th>
                <th>Published</th>
                <th>Acc/Pub</th>
                <th>Status</th>
                <th>Reject</th>
                <th>Delete</th>
                <th>Admin</th>
            </tr>
            <?php
            foreach ($projects as $ix=>$project){
                if ($project['status']=='0')
                    $status= "Pending";
                elseif($project['status']=='1')
                    $status= "Accepted";
                else $status ="Rejected";
            $user =getUserData($project['created_by']);
                $project_id=$project['project_id'];
                $raters = getRatersForProject($project_id);
                ?>
            <tr id ="projectlist_<?php echo $project['project_id']; ?>">
                <td><?php echo ($ix+1);?></td>
                <td><input type ="button" id ="project_raters" value="Assign" data-id="<?php echo $project['project_id'] ?>">
                    <div class="project-rater-area project-rater-area-<?php echo $project['project_id'] ?>">

                        <div style="width:296px;float:left;">
                            <input type="text" class="rater-search-<?php echo $project['project_id'] ?>"data-id="<?php echo $project['project_id'] ?>" placeholder="Type Your Router Name"
                                   data-id="<?php echo $_SESSION['uid']; ?>"/>
                            <input type="hidden" id="rater-button" value="Search"/>
                            <ul id="rater-result-<?php echo $project['project_id']; ?>" data-id="<?php echo $project['project_id'] ?>"></ul>
                        </div>

                        <div style="width:296px;float:right;margin-left:-5px;">
                            <ul class="rater-users raterusers-<?php echo $project['project_id']; ?>" data-id="<?php echo $project['project_id']; ?>">
                                <!--                --><?php //$raters = getRatersForProject($project_id);
                                if ($raters) {
                                    foreach ($raters as $rater) {
                                        echo '<div class="rater-users-list" data-id="' . $rater['rater_id'] . '" user-id="' . $rater['user_id'] . '"><span class="remove-rater" data-id="' . $rater['rater_id'] . '" user-id="' . $rater['user_id'] . '">X</span><a href="' . SITE_URL . '/user.php?uid=' . $rater['user_id'] . '"><li class="rater-name">' . getUserNameById($rater['user_id']) . '</li></a></div>';
                                    }
                                }
                                ?>
                            </ul>
                            <div class="success-message"></div>
                        </div>

                    </div> <!-- project-rater-area -->
                </td>
                <td>
                    <?php
                   // $rate = getAdminRatedStatus($project['project_id'], $_SESSION['uid']);
                    $value=getAdminRateForProject($project['project_id'], $_SESSION['uid']);
                    if($project['seed_rating']==0)
                        $seed='N/A';
                    else $seed =$project['seed_rating'];?>


                    <input type="button" id="admin_view_seed" href="#" class="admin-view-seed" data-id="<?php echo $project['project_id'] ?>" title="Click to view Stat" value="<?php echo $seed; ?>">

                    <div class="admin-seed-area admin-view-seed-<?php echo $project['project_id'] ?>">
                            <?php echo''.($ix+1).'.'.substr($project['project_title'],0,30);?> <span class="seed-value"> <?php echo $seed; ?>
                    </span></br>
                            <div class="divline"></div>
                        <div class="seeding-block">
                            <?php
                            $score = getScroreForProject($project['project_id']);

                            if (!$score) {
                                $feasibility = array('N/A', 'N/A', 'N/A', 'N/A', 'N/A');
                                $uniqueness = array('N/A', 'N/A', 'N/A', 'N/A', 'N/A');
                                $growth_quality = array('N/A', 'N/A', 'N/A', 'N/A', 'N/A');
                                $startup_easeness = array('N/A', 'N/A', 'N/A', 'N/A', 'N/A');
                                $process_clarity = array('N/A', 'N/A', 'N/A', 'N/A', 'N/A');
                                $risk_factor = array('N/A', 'N/A', 'N/A', 'N/A', 'N/A');
                                $time_consumption = array('N/A', 'N/A', 'N/A', 'N/A', 'N/A');
                                $redundancy_featured = array('N/A', 'N/A', 'N/A', 'N/A', 'N/A');
                                $impact = array('N/A', 'N/A', 'N/A', 'N/A', 'N/A');
                                $profile = array('N/A', 'N/A', 'N/A', 'N/A', 'N/A');
                            } else {
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
                            }
                            ?>
                            <ul>
                                <li>Assigned Rater: <?php

                                    for ( $i=0;$i<5;$i++) {

                                        echo '<span class="nums" title=" Name should be displayed later='.$project['project_id'].'">' . $i . '</span>';
                                    }
                                    ?></li>
                                <li>Feasibility: <?php
                                    foreach ($feasibility as $val) {
                                        if (is_numeric($val))
                                            $val = abs($val);
                                        echo '<span class="nums">' . $val . '</span>';
                                    }
                                    ?></li>
                                <li>Uniqueness: <?php
                                    foreach ($uniqueness as $val) {
                                        if (is_numeric($val))
                                            $val = abs($val);
                                        echo '<span class="nums">' . $val . '</span>';
                                    }
                                    ?></li>
                                <li>Growth Quality: <?php
                                    foreach ($growth_quality as $val) {
                                        if (is_numeric($val))
                                            $val = abs($val);
                                        echo '<span class="nums">' . $val . '</span>';
                                    }
                                    ?></li>
                                <li>Startup Easeness: <?php
                                    foreach ($startup_easeness as $val) {
                                        if (is_numeric($val))
                                            $val = abs($val);
                                        echo '<span class="nums">' . $val . '</span>';
                                    }
                                    ?></li>
                                <li>Process Clarity: <?php
                                    foreach ($process_clarity as $val) {
                                        if (is_numeric($val))
                                            $val = abs($val);
                                        echo '<span class="nums">' . $val . '</span>';
                                    }
                                    ?></li>
                            </ul>
                            <ul>
                                <li> Risk Factor: <?php
                                    foreach ($risk_factor as $val) {
                                        if (is_numeric($val))
                                            $val = abs($val);
                                        echo '<span class="nums">' . $val . '</span>';
                                    }
                                    ?></li>
                                <li>Time Consumption : <?php
                                    foreach ($time_consumption as $val) {
                                        if (is_numeric($val))
                                            $val = abs($val);
                                        echo '<span class="nums">' . $val . '</span>';
                                    }
                                    ?></li>
                                <li>Redundancy Featured: <?php
                                    foreach ($redundancy_featured as $val) {
                                        if (is_numeric($val))
                                            $val = abs($val);
                                        echo '<span class="nums">' . $val . '</span>';
                                    }
                                    ?></li>
                            </ul>
                            <ul>
                                <li>Impact: <?php
                                    foreach ($impact as $val) {
                                        if (is_numeric($val))
                                            $val = abs($val);
                                        echo '<span class="nums">' . $val . '</span>';
                                    }
                                    ?></li>
                                <li>Profile: <?php
                                    foreach ($profile as $val) {
                                        if (is_numeric($val))
                                            $val = abs($val);
                                        echo '<span class="nums">' . $val . '</span>';
                                    }
                                    ?></li>
                            </ul>
                        </div>

                    </div>

                </td>
                <td><a href="<?php echo SITE_URL."/project_details.php?pid=".$project['project_id']; ?>"><?php echo substr($project['project_title'],0,40);//this page need to restrict ?> </a>

<!--                    <div class="admin-rate-area admin-rate-area---><?php //echo $project['project_id'] ?><!--">-->
<!---->
<!--                           --><?php //echo''.($ix+1).'.'.substr($project['project_title'],0,30);?><!--</br>-->
<!--                            <div class="divline"></div>-->
<!---->
<!--                        <p class="listheight">Feasibility:      <input type="number"min="0" max="10" id="fes_value_--><?php //echo $project['project_id']; ?><!--" class="admin_rating_value"value="--><?php //if($value!=false) echo $value['feasibility']; else echo '';?><!--" placeholder="0-10"></p>-->
<!--                        <p class="listheight"> Uniqueness:       <input type="number"min="0"step="1"max="10"id="uni_value_--><?php //echo $project['project_id']; ?><!--" class="admin_rating_value"value="--><?php ////if($value!=false) echo $value['uniqness']; else echo '';?><!--" ></p>-->
<!--                        <p class="listheight"> Growth Quality:   <input type="number"min="0"step="1"max="10" id="gro_value_--><?php //echo $project['project_id']; ?><!--" class="admin_rating_value" value="--><?php ////if($value!=false) echo $value['growth_quality']; else echo '';?><!--"></p>-->
<!--                        <p class="listheight">  Startup Easeness: <input type="number"min="0"step="1"max="10" id="sta_value_--><?php //echo $project['project_id']; ?><!--" class="admin_rating_value" value="--><?php//// if($value!=false) echo $value['startup_easeness'];else echo '';?><!--"></p>-->
<!--                        <p class="listheight">  Process Clarity:  <input type="number"min="0"step="1"max="10" id="pro_value_--><?php //echo $project['project_id']; ?><!--" class="admin_rating_value" value="--><?php ////if($value!=false) echo $value['process_clarity'];else echo '';?><!--"></p>-->
<!--                        <p class="listheight">   Risk Factor:      <input type="number"min="0"step="1"max="10" id="ris_value_--><?php //echo $project['project_id']; ?><!--" class="admin_rating_value" value="--><?php//// if($value!=false) echo $value['risk_factor'];else echo '';?><!--"></p>-->
<!--                        <p class="listheight">   Time consumption: <input type="number"min="0"step="1"max="10" id="tim_value_--><?php //echo $project['project_id']; ?><!--" class="admin_rating_value" value="--><?php ////if($value!=false) echo $value['time_consumption'];else echo '';?><!--"></p>-->
<!--                        <p class="listheight">  Redundancy:       <input type="number"min="0"step="1"max="10" id="red_value_--><?php //echo $project['project_id']; ?><!--" class="admin_rating_value" value="--><?php ////if($value!=false) echo $value['redundancy_featured'];else echo '';?><!--"></p>-->
<!--                        <p class="listheight">  Impact:          <input type="number"min="0"step="1"max="10" id="imp_value_--><?php //echo $project['project_id']; ?><!--" class="admin_rating_value" value="--><?php ////if($value!=false) echo $value['impact'];else echo '';?><!--"></p>-->
<!--                        <p class="listheight">   Profile:           <input type="number"min="0"step="1"max="10" id="prf_value_--><?php //echo $project['project_id']; ?><!--" class="admin_rating_value" value="--><?php ////if($value!=false) echo $value['profile'];else echo '';?><!--"></p>-->
<!---->
<!--                            <a href="#" class="project-action-btn" id="admin_save_rate_project"-->
<!--                               data-id="--><?php //echo $project['project_id'] ?><!--"-->
<!--                               data-user="--><?php //echo $_SESSION['uid']; ?><!-- "style="color:#fff">Rate</a>-->
<!--                        </div>-->

                </td>
                <td><a href="<?php echo SITE_URL."/user.php?uid=".$user['user_id']; ?>"><?php echo ucwords($user['display_name']); ?><?php if ($user['verified']=='1') { ?><img src="images/4.png" alt=""  title="Verified."class="ver-admin-page"><?php } ?></a></td>

                <td id ="projectstatus_<?php echo $project['project_id']; ?>"><?php if ($project['status']=='0') echo "No"; else echo "Yes";  ?></td>
                <?php if ($project['status']=='2') {?>
                    <td><a class=""><input type="button" style="opacity:0.4"data-user="<?php echo getUserFNameById($_SESSION['uid']); ?>" data-id="<?php echo $project['project_id']; ?>" class="admin-accept-project projectaccept_<?php echo $project['project_id']; ?>" value ="<?php if($project['status']=='1') echo "Unpublish"; else echo "Accept"; ?>" disabled></a></td>

                <?php }else {?>
                    <td><a class=""><input type="button"data-user="<?php echo getUserFNameById($_SESSION['uid']); ?>" data-id="<?php echo $project['project_id']; ?>" class="admin-accept-project projectaccept_<?php echo $project['project_id']; ?>" value ="<?php if($project['status']=='1') echo "Unpublish"; else echo "Accept"; ?>" <?php //if($project['seed_rating']<=0 &&$project['status']!='1') echo'style="opacity:0.6;disable:disabled;"'; ?>></a></td>

                <?php }?>
<!--                <td><a class=""><input type="button"data-user="--><?php //echo getUserFNameById($_SESSION['uid']); ?><!--" data-id="--><?php //echo $project['project_id']; ?><!--"   class="admin-accept-project projectaccept_--><?php //echo $project['project_id']; ?><!--" value ="--><?php //if($project['status']=='1') echo "Unpublish"; else echo "Accept"; ?><!--"style="color:#5577A9"></a></td>-->
                <td id="projectstatusrej_<?php echo $project['project_id']; ?>"><?php echo $status;?></td>
                <?php if($project['status']=='0'){?>
                    <td><a class=""><input type="button" data-user="<?php echo getUserFNameById($_SESSION['uid']); ?>"data-id="<?php echo $project['project_id']; ?>"  class="admin-reject-project projectreject_<?php echo $project['project_id']; ?>" value ="<?php echo "Reject"; ?>"></a></td>
                <?php }else {?>
                    <td><a class=""><input type="button" value ="<?php echo "Reject"; ?>"style="opacity:0.4;" disabled></a></td>
                <?php }?>
                <td><a class ="admin-delete-project del-project-<?php echo $project['project_id'] ?>" data-id="<?php echo $project['project_id']; ?>" ><img src="images/icons/delete.png" title="delete"/>
<!--                        <input type="button" class="delete-project-admin" style="color:red;" value="X">-->
                        <a></td>
                <td id="project_acceptor_<?php echo $project['project_id']; ?>"><?php echo getUserFNameById($project['accepted_by']); ?></td>
            </tr>

            <?php }?>
        </tbody>

    </table>

       <div class=" index line"></div>



<?php
}


?>

