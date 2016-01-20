
<?php
include_once('../includes/config.php');
include_once('../includes/app/projects.php');
include_once('../includes/app/users.php');

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
                <th>Status</th>
                <th>Accept/Reject</th>
                <th>Delete</th>
            </tr>
            <?php
            foreach ($projects as $ix=>$project){
            $user =getUserData($project['created_by']); ?>
            <tr id ="projectlist_<?php echo $project['project_id']; ?>">
                <td><?php echo ($ix+1);?></td>
                <td>
                    <?php
                    $rate = getUserRateForProject($project['project_id'], $_SESSION['uid']);
                    if ($rate) {
                        ?>
                        <input type="button" class="admin_rate_project_<?php echo $project['project_id']  ?>" id="admin_rate_project"
                           data-id="<?php echo $project['project_id'] ?>" value="Rated" style="color:#FF4F03"/>
                        <?php
                    } else {
                        $rate = 0;
                        ?>
                        <input type="button" href="#" class="admin_rate_project_<?php echo $project['project_id']  ?>" id="admin_rate_project"
                           data-id="<?php echo $project['project_id'] ?>" value="Rate" style="color:#5577A9"/>
                    <?php } ?>
                </td>
                <td><a href="<?php echo SITE_URL."/project_details.php?pid=".$project['project_id']; ?>"><?php echo $project['project_title'];//this page need to restrict ?> </a>

                    <div class="admin-rate-area admin-rate-area-<?php echo $project['project_id'] ?>">
                        <script>
                            $(function () {
                                $("#admin-slider-range").slider({
                                    range: "max",
                                    min: 0,
                                    max: 10,
                                    value: <?php echo $rate; ?>,
                                    step: 0.01,
                                    slide: function (event, ui) {
                                        $("#rating_value").val(ui.value);
                                    }
                                });
                                $("#rating_value").val($("#admin-slider-range").slider("value"));
                            });
                        </script>
                        <input type="text" name="rating_value" id="rating_value">

                        <div class="admin-slider-area"><span class="rate-range">0</span>

                            <div id="admin-slider-range"></div>
                            <span class="rate-range">10</span>
                            <a href="#" class="project-action-btn" id="admin_save_rate_project"
                               data-id="<?php echo $project['project_id'] ?>"
                               data-user="<?php echo $_SESSION['uid']; ?> "style="color:#fff">Ok</a>
                        </div>
                    </div>   <!-- rate area -->

                </td>
                <td><a href="<?php echo SITE_URL."/user.php?uid=".$user['user_id']; ?>"><?php echo ucwords($user['display_name']); ?><?php if ($user['verified']=='1') { ?><img src="images/4.png" alt=""  title="Verified."class="ver-admin-page"><?php } ?></a></td>

                <td id ="projectstatus_<?php echo $project['project_id']; ?>"><?php if ($project['status']=='0') echo "Unpublished."; else echo "Published.";  ?></td>

                <td><a class=""><input type="button" data-id="<?php echo $project['project_id']; ?>"   class="admin-accept-project projectaccept_<?php echo $project['project_id']; ?>" value ="<?php if($project['status']=='1') echo "Reject"; else echo "Accept"; ?>"style="color:#5577A9"></a></td>
                <td><a class ="admin-delete-project del-project-<?php echo $project['project_id'] ?>" data-id="<?php echo $project['project_id']; ?>" ><img src="images/icons/delete.png" title="delete"/>
<!--                        <input type="button" class="delete-project-admin" style="color:red;" value="X">-->
                        <a></td>
            </tr>

            <?php }?>
        </tbody>

    </table>

       <div class=" index line"></div>


<?php
}
?>

