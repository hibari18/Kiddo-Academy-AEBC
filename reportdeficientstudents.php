<?php
require ("fpdf.php");
include "db_connect.php";
$type=$_POST['txttype'];

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

    $this->SetFont('Arial','B',10);
    $this->SetXY(175,50);//X-Left, Y- Down
    $this->Cell(100,10,'Date: '.date("Y-m-d").'',0,0,'');
    $this->SetXY(100,55);
    $this->SetFont('Arial','B',15);
    $this->Cell(10,10,"Deficient Students",0,0,'C');

    $this->Ln(15);// Line break
    $this->SetFont('Arial','',8);
    $this->Cell(20,5,"Student Id",1,0,'C');
    $this->Cell(50,5,"Student Name",1,0,'C');
    $this->Cell(30,5,"Student Level",1,0,'C');
    $this->Cell(95,5,"Reason",1,0,'C');


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

    $query = mysqli_query($con, "select * from tblschoolyear where tblSchoolYrActive='ACTIVE' and tblSchoolYearFlag=1");
    $row=mysqli_fetch_array($query);
    $syid=$row['tblSchoolYrId'];
    $x=1;
    $query=mysqli_query($con, "select concat(si.tblStudInfoLname, ', ', si.tblStudInfoFname, ' ', si.tblStudInfoMname) as studentname, s.tblStudentId, s.tblStudent_tblLevelId from tblstudent s, tblstudentinfo si where si.tblStudInfo_tblStudentId=s.tblStudentId and s.tblStudentType='$type' group by s.tblStudentId");
    while($row=mysqli_fetch_array($query)):
        $lvlid=$row['tblStudent_tblLevelId'];
        $query1=mysqli_query($con, "select tblLevelName from tbllevel where tblLevelId='$lvlid' and tblLevelFlag=1");
        $row1=mysqli_fetch_array($query1);
        $lvlname=$row1['tblLevelName'];
        $pdf->Ln(5);
        $pdf->Cell(20, 5, $row['tblStudentId'], 1, 0);
        $pdf->Cell(50,5,$row['studentname'],1,0);
        $pdf->Cell(30,5,$lvlname,1,0);
        $pdf->Cell(95,5,'sample',1,0);
        $x++;
    endwhile;

	$pdf -> Output();


?>