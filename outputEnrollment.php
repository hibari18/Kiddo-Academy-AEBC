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


    $this->SetXY(105,50);
    $this->SetFont('Arial','B',12);
    $this->Cell(5,10,"Enrollment Voucher (S.Y. 20**-20**)",0,0,'C');

    $this->SetXY(35,60);
    $this->SetFont('Arial','B',11);
    $this->Cell(5,10,"Name:",0,0,'C');  

    $this->SetXY(152,60);
    $this->SetFont('Arial','B',11);
    $this->Cell(5,10,"Date:",0,0,'C');    

    $this->SetXY(35, 67);
    $this->SetFont('Arial','B',11);
    $this->Cell(5,10,"Level:",0,0,'C');  

    $this->SetXY(155, 67);
    $this->SetFont('Arial','B',11);
    $this->Cell(5,10,"Session:",0,0,'C');  


    $this->Ln(15);// Line break
    $this->SetFont('Arial','',8);
    $this->SetX(30);
    $this->Cell(40,5,"Fee",1,0,'C');
    $this->Cell(35,5,"Scheme",1,0,'C');
    $this->Cell(30,5,"Order of Payment",1,0,'C');
    $this->Cell(25,5,"Amount",1,0,'C');
    $this->Cell(25,5,"Deadline",1,0,'C');


    $this->SetXY(110, 200);
    $this->SetFont('Arial','',11);
    $this->Cell(5,10,"Please settle the amount before due date. For further information, contact the",0,0,'C'); 

    $this->SetXY(100, 207);
    $this->SetFont('Arial','',11);
    $this->Cell(5,10,"management or go through the guidelines in the website (https://kiddoacademy.com).",0,0,'C'); 
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

    $pdf->SetFont('Arial','',10);
    $pdf->SetXY(150,230);//X-Left, Y- Down
    $pdf->Cell(10,10,'Aimee Tayag-Ang',0,0,'');
    $pdf->SetFont('Arial','',8);
    $pdf->SetXY(150,235);//X-Left, Y- Down
    $pdf->Cell(10,10,'School-Head',0,0,'');






    $pdf -> Output();


?>