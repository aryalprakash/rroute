<?php
include ('includes/header.php');
require_once(DIR_APP.'users.php');

if (empty($_SESSION['logged_in']))
	redirect('index.php');

if (isset($_POST['update_profile']))
	updateUser($_POST);

$message = '';
if (isset($_POST['upload']))
	$message = getVerified();

$user = getUserData($_SESSION['uid']);

if (!$user) exit();

$date = split_date($user['birthday']);

?>

<div class="inner-page-wrapper">

<div class="account inner-page content">

<?php include (DIR_INCLUDE.'left_nav.php'); ?>


<div class="main-content">

<div class="content-block personal-details">
<div class="content-left-col">
<div class="content-title">Personal Details <?php if (!$user['verified'] && $user['user_id'] == $_SESSION['uid']) { ?><img src="images/get_verified.png" alt="" class="right-pull get-verified"><?php } ?></div>
<form action="" method="post" enctype="multipart/form-data" id="upload-id">
<div class="form-item">To get verified user badge in rangeenroute</div>
<div class="form-item"><input type="file" name="verify_file"></div>
<div class="form-item">Select your personal ID or business ID</div>
<input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
<input type="submit" name="upload" value="Upload" class="right-pull">
</form>

<?php if (!empty($message)) echo '<div class="form-item">'.$message.'</div>';?>

<form action="" method="post">

<div class="form-item"><label>First Name:</label> <input type="text" name="first_name" value="<?php echo $user['first_name']; ?>"></div>
<div class="form-item"><label>Last Name:</label> <input type="text" name="last_name" value="<?php echo $user['last_name']; ?>"></div>
<div class="form-item"><label>Birthday:</label>
<select class="month" name="month">
<option>MM</option>
<?php for ($i = 1; $i < 13; $i++) {
	if ($i == $date['month']) $selected = 'selected';
    else $selected = '';
echo '<option value="'.$i.'" '.$selected.'>' . $i . '</option>';
}
?>
</select>
<select class="day" name="day">
<option>DD</option>
<?php for ($i = 1; $i < 31; $i++) {
	if ($i == $date['day']) $selected = 'selected';
    else $selected = '';
echo '<option value="'.$i.'" '.$selected.'>' . $i . '</option>';
}
?>
</select>
<select class="year" name="year">
<option>YYYY</option>
<?php for ($i = date('Y', time()); $i > 1900; $i--) {
	if ($i == $date['year']) $selected = 'selected';
    else $selected = '';
echo '<option value="'.$i.'" '.$selected.'>' . $i . '</option>';
}
?>
</select>
</div>

<div class="form-item"><label>Gender:</label>
<select class="gender" name="gender">
<option value="1" <?php if ($user['gender'] == 1) echo 'selected'; ?>>Male</option>
<option value="2" <?php if ($user['gender'] == 2) echo 'selected'; ?>>Female</option>
</select>
</div>

</div>

<div class="content-right-col">
<div class="form-item no-height">

<label class="middle-label photo-label">Photo:
<a href="#" id="remove-photo">Remove Photo</a>
<input type="file" id="upload_file" style="display: none;">
<a href="#" id="replace-photo">Change Photo</a></label>

<?php if (empty($user['photo'])) {
echo '<img src="uploads/avatars/nophoto.jpg" alt="" class="avatar-img">';
 }
 else {
 	echo '<img src="uploads/avatars/'.$user['photo'].'" alt="" class="avatar-img fancybox" rel="group">';
 	}
?>
</div>
</div>
</div>

<div class="content-block">
<div class="content-title">Work / Education</div>
<div class="content-left-col">
<div class="form-item"><label>College:</label> <input type="text" name="college" maxlength="20" value="<?php echo $user['college']; ?>"></div>
<div class="form-item"><label>High School:</label> <input type="text" name="high_school" maxlength="20" value="<?php echo $user['high_school']; ?>"></div>
<div class="form-item"><label>School:</label> <input type="text" name="school" maxlength="20" value="<?php echo $user['school']; ?>"></div>
</div>
<div class="content-right-col">
<div class="form-item"><label>Company:</label> <input type="text" name="company_name" maxlength="20" value="<?php echo $user['company_name']; ?>"></div>
<div class="form-item"><label>Position:</label> <input type="text" name="position" value="<?php echo $user['position']; ?>"></div>
</div>
</div>

<div class="content-block">
<div class="content-title">Contact Information</div>
<div class="content-left-col">
<div class="form-item"><label>Current Location:</label> <input type="text" name="location" maxlength="20" value="<?php echo $user['location']; ?>"></div>
<div class="form-item"><label>Hometown:</label> <input type="text" name="hometown" maxlength="20" value="<?php echo $user['hometown']; ?>"></div>
<div class="form-item"><label>Mailing Address:</label> <input type="text" name="mailing_address" maxlength="20" value="<?php echo $user['mailing_address']; ?>"></div>
</div>
<div class="content-right-col">
<div class="form-item"><label>Email:</label> <input type="text" name="alt_email" value="<?php echo $user['alt_email']; ?>"></div>
<div class="form-item"><label>Social Network:</label> <input type="text" name="social_network" value="<?php echo $user['social_network']; ?>"></div>
<div class="form-item"><label>Phone:</label> <input type="text" name="phone" value="<?php echo $user['phone']; ?>"></div>
</div>
</div>

<div class="content-block">
<div class="content-title">About Yourself</div>
<div class="form-item no-height"><label class="top-label"></label> <textarea name="about_me"><?php echo $user['about_me']; ?></textarea></div>
</div>
</div>

<input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
<input type="hidden" name="photo" value="<?php echo $user['photo']; ?>" id="user_photo">
<input type="hidden" name="photo_updated" id="photo_updated">
<input type="submit" name="update_profile" value="Save Changes" class="right-pull">

</form>

</div> <!-- main-content -->


</div> <!-- account inner-page content -->

<?php include (DIR_INCLUDE.'right_side.php'); ?>

</div> <!-- inner-page-wrapper -->

<?php include (DIR_INCLUDE.'footer.php'); ?>