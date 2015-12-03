<div class="content-block">
<div class="content-title">Project Information</div>
<div class="form-item"><label>Project Title:</label> <input type="text" maxlength="70" name="project_title" id="project_title" value="<?php if (!empty($project)) echo $project['project_title']; ?>"></div>
<div class="form-item"><label>Category:</label>
<select name="project_category" id="project_category">
<?php
$categories = getCategories();
foreach ($categories as $ix=>$cat) {
	if (!empty($project) && $cat['category_id'] == $project['project_category'])
		$selected = 'selected';
	else
		$selected = '';
        
        if ($cat['is_optgroup'] == 1 && $ix == 0)
            echo '<optgroup label="'.$cat['category_name'].'">';
        else if ($cat['is_optgroup'] == 1 && $ix != 0)
            echo '</optgrouop> <optgroup label="'.$cat['category_name'].'">';
        else 
	echo '<option value="'.$cat['category_id'].'" '.$selected.'>'.$cat['category_name'].'</option>';
	}        
?>
    </optgroup>
</select>
</div>

<div class="form-item"><label>Project Location:</label> <input type="text" name="project_location" id="project_location" value="<?php if (!empty($project)) echo $project['project_location']; ?>"></div>

 <div class="form-item"><label>Developer:</label>
<input type="text" name="project_location" id="project_location" value="<?php echo $_SESSION['display_name']; ?>" disabled></div>


<div class="form-item"><br>Co-founder(s):<div class="cofounder-selected-list"></div></div>

<div class="form-item no-height"><label>&nbsp;</label>
    <select name="developers[]" multiple="multiple" class="multiple-select" id="co_founders">
    <?php 
    $developers = getAllUsers(); 
    foreach ($developers as $dev){
        echo '<option value="'.$dev['user_id'].'">'.$dev['first_name'].' '.$dev['last_name'].'</options>';
    }
    ?>
    </select>
</div>


<hr class="delimiter">

<div class="form-item">
<input type="submit" value="Save & Next &raquo;" class="upload-next" name="save_project">
</div>

</div>