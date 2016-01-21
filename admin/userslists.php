<?php
include_once('../includes/config.php');
include_once('../includes/app/projects.php');
include_once('../includes/app/users.php');

$users = getAllUsersData();
//print_r($users);
if ($users) {?>

    <table class ="adminlist-table"  id ="t02" cellpadding="0"cellspacing ="0">
        <tbody>
        <caption class="post-title"><b style="color:#4a77a4; height:10px;">Users</b></caption>
        <tr>
            <th>No.</th>
            <th>photo </th>
            <th>Name </th>
            <th>Email</th>
            <th>Verify_file</th>
            <th>Verified</th>
            <th>Verify/Deny</th>
            <th>Delete</th>
            <th>Acceptor</th>
        </tr>
        <?php
        foreach ($users as $ix=>$user){
             ?>
            <tr id ="userlist_<?php echo $user['user_id']; ?>">
                <td><?php echo ($ix+1);?></td>
                <td><div class="userlists-photo">
<!--                        <a href="user.php?uid=--><?php //echo $user['user_id']; ?><!--">-->
                            <?php if (empty($user['photo'])) { ?>
                                <img src="uploads/avatars/nophoto.jpg" alt="" title="Photo <?php echo $user['display_name'] ?>">
                            <?php } else {
                                ?>
                                <img class="fancybox" src="uploads/avatars/thumbs/<?php echo $user['photo']; ?>" alt=""
                                     title="photo <?php echo $user['display_name'] ?>">
                            <?php } ?>
<!--                        </a>-->

                    </div>
                </td>
                <td id="username_<?php echo $user['user_id'] ?>"> <a href="<?php echo SITE_URL."/user.php?uid=".$user['user_id']; ?>"><?php echo ucwords($user['display_name']); ?>
                    </a><?php if ($user['verified']=='1') { ?><img src="images/4.png" alt=""  title="Verified."class="ver-admin-page"><?php } ?>
                </td>
                <td><?php echo $user['email']; ?></td>
                <td><div class="userlists-photo">
<!--                        <a href="user.php?uid=--><?php //echo $user['user_id']; ?><!--">-->
                            <?php if (empty($user['verify_file'])) { ?>
                                <img class=""src="uploads/avatars/nophoto.jpg" alt="" title="">
                            <?php } else {
                                ?>
                                <img class="fancybox" src="uploads/documents/<?php echo $user['verify_file']; ?>" alt=""
                                     title="verification File of <?php echo $user['display_name'] ?>">
                            <?php } ?>
<!--                        </a>-->

                    </div></td>

                <td id="userstatus_<?php echo $user['user_id']; ?>"><?php if ($user['verified']=='0') echo "No."; else echo "Yes.";  ?></td>
                <td><a class=""><input type="button"data-user="<?php echo getUserFNameById($_SESSION['uid']); ?>" data-id="<?php echo $user['user_id']; ?>"  class="admin-accept-user useraccept_<?php echo $user['user_id']; ?>" value ="<?php if($user['verified']=='1') echo "Deny"; else echo "Verify"; ?>" <?php if($user['user_id']==$_SESSION['uid'])echo'style="opacity:0.5"'. 'disabled'; ?>></a></td>
                <td ><a class ="admin-delete-user del-user-<?php echo $user['user_id']; ?>" data-id="<?php echo $user['user_id']; ?>"
                    ><img src="images/icons/delete.png" title="delete" <?php if($user['user_id']==$_SESSION['uid'])echo'style="opacity:0.5"'. 'disabled'; ?>/>
                        <!--                        <input type="button" class="delete-project-admin" style="color:red;" value="X">-->
                    </a></td>
                <td id="user_acceptor_<?php echo $user['user_id']; ?>"><?php echo getUserFNameById($user['accepted_by']); ?></td>
            </tr>
        <?php }?>
        </tbody>

    </table>
    <div class=" index line"></div>


    <?php
}
?>
