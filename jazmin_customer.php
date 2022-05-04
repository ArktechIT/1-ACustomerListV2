<?php  
include $_SERVER['DOCUMENT_ROOT']."/version.php";
$path = $_SERVER['DOCUMENT_ROOT']."/".v."/Common Data/";
set_include_path($path);
include('PHP Modules/mysqliConnection.php');
include('PHP Modules/gerald_functions.php');
include('PHP Modules/anthony_retrieveText.php');
include("PHP Modules/anthony_wholeNumber.php");
ini_set("display_errors", "on");
$tpl = new PMSTemplates;

$customerName = (isset($_POST['customerName'])) ? $_POST['customerName'] : '';
$customerAlias = (isset($_POST['customerAlias'])) ? $_POST['customerAlias'] : '';
$customerAddress = (isset($_POST['customerAddress'])) ? $_POST['customerAddress'] : '';
$customerPhone = (isset($_POST['customerPhone'])) ? $_POST['customerPhone'] : '';
$customerEmail = (isset($_POST['customerEmail'])) ? $_POST['customerEmail'] : '';
$tinNumber = (isset($_POST['tinNumber'])) ? $_POST['tinNumber'] : '';
$customerFax = (isset($_POST['customerFax'])) ? $_POST['customerFax'] : '';
$customerContactPerson = (isset($_POST['customerContactPerson'])) ? $_POST['customerContactPerson'] : '';
$status = (isset($_POST['status'])) ? $_POST['status'] : '';
$includeInactiveFlag = (isset($_POST['includeInactiveFlag'])) ? 1 : 0;


$sqlFilter = "";
$sqlFilterArray = array();
if($customerName!='') $sqlFilterArray[] = "customerName LIKE '%".$customerName."%'";
if($customerAlias!='') $sqlFilterArray[] = "customerAlias LIKE '%".$customerAlias."%'";
if($customerAddress!='') $sqlFilterArray[] = "customerAddress LIKE '%".$customerAddress."%'";
if($status!='') $sqlFilterArray[] = "status LIKE '%".$status."%'";
if($includeInactiveFlag==0)
{
    $sqlFilterArray[] = "status = 1";
} 
if(count($sqlFilterArray) > 0)

{
    $sqlFilter =  "WHERE " .implode(" AND ",$sqlFilterArray);
}

$totalRecords = 0;

echo $sql = "SELECT customerName, customerAlias, customerAddress, customerPhone, customerEmail, tinNumber, customerFax, customerContactPerson, status FROM sales_customer ".$sqlFilter."";
$sqlFilter = trim(preg_replace('/\s+/', ' ', $sqlFilter));
$query = $db->query($sql);
if($query AND $query->num_rows > 0)
{
    $totalRecords = $query->num_rows;
}
//TAMANG
// $visitorBtn = $tpl->setDataValue("L482")
//               ->setAttribute([
//                     "name"  => "visitorAdd",
//                     "id"    => "visitorAdd"
//               ])
//               ->createButton();
//TAMANG

$addBtn = $tpl->setDataValue("L482")
              ->setAttribute([
                    "name"  => "customerAdd",
                    "id"    => "customerAdd"
              ])
              ->createButton();

$filterBtn = $tpl->setDataValue("L437")
                 ->setAttribute([
                        "name"  => "filterData",
                        "id"    => "filterData"
                 ])
                 ->createButton();

$exportBtn = $tpl->setDataValue("L487")
                 ->setAttribute([
                        "name"  => "export",
                        "id"    => "exportData1"
                 ])
                 ->createButton();

$refreshBtn = $tpl->setDataValue("L436")
                  ->setAttribute([
                            "id"        => "refresh",
                            "onclick"   => "location.href='".$_SERVER['PHP_SELF']."'"
                  ])
                  ->createButton();

$customerLink = $tpl->createElement("a")
				  ->setDataValue("L24")
					->setAttribute([
						  "href"   => "/".v."/1-A Customer List V2/jazmin_customer.php"
					])
				  ->addClass("w3-pink")
					->createButton();
					
$supplierLink = $tpl->createElement("a")
				  ->setDataValue("L367")
					->setAttribute([
						  "href"   => "/".v."/4-B Supplier List V2/jazmin_supplierSummary.php"
					])
				  ->addClass("w3-blue")
					->createButton();

$subconLink = $tpl->createElement("a")
				  ->setDataValue("L91")
					->setAttribute([
						  "href"   => "/".v."/4-A Subcon List V2/jazmin_subconSummary.php"
					])
				  ->addClass("w3-blue")
					->createButton();

