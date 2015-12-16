<?php
include ('includes/header.php');
require_once(DIR_APP.'projects.php');

if (empty($_SESSION['logged_in']))
	redirect('index.php');

?>

<div class="inner-page-wrapper store">

<div class="inner-page content">

<?php include (DIR_INCLUDE.'left_nav.php'); ?>


<div class="main-content">

<form action="" method="post">

<div class="store-search">
    <div class ="content-titles">My Store</div>
<div class="search-category"><label>Category: </label>
<select name="project_category">
<option value="-1">Any</option>
<?php
$categories = getCategories();
foreach ($categories as $ix=>$cat) {
        
        if ($cat['is_optgroup'] == 1 && $ix == 0)
            echo '<optgroup label="'.$cat['category_name'].'">';
        else if ($cat['is_optgroup'] == 1 && $ix != 0)
            echo '</optgrouop> <optgroup label="'.$cat['category_name'].'">';
        else {
            if ($_POST['project_category'] == $cat['category_id'] ) $selected = 'selected';
            else $selected = '';
	echo '<option value="'.$cat['category_id'].'" '.$selected.'>'.$cat['category_name'].'</option>';
        }
	}        
?>
    </optgroup>
</select>
</div>

<div class="search-rating"><label>Rating: </label>
<select name="search_rating">
<option value="-1">Any</option>
<option value="0" <?php if ($_POST['search_rating'] >= 0) echo 'selected'?>>0+</option>
<option value="1" <?php if ($_POST['search_rating'] >= 1) echo 'selected'?>>1+</option>
<option value="2" <?php if ($_POST['search_rating'] >= 2) echo 'selected'?>>2+</option>
<option value="3" <?php if ($_POST['search_rating'] >= 3) echo 'selected'?>>3+</option>
<option value="4" <?php if ($_POST['search_rating'] >= 4) echo 'selected'?>>4+</option>
<option value="5" <?php if ($_POST['search_rating'] >= 5) echo 'selected'?>>5+</option>
<option value="6" <?php if ($_POST['search_rating'] >= 6) echo 'selected'?>>6+</option>
<option value="7" <?php if ($_POST['search_rating'] >= 7) echo 'selected'?>>7+</option>
<option value="8" <?php if ($_POST['search_rating'] >= 8) echo 'selected'?>>8+</option>
<option value="9" <?php if ($_POST['search_rating'] >= 9) echo 'selected'?>>9+</option>
<option value="10" <?php if ($_POST['search_rating'] >= 10) echo 'selected'?>>10</option>
</select>
</div>

<div class="search-ranking"><label>Ranking: </label>
<select name="search_ranking">
<option value="-1">Any</option>
<option value="1" <?php if ($_POST['search_ranking'] == 1) echo 'selected'?>>1-100</option>
<option value="2" <?php if ($_POST['search_ranking'] == 2) echo 'selected'?>>100-200</option>
<option value="3" <?php if ($_POST['search_ranking'] == 3) echo 'selected'?>>200-300</option>
<option value="4" <?php if ($_POST['search_ranking'] == 4) echo 'selected'?>>300-400</option>
<option value="5" <?php if ($_POST['search_ranking'] == 5) echo 'selected'?>>400-500</option>
<option value="6" <?php if ($_POST['search_ranking'] == 6) echo 'selected'?>>500+</option>
</select>
</div>

<div class="search-ranking"><label>Sort By: </label>
<select name="search_sort">
<option value="-1">Magic</option>
<option value="1" <?php if ($_POST['search_sort'] == 1) echo 'selected'?>>Recent</option>
<option value="2" <?php if ($_POST['search_sort'] == 2) echo 'selected'?>>A-Z</option>
<option value="3" <?php if ($_POST['search_sort'] == 3) echo 'selected'?>>Rating</option>
</select>
</div>

 <div class="search-rating"><input type="submit" name="submit" value="Search"></div>
 
</div>
 </form>

<div class="content-block">

    <div class ="content-title">My Store</div>
<?php $projects = getAllRecentProjectsWithFilter($_POST);

if ($projects) {
foreach ($projects as $project) {

$title = $project['project_title'];
$user = getUserData($project['created_by']);

if (strlen($title) < 20 )
	$short_title = $title;
else $short_title = substr($title, 0, 19).'...';
?>
 <div class="recent-project-item">

            <?php $image = getFeaturingImage($project['project_id']);
            if (!empty($image)) {
                ?>
                <a href="home.php?pid=<?php echo $project['project_id']; ?>" class="recent-project-title" title="<?php echo $title; ?>"><img src="<?php echo SITE_URL . '/uploads/images/thumbs/' . $image; ?>" alt=""></a>
        <?php } else { ?>
                <a href="home.php?pid=<?php echo $project['project_id']; ?>" class="recent-project-title" title="<?php echo $title; ?>"><img src="<?php echo SITE_URL . '/uploads/avatars/nophoto.jpg'; ?>" alt=""></a>
        <?php } ?>

            <div class="project-bottom-details">
            <a href="home.php?pid=<?php echo $project['project_id']; ?>" class="recent-project-title" title="<?php echo $title; ?>"><?php echo $short_title; ?></a>
             <span class="project-rating"><?php echo calculateRating($project['project_id']); ?></span>
            
            </div> <!-- project-bottom-details --> 
            
            <div class="project-author"><?php echo TimeAgo(date('Y-m-d', strtotime($project['created_on']))); ?> by <a href="user.php?uid=<?php echo $project['created_by']; ?>"><?php echo $user['display_name']; ?></a></div>
            
        </div>
<?php	} 
}
else 
    echo 'Nothing found.';
?>

</div>


</div> <!-- main-content -->


</div> <!-- account inner-page content -->

<?php include (DIR_INCLUDE.'right_side.php'); ?>

</div> <!-- inner-page-wrapper -->

<?php include (DIR_INCLUDE.'footer.php'); ?>