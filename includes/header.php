<?php require_once('includes/config.php'); ?>
<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <meta content ="Rangeenroute | Together we bring the stuffs - dreams are made of" name="title" property="og:title">
        <meta content ="Rangeenroute is a creative platform that connects people to discover, share and boost genuine ideas. With Rangeenroute, people can bring the stuffs – dreams are made of and drive them towards reality." name="description" property="og:description">
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo SITE_URL ?>/css/jquery-ui-git.css" />
        <link rel="stylesheet" href="<?php echo SITE_URL ?>/css/style.css" type="text/css" media="all" />
        <link rel="stylesheet" href="<?php echo SITE_URL ?>/css/new_style.css" type="text/css" media="all" />
        <link rel="stylesheet" href="<?php echo SITE_URL ?>/css/fonts/stylesheet.css" type="text/css" media="all" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" type="text/css" />
        <script type="text/javascript" src="<?php echo SITE_URL ?>/js/jquery-1.11.1.js"></script>
        <script src="<?php echo SITE_URL ?>/js/validate/jquery.validate.js"></script>
        <script src="<?php echo SITE_URL ?>/js/jquery-ui-git.js"></script>
        <script type="text/javascript" src="<?php echo SITE_URL ?>/js/validate.js"></script>
        <script type="text/javascript" src="<?php echo SITE_URL ?>/js/main.js"></script>
        <script type="text/javascript" src="<?php echo SITE_URL ?>/js/newScripts.js"></script>

        <!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
        <script src="<?php echo SITE_URL ?>/js/file-uploading/js/jquery.iframe-transport.js"></script>
        <!-- The basic File Upload plugin -->
        <script src="<?php echo SITE_URL ?>/js/file-uploading/js/jquery.fileupload.js"></script>


        <link rel="stylesheet" href="<?php echo SITE_URL ?>/js/jquery-ui/jquery-ui-1.11.0/jquery-ui.css">
        <script src="<?php echo SITE_URL ?>/js/jquery-ui/jquery-ui-1.11.0/jquery-ui.js"></script>



        <!-- Add mousewheel plugin (this is optional) -->
        <script type="text/javascript" src="js/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>

        <!-- Add fancyBox -->
        <link rel="stylesheet" href="js//fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
        <script type="text/javascript" src="js//fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>



        <title>Rangeenroute</title>
    </head>
    <body>
        <header class="header-wrapper">
            <div class="header-container">
                <?php if (!empty($_SESSION['logged_in'])) { ?>
                    <a href="home.php" alt="Home" class="site-logo"><img src="<?php echo SITE_URL; ?>/images/logo.png"></a>
                    <div class="user-bar">
                        <div class="search-form">
                            <form action="search.php" method="post">
                                <input type="text" name="search_text" placeholder="Search">
                                <input type="submit" name="search" value="">
                            </form>
                        </div>
                        <div class="user-name-top"><a href="user.php"><?php echo $_SESSION['display_name']; ?></a></div>
                        <a href="#" class="top-messages allNotifications" user-id="<?php echo $_SESSION['uid'] ;?>">
                         <?php require_once('includes/app/users.php');
                            $notifications = getNotifications($_SESSION['uid']);
                            $count = countNotifications($_SESSION['uid']);
                            if($notifications){
                            if($count > 0){
                            echo '<p class="notifyNo">';
                            	echo $count;
                            echo '</p>';
                            }
                                //echo sizeof($notifications);
                            }
                             ?>

                       </a>

                        <div class="popup-alerts">
                            <?php
                           
                            if ($notifications) {
                                foreach ($notifications as $n) {

                                    $date = date('m/d/Y', strtotime($n['created_on']));
                                    if ($date == date('m/d/Y', time()))
                                        $date = 'Today';
                                    ?>
                                    <div class="notify-item" <?php if ($date == $last_date) echo 'style="border: none;"'; ?> data-id="<?php echo $n['notify_id']; ?>">
                                        <div class="notify-date"><?php if (!isset($last_date) || $date != $last_date) echo $date ?></div>
                                        <div class="notify-text" id="notifytext_<?php echo $n['notify_id']; ?>"><?php echo $n['text'] ?></div>
                                    </div>

                                    <?php
                                    $last_date = $date;
                                }
                            }
                            else { 
                             echo '<div class="notify-item">No notifications</div>';
                            }
                            ?>        
                        </div>

                    </div>
                <?php } else {
                    ?>
                    <a href="<?php echo SITE_URL; ?>" alt="Home" class="site-logo"><img src="<?php echo SITE_URL; ?>/images/logo.png"></a>
                    <div class="login-top-form">
                        <form action="" method="post">
                            <input type="email" name="user_email" id="user_email" placeholder="Email"/>
                            <input type="password" name="user_password" id="user_password" placeholder="Password"/>
                            <input type="submit" name="login_submit"  id="login_submit" value="Log In"/>

                            <div class="additional-login-func">
                                <div class="keep-me"><input type="checkbox" id="keep_me_logged"><label for="keep_me_logged">Keep me logged in</label></div>
                                <div class="forgot-pass"><a href="forgot.php">Forgot password?</a></div>
                            </div>

                        </form>
                    </div>
                <?php } ?>

            </div> <!-- header-container -->
        </header>
        <div class="main-wrapper">