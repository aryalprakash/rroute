<script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
    selector: "textarea"
 });
</script>

<div class="content-block">
<div class="content-title">Project Details</div>
<p style="color:red;">All fields required</p>
<div class="form-item no-height">
<textarea name="details" id="details" required><?php if (!empty($project['details'])) echo $project['details']; ?></textarea>
</div>

<div class="form-item no-height">
<?php $video = getVideo($id);
if (!empty($video)) { ?>
<br/>
  <link href="js/video-js/video-js.css" rel="stylesheet" type="text/css">
  <!-- video.js must be in the <head> for older IEs to work. -->
  <script src="js/video-js/video.js"></script>

  <!-- Unless using the CDN hosted version, update the URL to the Flash SWF -->
  <script>
    videojs.options.flash.swf = "js/video-js/video-js.swf";
  </script>
        
  <div class="project-video auto-width">
  <video id="video_1" class="video-js vjs-default-skin" controls preload="none" width="360" height="203" data-setup="{}">
    <source src="<?php echo SITE_URL ?>/uploads/videos/<?php echo $video; ?>"/>        
    <p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a></p>
  </video>                            
      
  </div> 
<?php } else { ?>

<a href="#" class="upload-video details"></a>
<?php } ?>

<input type="file" id="upload_video" style="display: none;">
<input type="hidden" id="uploaded_video" name="uploaded_video">
</div>

<div class="form-item no-height">
<?php $images = getImages($id);

?>
<?php for ($i = 0; $i < 5; $i++) {
if($images[$i]['file_name']) {
echo '<a href="#" class="upload-picture upload-image-<?php echo $i; ?> details"><img src="'.SITE_URL.'/uploads/images/'.$images[$i]['file_name'].'" style="width: 100%; height: 100%;"></a>'; } else {?>
<a href="#" class="upload-picture upload-image-<?php echo $i; ?> details"></a>
<?php } ?>
<input type="file" id="upload_picture_<?php echo $i; ?>" style="display: none;">
<input type="hidden" id="uploaded_picture_<?php echo $i; ?>" name="uploaded_picture[]">
<?php } ?>
</div>

<hr class="delimiter">
<div class="form-item">
<input type="button" value="&laquo; Back" class="upload-back" onclick="window.location='upload.php?step=<?php echo ($step - 1 )?>&id=<?php echo $id?>'">
<input type="submit" value="Save & Next &raquo;" class="upload-next" name="save_project">
</div>

</div>