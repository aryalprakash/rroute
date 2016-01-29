<?php
$uid = intval($_GET['iuid']);
$investor = getInvestorById($uid);
$userverification =getUserData($_SESSION['uid']);

if (!$investor){
   echo ' <div class="content-titles">Investor does not exist.</div>';
exit();}?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="content-block">
        <div
            class="content-title"><?php echo $investor['company_name']; ?> <?php if ($investor['verified'] == True) { ?>
                <img src="images/4.png" title="Verified." "><?php } ?>
            <div class="add-router">
                <?php if($investor['verified'] == True&&($userverification['verified'])==True){?> <input type="button" value="Apply" id="apply_project_button"/> <?php } ?>
            </div>
        </div><div class="apply-project-area">
            <?php $user_id =$_SESSION['uid'];
            $projects =getAllUserProjects($user_id);
            if($projects){?>
            <div class="form-item"><h2>  Select Your Best Project/s.<h2></div>

              <?php  foreach ($projects as $ix => $project){
                    ?>
                    <div class="form-item"><input type="checkbox" id="project_apply_id" data-value="<?php echo $investor['investor_id']; ?>" data-id="<?php echo $project['project_id']; ?>"> <label for=""><?php echo $project['project_title'];?></label></div>
                <?php }?>
                <div class="form-item apply-success">Your Project has been submitted.</div>
                <div class="form-item"><input type="submit" value="Submit" class="apply-project-bottom"
                                              id="" data-id="<?php echo 'hey'; ?>">
                </div>
            <?php }else{ echo '<h2>you have not uploaded any projects.</h2>';}?>
        </div>
        <div class="content-left-col project-details">
            <div class="user-photo">
                <?php
                if (empty($investor['photo'])) {
                    echo '<img src=' . SITE_URL . '/uploads/avatars/nophoto.jpg.' . ' alt="">';
                } else {
                    echo '<img src="' . SITE_URL . '/uploads/avatars/investors/'. $investor['photo'].'" alt="">';
                    //echo '<img src="uploads/avatars/investors/' . $investor['photo'] . '" style="width:200px;" alt="">';
                }
                ?>
                <div class="name-block"><a
                        href="<?php SITE_URL . '/investor.php?iuid=' . $investor['investor_id']; ?>"><?php echo ucwords($investor['company_name']); ?></a>
                </div>
            </div>
        </div>

        <div class="content-right-col project-details">
            <div class="form-item no-height">
                <ul class="user-info-left">
                    <li><label>Name:</label><?php echo ucwords($investor['company_name']); ?></li>
                    <li><label>Current City:</label><?php echo $investor['location'] ?></li>
                    <li><label>Website:</label><a href="<?php echo $investor['website']; ?>"><?php echo $investor['website'] ?></a></li>
                </ul>

                <ul class="user-info-right">
                    <li><label>phone:</label><?php echo $investor['phone'] ?></li>
                    <li><label>Email:</label><?php echo $investor['email'] ?></li>
                </ul>
            </div>

            <p align="justify"><?php echo $investor['about']; ?></p>
        </div>
    </div>
    <div class=" content-block">

        <div class="content-title"><?php
            //                        if ($own_profile)
            //                            echo 'My';
            //                        else
            //echo $investor['company_name'] . "'s";
            ?> Upcoming Events.
        </div>
        <?php
        $events=getInvestorEvents($investor['investor_id']);
        if($events){foreach ($events as $event){?>
            <div class="my-projects-list">
                <ul>
                   <li><a href ="<?php echo $event['url']; ?>"> <?php echo $event['events'] ?></a></li>
                    <li><?php echo getDateformat($event['event_date']); ?></li>
                </ul>
            </div>
        <?php }}?>
    </div>
    <div class=" content-block">

        <div class="content-title"><?php
            //                        if ($own_profile)
            //                            echo 'My';
            //                        else
            //echo $investor['company_name'] . "'s";
            ?> Funded Projects
        </div>
        <?php
            $projects=getInvestorfundedProjects($investor['investor_id']);
            if($projects){foreach ($projects as $project){
               ?>
        <div class="my-projects-list">
            <ul>
                <li><a href ="<?php echo $project['url']; ?>"> <?php echo $project['Title'] ?></a></li>
                <li> <?php echo $project['description'] ?></li>
            </ul>
        </div>
        <?php }}?>
    </div>

    <div class="my-routers content-block">
        <div class="content-title"><?php
            //echo $investor['company_name'] . 's';
            ?> Investor List
        </div>
        <div class="form-item no-height">
         <?php $arr =explode(',',$investor['co_investors']); for( $i=0; $i<sizeof($arr);$i++){echo $arr[$i];if($i>=(intval(sizeof($arr))-1)){echo '';}else {echo' , ';}} ?>
        </div>
    </div> <!-- my-routers content-block -->


    <div class="footnote content-block">
        <div class="content-title">Footnote</div>
        <?php
        $myfootnote = getFootnoteByAuthorForInvestor($investor['investor_id'], $_SESSION['uid']);
        // $ismyrouter = isMyRouter($user['user_id']);
        // if (!$myfootnote && $ismyrouter) { //replaced line
        if (!$myfootnote) { ?>
            <form action="" method="post">
                <div class="form-item no-height"><textarea name="footnote" id="footnote"
                                                           maxlength="111"></textarea> <input
                        type="submit" name="add_foonote" value="Add"></div>
                <input type="hidden" name="investor_id" value="<?php echo $investor['investor_id']; ?>">
            </form>
        <?php }

        $footnotes = getFootnotesForInvestor($investor['investor_id']);

        if ($footnotes) {
            foreach ($footnotes as $ix => $notes)
                echo '<a href="'.SITE_URL.'/user.php?uid='.$notes['created_by'].'"><p>'.getUserNameById($notes['created_by']).'</a>' /*($ix + 1)*/ . ' : ' . $notes['text'] . '</p>';
        }
        ?>
    </div> <!-- footnote content-block -->

