<?php
require_once ('includes/header.php');
require_once(DIR_APP.'users.php');


$msg = '';

if (isset($_GET['uid'])){
	ConfirmEmail($_GET['uid']);    
	}
?>
<div class="home-page content">
	<h1 class="home-welcome">Welcome to Rangeenroute.</h1>
        <h2 class="home-signup" style="background: none; margin-bottom: 300px;">Your Email has been confirmed. You can login into your account now.</h2>
	
</div> <!-- home-page content -->
<?php include ('includes/footer.php'); ?>