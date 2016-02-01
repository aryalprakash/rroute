
<?php
include_once('../includes/config.php');
include_once('../includes/app/projects.php');
include_once('../includes/app/users.php');

$projects = getAllIdeathread();
if ($projects) {?>

    <table class ="adminlist-table" id ="t02" cellpadding="0"cellspacing ="0">
        <tbody>
        <caption class="post-title"><b style="color:#4a77a4; height:10px;">Ideathread Lists</b></caption>
        <tr>
            <th>No.</th>
            <th>Ideathread Title </th>
            <th>Author</th>
            <th>Published</th>
            <th>Accept/Publish</th>
            <th>Status</th>
            <th>Reject</th>
            <th>Delete</th>
            <th>Admin</th>
        </tr>
        <?php
        foreach ($projects as $ix=>$project){
            $user =getUserData($project['created_by']);
            if ($project['status']=='notapproved')
                $status= "Pending";
            elseif($project['status']=='approved')
                $status= "Accepted";
            else $status ="Rejected";
            ?>
            <tr id ="idealist_<?php echo $project['ideathread_id']; ?>">
                <td><?php echo ($ix+1);?></td>
                <td><a href="<?php echo SITE_URL."/home.php?iid=".$project['ideathread_id']; ?>"><?php echo substr($project['ideathread_title'],0,40);//this page need to restrict ?> </a></td>
                <td ><a href="<?php echo SITE_URL."/user.php?uid=".$user['user_id']; ?>"><?php echo ucwords($user['display_name']); ?><?php if ($user['verified']=='1') { ?><img src="images/4.png" alt=""  title="Verified."class="ver-admin-page"><?php } ?></a></td>
                <td id ="status_<?php echo $project['ideathread_id']; ?>"><?php if ($project['status']=='approved') echo "Yes"; else echo "No";  ?></td>
                <?php if ($project['status']=='rejected') {?>
                    <td><a class=""><input type="button" style="opacity:0.4"data-user="<?php echo getUserFNameById($_SESSION['uid']); ?>" data-id="<?php echo $project['ideathread_id']; ?>" class="admin-accept-ideathread accept_<?php echo $project['ideathread_id']; ?>" value ="<?php if($project['status']=='approved') echo "Unpublish"; else echo "Accept"; ?>" disabled></a></td>

                <?php }else {?>
                    <td><a class=""><input type="button"data-user="<?php echo getUserFNameById($_SESSION['uid']); ?>" data-id="<?php echo $project['ideathread_id']; ?>" class="admin-accept-ideathread accept_<?php echo $project['ideathread_id']; ?>" value ="<?php if($project['status']=='approved') echo "Unpublish"; else echo "Accept"; ?>"></a></td>

                <?php }?>

                <td id="ideathreadstatusrej_<?php echo $project['ideathread_id']; ?>"><?php echo $status;?></td>
                <?php if($project['status']=='notapproved'){?>
                    <td><a class=""><input type="button" data-user="<?php echo getUserFNameById($_SESSION['uid']); ?>"data-id="<?php echo $project['ideathread_id']; ?>"  class="admin-reject-ideathread ideathreadreject_<?php echo $project['ideathread_id']; ?>" value ="<?php echo "Reject"; ?>"></a></td>
                <?php }else {?>
                    <td><a class=""><input type="button" value ="<?php echo "Reject"; ?>"style="opacity:0.4;" disabled></a></td>
                <?php }?>
                <td ><a class ="admin-delete-idea del-idea-<?php echo $project['ideathread_id']; ?>" data-id="<?php echo $project['ideathread_id']; ?>"
                        ><img src="images/icons/delete.png" title="delete"/>
                        <!--                        <input type="button" class="delete-project-admin" style="color:red;" value="X">-->
                        </a></td>
                <td id="ideathread_acceptor_<?php echo $project['ideathread_id']; ?>"><?php echo getUserFNameById($project['accepted_by']); ?></td>
            </tr>
        <?php }?>
        </tbody>

    </table>
    <div class=" index line"></div>

    <?php
}
?>