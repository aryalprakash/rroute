<?php
//if (isset($_POST['title'])) {
//    //	$_POST['filename'] = $filename;
//    $message = addBlogPost($_POST);
//}

?>
<script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
<script type="text/javascript">
    tinymce.init({
        selector: "textarea"
    });
</script>
<div class="main-content">
    <div class="upload-project-progress">
        <span class="content-title">Share Post for Blog</span>
    </div>
<!--    <div class="postedblogpost" style="text-color:red;">Your Post Has been submitted.</div>-->
    <div class="content-block">
        <?php
//        if (isset($message))
//            echo '<span style="color: rgb(255, 79, 3);font-size: 16px;">' . $message . '</span>';
//        else{?>
		<form action="admin/processblogpost.php" method="post" novalidate enctype="multipart/form-data">
		<div class="form-item"><input type="text" name = "title" id="post_title"  placeholder="Post Title" maxlength="95" required></div></br>


		<div class="form-item" style="height:inherit;"><textarea name="description" id="post_description"  style="width:570px !important;" placeholder="Details" required></textarea></div></br>
<!--	<div class="form-item"><input type="text" name="category" id = "source_url"  placeholder="Category (comma separated value.)" required></div></br> -->
		<div class="form-item"><label>Featuring Image</label><input type="file" accept="image/*" name="thumbnailImg"  id="thumbnailImg" placeholder="Input an image file for thumbnail"></div></br>
	<!--<div class="form-item"><input type="text" name="original_creator" id="original_creator"  placeholder="Suggest the original creator" required></div>-->
		<br/>
		<div class="form-item">
		<input type="submit"  value="Submit" class="upload-next" name="save_blogpost" id="save_blogpost">
		</div>
		</form>


    </div>
<!--    --><?php //}?>

</div> <!-- main-content -->

