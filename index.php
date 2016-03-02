<?php
require_once ('includes/header.php');
require_once(DIR_APP.'users.php');
if (!empty($_SESSION['logged_in']))
	redirect('home.php');

$msg = '';
//$promsg='';
//if(isset($_POST['profiled-email'])&&isset($_POST['profiled-loc'])&&isset($_POST['profiled-name']))
//{
//	if ( registerProfile($_POST)) {
//		//redirect('home.php');
//		$promsg = 'Your Information has been submitted.';
//		echo '<script>
//             $(function() {
//				$( "#profiled-message" ).dialog({
//				modal: true,
//				buttons: {
//				Ok: function() {
//				$( this ).dialog( "close" );
//				}
//				}
//				});
//			});</script>';
//	}
//}

//if (isset($_POST["signup"]) && !empty($_POST["signup"]))
if($_SERVER['REQUEST_METHOD']=='POST'){
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

	<div class="inner-page-wrapper">
		<div class="home-page centerme">
			<div id="dialog-message" title="Confirm Your Email">
				<h3><?php echo $msg;?></h3>
			</div>
			<div id="profiled-message" title="Thank You!">
				<h3></h3>
			</div>


			<div class="tagline-home" style=" height: 460px; width: 100%;">
				<h1 class="home-welcome" style="margin-bottom: 20px;">Welcome to Rangeenroute.</h1>
				<div class="tagline-box">
					One stop platform for Startups
				</div>
				<div class="feat-box">
					<div class="feature-list"><img src="./images/icons/Share-your-ideas.png" class="feat-img"><div class="feat-text">Share your idea.</div></div>
					<div class="feature-list" ><img src="./images/icons/Connect-with-friends.png" class="feat-img"><div class="feat-text">Connect with friends.</div></div>
					<div class="feature-list"><img src="./images/icons/Get-project-analytics.png" class="feat-img"><div class="feat-text">Get project analytics.</div></div>
					<div class="feature-list" ><img src="./images/icons/Raise-funds.png" class="feat-img"><div class="feat-text">Raise funds.</div></div>
					<div class="feature-list"><img src="./images/icons/Engage-with-investors.png" class="feat-img"><div class="feat-text">Engage with Investors.</div></div>
					<div class="feature-list"><img src="./images/icons/Build-your-marketplace.png" class="feat-img"><div class="feat-text">Build your marketplace.</div></div>
				</div>

			</div>

			<div class="profile-input" >
				<form >
					<input type="text" id="profiled_name"placeholder="Company Name" required/>
					<input type="email" id="profiled_email"placeholder="Email" required/>
					<input type="text" id="profiled_loc" placeholder="Location" required/>
					<input type="button" id="profiled_id" value="[Get Profiled]"/>
					<form>
			</div>

			<div class="homepage-showcase" style="width: 100%; margin-top: 50px;">
				<h2 class="home-welcome">Trending Projects</h2>
				<?php include 'includes/index-page-trend.php'; ?>
			</div>

			<div class="homepage-showcase showmore" style="width: 100%; margin-top: 20px; float: left;">
				<h2 class="home-welcome">Trending Ideathreads </h2>

				<?php include 'includes/index-page-ideathread.php'; ?>

			</div>
			<?php
			//		$reload = $_SERVER['PHP_SELF'] . "?tpages=" . $tpages;
			//		echo '<div class="pagination"><ul>';
			//		if ($total_pages > 1) {
			//			echo paginate($reload, $show_page, $total_pages);
			//		}
			//		echo "</ul></div>";?>
			<div class="signup-line" style="width: 100%; float: left; margin-top: -30px;"></div>
			<h2 class="home-signup" style="width: 100%; float: left;"><span>Sign up.</span> Together we bring the stuffs - dreams are made of.</h2>

			<div class="sign-up-container" style="float: left">


				<div class="signup-form"  >
					<h3><?php echo $msg; ?></h3>
					<form action="" method="post" name = "signup" id="register-form">

						<div class="form-left">
							<div class="form-item"><label>First Name <span>*</span></label> <input type="text" name="first_name"></div>
							<div class="form-item"><label>Last Name <span>*</span></label> <input type="text" name="last_name"></div>
							<!--<div class="form-item"><label>Company Name <span>*</span></label> <input type="text" name="company_name"></div>
                            <div class="form-item"><label>Location <span>*</span></label> <input type="text" name="location" placeholder="Enter Location"></div>-->
							<div class="form-item"><label>Birthday <span>*</span></label>
								<select class="month" name="month">
									<option>MM</option>
									<?php for ($i = 1; $i < 13; $i++) {
										echo '<option value="'.$i.'">'.$i.'</option>';
									}
									?>
								</select>
								<select class="day" name="day">
									<option>DD</option>
									<?php for ($i = 1; $i < 32; $i++) {
										echo '<option value="'.$i.'">'.$i.'</option>';
									}
									?>
								</select>
								<select class="year" name="year">
									<option>YYYY</option>
									<?php for ($i = (date('Y', time()) - 13); $i > 1930; $i--) {
										if ($i == $date['year'])
										{$selected = 'selected';}
										else $selected = '';
										{echo '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';}
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

							<input type="submit" value="Sign Up">
						</div>

					</form>

				</div> <!-- signup-form -->
			</div> <!-- sign-up-container -->

			<div class="fb_login" style="width: 100%; float: left;"><a href="login-facebook.php"></a></div>

		</div> <!-- home-page content -->
	</div>
<?php include ('includes/footer.php'); ?>