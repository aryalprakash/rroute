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

            <div class="content-block">
                <div class="content-title">Advertisement</div>

                <p>Please contact our advertisement department for details. <br/><br/>
<a href="mailto:advertisement@rangeenroute.com"><font color="FF4F00">advertisement@rangeenroute.com</font></a></p>
            </div>

        </div>


    </div> <!-- account inner-page content -->

    <?php include (DIR_INCLUDE . 'right_side.php'); ?>

</div> <!-- inner-page-wrapper -->

<?php include (DIR_INCLUDE . 'footer.php'); ?>