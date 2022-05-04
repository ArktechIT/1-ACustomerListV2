<?php
include $_SERVER['DOCUMENT_ROOT']."/version.php";
$path = $_SERVER['DOCUMENT_ROOT']."/".v."/Common Data/";
set_include_path($path);    
include('PHP Modules/mysqliConnection.php');
include('PHP Modules/anthony_retrieveText.php');
include('PHP Modules/gerald_functions.php');
include("PHP Modules/rose_prodfunctions.php");
ini_set("display_errors", "on");
$ctrl = new PMSDatabase;
$tpl = new PMSTemplates;
$pms = new PMSDBController;
$rdr = new Render\PMSTemplates;

$title = "";
PMSTemplates::includeHeader($title);


$tpl = new PMSTemplates; // Declare Once
// $btnAdd = $tpl->setDataValue("L482")
//                ->setAttribute([
//                     "name"  => "",
//                     "id"    => "",
//                     "type"  => ""
//                ])
//                ->addClass("w3-right") // Optional
//                ->createButton();

   
$tpl->setDataValue("L436");
$tpl->setAttribute("type","button");
$tpl->setAttribute("onclick","location.href=''");
$tpl->addClass("w3-right");
$refreshBtn = $tpl->createButton();

    
$tpl->setDataValue("L482");
$tpl->setAttribute([
     "name"  => "btnAdd",
     "id"    => "btnAdd",
     "type"  => "submit",
     "onclick"  => "modalAddForm()"
]);
$tpl->addClass("w3-right");
$btnAdd = $tpl->createButton();


$sql= "SELECT visitorId, supplierName FROM system_visitors";
$queryPrint = $db->query($sql) or die ($db->error);
$resultPrint = $queryPrint->fetch_assoc();
$visitorId = $resultPrint['visitorId'];

$tpl->setDataValue("L1201");
$tpl->setAttribute([
     "name"  => "btnPrint",
     "form"  => "formPrint",
     "id"    => "btnPrint",
     "type"  => "submit"

]);
$tpl->addClass("w3-right");
$btnPrint = $tpl->createButton();



$tpl->setDisplayId("") # OPTIONAL
    ->setVersion("") # OPTIONAL
    ->setPrevLink($_SERVER['HTTP_REFERER']) # OPTIONAL
    ->setHomeIcon() # OPTIONAL 0 - Default; 1 - w/o home icon
    ->createHeader();

$sql="SELECT visitorId, supplierName, visitorType FROM system_visitors";
$queryVisitors = $db->query($sql);
$resultVisitors = $queryVisitors->fetch_assoc();
$sqlData=$sql;
$totalRecords=$queryVisitors->num_rows;


?>
<div class='container-fluid'>
    <form id="formPrint" action="jhon_printVisitorAll.php" method="post"></form>
    <div class='row w3-padding-top w3-right'> <!-- row 1 -->
        <div class='col-md-4'>
            <?php echo $btnAdd; ?>
        </div>
        <div class='col-md-4'>
            <?php echo $btnPrint; ?>
        </div>
        <div class='col-md-4'>
            <?php echo $refreshBtn; ?>
        </div>
    </div>
    <div class='row w3-padding-top'>  <!-- row 2 -->
        <div class='col-md-12'>
            <!-- TABLE TEMPLATE -->
            <label><?php echo displayText("L41", "utf8", 0, 0, 1)." : ". $totalRecords; ?></label>
            			<table id='mainTableId' class="table table-bordered table-striped table-condensed" style="width:100%;">
				<thead class='w3-indigo' style='text-transform:uppercase;'>
                    <th class='w3-center' style='vertical-align:middle;'>#</th>
                    <th class='w3-center' style='vertical-align:middle;'>VISITOR ID</th>
                    <th class='w3-center' style='vertical-align:middle;'>SUPPLIER NAME</th>
                    <th class='w3-center' style='vertical-align:middle;'>VISITOR TYPE</th>
                    <th class='w3-center' style='vertical-align:middle;'>ACTION</th>
				</thead>
				<tbody class='w3-center'>
					
				</tbody>
				<tfoot class='w3-indigo' >
                    <tr>
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
<div id='modal-izi-add'><span class='izimodal-content-add'></span></div>
<div id='modal-izi-edit'><span class='izimodal-content-edit'></span></div>  
<div id='modal-izi-print'><span class='izimodal-content-print'></span></div>  
<?php
PMSTemplates::includeFooter();
?>
<script>

