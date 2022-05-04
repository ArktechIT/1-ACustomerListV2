<?php
include $_SERVER['DOCUMENT_ROOT']."/version.php";
$path = $_SERVER['DOCUMENT_ROOT']."/".v."/Common Data/";
set_include_path($path);    
include('Templates/mysqliConnection.php');
// include('PHP Modules/anthony_wholeNumber.php');
// include('PHP Modules/anthony_retrieveText.php');
// include('PHP Modules/gerald_functions.php');
// include('PHP Modules/rose_prodfunctions.php');
ini_set("display_errors", "on");

$visitorId = $_POST['visitorId'];
   
$requestData= $_REQUEST;
$sqlData = isset($requestData['sqlData']) ? $requestData['sqlData'] : "";
//$exportExcelData = isset($requestData['exportExcelData']) ? $requestData['exportExcelData'] : "";
$totalRecords = (isset($requestData['totalRecords'])) ? $requestData['totalRecords'] : 0;
$totalFiltered = $totalRecords;
$totalData = $totalFiltered;

$data = array();

$sql= $sqlData;
$sql.=" LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
$counter = $requestData['start'];
$queryVisitors = $db->query($sql) or die ($db->error);
$num=0;
    
 
if($queryVisitors AND $queryVisitors->num_rows > 0)
{
    while($resultVisitors = $queryVisitors->fetch_assoc())
    {     
        $visitorId = $resultVisitors['visitorId'];
        $supplierName = $resultVisitors['supplierName'];
        $visitorType = ($resultVisitors['visitorType'] == 0)? 'Supplier':'Subcon';
       
        $button ="<button style='height:25px;width:40px;border:none;border-radius:5px;' class='w3-indigo' name='edit' title='Edit' onclick=\"modalEditForm('".$resultVisitors['visitorId']."')\"><i class='fa fa-edit'></i></button>";
     
        $nestedData = Array ();

        $nestedData[] = "<input type='checkbox' name='visitorIdArray[]' form='formPrint' value='".$visitorId."'>"." ". $num+=1;
        $nestedData[] = $visitorId;
        $nestedData[] = $supplierName;
        $nestedData[] = $visitorType;
        $nestedData[] = $button;

        $data[] = $nestedData;
    }
}
   
    

$json_data = array(
    "draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
    "recordsTotal"    => intval( $totalData ),  // total number of records
    "recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
    "data"            => $data   // total data array
);

echo json_encode($json_data);  // send data as json format
?>
