<?php
require_once('config.php');
require_once(DIR_APP.'users.php');

$term = trim(strip_tags($_GET['term']));//retrieve the search term that autocomplete sends

loadRecipients($term);

?>