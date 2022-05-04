<?php
include $_SERVER['DOCUMENT_ROOT']."/version.php";
$path = $_SERVER['DOCUMENT_ROOT']."/".v."/Common Data/";
set_include_path($path);
include('PHP Modules/mysqliConnection.php');
include('PHP Modules/gerald_functions.php');
include('PHP Modules/anthony_retrieveText.php');
include("PHP Modules/anthony_wholeNumber.php");
ini_set("display_errors", "on");

$filename ="Customer_List.xls";
header('Content-type: application/ms-excel');
header('Content-Disposition: attachment; filename='.$filename);

echo "<table border = 1>";
	echo "<thead>
			<tr>";
			echo "<th>".displayText('L209')."</th>";
			echo "<th>".displayText('L528')."</th>";
			echo "<th>".displayText('L529')."</th>";
			echo "<th>".displayText('L531')."</th>";
			echo "<th>".displayText('L535')."</th>";
			echo "<th>Tin #</th>";
			echo "<th>".displayText('L239')."</th>";
			echo "<th>".displayText('L536')."</th>";
			echo "<th>Nature Of Business</th>";
		echo "</tr>";
	echo "</thead>";
	
	echo "<tbody>";
	$sql = "SELECT * FROM sales_customer WHERE status = 1 ";
	$getCustomers = $db->query($sql);
	while($getCustomersResult = $getCustomers->fetch_array())
	{
		echo "<tr>
			<td>".$getCustomersResult['customerName']."</td>
			<td>".$getCustomersResult['customerAlias']."</td>
			<td>".$getCustomersResult['customerAddress']."</td>
			<td>".$getCustomersResult['customerPhone']."</td>
			<td>".$getCustomersResult['customerFax']."</td>
			<td>".$getCustomersResult['tinNumber']."</td>
			<td>".$getCustomersResult['customerEmail']."</td>
			<td>".$getCustomersResult['customerContactPerson']."</td>
			<td>".$getCustomersResult['companyProfile']."</td>
		</tr>";
	}
	echo "</tbody>";
echo "</table>";
?>
