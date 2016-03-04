<?php
include('includes/header.php');

require_once(DIR_APP . 'projects.php');
require_once(DIR_APP . 'users.php');

if (empty($_SESSION['logged_in']))
    redirect('index.php');
?>

    <div class="inner-page-wrapper">

    <div class="project inner-page content">

        <?php include(DIR_INCLUDE . 'left_nav.php'); ?>


        <div class="main-content">


            <?php if (isset($_GET['ideathread_id'])) {
            $id = intval($_GET['ideathread_id']);
            $idea = getIdeaById($id);


            if (!empty($idea))
            require(DIR_INCLUDE . 'idea_details.php');
            else { ?>
            <div class="content-block">
                <div class="content-title">Ideathread not found</div>
                <?php }
                }
                ?>

            </div>


        </div> <!-- account inner-page content -->

        <?php include(DIR_INCLUDE . 'right_side.php'); ?>

    </div> <!-- inner-page-wrapper -->

<?php include(DIR_INCLUDE . 'footer.php'); ?>