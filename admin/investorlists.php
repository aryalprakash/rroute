<?php
include_once('../includes/config.php');
include_once('../includes/app/projects.php');
include_once('../includes/app/users.php');

$investors = getAllInvestorData();
//print_r($investors);
if ($investors) {?>

    <table class ="adminlist-table"  id ="t02" cellpadding="0"cellspacing ="0">
        <tbody>
        <caption class="post-title"><b style="color:#4a77a4; height:10px;">investors</b></caption>
        <tr>
            <th>No.</th>
            <th>photo </th>
            <th>Name </th>
            <th>Email</th>
            <th>Published</th>
            <th>Show/Hide</th>
            <th>Edit</th>
            <th>Delete</th>
            <th>Updater</th>
        </tr>
        <?php
        foreach ($investors as $ix=>$investor){
            ?>
            <tr id ="investorlist_<?php echo $investor['investor_id']; ?>">
                <td><?php echo ($ix+1);?></td>
                <td><div class="userlists-photo">
                        <!--                        <a href="investor.php?uid=--><?php //echo $investor['investor_id']; ?><!--">-->
                        <?php if (empty($investor['photo'])) { ?>
                            <img src="uploads/avatars/nophoto.jpg" alt="" title="Photo <?php echo $investor['company_name'] ?>">
                        <?php } else {
                            ?>
                            <img class="fancybox" src="uploads/avatars/thumbs/<?php echo $investor['photo']; ?>" alt=""
                                 title="photo <?php echo $investor['company_name'] ?>">
                        <?php } ?>
                        <!--                        </a>-->

                    </div>
                </td>
                <td id="investorname_<?php echo $investor['investor_id'] ?>"> <a href="<?php echo SITE_URL."/investor.php?iuid=".$investor['investor_id']; ?>"><?php echo ucwords($investor['company_name']); ?>
                    </a><?php if ($investor['verified']=='1') { ?><img src="images/4.png" alt=""  title="Verified."class="ver-admin-page"><?php } ?>
                </td>
                <td><?php echo $investor['email']; ?></td>
<!--                <td><div class="investorlists-photo">-->
<!--                        <!--                        <a href="investor.php?uid=--><?php ////echo $investor['investor_id']; ?><!--<!--">-->
<!--                        --><?php //if (empty($investor['verify_file'])) { ?>
<!--                            <img class=""src="uploads/avatars/nophoto.jpg" alt="" title="">-->
<!--                        --><?php //} else {
//                            ?>
<!--                            <img class="fancybox" src="uploads/documents/--><?php //echo $investor['verify_file']; ?><!--" alt=""-->
<!--                                 title="verification File of --><?php //echo $investor['display_name'] ?><!--">-->
<!--                        --><?php //} ?>
<!--                        <!--                        </a>-->
<!---->
<!--                    </div></td>-->

                <td id="investorstatus_<?php echo $investor['investor_id']; ?>"><?php if ($investor['verified']=='0') echo "No."; else echo "Yes.";  ?></td>
                <td><a class=""><input type="button"data-investor="<?php echo getuserFNameById($_SESSION['uid']); ?>" data-id="<?php echo $investor['investor_id']; ?>"  class="admin-accept-investor investoraccept_<?php echo $investor['investor_id']; ?>" value ="<?php if($investor['verified']=='1') echo "Hide"; else echo "Show"; ?>" <?php if($investor['investor_id']==$_SESSION['uid'])echo'style="opacity:0.5"'. 'disabled'; ?>></a></td>
               <td> <a href="<?php echo SITE_URL.'/admin/edit_investor.php?iuid='.$investor['investor_id'];  ?>"><input type="button" value="Edit"/></a></td>
                <td ><a class ="admin-delete-investor del-investor-<?php echo $investor['investor_id']; ?>" data-id="<?php echo $investor['investor_id']; ?>"
                    ><img src="images/icons/delete.png" title="delete" <?php if($investor['investor_id']==$_SESSION['uid'])echo'style="opacity:0.5"'. 'disabled'; ?>/>
                        <!--                        <input type="button" class="delete-project-admin" style="color:red;" value="X">-->
                    </a></td>
                <td id="investor_acceptor_<?php echo $investor['investor_id']; ?>"><?php echo getuserFNameById($investor['accepted_by']); ?></td>
            </tr>
        <?php }?>
        </tbody>

    </table>
    <div class=" index line"></div>


    <?php
}
?>
<?php
/**
 * Created by PhpStorm.
 * investor: sentiking
 * Date: 2016-01-28
 * Time: 2:04 PM
 */