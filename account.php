<?php
include ('includes/header.php');

require_once(DIR_APP.'projects.php');
require_once(DIR_APP.'users.php');

if (empty($_SESSION['logged_in']))
	redirect('index.php');


if (isset($_POST['save_account']))
	updateAccount($_POST);

$user = getUserData($_SESSION['uid']);
?>

<div class="inner-page-wrapper">

<div class="account inner-page content">

<?php include (DIR_INCLUDE.'left_nav.php'); ?>


<div class="main-content">

<ul class="router-top-nav">
<li class="active"><a href="account.php">Account</a></li>
<li><a href="privacy.php">Privacy</a></li>
<li><a href="payment.php">Payment</a></li>
<li><a href="report.php">Report</a></li>
<li class="logout"><a href="logout.php">Logout</a></li>
</ul>

<form action="" method="post" id="account-form">
<div class="content-block">
<div class="content-title">Account Settings</div>
<div class="report-content-title">Display Name</div>
<div class="content-left-col">
<div class="form-item"><label>First Name:</label> <input type="text" name="first_name" value="<?php echo $user['first_name']; ?>"></div>
<div class="form-item"><label>Preferred Name:</label> <input type="text" name="preferred_name" value="<?php echo $user['preferred_name']; ?>"></div>
<div class="form-item no-height">
<input type="checkbox" name="keep_preferred_only" id="keep_preferred_only" <?php if($user['keep_preferred_only']) echo 'checked'; ?>><label for="keep_preferred_only" class="account-checkbox-label">Keep Preferred name only</label><br>
<input type="checkbox" name="keep_preferred_nickname" id="keep_preferred_nickname" <?php if($user['keep_preferred_nickname']) echo 'checked'; ?>><label for="keep_preferred_nickname" class="account-checkbox-label">Keep Preferred name as nickname</label>
</div>
</div>

<div class="content-right-col">
<div class="form-item"><label>Last Name:</label> <input type="text" name="last_name" value="<?php echo $user['last_name']; ?>"></div>
</div>

</div>

<div class="content-block">
<div class="report-content-title">Log-in Email</div>

<div class="content-left-col">
<div class="form-item"><label>Primary Email:</label> <input type="text" name="email" value="<?php echo $user['email']; ?>" readonly></div>
<div class="form-item"><label>Add Email:</label> <input type="text" name="alt_email" value="<?php echo $user['alt_email']; ?>"></div>
</div>

<div class="content-right-col">
<div class="account-email-note">Users can only log-in with primary email address but receive notification in all email addresses</div>
</div>

</div>

<div class="content-block">
<div class="report-content-title">Log-in Password</div>
<div class="form-item"><label>Password:</label> <input type="password" value="********" name="empty_password" readonly> <span class="warning-text"><?php echo daysDifference($user['created_on']); ?> day(s) old</span> <a href="#" class="edit-create-password orange-link">Edit/Create New Password</a></div>
<hr class="delimiter standrt">
<div class="form-item"><label>New Password: </label> <input type="password" name="password" id="password"> <span class="warning-text">Minimum 7 characters and at least 1 number</span></div>
<div class="form-item"><label>Repeat Password: </label> <input type="password" name="verify_password" id="verify_password"></div>
</div>

<div class="content-block">
<div class="report-content-title">Save Changes</div>
<div class="form-item">Enter the log-in password to save any changes: <input type="password" name="current_password" id="current_password">&nbsp;&nbsp;<input class="submit-rounded" type="submit" name="save_account" value="Save Changes"></div>
</div>
</form>

   
 </div>   

</div> <!-- account inner-page content -->

<?php include (DIR_INCLUDE.'right_side.php'); ?>

</div> <!-- inner-page-wrapper -->

<?php include (DIR_INCLUDE.'footer.php'); ?>