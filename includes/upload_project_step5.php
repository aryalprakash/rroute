<script>
$(function() {
$( "#slider-range-max" ).slider({
range: "max",
min: 0,
max: 100,
<?php if (!empty($project['monetize']))
echo 'value:'. $project['monetize'].',';
else echo 'value: 0,';
?>
slide: function( event, ui ) {
$( "#project_monetize" ).val( ui.value );
}
});
$( "#project_monetize" ).val( $( "#slider-range-max" ).slider( "value" ) );
});
</script>

<div class="content-block">
<div class="content-title">Project Penetration</div>
<p style="color:red;">All fields are required</p>

<div class="form-item"><label>Project Privacy</label>
<select style="width:290px;" id="projectType" name="privacy" >
<option value="public" <?php echo 'selected ='; if ($project['privacy'] == 'public') echo "selected"; ?>>Free, available to everyone</option>
<option value="private" <?php echo 'selected ='; if ($project['privacy'] == 'private') echo "selected" ?>>Free, permission required</option>
<option value="monetized" <?php echo 'selected ='; if ($project['privacy'] == 'monetized') echo "selected" ?>>Monetised</option>
</select>
</div>

<div class="form-item" style="margin-top:12px; display: none;" id="monitizeBar"><label>Monetize</label>
$ <div id="slider-range-max"></div>
<input type="text" name="project_monetize" id="project_monetize" required>
</div>
</br>

<div class="form-item"><label>Startup Amount</label>
<input type="text" style="width: 263px;" name="startup_amount" id="startup_amount" style="width:20%" value="<?php if (!empty($project['startup_amount'])) echo $project['startup_amount']; ?>" required>
</div>
</br>

<div class="form-item"><label>Select Reward</label>
<select style="width:295px;" id="rewardType" name="reward">
<option value="Equity" <?php echo 'selected =';  if ($project['reward'] == 'Equity') echo "selected"; ?>>Equity</option>
<option value="Product" <?php echo 'selected =';  if ($project['reward'] == 'Product') echo "selected"; ?>>Product</option>
</select>
</div>

<div id="equityEntry" class="form-item" style="margin-top: 20px; margin-bottom: 50px;"><label></label>
<span style="font-weight:600">Enter your reward equity %</span>
<div class="form-item" style="margin-top: 5px"><label></label>

<input type="text" id="equityValue" name="equity_pc" style="width:185px" value="<?php if (!empty($project['equity_pc'])) echo $project['equity_pc']; ?>">
<a href="#" id="equitySubmit" style="text-decoration: none;"> <span   class="submitButton" >Submit</span></a>
</div>
<div id="contdEquity" class="form-item" style="display: none; margin-top: 15px;">
<label></label>
<span class="equityVal" style="font-weight: 600; color: #FF4F00;"></span>
</div>
</div>

<div id="productEntry" class="form-item" style="margin-top: 20px; margin-bottom: 80px; display: none;"><label></label>
<span style="font-weight:600">Estimate your per product cost</span>
<div class="form-item" style="margin-top: 5px"><label></label>

<input type="text" id="productCost" name="per_product_cost" value="<?php if (!empty($project['per_product_cost'])) echo $project['per_product_cost']; ?>" style="width:185px"><a href="#" id="productSubmit" style="text-decoration: none;"><span   class="submitButton"> Submit</span></a>
</div>
<div id="contdProduct" class="form-item" style="display: none; margin-top: 15px;">
<label></label>
<div class="form-item">
<label></label>

<span style="height: 200px; padding: 15px; border: 1px solid;"><a href="#" class="upload-product-image">
<?php $image = getProductImage($id);

if (!empty($image)) { 
	echo $image['file_name'];
 }else{ ?>
Click to upload final product picture
<?php } ?>
</a>
<input type="file" id="upload_product_image" style="display: none;">
<input type="hidden" id="uploaded_product_image" name="uploaded_product_image" >
</span>


<span style="height: 200px; padding:15px; border: 1px solid;">Reward for Investment</span>

</div>
</div>
</div>


<div class="form-item no-height"><label>&nbsp;</label>
<textarea name="about_amount" placeholder="About financial planning of start up amount / Business model" required><?php if (!empty($project['about_amount'])) echo html_entity_decode($project['about_amount']); ?></textarea>
</div>

<div class="form-item no-height"><label>&nbsp;</label>
<textarea name="risk_amount" placeholder="Risk / Challenges (Present / Future)" required><?php if (!empty($project['risk_amount'])) echo html_entity_decode($project['risk_amount']); ?></textarea>
</div>

<hr class="delimiter">
<div class="form-item">
<input type="hidden" name="last_step" value="1">
<input type="button" value="&laquo; Back" class="upload-back" onclick="window.location='upload.php?step=<?php echo ($step - 1 )?>&id=<?php echo $id?>'">
<input type="submit" value="Save & Next &raquo;" class="upload-next" name="save_project">
</div>

</div>