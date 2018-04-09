<?php
require ("fpdf.php");
// $con  = mysqli_connect("localhost","root","");
include "db_connect.php";
// mysqli_select_db($con,'dbkadc');
$studid=$_POST['studentid'];
$query=mysqli_query($con, "select s.tblStudentId, concat(si.tblStudInfoLname, ', ', si.tblStudInfoFname, ' ', si.tblStudInfoMname) as studentname, s.tblStudent_tblLevelId from tblstudent s, tblstudentinfo si where s.tblStudentId=si.tblStudInfo_tblStudentId and s.tblStudentId='$studid' and s.tblStudentFlag=1");
$row=mysqli_fetch_array($query);
$studname=$row['studentname'];
$lvlid=$row['tblStudent_tblLevelId'];
$query1=mysqli_query($con, "select tblLevelName from tbllevel where tblLevelId='$lvlid' and tblLevelFlag=1");
$row1=mysqli_fetch_array($query1);
$lvlname=$row1['tblLevelName'];
class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    // $this->Image('images/logo.png',65,10,150,30);
    // Arial bold 10
    $this->SetFont('Arial','',8);
    // Set placement
    $this->SetXY(135,25);
    // Contact Details
    $this->Cell(10,10,"Address:",0,0,'C');
    $this->Ln(3);// Line break
    $this->SetX(135);
    $this->Cell(10,10,"Telephone Nos.:",0,0,'C');
    $this->Ln(3);// Line break
    $this->SetX(135);
    $this->Cell(10,10,"E-mail:",0,0,'C');
    $this->Ln(3);// Line break
    $this->SetX(135);
    $this->Cell(10,10,"Website:",0,0,'C');

    
}



 // function Content()

// Page footer
function Footer()
{
   // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

	$pdf = new PDF();
	$pdf -> AliasNbPages();
	$pdf -> AddPage("L","Letter",0);

    $pdf->SetFont('Arial','',10);
    $pdf->SetXY(30,50);//X-Left, Y- Down
    $pdf->Cell(10,10,'Name of Student: '.$studname,0,0,'');
    $pdf->SetXY(180,50);
    $pdf->Cell(10,10,'Student Id: '.$studid,0,0,'');
    $pdf->SetXY(30,55);
    $pdf->Cell(10,10,'Level: '.$lvlname,0,0,'');
    $pdf->SetXY(180,55);
    $pdf->Cell(10,10,'Date: '.date("Y-m-d"),0,0,'');
    $pdf->SetXY(30,60);

    $pdf->SetXY(130,70);
    $pdf->SetFont('Arial','B',15);
    $pdf->Cell(10,10,"STATEMENT OF ACCOUNT",0,0,'C');

    $pdf->Ln(15);// Line break
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(25,5,"Due/Payment Date",1,0,'C');
    $pdf->Cell(15,5,"Code",1,0,'C');
    $pdf->Cell(40,5,"Details",1,0,'C');
    // $pdf->Cell(15,5,"TN#",1,0,'C');
    $pdf->Cell(25,5,"Credit",1,0,'C');
    $pdf->Cell(25,5,"Receipt Number",1,0,'C');
    $pdf->Cell(25,5,"Payment Date",1,0,'C');
    $pdf->Cell(25,5,"Payment",1,0,'C');
    $pdf->Cell(25,5,"Running Balance",1,0,'C');
    $pdf->Cell(40,5,"Status",1,1,'C');

    $query=mysqli_query($con, "select a.*, s.tblStudScheme_tblFeeId from tblaccount a, tblstudscheme s where a.tblAcc_tblStudSchemeId=s.tblStudSchemeId and a.tblAcc_tblStudentId='".$studid."' and a.tblAccFlag=1 and s.tblStudSchemeFlag=1 and s.tblStudScheme_tblSchoolYrId='$syid' group by a.tblAccPaymentNum, a.tblAcc_tblStudSchemeId");
// if (!$query) {
//     printf("Error: %s\n", mysqli_error($con));
//     exit();
// }
    $totcredit = 0;
    $totpayment = 0;
   while($row3=mysqli_fetch_array($query)){
    $feeid=$row3['tblStudScheme_tblFeeId'];
    $query1=mysqli_query($con, "select * from tblfee where tblFeeId='$feeid' and tblFeeFlag=1");
    $row2=mysqli_fetch_array($query1);
    $feecode=$row2['tblFeeCode'];
    $feename=$row2['tblFeeName'];

    $pdf->Cell(25, 5, $row3['tblAccDueDate'], 1, 0);

    $pdf->Cell(15, 5, $feecode, 1, 0);
    $pdf->Cell(40, 5, $feename, 1, 0);

    // $pdf->Cell(15, 5, $row3['tblAccTN'], 1, 0);
    $pdf->Cell(25, 5, $row3['tblAccCredit'], 1, 0,'R');
    $totcredit = $totcredit + $row3['tblAccCredit'];
    $pdf->Cell(25, 5, $row3['tblAccOR'], 1, 0);
     $pdf->Cell(25, 5, $row3['tblAccPaymentDate'], 1, 0);
    $pdf->Cell(25, 5, $row3['tblAccPayment'], 1, 0,'R');
    $totpayment = $totpayment + $row3['tblAccPayment'];
    $pdf->Cell(25, 5, $row3['tblAccRunningBal'], 1, 0,'R');
    $pdf->Cell(40, 5, $row3['tblAccPaid'], 1, 1);
}


    $totrunbal = $totcredit - $totpayment;
    $pdf->Cell(80,5,"Total on School Year End",1,0,'C');
    // $pdf->Cell(15,5," ",1,0,'C');
    $pdf->Cell(25,5,$totcredit,1,0,'R');
    $pdf->Cell(25,5," ",1,0,'C');
    $pdf->Cell(25,5," ",1,0,'C');
    $pdf->Cell(25,5,$totpayment,1,0,'R');
    $pdf->Cell(25,5,$totrunbal,1,0,'R');
    $pdf->Cell(40,5," ",1,0,'C');
  



    $pdf->SetFont('Arial','',10);
    $pdf->SetXY(30,180);//X-Left, Y- Down
    $pdf->Cell(10,10,'',0,0,'');
    $pdf->SetFont('Arial','',8);
    $pdf->SetXY(30,185);//X-Left, Y- Down
    $pdf->Cell(10,10,'School-Head',0,0,'');






	$pdf -> Output();


?>