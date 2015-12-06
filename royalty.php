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

<div class="finance inner-page content">

<?php include (DIR_INCLUDE.'left_nav.php'); ?>


<div class="main-content">

<div class="content-title">Finance</div>

<div class="finance-graph"><?php include (DIR_INCLUDE.'draw_graph.php'); ?></div>

<ul class="router-top-nav">
<li><a href="account_management.php">Account Management</a></li>
<li class="active"><a href="royalty.php">Royalty</a></li>
<li><a href="advertisement.php">Advertisement</a></li>
</ul>

<div class="content-block">
<table class="finance-table" cellpadding="0" cellspacing="0">
<tr>
<th>Date</th>
<th>Router</th>
<th>Project</th>
<th>Type</th>
<th>Payable</th>
</tr>
<!--<tr>
<td>03/27/2014</td>
<td>John</td>
<td>Hunting Hall</td>
<td>Project Detail</td>
<td class="bold">75% of monetized value</td>
</tr>
<tr>
<td>03/27/2014</td>
<td>Mark</td>
<td>Building Hall</td>
<td>Project Statistics</td>
<td class="bold">75% of monetized value</td>
</tr>-->
</table>

</div>

</div>

</div> <!-- account inner-page content -->

<?php include (DIR_INCLUDE.'right_side.php'); ?>

</div> <!-- inner-page-wrapper -->

<?php include (DIR_INCLUDE.'footer.php'); ?>