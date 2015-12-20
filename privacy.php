<?php
include ('includes/header.php');

require_once(DIR_APP.'projects.php');
require_once(DIR_APP.'users.php');

if (empty($_SESSION['logged_in']))
	redirect('index.php');

if (isset($_POST['save_privacy'])) {
	updatePrivacySettings($_POST, $_SESSION['uid']);
	}

$privacy = getPrivacySettings($_SESSION['uid']);

?>

<div class="inner-page-wrapper">

<div class="privacy inner-page content">

<?php include (DIR_INCLUDE.'left_nav.php'); ?>


<div class="main-content">

<ul class="router-top-nav">
<li><a href="account.php">Account</a></li>
<li class="active"><a href="privacy.php">Privacy</a></li>
<li><a href="payment.php">Payment</a></li>
<li><a href="report.php">Report</a></li>
<li class="logout"><a href="logout.php">Logout</a></li>
</ul>

<div class="content-block">
<div class="content-title">Privacy</div>


<form action="" method="post">
<?php if (empty($privacy)) { ?>
<div class="form-item no-height"><input type="radio" name="privacy_type" value="1" id="general_privacy" checked><label for="general_privacy" class="radio-label">General Privacy Settings<span>Everything is available to everyone</span></label></div>
<hr class="delimiter standart">
<div class="form-item"><input type="radio" name="privacy_type" value="2" id="custom_privacy"><label for="custom_privacy" class="radio-label">Custom Privacy Settings</label></div>
<div class="form-item"><label class="privacy-label">Limit my activity to</label>
<select name="limit_authority">
<option value="1">Everyone</option>
<option value="2">My routers only</option>
<option value="3">My routers and their routers</option>
<option value="4">Myself</option>
</select>
</div>

<div class="form-item"><label class="privacy-label">Adding router-available to</label>
<select name="router_available">
<option value="1">Everyone</option>
<option value="2">My router's routers</option>
<option value="3">None</option>
</select>
</div>
<?php }

else { ?>
<div class="form-item no-height"><input type="radio" name="privacy_type" value="1" id="general_privacy" <?php if ($privacy['selected_option'] == 1) echo 'checked'; ?>><label for="general_privacy" class="radio-label">General Privacy Settings<span>Everything is available to everyone</span></label></div>
<hr class="delimiter standart">
<div class="form-item"><input type="radio" name="privacy_type" value="2" id="custom_privacy" <?php if ($privacy['selected_option'] == 2) echo 'checked'; ?>><label for="custom_privacy" class="radio-label">Custom Privacy Settings</label></div>
<div class="form-item"><label class="privacy-label">Limit my activity to</label>
<select name="limit_authority">
<option value="1" <?php if ($privacy['limit_activity'] == 1) echo 'selected'; ?>>Everyone</option>
<option value="2" <?php if ($privacy['limit_activity'] == 2) echo 'selected'; ?>>My routers only</option>
<option value="3" <?php if ($privacy['limit_activity'] == 3) echo 'selected'; ?>>My routers and their routers</option>
<option value="4" <?php if ($privacy['limit_activity'] == 4) echo 'selected'; ?>>Myself</option>
</select>
</div>

<div class="form-item"><label class="privacy-label">Adding router-available to</label>
<select name="router_available">
<option value="1" <?php if ($privacy['router_available'] == 1) echo 'selected'; ?>>Everyone</option>
<option value="2" <?php if ($privacy['router_available'] == 2) echo 'selected'; ?>>My router's routers</option>
<option value="3" <?php if ($privacy['router_available'] == 3) echo 'selected'; ?>>None</option>
</select>
</div>
<?php } ?>

<div class="form-item"></div>
<div class="form-item">
<input class="submit-rounded" type="submit" name="save_privacy" value="Save Changes">
</div>
</form>

</div>

</div>
    
</div> <!-- account inner-page content -->

<?php include (DIR_INCLUDE.'right_side.php'); ?>

</div> <!-- inner-page-wrapper -->

<?php include (DIR_INCLUDE.'footer.php'); ?>