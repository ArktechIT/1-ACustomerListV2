<?php 
include $_SERVER['DOCUMENT_ROOT']."/version.php";
$path = $_SERVER['DOCUMENT_ROOT']."/".v."/Common Data/";
set_include_path($path);    
include('Templates/mysqliConnection.php');
ini_set("display_errors", "on");


if(isset($_POST['radioBtn']))
{
    echo "<option>--</option>";
    if($_POST['radioBtn'] == 'radioBtn')
    {
        $sql="SELECT DISTINCT supplierName FROM purchasing_supplier ORDER BY supplierName ASC";
        $querySupplier = $db->query($sql);
        if($querySupplier AND $querySupplier->num_rows)
        {
            while($resultSupplier = $querySupplier->fetch_assoc())
            {
            //$supplierId = $resultSupplier['supplierId'];
            $supplierName = $resultSupplier['supplierName'];

            echo"<option value='".$supplierName."'>".$supplierName."</option>";
            }
        }

    }
}
if(isset($_POST['radioBtn2']))
{
    echo "<option>--</option>";
    if($_POST['radioBtn2'] == 'radioBtn2')
    {
        $sql="SELECT DISTINCT subconName FROM purchasing_subcon ORDER BY subconName ASC";
        $querySubcon = $db->query($sql);
        if($querySubcon AND $querySubcon->num_rows)
        {
            while($resultSubcon = $querySubcon->fetch_assoc())
            {
            //$supplierId = $resultSupplier['supplierId'];
            $subconName = $resultSubcon['subconName'];

            echo"<option value='".$subconName."'>".$subconName."</option>";
            }
        }

    }
}


?>