<?php
include ('includes/header.php');
require_once(DIR_APP.'projects.php');
require_once(DIR_APP.'users.php');

if (empty($_SESSION['logged_in']))
	redirect('index.php');

	if(isset($_POST['ideathread_title'])){
//		$_POST['filename'] = $filename;
		$message = addIdea($_POST);
	}

?>

<div class="inner-page-wrapper">

<div class="upload inner-page content">

<?php include (DIR_INCLUDE.'left_nav.php'); ?>


<div class="main-content">
	<div class="upload-project-progress">
	<span class="pagetitle">IdeaThread</span>
	</div>
	
	<div class="content-block">
	<?php
			if(isset($message))
			echo '<span style="color: rgb(255, 79, 3);font-size: 16px;">'.$message.'</span>';
			
			else echo'
		<div class="pagesubtitle">Share the best new project-idea, seeking early stage funds.</div><br/></br>
			
		<form action="uploadidea.php" method="post" enctype="multipart/form-data">
		<div class="form-item"><input type="text" name = "ideathread_title" id="ideathread_title"  placeholder="IdeaThread Title" maxlength="70" required></div></br>
		<div class="form-item" style="height:inherit;"><textarea name="description" id="description"  style="width:570px !important;" placeholder="Say few lines on what makes it awesome. Limit 222 characters." maxlength="222" required></textarea></div></br>
		<div class="form-item"><input type="text" name="source_url" id = "source_url"  placeholder="Link the URL (Where you saw It)" required></div></br>
		<div class="form-item"><label>Thumbnail </label><input type="file" accept="image/*" name="thumbnailImg"  id="thumbnailImg" placeholder="Input an image file for thumbnail"></div></br>
		<div class="form-item"><input type="text" name="original_creator" id="original_creator"  placeholder="Suggest the original creator" required></div>
		<br/>
		<div class="form-item">
		<input type="submit"  value="Submit" class="upload-next" name="save_ideathread">
		</div>
		</form>';
		
		?>
		
	</div>



</div> <!-- main-content -->


</div> <!-- upload inner-page content -->

<?php include (DIR_INCLUDE.'right_side.php'); ?>

</div> <!-- inner-page-wrapper -->

<?php include (DIR_INCLUDE.'footer.php'); ?>