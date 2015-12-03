<?php
include ('includes/header.php');

require_once(DIR_APP.'projects.php');
require_once(DIR_APP.'users.php');

if (empty($_SESSION['logged_in']))
	redirect('index.php');

if (isset($_POST['send_report']))
	sendReport($_POST);
?>

<div class="inner-page-wrapper">

<div class="connection inner-page content">

<?php include (DIR_INCLUDE.'left_nav.php'); ?>


<div class="main-content">

<ul class="router-top-nav">
<li><a href="account.php">Account</a></li>
<li><a href="privacy.php">Privacy</a></li>
<li><a href="payment.php">Payment</a></li>
<li class="active"><a href="report.php">Report</a></li>
<li class="logout"><a href="logout.php">Logout</a></li>
</ul>

<div class="content-block">
<div class="content-title">Report</div>

<div class="report-page-block">
<div class="report-content-title">Service Functionality</div>

<form action="" method="post">
<div class="reports-list">
<div class="form-item"><input type="checkbox" name="report_items[]" value="profile" id="report-profile"><label for="report-profile">Profile</label></div>
<div class="form-item"><input type="checkbox" name="report_items[]" value="project" id="report-project"><label for="report-project">Project</label></div>
<div class="form-item"><input type="checkbox" name="report_items[]" value="router" id="report-router"><label for="report-router">Router</label></div>
<div class="form-item"><input type="checkbox" name="report_items[]" value="finance" id="report-finance"><label for="report-finance">Finance</label></div>
<div class="form-item"><input type="checkbox" name="report_items[]" value="store" id="report-store"><label for="report-store">Store</label></div>
<div class="form-item"><input type="checkbox" name="report_items[]" value="settings" id="report-settings"><label for="report-settings">Settings</label></div>
<div class="form-item"><input type="checkbox" name="report_items[]" value="others" id="report-others"><label for="report-others">Others</label></div>
</div>

<div class="report-form">

<div class="form-item no-height" id="profile-report-area">
<p><span>Profile</span> - Report about this function.</p>
<textarea name="profile-report-text"></textarea>
</div>

<div class="form-item no-height" id="project-report-area">
<p><span>Project</span> - Report about this function.</p>
<textarea name="project-report-text"></textarea>
</div>

<div class="form-item no-height" id="router-report-area">
<p><span>Router</span> - Report about this function.</p>
<textarea name="router-report-text"></textarea>
</div>

<div class="form-item no-height" id="finance-report-area">
<p><span>Finance</span> - Report about this function.</p>
<textarea name="finance-report-text"></textarea>
</div>

<div class="form-item no-height" id="store-report-area">
<p><span>Store</span> - Report about this function.</p>
<textarea name="store-report-text"></textarea>
</div>

<div class="form-item no-height" id="settings-report-area">
<p><span>Settings</span> - Report about this function.</p>
<textarea name="settings-report-text"></textarea>
</div>

<div class="form-item no-height" id="others-report-area">
<p><span>Others</span> - Report any bug.</p>
<textarea name="others-report-text"></textarea>
</div>


<div class="form-item">
<input class="submit-rounded" type="submit" value="Send" name="send_report">
</div>

</div>

</form>

</div>

<div class="report-page-block">
<div class="report-content-title">Content Issue</div>
<p>The content in Rangeenroute must follow <a href="terms.php">Terms and conditions</a></p><br/><br/>

<div style="width: 100%; overflow: hidden;">
<ul class="left-pull">
<li>&raquo; Harasing/Embarrasing</li>
<li>&raquo; Abusive</li>
<li>&raquo; Violent</li>
<li>&raquo; Spam/Misleading</li>
</ul>

<ul class="left-pull">
<li>&raquo; Harasing/Embarrasing</li>
<li>&raquo; Abusive</li>
<li>&raquo; Violent</li>
<li>&raquo; Spam/Misleading</li>
</ul>
</div>

<p>These content can be reported as follow:</p>
<ul class="lowercase-list">
<li>1) Go to the content</li>
<li>2) Click "Report" on right bottom</li>
</ul>

</div>

</div>

    </div>

</div> <!-- account inner-page content -->

<?php include (DIR_INCLUDE.'right_side.php'); ?>

</div> <!-- inner-page-wrapper -->

<?php include (DIR_INCLUDE.'footer.php'); ?>