<!DOCTYPE html>
<html>
<?php
require('db.php');
require('utils.php');
require('header.php');
?>
<body>
<div  data-role="page">
	<div data-role="header"><h1><a href="./">JQuery Tutorial</a></h1></div>
	<div data-role="content">
<!-- #################################################################################################################### -->
<?php
$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';
if ($action == 'addnew') {  showOneOpp(-1); } 
elseif ($action == 'upsert') 
{
	if ($_REQUEST['id'] == '-1') { addOpp($_REQUEST['person'],$_REQUEST['contact'],$_REQUEST['description']);  } 
	else { updateOpp($_REQUEST['id'],$_REQUEST['person'],$_REQUEST['contact'],$_REQUEST['description']); }
	showOpps();
} 
elseif ($action == 'delete')  { killOpp($_REQUEST['id']); showOpps(); } 
elseif ($action == 'details') {	showOneOpp($_REQUEST['id']); } 
else { showOpps(); }

echo "\n\n";
?>
<!-- #################################################################################################################### -->
	</div>
	<div data-role="footer">
	Sample code for IBM Developerworks
	</div>
</div>
<?php //require('footer.php'); ?>
</body>
</html>