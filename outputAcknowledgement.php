<?php
require ("fpdf.php");
// $con  = mysqli_connect("localhost","root","");
// mysqli_select_db($con,'dbkadc');
include "db_connect.php";

$query=mysqli_query($con, "Select * FROM tblschoolyear WHERE tblSchoolYrActive='ACTIVE' AND tblSchoolYearFlag = 1");
$row=mysqli_fetch_array($query);
$syid = $row['tblSchoolYrId'];
class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    $this->Image('images/logo.png',35,10,150,30);
    // Arial bold 10
    $this->SetFont('Arial','',8);
    // Set placement
     $this->SetXY(111,25);
    // Contact Details
    $this->Cell(10,10,"2/F GA Tower, # 83 EDSA, Mandaluyong City 1550, Philippines",0,0,'C');
    $this->Ln(3);// Line break
    $this->SetX(111);
    $this->Cell(10,10,"Telephone Nos.: 576-4171/0905-5529605",0,0,'C');
    $this->Ln(3);// Line break
    $this->SetX(111);
    $this->Cell(10,10,"E-mail: kiddo_academy@yahoo.com",0,0,'C');
    $this->Ln(3);// Line break
    $this->SetX(111);
    $this->Cell(10,10,"Website: www.kiddoacademy.com",0,0,'C');


    $this->SetXY(112,65);
    $this->SetFont('Arial','B',12);
    $this->Cell(5,10,"Acknowledgement Receipt",0,0,'C');
    
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

    $pdf->SetXY(113,90);
    $pdf->SetFont('Arial','',11);
    $pdf->Cell(5,10,"Received from _______________________________ the amount of ___________________",0,0,'C');

    $pdf->SetXY(107,100);
    $pdf->SetFont('Arial','',11);
    $pdf->Cell(5,10,"________________________________________________________________________________",0,0,'C');

    $pdf->SetXY(45,110);
    $pdf->SetFont('Arial','',11);
    $pdf->Cell(5,10,"representing the payment of:",0,0,'C');

    $pdf->SetXY(160,210);
    $pdf->SetFont('Arial','',11);
    $pdf->Cell(5,10,"Received by:",0,0,'C');

    $pdf->SetFont('Arial','',10);
    $pdf->SetXY(150,230);//X-Left, Y- Down
    $pdf->Cell(10,10,'Aimee Tayag-Ang',0,0,'');
    $pdf->SetFont('Arial','',8);
    $pdf->SetXY(150,235);//X-Left, Y- Down
    $pdf->Cell(10,10,'School-Head',0,0,'');






    $pdf -> Output();


?>