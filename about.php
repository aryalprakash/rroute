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
                <div class="content-title">About Rangeenroute</div>

                <p align="justify">Rangeenroute is a creative platform that connects people to discover, share, boost and fund genuine ideas. With Rangeenroute, people can bring the stuffs – dreams are made of and drive them towards reality.</p>
<p align="center"><img src="uploads/images/Theme-rangeenroute.png"></p>

            </div>
<p align="left"><img src="uploads/images/Discover.jpg" width = 100% height = 100% >
<p align="left"><img src="uploads/images/Share.jpg" width = 100% height = 100% >
<p align="left"><img src="uploads/images/Boost.jpg" width = 100% height = 100% >
<p align="left"><img src="uploads/images/Fund.jpg" width = 100% height = 50% ></p>
        </div>

    </div> <!-- account inner-page content -->

    <?php include (DIR_INCLUDE . 'right_side.php'); ?>

</div> <!-- inner-page-wrapper -->

<?php include (DIR_INCLUDE . 'footer.php'); ?>