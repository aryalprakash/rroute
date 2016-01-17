<?php
include('includes/header.php');
require_once(DIR_APP . 'users.php');
require_once(DIR_APP . 'projects.php');
if (empty($_SESSION['logged_in']))
    redirect('index.php');
if (isset($_POST['add_foonote']))
    addFootNoteForInvestor($_POST);
//if (isset($_GET['uid']))
//    $uid = intval($_GET['uid']);
//else
//    $uid = $_SESSION['uid'];
?>

<div class="inner-page-wrapper">

    <div class="inner-page content">

        <?php include(DIR_INCLUDE . 'left_nav.php'); ?>

        <div class="main-content">
            <div class="upload-project-progress">
                <span class="pagetitle">Investors</span>
            </div>
           <?php  if(!isset($_GET['iuid']))
            include_once('investorslist.php');
             else
                include_once('investor_details.php');
           ?>

        </div> <!-- main-content -->


    </div> <!-- account inner-page content -->

    <?php include(DIR_INCLUDE . 'right_side.php'); ?>

</div> <!-- inner-page-wrapper -->

<?php include(DIR_INCLUDE . 'footer.php');
?>