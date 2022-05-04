<?php 
include $_SERVER['DOCUMENT_ROOT']."/version.php";
$path = $_SERVER['DOCUMENT_ROOT']."/".v."/Common Data/";
set_include_path($path);    
include('Templates/mysqliConnection.php');
ini_set("display_errors", "on");

$varSupplier = $_POST['supplier'];

$sql="SELECT visitorId FROM system_visitors ORDER BY visitorId DESC LIMIT 1";
$queryId =$db->query($sql);
$resultId = $queryId->fetch_assoc();
$lastId = $resultId['visitorId'];

if($lastId == "")
{
    $visitorId ="V0001";
}
else 
{
    $leadingZero = "";
    $visitorId = substr($lastId,1);
    $newCount = ($visitorId + 1);

    for($i=0; $i < 4-(strlen($newCount)); $i++)
    {
        $leadingZero.= "0";
    }
    $newVisitorId = "V".$leadingZero.$newCount;
}


if(isset($_POST['btnAdd']))
{
    $visitorId      = $_POST['visitorId'];
    $supplierName   = $_POST['supplierNameAdd'];
    $supplierType   = $_POST['radioBtn'];

    $sql = "INSERT INTO system_visitors (visitorId,supplierName,visitorType) VALUES ('".$visitorId."','".$supplierName."','".$supplierType."')";
    $queryInsertVisitor = $db->query($sql);

    header("Location:jhon_visitorMonitoring.php");
    exit(0);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Visitors</title>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
</head>
<body>
<div class="container-fluid">
<form action="jhon_addVisitors.php" method="post">

    <div class="row">
                    <label>TYPE:</label>
                    <div class="d-flex flex-row">
                    
                        <input class="radioBtn form-check-input" type="radio" name="radioBtn" value="0" class="radio">
                        <label style="margin-left:5px;" class="form-check-label">
                                Supplier
                        </label>
                        
                    
                        <input class="radioBtn2 form-check-input" type="radio" name="radioBtn" id="radioBtn" style="margin-left:20px;" value="1" class="radio">
                        <label style="margin-left:5px;" class="form-check-label">
                                Subcon
                        </label>
                    </div>
 
    </div>
    <div class="row">
        <div class="col">
            <label>VISITOR ID:</label>
            <input type="text" name="visitorId" id="visitorId" class="form-control" style="background:white;" value="<?php echo $newVisitorId;?>" readonly>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <label>SUPPLIER NAME:</label>
            <!-- <input type="text" list="supplierNames" name="supplierName" id="supplierName" class="form-control"> -->
            <select name="supplierNameAdd" id="supplierNameAdd" class="form-control">
                <option>--</option>
            </select>
        </div>
    </div>
    
    <div class="row w3-padding-top w3-center">
        <div class="col">
            
            <button type="submit" name="btnAdd" id="btnAdd" class="w3-indigo" style="border:none;text-align:center;width:120px;border-radius:5px;height:27px;">Save</button>
        </div>
    </div>
</form>
</div>   
</body>
</html>
<script>
		$(document).on('change','.radioBtn',function(){
            // var supplierId = $(this).data('supplierId');
            // var supplierName = $(this).data('supplierName');
			$.ajax({
				url:"jhon_supplier.php",
				type:'post',
				data:{
                    radioBtn    : 'radioBtn'

				},
				success:function(data){
					$("#supplierNameAdd").html(data);
				}
			});
		});
        $(document).on('change','.radioBtn2',function(){
            // var supplierId = $(this).data('supplierId');
            // var supplierName = $(this).data('supplierName');
			$.ajax({
				url:"jhon_supplier.php",
				type:'post',
				data:{
                    radioBtn2    : 'radioBtn2'

				},
				success:function(data){
					$("#supplierNameAdd").html(data);
				}
			});
		});  
</script>