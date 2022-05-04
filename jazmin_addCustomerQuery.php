<?php
include $_SERVER['DOCUMENT_ROOT']."/version.php";
$path = $_SERVER['DOCUMENT_ROOT']."/".v."/Common Data/";
set_include_path($path);
include('PHP Modules/mysqliConnection.php');
include('PHP Modules/gerald_functions.php');
include('PHP Modules/anthony_retrieveText.php');
include("PHP Modules/anthony_wholeNumber.php");
ini_set("display_errors", "on");

$sql = "INSERT INTO sales_customer (customerName, customerAlias, customerAddress, customerPhone, customerEmail, tinNumber, customerFax, customerContactPerson, status, materialParameter) values ('".$_POST["customerName"]."', '".$_POST["customerAlias"]."', '".$_POST["customerAddress"]."', '".$_POST["customerPhone"]."', '".$_POST["customerEmail"]."', '".$_POST["tinNumber"]."', '".$_POST["customerFax"]."', '".$_POST["customerContactPerson"]."', '1', '".$_POST["materialParameter"]."')";
	$result = $db->query($sql);
	header('Location: jazmin_customer.php');
?>