<div class="content-block">
<div class="content-title">Featuring Presentation</div>
<p style="color:red;">All fields required</p>
<div class="form-item no-height"><label class="featuring">Upload a Featuring Video:
<span>Up to 5 minutes</span>
<input type="radio" name="featuring_item[]" value="video" id="featuring_video" checked><label for="featuring_video" class="radio-label">Feature It</label>
</label>

<?php $video = getFeaturingVideo($id);
 if (!empty($video)) {
	$uploaded_video = $video;
?>

<a  href="#" class="upload-video" style="float: right; margin-right: 390px; width: 244px; height: 143px; background: none; ">
<img src="images/video_preview<?php echo 1; ?>.jpg" alt="">
</a>
<input type="hidden" id="uploaded_video" name="uploaded_video" value="<?php echo $uploaded_video; ?>">
<?php } else { ?>
<a href="#" class="upload-video"></a>

<input type="file" id="upload_video" style="display: none;" required >
<input type="hidden" id="uploaded_video" name="uploaded_video" required>
<?php } ?>
</div>
<br>

<div class="form-item no-height"><label class="featuring">Upload a Featuring Picture:
<span>Maintain aspect ratio of 16:9 </span>
<input type="radio" name="featuring_item[]" value="picture" id="featuring_picture" checked><label for="featuring_picture" class="radio-label">Feature It</label>
</label>

<?php $image = getFeaturedImage($id);

if (!empty($image)) { ?>

	<a href="#" class="upload-image" style="background: none;"> <img src="uploads/images/thumbs/<?php echo $image['file_name']; ?>" alt="" width="244" height="143"></a>
	<input type="hidden" id="uploaded_image" name="uploaded_image" value="<?php echo $image['file_name']; ?>" >
<?php	} else { ?>
<a href="#" class="upload-image"></a>
<input type="file" id="upload_image" style="display: none;" required>
<input type="hidden" id="uploaded_image" name="uploaded_image" required>
<?php } ?>
</div>
<br>

<div class="form-item no-height"><label class="featuring">Write a Featured Post:
<span>Up to 500 characters</span>
<input type="radio" name="featuring_item[]" value="post" id="featuring_post" checked><label for="featuring_post" class="radio-label">Feature It</label>
</label>
<textarea name="featuring_text" class="featuring-text" style="width: 94% !important" >

<?php $description = getFeaturedDescription($id); if(!empty($description)) echo substr($description['content'], 0, 200); ?>

</textarea>
</div>

<hr class="delimiter">

<div class="form-item">
<input type="button" value="&laquo; Back" class="upload-back" onclick="window.location='upload.php?step=<?php echo ($step - 1 )?>&id=<?php echo $id?>'">
<input type="submit" value="Save & Next &raquo;" class="upload-next" name="save_project">
</div>

</div>