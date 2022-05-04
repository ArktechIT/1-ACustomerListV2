<?php
include $_SERVER['DOCUMENT_ROOT']."/version.php";
$path = $_SERVER['DOCUMENT_ROOT']."/".v."/Common Data/";
set_include_path($path);    
include('Templates/mysqliConnection.php');
  ini_set("display_errors", "on");


  
require('Libraries/PHP/FPDF/fpdf.php');
// require('classes/fpdf.php');


$visitorIdArray = $_POST['visitorIdArray'];
if($visitorIdArray == "")
{
  echo "<script>";
  echo "alert('Please select visitor first!')";

  echo "</script>";
  header('Location:jhon_visitorMonitoring.php');
}
else 
{
  $sql= "SELECT visitorId, supplierName FROM system_visitors WHERE visitorId IN('".implode("','",$visitorIdArray)."')";
  $queryPrint = $db->query($sql) or die ($db->error);
  $totalCount = $queryPrint->num_rows;
  
  $num=0;
  $paperWidth   = 210;
  $paperLength  = 297;
  
  $idVisitor    = $visitorIdArray;
  $maxPrint     = $totalCount;
  $maxColumn    = 2;
  $code         = "V";
  $copy         = 1;
  
  
  $pdf = new FPDF();
  $pdf->AddFont('IDAutomationHC39M','');
  $pdf->AddPage();
  
        $x1 = 1;
        $y1 = 1;
        $width = 104;
        $height = 97.9;
    
       
      
      for($y = 0; $y < $maxPrint ; $y++ )
      {
          $pdf->Image('arkLogo.jpg',30+$x1 ,6+$y1,40);
        
          $pdf->Rect($x1,$y1,$width,$height);
          $pdf->SetFont('Arial','B',20);
          
          $pdf->SetXY(0+$x1,5+$y1);
          $pdf->Cell(100,50,'VISITOR PASS',0,0,'C');
      
          $pdf->SetXY(0+$x1,40+$y1);
          $pdf->SetFont('Arial','B',14);
  
          $sql="SELECT visitorId,supplierName FROM system_visitors WHERE visitorId= ".$visitorIdArray[$y]."";
          $resultPrint = $queryPrint->fetch_assoc();
          $visitorId = $resultPrint['visitorId'];
          $supplierName = $resultPrint['supplierName'];
  
          $pdf->Cell(100,20,$supplierName,0,0,'C');
          $pdf->SetXY(0+$x1,60+$y1);
  
          $pdf->SetFont('IDAutomationHC39M','',12);
          $pdf->Cell(100,20,"*".$visitorId."*",0,0,'C');
  
          $x1 = $x1 + 104;
  
          if($y%2 == 1)
          {
            $y1 = $y1 + 97.9;
          
            $x1 = 1;
          }
          
          if($y%5 == 0 && $y != 0)
          {
            $pdf->AddPage();
            $X1 = 1;
          
            $y1 = 1;
          }
  
      }
}




  
  $pdf->Output();


?>
