<?php
include ('includes/header.php');

require_once(DIR_APP.'projects.php');
require_once(DIR_APP.'users.php');

if (empty($_SESSION['logged_in']))
	redirect('index.php');

if (isset($_GET['mode']) && $_GET['mode'] == 'settings')
	$mode = 'settings';
else
	$mode  = 'activity';


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
<li class="active"><a href="account_management.php">Account Management</a></li>
<li><a href="royalty.php">Royalty</a></li>
<li><a href="advertisement.php">Advertisement</a></li>
</ul>

<div class="content-block">
<div class="form-item">
<input class="inbox-btn <?php if($mode == 'activity') echo 'active'; ?>" type="button" onclick="window.location='account_management.php'" value="Activity">
<input class="create-message-btn  <?php if($mode == 'settings') echo 'active'; ?>" type="button" onclick="window.location='payment.php'" value="Settings">
</div><br>

<table class="finance-table" cellpadding="0" cellspacing="0">
<tr>
<th>Date</th>
<th>Type</th>
<th>Description</th>
<th>Amount</th>
<th>Balance</th>
</tr>

<?php $payments = getAllPayments($user['user_id']); 
if ($payments) {
foreach($payments as $payment) {
?>
<tr>
<td><?php echo date('m/d/Y', strtotime($payment['created_on'])); ?></td>
<td><?php echo $payment['type']; ?></td>
<td><?php echo $payment['description']; ?></td>
<td><?php $amount = number_format($payment['amount'], 2, '.', ''); if ($amount < 0) { echo '-'; $amount = abs($amount); } echo '$'.$amount ?></td>
<td class="bold"><?php echo '$'.number_format($payment['balance'], 2, '.', ''); ?></td>
</tr>
<?php } 
}
?>

</table>

</div>

</div>

</div> <!-- account inner-page content -->

<?php include (DIR_INCLUDE.'right_side.php'); ?>

</div> <!-- inner-page-wrapper -->

<?php include (DIR_INCLUDE.'footer.php'); ?>