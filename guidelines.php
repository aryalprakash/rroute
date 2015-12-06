<?php
include ('includes/header.php');

require_once(DIR_APP . 'projects.php');
require_once(DIR_APP . 'users.php');

//if (empty($_SESSION['logged_in']))
  //  redirect('index.php');
?>

<div class="inner-page-wrapper">

    <div class="project inner-page content">

        <?php include (DIR_INCLUDE . 'left_nav.php'); ?>


        <div class="main-content">

            <div class="content-block" style="height:70%">
                <div class="content-title">Community Guidelines</div>

                <p align="justify">Rangeenroute is a creative platform for everyone. We do care all of you and so do we expect all of you to respect each other. By using Rangeenroute and its services, you also have agreed to our terms and conditions. So we cannot tolerate any activity that can hurt or harm our community by breaking the promises you made to us. </p>
<ul><font size="3">
<p align = "justify"><li>1. Please be nice. Do treat others, as you would like to be treated.</li><br/>
<li>2. Do respect copyright ownership. Post those images, audio and videos that are yours.</li><br/>
<li>3. Do care of minors. Teenagers are always in crucial phase of their lives. So be helpful, thoughtful and positive to them.</li><br/>
<li>4. Don’t encourage hatred or violence. Nobody likes that. </li><br/>
<li>5. Always put your clothes on. Sexually explicit contents are not allowed here.</li><br/>
<li>6. Don’t spam or abuse. Our services are for communicating and sharing good things - so please use them as intended.</li><br/>
<li>7. Please follow moral and legal laws. Rangeenroute is not a place for illegal behavior, including privacy violations, fraud, <br/><br/>phishing or deceptive contest.</li></ul></font></p>

<br/><br/>
<p>Thanks for being a part of Rangeenroute community!</p>
            </div>

        </div>


    </div> <!-- account inner-page content -->

    <?php include (DIR_INCLUDE . 'right_side.php'); ?>

</div> <!-- inner-page-wrapper -->

<?php include (DIR_INCLUDE . 'footer.php'); ?>