$title = displayText("L4119", "utf8", 0, 1);
PMSTemplates::includeHeader($title);
?> 

<form id='formFilter' action='<?php echo $_SERVER['PHP_SELF'];?>' method='POST'></form>
<?php 
$displayId = "1-A";
$version = "- ".displayText("L24", "utf8", 0, 0, 1);
createHeader($displayId, $version);
?>
<div class="container-fluid"> 
    <div class="w3-padding-top"></div>
    <div class="row w3-padding-top">
        <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
            <?php
			echo $customerLink.$supplierLink.$subconLink;
			?>
            <a href='jhon_visitorMonitoring.php'><button class="w3-btn w3-round w3-purple" name="visitorBtn" id="visitorBtn" style="border:none;width:120px;"><i class="btnIcon fa fa-plus"><b>VISITOR</b></i></button></a>
        </div>
        <div class="hidden-lg hidden-md hidden-sm col-xs-4">
            <div class="w3-padding-top"></div>
            <div class="w3-padding-top"></div>
        </div>
        <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
            <div class='w3-right'>
                <?php
                echo $addBtn.$filterBtn.$exportBtn.$refreshBtn;
                ?>
            </div>
        </div>
    </div>
    <div class="row w3-padding-top">
        <div class="col-lg-12"> 
            <label><?php echo (displayText("L41")); // Records ?> : <?php echo $totalRecords; ?></label>
            <table id='mainTableId' style='' class="table table-bordered table-striped table-condensed" data-counter='-1' data-detail-type='left'>
                <thead class='w3-indigo' style='text-transform: uppercase;'>
                    <th class='w3-center' style='vertical-align:middle;'><?php echo displayText('L209');?></th>
                    <th class='w3-center' style='vertical-align:middle;'><?php echo displayText('L528');?></th>
                    <th class='w3-center' style='vertical-align:middle;'><?php echo displayText('L529');?></th>
                    <th class='w3-center' style='vertical-align:middle;'><?php echo displayText('L531');?></th>
                    <th class='w3-center' style='vertical-align:middle;'><?php echo displayText('L498');?></th>
                    <th class='w3-center' style='vertical-align:middle;'><?php echo displayText('L511');?></th> 
                    <th class='w3-center' style='vertical-align:middle;'><?php echo displayText('L535');?></th>
                    <th class='w3-center' style='vertical-align:middle;'><?php echo displayText('L536');?></th>
                    <th class='w3-center' style='vertical-align:middle;'><?php echo displayText('L4185');;?></th>
                    <th class='w3-center' style='vertical-align:middle;'><?php echo displayText('L1387');?></th>
                </thead>
                <tbody class='text-center'>
                    
                </tbody>
                <tfoot class='w3-indigo' style='text-transform: uppercase;'>
                    <tr>
                        <th class='w3-center' style='vertical-align:middle;'></th>
                        <th class='w3-center' style='vertical-align:middle;'></th>
                        <th class='w3-center' style='vertical-align:middle;'></th>
                        <th class='w3-center' style='vertical-align:middle;'></th>
                        <th class='w3-center' style='vertical-align:middle;'></th>
                        <th class='w3-center' style='vertical-align:middle;'></th>
                        <th class='w3-center' style='vertical-align:middle;'></th>
                        <th class='w3-center' style='vertical-align:middle;'></th>
                        <th class='w3-center' style='vertical-align:middle;'></th>
                        <th class='w3-center' style='vertical-align:middle;'></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
<div id='modal-izi'><span class='izimodal-content'></span></div>
<div id='modal-izi-edit'><span class='izimodal-content-edit'></span></div>
<?php
PMSTemplates::includeFooter();
?>
<script>
function modalFunctionEdit(customerId='')
{
    $("#modal-izi").iziModal("close");
    $("#modal-izi-edit").iziModal({
        title 					: '<i class="fa fa-list w3-large"></i>&emsp;<label class="w3-large">EDIT</label>',
        headerColor 			: '#1F4788',
        subtitle 				: '',
        width 					: 500,
        fullscreen 				: false,
        // openFullscreen			: true,
        transitionIn 			: 'comingIn',
        transitionOut 			: 'comingOut',
        padding 				: 20,
        radius 					: 0,
        restoreDefaultContent 	: true,
        closeOnEscape           : true,
        closeButton             : true,
        overlayClose            : false,
        onOpening   			: function(modal){
                                    modal.startLoading();
                                    setTimeout(function(){
                                        $.post( "anthony_editCustomer.php", { cusEdit: customerId }, function( data ) {
                                            $( ".izimodal-content-edit" ).html(data);
                                            modal.stopLoading();
                                        });
                                    }, 100);
                                },
        onClosed                : function(modal){
                                        $("#modal-izi-edit").iziModal("destroy");
                            } 
    });

    $("#modal-izi-edit").iziModal("open");
}

