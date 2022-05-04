<?php
include $_SERVER['DOCUMENT_ROOT']."/version.php";
$path = $_SERVER['DOCUMENT_ROOT']."/".v."/Common Data/";
set_include_path($path);
include('PHP Modules/mysqliConnection.php');
include('PHP Modules/gerald_functions.php');
include('PHP Modules/anthony_retrieveText.php');
include("PHP Modules/anthony_wholeNumber.php");
ini_set("display_errors", "on");
?>
<form id='formAdd' action ="jazmin_addCustomerQuery.php" method="POST">
<div class='row'>
	<div class='col-md-12'>
		<label><?php echo (displayText('L641', 'utf8', 0, 0, 1));?></label>
		<input type="text" name="customerAlias" class='w3-input w3-border w3-small w3-pale-yellow' form='formAdd' autofocus required>
	</div>
</div>
<div class='row w3-padding-top'>
	<div class='col-md-12'>
		<label><?php echo (displayText('L269', 'utf8', 0, 0, 1));?></label>
		<input type="text" name="customerName" class='w3-input w3-border w3-small w3-pale-yellow' form='formAdd' required>
	</div>
</div>
<div class='row w3-padding-top'>
	<div class='col-md-12'>
		<label><?php echo (displayText('L1108', 'utf8', 0, 0, 1));?></label>
		<textarea type="text" rows='5' cols='20' name='customerAddress' class='w3-input w3-border w3-small w3-pale-yellow' form='formAdd' required></textarea>
	</div>
</div>
<div class='row w3-padding-top'>
	<div class='col-md-12'>
		<label><?php echo (displayText('L1109', 'utf8', 0, 0, 1));?></label>
		<input type="text" name="customerPhone" class='w3-input w3-border w3-small w3-pale-yellow' form='formAdd'>
	</div>
</div>
<div class='row w3-padding-top'>
	<div class='col-md-12'>
		<label><?php echo (displayText('L1110', 'utf8', 0, 0, 1));?></label>
		<input type="text" name="customerEmail" class='w3-input w3-border w3-small w3-pale-yellow' form='formAdd'>
	</div>
</div>
<div class='row w3-padding-top'>
	<div class='col-md-12'>
		<label><?php echo (displayText('L1111', 'utf8', 0, 0, 1));?></label>
		<input type="text" name="tintext" class='w3-input w3-border w3-small w3-pale-yellow' form='formAdd'>
	</div>
</div>
<div class='row w3-padding-top'>
	<div class='col-md-12'>
		<label><?php echo (displayText('L1112', 'utf8', 0, 0, 1));?></label>
		<input type="text" name="customerFax" class='w3-input w3-border w3-small w3-pale-yellow' form='formAdd'>
	</div>
</div>
<div class='row w3-padding-top'>
	<div class='col-md-12'>
		<label><?php echo (displayText('L1113', 'utf8', 0, 0, 1));?></label>
		<input type="text" name="customerContactPerson" class='w3-input w3-border w3-small w3-pale-yellow' form='formAdd'>
	</div>
</div>
<div class='row w3-padding-top'>
	<div class='col-md-12'>
		<label><?php echo (displayText('L4185', 'utf8', 0, 0, 1));?></label>
	</div>
	<div class='col-md-12'>
		<input type="radio" name="materialParameter" value='0' class='w3-radio' form='formAdd' checked>
		<label><?php echo (displayText('L4186', 'utf8', 0, 0, 1));?></label>&nbsp;
	</div>
	<div class='col-md-12'>
		<input type="radio" name="materialParameter" value='1' class='w3-radio' form='formAdd'>
		<label><?php echo (displayText('L4187', 'utf8', 0, 0, 1));?></label>&nbsp;
	</div>
	<div class='col-md-12'>
		<input type="radio" name="materialParameter" value='2' class='w3-radio' form='formAdd'>
		<label><?php echo (displayText('L4188', 'utf8', 0, 0, 1));?></label>&nbsp;
	</div>
</div>
<div class='row w3-padding-top'>
	<div class='col-md-12 w3-center'>
		<button type='submit' id='btnAdd' class='w3-btn w3-medium w3-indigo w3-round' form='formAdd'><i class='fa fa-plus'></i>&emsp;<b><?php echo (displayText('B4', 'utf8', 0, 0, 1));?></b></button>
	</div>
</div>