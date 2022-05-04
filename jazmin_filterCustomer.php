<?php
include $_SERVER['DOCUMENT_ROOT']."/version.php";
$path = $_SERVER['DOCUMENT_ROOT']."/".v."/Common Data/";
set_include_path($path);
include('PHP Modules/mysqliConnection.php');
include('PHP Modules/gerald_functions.php');
include('PHP Modules/anthony_retrieveText.php');
include("PHP Modules/anthony_wholeNumber.php");
ini_set("display_errors", "on");

$sqlFilter = isset($_POST['sqlFilter']) ? $_POST['sqlFilter'] : "";
$_POST = json_decode(str_replace("'",'"',$_POST['filterDataPost']),true);
$_GET = json_decode(str_replace("'",'"',$_POST['filterDataGet']),true);

function createFilterInput($sqlFilter,$column,$value)
{
	include('PHP Modules/mysqliConnection.php');
	$return = "<option value=''>All </option>";	
	if(in_array($column,array('customerName', 'customerAlias', 'customerAddress', 'customerPhone', 'customerEmail', 'tinNumber', 'customerFax', 'customerContactPerson', 'status')))
	{
		$columnSql = "a.".$column;
	}

	$sql = "SELECT DISTINCT ".$columnSql." FROM sales_customer as a ".$sqlFilter."";
	$query = $db->query($sql);
	if($query->num_rows > 0)
	{
		while($result = $query->fetch_array())
		{
			$valueColumn = $valueCaption = $result[$column];
			
			$selected = ($value==$result[$column]) ? 'selected' : '';
			
			if($column=='status')
			{
				if($valueColumn==0)		$valueCaption = 'Inactive';
				else if($valueColumn==1)	$valueCaption = 'Active';
			}

			$string = $string.$counterData;
			if(trim($valueColumn) != "")
			{
				$return .= "<option value='".$valueColumn."' ".$selected.">".$string." ".$valueCaption."</option>";
			}
		}
	}
	return $return;
}

$customerName = (isset($_POST['customerName'])) ? $_POST['customerName'] : '';
$customerAlias = (isset($_POST['customerAlias'])) ? $_POST['customerAlias'] : '';
$customerAddress = (isset($_POST['customerAddress'])) ? $_POST['customerAddress'] : '';
$status = (isset($_POST['status'])) ? $_POST['status'] : '';
$includeInactiveFlag = (isset($_POST['includeInactiveFlag'])) ? 1 : 0;
?>

<div class='w3-padding-top'></div>
<div class='row'>
    <div class='col-md-2'>
        <label class='w3-tiny'><?php echo displayText('L209', 'utf8', 0, 0, 1); # NAME ?></label>
		&emsp;<span onclick="this.form.submit();" class='w3-right filterIcon'><i style='cursor:pointer;' class='fa fa-filter w3-small w3-text-blue'></i></span>
		<input list='customerName' placeholder='<?php echo displayText("L209",'utf8',0,1); ?>' name='customerName' class='w3-input w3-border w3-pale-red' value='<?php echo $customerName;?>' form='formFilter'>
		<datalist id = 'customerName'>
		<?php echo createFilterInput($sqlFilter,'customerName',$customerName);?>
		</datalist>
	</div>
    <div class='col-md-2'>
        <label class='w3-tiny'><?php echo displayText('L528', 'utf8', 0, 0, 1); # ALIAS ?></label>
		&emsp;<span onclick="this.form.submit();" class='w3-right filterIcon'><i style='cursor:pointer;' class='fa fa-filter w3-small w3-text-blue'></i></span>
		<input list='customerAlias' placeholder='<?php echo displayText("L528",'utf8',0,1); ?>' name='customerAlias' class='w3-input w3-border w3-pale-red' value='<?php echo $customerAlias;?>' form='formFilter'>
		<datalist id = 'customerAlias'>
		<?php echo createFilterInput($sqlFilter,'customerAlias',$customerAlias);?>
		</datalist>
	</div>
    <div class='col-md-2'>
        <label class='w3-tiny'><?php echo displayText('L529', 'utf8', 0, 0, 1); # Address ?></label>
		&emsp;<span onclick="this.form.submit();" class='w3-right filterIcon'><i style='cursor:pointer;' class='fa fa-filter w3-small w3-text-blue'></i></span>
		<input list='customerAddress' placeholder='<?php echo displayText("L529",'utf8',0,1); ?>' name='customerAddress' class='w3-input w3-border w3-pale-red' value='<?php echo $customerAddress;?>' form='formFilter'>
		<datalist id = 'customerAddress'>
		<?php echo createFilterInput($sqlFilter,'customerAddress',$customerAddress);?>
		</datalist>
	</div>
    <div class='col-md-2'>
		<div class='w3-padding'></div>
		<span class='w3-padding w3-round w3-khaki'>
			<b><?php echo displayText('L530', 'utf8', 0, 0, 1); # SHOW INACTIVE ?></b>&emsp;
			<input onclick='this.form.submit();' type='checkbox' class='w3-check'  style='position:relative; top:8px;' name='includeInactiveFlag' form='formFilter' <?php if($includeInactiveFlag==1) { echo 'checked'; }?>>
		</span>
	</div>
</div>
<div class='row w3-padding-top'>
    <div class='col-md-12 w3-center'>
        <button class='w3-btn w3-round w3-small w3-indigo' form='formFilter'><i class='fa fa-search'></i>&emsp;<b><?php echo (displayText("B5", 'utf8', 0, 0, 1)); ?></b></button>
    </div>
</div>
