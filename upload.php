<?php
include ('includes/header.php');
require_once(DIR_APP.'projects.php');
require_once(DIR_APP.'users.php');

if (empty($_SESSION['logged_in']))
	redirect('index.php');

if (!isset($_GET['step']))
	$step = 0;
else
	$step = intval($_GET['step']);

if (isset($_GET['id']))
	$id = intval($_GET['id']);
else
	$id = 0;

if ($id)
	$project = getProjectById($id);

if ($step == 2 && !$id && isset($_POST['save_project'])) {
	$id = addProject($_POST);
	redirect ('upload.php?step=2&id='.$id);
	}
else if ($step && $id && isset($_POST['save_project'])) {
	updateProject($_POST, $id, $step);
	}

?>

<div class="inner-page-wrapper">

<div class="upload inner-page content">

<?php include (DIR_INCLUDE.'left_nav.php'); ?>


<div class="main-content">

<div class="upload-project-progress step<?php echo $step; ?>"></div>

<form action="upload.php?step=<?php if ($step < 6 ) echo ($step + 1); else echo '6'; ?>&id=<?php echo $id; ?>" method="post" id="upload_step_<?php echo $step; ?>">
<?php 

if ($step == 0) {
	include (DIR_INCLUDE.'upload_guideline.php');
} /* end step 1 */

if ($step == 1) {
	include (DIR_INCLUDE.'upload_project_step1.php');
} /* end step 1 */

else if ($step == 2){
	include (DIR_INCLUDE.'upload_project_step2.php');
} /* end step 2 */

else if ($step == 3) {
	include (DIR_INCLUDE.'upload_project_step3.php');
 } /* end step 3 */

else if ($step == 4) {
	include (DIR_INCLUDE.'upload_project_step4.php');
}  /* end step 4 */

else if ($step == 5) {
	include (DIR_INCLUDE.'upload_project_step5.php');
} /* end step 5 */

else if ($step == 6) {
	include (DIR_INCLUDE.'upload_project_step6.php');
} ?>


</form>

</div> <!-- main-content -->


</div> <!-- uplload inner-page content -->

<?php include (DIR_INCLUDE.'right_side.php'); ?>

</div> <!-- inner-page-wrapper -->

<?php include (DIR_INCLUDE.'footer.php'); ?>