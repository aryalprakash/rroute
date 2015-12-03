<footer class="site-footer">
	<div class="footer-container">
	<?php if (empty($_SESSION['logged_in'])) {?>
    	<!--<div class="footer-banners">
    	<div class="banner"><img src="images/300-250-banner.jpg" alt=""></div>
    	<div class="banner"><img src="images/300-250-banner.jpg" alt=""></div>
    	<div class="banner"><img src="images/300-250-banner.jpg" alt=""></div>
    	</div>-->
    	<?php } ?>

    	<nav class="footer-menu">
    	<ul>
    	<li><a href="about.php">About Rangeenroute</a></li>
    	<li><a href="help.php">Help Center</a></li>
    	<li><a href="guidelines.php">Community Guidelines</a></li>
    	<li><a href="privacy_policy.php">Privacy</a></li>
        <li><a href="terms.php">Terms and Conditions</a></li>
        <li><a href="careers.php">Careers</a></li>
        <li><a href="advertisement_help.php">Advertisement</a></li>        
    	</ul>
    	</nav>

    	<div class="copyright">Copyright &copy; <?php echo date('Y', time()); ?> Rangeenroute 
         </br> <p align="center"> Algebra, Inc.</p></div>

	</div>
</footer>
</div><!-- .main-wrapper -->

</body>
</html>
