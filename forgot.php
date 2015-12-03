<?php
require_once ('includes/header.php');
require_once(DIR_APP.'users.php');

if (isset($_POST['reset_password'])){
        
        $result = resetPassword($_POST['email']);
    
	
	}
?>
<div class="home-page content page-forgot">	
	<div class="main-content">

            <div class="content-block">
                <div class="content-title">Reset Password</div>

                <form action="" method="post">
                    
                <?php if (!empty($result)) echo '<p>'.$result.'</p>'; ?>

                <?php if ($result != 'Thank you. We have sent a login passcode to your email. Please do login with that sent passcode and remember to change it.') echo '
                <div class="form-item"><label>Your Email:</label> <input type="email" name="email"></div>
                <div class="form-bottom"><input type="submit" name="reset_password" value="Send" style=""></div>'; ?>
                </form>
            </div>

        </div>
	

</div> <!-- home-page content -->
<?php include ('includes/footer.php'); ?>