$(function(){
    var sqlFilter = "<?php echo $sqlFilter; ?>";
    var dataTable = $('#mainTableId').DataTable( {
        "searching"    : false,
        "processing"    : true,
        "ordering"      : false,
        "serverSide"    : true,
        "bInfo" : false,
        "ajax":{
            url     :"jazmin_customerAJAX.php", // json datasource
            type    : "post",  // method  , by default get
            data    : {
                        "sqlFilter"     : sqlFilter
                        },
            error: function(){  // error handling
                $(".mainTableId-error").html("");
                $("#mainTableId").append('<tbody class="mainTableId-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                $("#mainTableId_processing").css("display","none");
                
            }
        },
        "columnDefs": [
                    { 
                        "width"     : "5%",
                        "targets"   : 6
                    },
                    {
                        render: function (data, type, full, meta) {
                            return "<div class='text-wrap width-200'>" + data + "</div>";
                        },
                        targets: [0, 2, 3, 7]
                    },

                    {
                        render: function (data, type, full, meta) {
                            var new1 = data.replace(";",";<br>");
                            return "<div style='white-space:normal; width:150px;'>" + new1 + "</div>";
                        },
                        targets: [4]
                    }
        ],

        fixedColumns: false,
        deferRender: true,
        scrollY     : 530,
        scrollX     : true,
        scroller    : {
            loadingIndicator    : true
        },
        stateSave   : false
    });
    
    $("#filterData").on('click', function (event) {
        var filterDataPost = "<?php echo str_replace('"',"'",json_encode($_POST));?>";
        var filterDataGet = "<?php echo str_replace('"',"'",json_encode($_GET));?>";

        $("#modal-izi").iziModal({
            title                   : '<i class="fa fa-flash"></i> <?php echo (displayText("B7", "utf8", 0, 0, 1)); ?>',
            headerColor             : '#1F4788',
            subtitle                : '<b><?php echo strtoupper(date('F d, Y'));?></b>',
            width                   : 1200,
            fullscreen              : false,
            transitionIn            : 'comingIn',
            transitionOut           : 'comingOut',
            padding                 : 20,
            radius                  : 0,
            top                     : 10,
            restoreDefaultContent   : true,
            closeOnEscape           : true,
            closeButton             : true,
            overlayClose            : false,
            onOpening               : function(modal){
                                        modal.startLoading();
                                        $.post( "jazmin_filterCustomer.php", {
                                            sqlFilter                     : sqlFilter,
                                            filterDataPost                : filterDataPost,
                                            filterDataGet                 : filterDataGet
                                        }, function( data ) {
                                            $( ".izimodal-content" ).html(data);
                                            modal.stopLoading();
                                        });
                                    },
                onClosed            : function(modal){
                                        $("#modal-izi").iziModal("destroy");
                        }
        });

        $("#modal-izi").iziModal("open");
    });        

    $("#customerAdd").on('click', function (event) {
        $("#modal-izi").iziModal({
            title 					: '<i class="fa fa-plus w3-large"></i>&emsp;<label class="w3-large" style="text-transform: uppercase;"><?php echo displayText("B4", "utf8", 0, 0, 1);?></label>',
            headerColor 			: '#1F4788',
            subtitle 				: '',
            width 					: 400,
            fullscreen 				: false,
            // openFullscreen			: true,
            transitionIn 			: 'comingIn',
            transitionOut 			: 'comingOut',
            padding 				: 20,
            radius 					: 0,
            restoreDefaultContent 	: true,
            closeOnEscape           : true,
            closeButton             : true,
            overlayClose            : false,
            onOpening   			: function(modal){
                                        modal.startLoading();
                                        setTimeout(function(){
                                            $.post( "jazmin_addCustomer.php", function( data ) {
                                                $( ".izimodal-content" ).html(data);
                                                modal.stopLoading();
                                            });
                                        }, 100);
                                    },
            onClosed                : function(modal){
                                            $("#modal-izi").iziModal("destroy");
                                } 
        });

        $("#modal-izi").iziModal("open");
    });        
});
</script>
</html>
