<?php
	include $_SERVER['DOCUMENT_ROOT']."/version.php";
	$path = $_SERVER['DOCUMENT_ROOT']."/".v."/Common Data/";
	set_include_path($path);
	include('PHP Modules/mysqliConnection.php');
	include('PHP Modules/gerald_functions.php');
	include('PHP Modules/anthony_retrieveText.php');
	include("PHP Modules/anthony_wholeNumber.php");
	ini_set("display_errors", "on");
	
	$requestData = $_REQUEST;
	$sqlFilter = $requestData['sqlFilter'];

	$sql = "SELECT * FROM sales_customer ".$sqlFilter."";
	$query=$db->query($sql);

	$totalData = $query->num_rows;
	$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.	
	$sql.=" LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
	$count = $requestData['start'];

	$data = array();
	$customerQuery = $db->query($sql);
	if($customerQuery AND $customerQuery->num_rows > 0)
	{
		while($customerQueryResult = $customerQuery->fetch_assoc())
		{
			$customerName	= $customerQueryResult['customerName'];
			$customerAlias	= $customerQueryResult['customerAlias'];
            $customerAddress	= $customerQueryResult['customerAddress'];
            $customerPhone	= $customerQueryResult['customerPhone'];
            $customerEmail= $customerQueryResult['customerEmail'];
            $tinNumber= $customerQueryResult['tinNumber'];
            $customerFax= $customerQueryResult['customerFax'];
			$customerContactPerson= $customerQueryResult['customerContactPerson'];
			$materialParameter= $customerQueryResult['materialParameter'];
			$edit = "<b><i class='fa fa-edit w3-text-blue w3-medium' style='cursor:pointer;' onclick=\"modalFunctionEdit(".$customerQueryResult['customerId'].");\"></i></b>";
			// $edit = "<a onclick=\"TINY.box.show({url:'anthony_editCustomer.php',post:'cusEdit=".$customerQueryResult['customerId']."',width:400,height:420,opacity:10,topsplit:6,animate:false,close:true})\"><center><img src='../Common Data/Templates/images/edit1.png' width='15' height='15' alt='VIEW' title='Details' ></center></a> ";
			
			if($materialParameter == 0) $materialParameterText = "Purchased";
			if($materialParameter == 1) $materialParameterText = "Customer Supplied";
			if($materialParameter == 2) $materialParameterText = "Both";

			$nestedData = array();
			$nestedData[] = $customerName;
			$nestedData[] = $customerAlias;
			$nestedData[] = $customerAddress;
			$nestedData[] = $customerPhone;
			$nestedData[] = $customerEmail;
			$nestedData[] = $tinNumber;
			$nestedData[] = $customerFax;
			$nestedData[] = $customerContactPerson;
			$nestedData[] = $materialParameterText;
			$nestedData[] = $edit;
			$data[] = $nestedData;
	}	
	// --------------------------------------------------- End of Execute Query ---------------------------------------------			
}

	$json_data = array(
				"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
				"recordsTotal"    => intval( $totalData ),  // total number of records
				"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
				"data"            => $data   // total data array
				);

	echo json_encode($json_data);  // send data as json format	
?>