//ADD START HERE==============================================================================================================================================================
function modalAddForm()
        {
                $("#modal-izi-add").iziModal({
                    title                   : '<i class="fa fa-add"></i> <?php echo displayText("L482","utf8",0,0,1);?>',
                    headerColor             : '#1F4788',
                    subtitle                : '<b><?php //echo strtoupper(date('F d, Y'));?></b>',
                    width                   : 400,
                    fullscreen              : false,
                    transitionIn            : 'comingIn',
                    transitionOut           : 'comingOut',
                    padding                 : 20,
                    radius                  : 0,
                    top                     : 100,
                    restoreDefaultContent   : true,
                    closeOnEscape           : true,
                    closeButton             : true,
                    overlayClose            : false,
                    onOpening               : function(modal){
                                                modal.startLoading();
                                                // alert(assignedTo);
                                                $.ajax({
                                                    url         : 'jhon_addVisitors.php',
                                                    type        : 'POST',
                                                    data        : {
                                                      
                                                        // shift           :'<?php echo $shift;?>',
                                                        // idNumber        :'<?php echo $idNumber;?>',
                                                        // dateFrom        :'<?php echo $dateFrom;?>',
                                                        // dateTo          :'<?php echo $dateTo;?>',
                                                        // remarks         :'<?php echo $remarks;?>',
                                                        // processFlag     :'<?php echo $processFlag;?>',
                                                        // dateTimeLog     :'<?php echo $dateTimeLog;?>',

                                                                
                                                    },
                                                    success     : function(data){
                                                                    $( ".izimodal-content-add" ).html(data);
                                                                    modal.stopLoading();
                                                    }
                                                });
                                            },
                    onClosed                : function(modal){
                                                $("#modal-izi-add").iziModal("destroy");
                                } 
                });

                $("#modal-izi-add").iziModal("open");
        }
//ADD END HERE=================================================================================================================================================================

//EDIT START HERE==============================================================================================================================================================
function modalEditForm(visitorId)
        {

                $("#modal-izi-edit").iziModal({
                    title                   : '<i class="fa fa-add"></i> <?php echo displayText("EDIT","utf8",0,0,1);?>',
                    headerColor             : '#1F4788',
                    subtitle                : '<b><?php //echo strtoupper(date('F d, Y'));?></b>',
                    width                   : 400,
                    fullscreen              : false,
                    transitionIn            : 'comingIn',
                    transitionOut           : 'comingOut',
                    padding                 : 20,
                    radius                  : 0,
                    top                     : 100,
                    restoreDefaultContent   : true,
                    closeOnEscape           : true,
                    closeButton             : true,
                    overlayClose            : false,
                    onOpening               : function(modal){
                                                modal.startLoading();
                                                // alert(assignedTo);
                                                $.ajax({
                                                    url         : 'jhon_editVisitors.php',
                                                    type        : 'POST',
                                                    data        : {
                                                      
                                                        visitorId    :  visitorId   
                                                    },
                                                    success     : function(data){
                                                                    $( ".izimodal-content-edit" ).html(data);
                                                                    modal.stopLoading();
                                                    }
                                                });
                                            },
                    onClosed                : function(modal){
                                                $("#modal-izi-edit").iziModal("destroy");
                                } 
                });

                $("#modal-izi-edit").iziModal("open");
        }
//EDIT END HERE=================================================================================================================================================================

// AJAX TABLE START HERE

$(document).ready(function(){ 
            var sqlData = "<?php echo $sqlData; ?>";
            console.log(sqlData);
            var totalRecords = "<?php echo $totalRecords; ?>";
            var dataTable = $('#mainTableId').DataTable({
                "searching"    : false,   
                "processing"    : true,
                "ordering"      : false,
                "serverSide"    : true,
                "bInfo" 		: false,
                "ajax":{
                    url     :"jhon_visitorMonitoringAJAX.php", // json datasource
                    type    : "post",  // method  , by default get
                    data    : {
                                "totalRecords"   	: totalRecords,
                                "sqlData"     	    : sqlData
                                },
                    error: function(data){  // error handling
                        console.log(data);
                        
                        // $("#idNumber").append('<tbody class="listTableAjax-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                        // $("#idNumber").css("display","none");
                        
                    }
                },
                
                language	: {
                            processing	: "<span class='loader'></span>"
                },
                fixedColumns:   {
                        leftColumns: 0
                },
                // responsive		: true,
                scrollY     	: 530,
                scrollX     	: true,
                scrollCollapse	: false,
                scroller    	: {
                    loadingIndicator    : true
                },
                stateSave   	: false
            });


        });
    
// AJAX TABLE END HERE
// $(document).on('change','#checkBox',function(){

//     //var visitorId = [];
//     if(this.checked)
//     {
//         console.log("ASD");
//     }

// 		});
</script>
<script>
//     var x = [];
// $("#checkBox").change(function(){
//     var x = $(this).val();
//     var response = confirm("Are you sure you want to delete?");
//     if(response)
//     {
//         location.href = "jhon_selectVistor.php="+x+"&visitorId=<?php echo $visitorId; ?> ";	
//     }
//     e.preventDefault();
// });
// $("input[type='checkbox']").change(function(){
//     var x = "";
//     $("[data-id=<?php echo $visitorId; ?>]").each(function(){
//       if(this.checked){
// 	    x = x + $(this).val() + ",";
//       }
//     });
//     console.log(x);

// });
</script>
