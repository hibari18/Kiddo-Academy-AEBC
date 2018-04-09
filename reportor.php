<?php
require ("fpdf.php");
include "db_connect.php";
$studid=$_POST['txtstud'];

class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    // $this->Image('images/logo.png',35,10,150,30);
    // Arial bold 10
    $this->SetFont('Arial','',8);
    // Set placement
    $this->SetXY(111,25);
    // Contact Details
    $this->Cell(10,10,"Address:",0,0,'C');
    $this->Ln(3);// Line break
    $this->SetX(111);
    $this->Cell(10,10,"Telephone Nos.:",0,0,'C');
    $this->Ln(3);// Line break
    $this->SetX(111);
    $this->Cell(10,10,"E-mail:",0,0,'C');
    $this->Ln(3);// Line break
    $this->SetX(111);
    $this->Cell(10,10,"Website:",0,0,'C');

    $this->SetFont('Arial','',10);
    $this->SetXY(170,50);//X-Left, Y- Down

   $tDate=date('Y-m-d');
    $this->Cell(10,10,'Date: '.$tDate,0,0,'');

    $this->SetXY(100,60);
    $this->SetFont('Arial','B',15);
    $this->Cell(10,10,"Accounts Receivable (Receipts)",0,0,'C');


    $this->Ln(15);// Line break
    $this->setX(20);
    $this->SetFont('Arial','',8);
    $this->Cell(35,5,"Student Id",1,0,'C');
    $this->Cell(65,5,"Student Name",1,0,'C');
    $this->Cell(45,5,"Payment Amount",1,0,'C');
    $this->Cell(35,5,"Payment Date",1,1,'C');
    
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
	$pdf -> AddPage("P","Letter",0);
    //$pdf -> SetFont('Arial','',8);

    //$query = mysqli_query(query)
    $tDate=date('Y-m-d');
  $query = mysqli_query($con, "Select s.tblStudentId, concat(si.tblStudInfoLname, ', ', si.tblStudInfoFname, ' ', si.tblStudInfoMname) as studentname, r.tblRecAmount, r.tblRecDate from tblstudent s, tblstudentinfo si, tblreceipt r where si.tblStudInfo_tblStudentId=s.tblStudentId and r.tblRec_tblStudentId=s.tblStudentId and s.tblStudentId='$studid' and s.tblStudentFlag=1");

while($row3=mysqli_fetch_array($query)){

    $pdf->SetX(10);
    $pdf->setX(20);
    $pdf->Cell(35, 5, $row3['tblStudentId'], 1, 0);
    $pdf->Cell(65, 5, $row3['studentname'], 1, 0);
    $pdf->Cell(45, 5, $row3['tblRecAmount'], 1, 0);
    $pdf->Cell(35, 5, $row3['tblRecDate'], 1, 1);
}

    $pdf->SetFont('Arial','',10);
    $pdf->SetXY(30,225);//X-Left, Y- Down
    $pdf->Cell(10,10,'',0,0,'');
    $pdf->SetFont('Arial','',8);
    $pdf->SetXY(30,230);//X-Left, Y- Down
    $pdf->Cell(10,10,'School-Head',0,0,'');





	$pdf -> Output();


?>