<?php  
include $_SERVER['DOCUMENT_ROOT']."/version.php";
$path = $_SERVER['DOCUMENT_ROOT']."/".v."/Common Data/";
set_include_path($path);
include('PHP Modules/mysqliConnection.php');
include('PHP Modules/gerald_functions.php');
include('PHP Modules/anthony_retrieveText.php');
include("PHP Modules/anthony_wholeNumber.php");
ini_set("display_errors", "on");

if(isset($_POST['submitcustomerEdit']))
{
	$sql = "SELECT * FROM sales_customer where customerId = ".$_POST['customerId']."";
	$query = $db->query($sql);
	if($query->num_rows>0)
	{
		while($result = $query->fetch_assoc())
		{
			$customerName =  $result['customerName']; 
			$customerAlias =  $result['customerAlias']; 
			$customerAddress =  $result['customerAddress']; 
			$customerPhone =  $result['customerPhone']; 
			$customerEmail =  $result['customerEmail']; 
			$customerFax =  $result['customerFax']; 
			$customerContactPerson =  $result['customerContactPerson']; 
			$companyProfile =  $result['companyProfile']; 	
		}

		$sql = "update sales_customer set materialParameter = '".$_POST['materialParameter']."', customerName = '".$_POST['customerName']."' , customerAlias = '".$_POST['customerAlias']."' , customerAddress = '".$_POST['customerAddress']."' , customerPhone = '".$_POST['customerPhone']."' , customerEmail = '".$_POST['customerEmail']."' , tinNumber = '".$_POST['tinNumber']."' , customerFax = '".$_POST['customerFax']."' , customerContactPerson = '".$_POST['customerContactPerson']."' , companyProfile = '".$_POST['companyProfile']."' , status = ".$_POST['status']." where customerId= ".$_POST['customerId']."";
		$queryUpdate = $db->query($sql);

		header("Location: jazmin_customer.php");
		exit();
	}
	// $pro = mysqli_query("SELECT * FROM sales_customer where customerId = ".$_POST['customerId']); 
	// while($pp = mysqli_fetch_assoc($pro))
	// 	{ 
	// 	$customerName =  $pp[customerName]; 
	// 	$customerAlias =  $pp[customerAlias]; 
	// 	$customerAddress =  $pp[customerAddress]; 
	// 	$customerPhone =  $pp[customerPhone]; 
	// 	$customerEmail =  $pp[customerEmail]; 
	// 	$customerFax =  $pp[customerFax]; 
	// 	$customerContactPerson =  $pp[customerContactPerson]; 
	// 	$companyProfile =  $pp[companyProfile]; 	
	// 	}
	// $updte = mysqli_query("update sales_customer set customerName = '".$_POST['customerName']."' , customerAlias = '".$_POST['customerAlias']."' , customerAddress = '".$_POST['customerAddress']."' , customerPhone = '".$_POST['customerPhone']."' , customerEmail = '".$_POST['customerEmail']."' , tinNumber = '".$_POST['tinNumber']."' , customerFax = '".$_POST['customerFax']."' , customerContactPerson = '".$_POST['customerContactPerson']."' , companyProfile = '".$_POST['companyProfile']."' , status = ".$_POST['status']." where customerId= ".$_POST['customerId']);
	// header("Location: jazmin_customer.php");
}
if($_POST['cusEdit']!='')
{
	$sql = "SELECT * FROM sales_customer where customerId = ".$_POST['cusEdit'];
	$query = $db->query($sql);
	if($query->num_rows>0)
	{
		$result = $query->fetch_assoc();
		$customerName =  $result['customerName']; 
		$customerAlias =  $result['customerAlias']; 
		$customerAddress =  $result['customerAddress']; 
		$customerPhone =  $result['customerPhone']; 
		$customerEmail =  $result['customerEmail']; 
		$customerTin =  $result['tinNumber']; 
		$customerFax =  $result['customerFax']; 
		$customerContactPerson =  $result['customerContactPerson']; 
		$companyProfile =  $result['companyProfile'];
		$status = $result['status'];
		$materialParameter = $result['materialParameter'];

		$selected1 = ($materialParameter == 0) ? "checked" : "";
		$selected2 = ($materialParameter == 1) ? "checked" : "";
		$selected3 = ($materialParameter == 2) ? "checked" : "";
	}
	echo "<form id='formEdit' action = 'anthony_editCustomer.php' method = 'POST'></form>";
	echo "<input form='formEdit' type='hidden' name='customerId' value='".$_POST['cusEdit']."'/>";
	?>
	<div class='row'>
		<div class='col-md-12'>
			<label><?php echo (displayText('L269', 'utf8', 0, 0, 1));?></label>
			<input type="text" name="customerName" class='w3-input w3-border w3-small w3-pale-yellow' value='<?php echo $customerName; ?>' form='formEdit'>
		</div>
	</div>
	<div class='row w3-padding-top'>
		<div class='col-md-12'>
			<label><?php echo (displayText('L641', 'utf8', 0, 0, 1));?></label>
			<input type="text" name="customerAlias" class='w3-input w3-border w3-small w3-pale-yellow' value='<?php echo $customerAlias; ?>' form='formEdit'>
		</div>
	</div>
	<div class='row w3-padding-top'>
		<div class='col-md-12'>
			<label><?php echo (displayText('L1108', 'utf8', 0, 0, 1));?></label>
			<textarea type="text" rows='5' cols='20' name='customerAddress' class='w3-input w3-border w3-small w3-pale-yellow' form='formEdit'><?php echo $customerAddress; ?></textarea>
		</div>
	</div>
	<div class='row w3-padding-top'>
		<div class='col-md-12'>
			<label><?php echo (displayText('L1109', 'utf8', 0, 0, 1));?></label>
			<input type="text" name="customerPhone" class='w3-input w3-border w3-small w3-pale-yellow' value='<?php echo $customerPhone; ?>' form='formEdit'>
		</div>
	</div>
	<div class='row w3-padding-top'>
		<div class='col-md-12'>
			<label><?php echo (displayText('L1110', 'utf8', 0, 0, 1));?></label>
			<input type="text" name="customerEmail" class='w3-input w3-border w3-small w3-pale-yellow' value='<?php echo $customerEmail; ?>' form='formEdit'>
		</div>
	</div>
	<div class='row w3-padding-top'>
		<div class='col-md-12'>
			<label><?php echo (displayText('L1111', 'utf8', 0, 0, 1));?></label>
			<input type="text" name="tinNumber" class='w3-input w3-border w3-small w3-pale-yellow' value='<?php echo $customerTin; ?>' form='formEdit'>
		</div>
	</div>
	<div class='row w3-padding-top'>
		<div class='col-md-12'>
			<label><?php echo (displayText('L1112', 'utf8', 0, 0, 1));?></label>
			<input type="text" name="customerFax" class='w3-input w3-border w3-small w3-pale-yellow' value='<?php echo $customerFax; ?>' form='formEdit'>
		</div>
	</div>
	<div class='row w3-padding-top'>
		<div class='col-md-12'>
			<label><?php echo (displayText('L1113', 'utf8', 0, 0, 1));?></label>
			<input type="text" name="customerContactPerson" class='w3-input w3-border w3-small w3-pale-yellow' value='<?php echo $customerContactPerson; ?>' form='formEdit'>
		</div>
	</div>
	<div class='row w3-padding-top'>
		<div class='col-md-12'>
			<label><?php echo (displayText('L4026', 'utf8', 0, 0, 1));?></label>
			<textarea type="text" rows='5' cols='20' name='companyProfile' class='w3-input w3-border w3-small w3-pale-yellow' form='formEdit'><?php echo $companyProfile; ?></textarea>
		</div>
	</div>
	<div class='row w3-padding-top'>
		<div class='col-md-12'>
			<label><?php echo (displayText('L4185', 'utf8', 0, 0, 1));?></label>
		</div>
		<div class='col-md-12'>
			<input <?php echo $selected1; ?> type="radio" name="materialParameter" value='0' class='w3-radio' form='formEdit'>
			<label><?php echo (displayText('L4186', 'utf8', 0, 0, 1));?></label>&nbsp;
		</div>
		<div class='col-md-12'>
			<input <?php echo $selected2; ?> type="radio" name="materialParameter" value='1' class='w3-radio' form='formEdit'>
			<label><?php echo (displayText('L4187', 'utf8', 0, 0, 1));?></label>&nbsp;
		</div>
		<div class='col-md-12'>
			<input <?php echo $selected3; ?> type="radio" name="materialParameter" value='2' class='w3-radio' form='formEdit'>
			<label><?php echo (displayText('L4188', 'utf8', 0, 0, 1));?></label>&nbsp;
		</div>
	</div>
	<div class='row w3-padding-top'>
		<div class='col-md-12'>
			<label><?php echo (displayText('L172', 'utf8', 0, 0, 1));?></label>&emsp;&emsp;
			<label><input class='w3-radio' type="radio" name = 'status' value = '1' <?php if($status == 1){echo "checked";}?> required form='formEdit'>&nbsp;<?php echo displayText('L549', 'utf8', 0, 0, 1);?></label>&emsp;
			<label><input class='w3-radio' type="radio" name = 'status' value = '0' <?php if($status == 0){echo "checked";}?> required form='formEdit'>&nbsp;<?php echo displayText('L1058', 'utf8', 0, 0, 1);?></label>&emsp;
		</div>
	</div>
	<div class='row w3-padding-top'>
		<div class='col-md-12 w3-center'>
			<button type='submit' name='submitcustomerEdit' class='w3-btn w3-medium w3-indigo w3-round' form='formEdit'><i class='fa fa-check'></i>&emsp;<b><?php echo (displayText('L1054', 'utf8', 0, 0, 1));?></b></button>
		</div>
	</div>
	<?php
}
else
{
	//END customer List-----------------------------
	//----------------------- END close2 is clicked-- from master to ppic
	if($_GET['clck']=='3')
	{
	?> 
		<script type="text/javascript">
		function Validate3()
		{
			window.open('','fenster3','left=50,screenX=300,screenY=30,resizable,scrollbars,status,width=700,height=650')
			return true;
		}
		</script>
		<center>
	<table>
	<tr>
	<td>
	<?php
	$lots=explode("`",$_POST['lots']);
	if($_POST['lots']==''){$num=0;}
	else{$num=count($lots);}
	//	for($x=0;$x<count($lots);$x++)
	//	{
	//	echo $lots[$x]."<br>";
	//	}
	//echo $_POST['lots'];
	if($num>0){ 
	echo '<center>Are you sure you want to print '.$num.' items?</center><br>';
	?></td></tr><tr><td>
	<form name='inputForm'  onsubmit="javascript:return Validate3();" action ='convertSales.php?source=printAllSales2' method ='POST' target="fenster3" >
	<input type="hidden" name="lots" value="<?php echo $_POST['lots']; ?>">
	<!--input type="image" src="images/printselected.png" width="60" height="35" alt="PRINT SELECT" align="center" name='print' value='print'-->
	<center>
	<input type="image" src="../images/printselected.png" width="60" height="35" alt="PRINT SELECT" align="center" name='print' value='print'>
	</center>
	</form></td>
	<?php }
	else{ 
	echo '<center><font color= red><b> ERROR!!!</b></font></center><br>';
	echo '<center><font color= red> NO Item Selected</font></center><br>';
	} ?>
	</tr></table>
	<?php
	}
	else if($_GET['clck']=='4')
	{
	?> 
	<script type="text/javascript">
	function Validate3()
	{
	window.open('','fenster3','left=50,screenX=300,screenY=30,resizable,scrollbars,status,width=700,height=650')
		return true;
	}
	</script>
	<center>
	<table><tr><td>
	<?php

	$poid=explode("`",$_POST['poid']);
	if($_POST['poid']==''){$num=0;}
	else{$num=count($poid);}
	//	for($x=0;$x<count($lots);$x++)
	//	{
	//	echo $lots[$x]."<br>";
	//	}
	//echo $_POST['lots'];
	if($num>0){ 
	echo '<center>Are you sure you want to print '.$num.' items?</center><br>';
	?></td></tr><tr><td>
	<form name='inputForm'  onsubmit="javascript:return Validate3();" action ='converter.php?source=printAllSalesace' method ='POST' target="fenster3" >
	<input type="hidden" name="poid" value="<?php echo $_POST['poid']; ?>">
	<!--input type="image" src="images/printselected.png" width="60" height="35" alt="PRINT SELECT" align="center" name='print' value='print'-->
	<center>
	<input type="image" src="../images/printselected.png" width="60" height="35" alt="PRINT SELECT" align="center" name='print' value='print'>
	</center>
	</form></td>
	<?php }
	else{ 
	echo '<center><font color= red><b> ERROR!!!</b></font></center><br>';
	echo '<center><font color= red> NO Item Selected</font></center><br>';
	} ?>
	</tr></table>
	<?php
	}
}
?>
