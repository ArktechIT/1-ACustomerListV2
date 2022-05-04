<?php 
include $_SERVER['DOCUMENT_ROOT']."/version.php";
$path = $_SERVER['DOCUMENT_ROOT']."/".v."/Common Data/";
set_include_path($path);    
include('Templates/mysqliConnection.php');
ini_set("display_errors", "on");


$visitorId = $_POST['visitorId'];

$sql="SELECT supplierName, visitorType FROM system_visitors WHERE visitorId ='".$visitorId."'";
$queryVisitors = $db->query($sql);
$resultVisitors = $queryVisitors->fetch_assoc();
$supplierName = $resultVisitors['supplierName'];
$visitorType = $resultVisitors['visitorType'];


if(isset($_POST['btnEdit']))
{
    $visitId            = isset($_POST['visitorId'])?$_POST['visitorId']:'';
    $supplierNameEdit   = isset($_POST['supplierNameEdit'])?$_POST['supplierNameEdit']:'';
    $supplierType       = isset($_POST['radioBtn'])?$_POST['radioBtn']:'';

    echo $sql = "UPDATE system_visitors SET visitorId ='".$visitId."', supplierName = '".$supplierNameEdit."', visitorType = '".$supplierType."' WHERE visitorId = '".$visitorId."'";
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
<form action="jhon_editVisitors.php" method="post">

    <div class="row">
                    <label>TYPE:</label>
                    <div class="d-flex flex-row">
                    
                        <input class="radioBtn form-check-input" type="radio" name="radioBtn" value="0" class="radio" <?php echo ($resultVisitors['visitorType'] == 0)? 'checked':'' ?>>
                        <label style="margin-left:5px;" class="form-check-label">
                                Supplier
                        </label>
                        
                    
                        <input class="radioBtn2 form-check-input" type="radio" name="radioBtn" id="radioBtn" style="margin-left:20px;" value="1" class="radio" <?php echo ($resultVisitors['visitorType'] == 1)? 'checked':'' ?>>
                        <label style="margin-left:5px;" class="form-check-label">
                                Subcon
                        </label>
                    </div>
 
    </div>
    <div class="row">
        <div class="col">
            <label>VISITOR ID:</label>
            <input type="text" name="visitorId" id="visitorId" class="form-control" value="<?php echo $visitorId; ?>" disable/>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <label>SUPPLIER NAME:</label>
            <!-- <input type="text" list="supplierNames" name="supplierName" id="supplierName" class="form-control"> -->
            <select name="supplierNameEdit" id="supplierNameEdit" class="form-control">>
                
                <?php
                    if($visitorType == 0)
                    {
                        $sql = "SELECT supplierName FROM purchasing_supplier";
                        $querySupplier = $db->query($sql);
                        while($resultSupplier = $querySupplier->fetch_assoc())
                        {
                            $supName = $resultSupplier['supplierName'];

                            echo"<option value='".$supName."' ".(($supplierName == $supName)?'selected':'').">".$supName."</option>";
                        }
                    }
                    else if($visitorType == 1)
                    {
                        $sql = "SELECT subconName FROM purchasing_subcon";
                        $querySubcon = $db->query($sql);
                        while($resultSubcon = $querySubcon->fetch_assoc())
                        {
                            $subName = $resultSubcon['subconName'];

                            echo"<option value='".$subName."' ".(($supplierName == $subName)?'selected':'').">".$subName."</option>";
                        }
                    }
                ?>
            </select>
        </div>
    </div>
    
    <div class="row w3-padding-top w3-center">
        <div class="col">
            
            <button type="submit" name="btnEdit" id="btnEdit" class="w3-indigo" style="border:none;text-align:center;width:120px;border-radius:5px;height:27px;">Save</button>
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
					$("#supplierNameEdit").html(data);
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
					$("#supplierNameEdit").html(data);
				}
			});
		});  
</script>