<?php
require_once ('includes/header.php');
require_once(DIR_APP.'users.php');


if (!empty($_SESSION['logged_in']))
	redirect('home.php');

$msg = '';

if (isset($_POST['signup'])){
	if ( registerUser($_POST)) {
		//redirect('home.php');
            $msg = 'Confirmation email has been sent to your email address.';
             echo '<script>
             $(function() {
				$( "#dialog-message" ).dialog({
				modal: true,
				buttons: {
				Ok: function() {
				$( this ).dialog( "close" );
				}
				}
				});
			});</script>';
        }      
	}
?>
<div class="home-page content">
	<div id="dialog-message" title="Confirm Your Email">
	<h3><?php echo $msg; ?></h3>
	</div>
	<h1 class="home-welcome">Welcome to Rangeenroute.</h1>
	
	<!-- <div class="signup-tabs">
	<ul>
		<li class="signup-tab1">Create - <span>Ideas</span></li>
		<li class="signup-tab2">Connect - <span>Resources</li>
		<li class="signup-tab3 active">Conquer - <span>Needs</span></li>
	</div> -->
	
	<div class="homepage-showcase" style="width: 100%; margin-top: 20px;">
	<h2 class="home-welcome">Trending Projects</h2>
	<?php include 'includes/index-page-trend.php'; ?> 
	</div>
	
	<div class="homepage-showcase" style="width: 100%; margin-top: 20px; float: left;">
	<h2 class="home-welcome">Trending Ideathreads </h2>
	<?php include 'includes/index-page-ideathread.php'; ?> 
	</div>
	
	<div class="signup-line" style="width: 100%; float: left; margin-top: -30px;"></div>
	<h2 class="home-signup" style="width: 100%; float: left;"><span>Sign up.</span> Together we bring the stuffs - dreams are made of.</h1>
	
	<div class="sign-up-container" style="float: left">
	

	<div class="signup-form" name="signup">
            <h3><?php echo $msg; ?></h3>
	<form action="" method="post" id="register-form">

	<div class="form-left">
	<div class="form-item"><label>First Name <span>*</span></label> <input type="text" name="first_name"></div>
	<div class="form-item"><label>Last Name <span>*</span></label> <input type="text" name="last_name"></div>
	<!--<div class="form-item"><label>Company Name <span>*</span></label> <input type="text" name="company_name"></div>
	<div class="form-item"><label>Location <span>*</span></label> <input type="text" name="location" placeholder="Enter Location"></div>-->
	<div class="form-item"><label>Birthday <span>*</span></label>
		<select class="month" name="month">
		<option>MM</option>
		<?php for ($i = 1; $i < 13; $i++) {
			echo '<option value="'.$i.'">' . $i . '</option>';
			}
		?>
		</select>
		<select class="day" name="day">
		<option>DD</option>
		<?php for ($i = 1; $i < 32; $i++) {
		echo '<option value="'.$i.'">' . $i . '</option>';
		}
		?>
		</select>
		<select class="year" name="year">
		<option>YYYY</option>
		<?php for ($i = (date('Y', time()) - 13); $i > 1930; $i--) {
			if ($i == $date['year']) $selected = 'selected';
    			else $selected = '';
			echo '<option value="'.$i.'" '.$selected.'>' . $i . '</option>';
		}
		?>
		</select>
		</div>
	</div>

	<div class="form-right">
	<div class="form-item"><label>Email <span>*</span></label> <input type="email" name="email"></div>
	<div class="form-item"><label>Password <span>*</span></label> <input type="password" name="password" id="password"></div>
	<div class="form-item"><label>Verify Password <span>*</span></label> <input type="password" name="verify_password" id="verify_password"></div>
	</div>

       <div class="form-bottom">
       <input type="checkbox" name="agree_terms" id="agree_terms"><label for="agree_terms">By signing up, you accept our <a href="terms.php" target="_blank">Terms and Conditions</a> & <a href="privacy_policy.php" target="_blank">Privacy policy</a><span></span></label>

	<input type="hidden" name="user_type" id="user_type" value="3">

	<input type="submit" name="signup" value="Sign Up">
	</div>

	</form>

	</div> <!-- signup-form -->
	</div> <!-- sign-up-container -->

	<div class="fb_login" style="width: 100%; float: left;"><a href="login-facebook.php"></a></div>

</div> <!-- home-page content -->
<?php include ('includes/footer.php'); ?>