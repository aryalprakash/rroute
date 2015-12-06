<div class="content-block">
<div class="content-title">Choose Thematic Post</div>

<div class="form-item no-height thematic">
<?php $video = getFeaturingVideo($id);

if (!empty($video)) {
for($i = 1; $i < 5; $i++) {?>
<div class="thematic_item">
<label for="thematic_post_<?php echo $i; ?>"><img src="images/video_preview<?php echo $i; ?>.jpg" alt=""></label>
<input type="radio" name="thematic_post[]" id="thematic_post_<?php echo $i; ?>" value="<?php echo $i; ?>" onclick="document.getElementById('thematic_type').value='video';">
</div>
<?php
	}
} ?>

<?php $image = getFeaturedImage($id);

if (!empty($image)) { ?>
	<div class="thematic_item">
<label for="thematic_post_5"><img src="uploads/images/thumbs/<?php echo $image['file_name']; ?>" alt="" width="244" height="143"></label>
<input type="radio" name="thematic_post[]" id="thematic_post_5" value="<?php echo $image['image_id']; ?>" onclick="document.getElementById('thematic_type').value='image';">
</div>
<?php	}

$description = getFeaturedDescription($id);
if (!empty($description)) { ?>
<div class="thematic_item">
<label for="thematic_post_6" class="post_description"><?php echo substr($description['content'], 0, 200); ?></label>
<input type="radio" name="thematic_post[]" id="thematic_post_6" value="<?php echo $description['description_id']; ?>" onclick="document.getElementById('thematic_type').value='description';">
</div>
<?php	} ?>

</div>

<hr class="delimiter">
<div class="form-item">
<input type="hidden" id="thematic_type" name="thematic_type" value="">
<input type="button" value="&laquo; Back" class="upload-back" onclick="window.location='upload.php?step=<?php echo ($step - 1 )?>&id=<?php echo $id?>'">
<input type="submit" value="Save & Next &raquo;" class="upload-next" name="save_project">
</div>

</div>