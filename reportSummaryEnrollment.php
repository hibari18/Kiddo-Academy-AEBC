<?php
require ("fpdf.php");
// $con  = mysqli_connect("localhost","root","");
// mysqli_select_db($con,'dbkadc');
include "db_connect.php";
$sy=$_POST['txtsy'];

$query=mysqli_query($con, "Select * FROM tblschoolyear WHERE tblSchoolYrId = '$sy' AND tblSchoolYearFlag = 1");
$row=mysqli_fetch_array($query);
$syname = $row['tblSchoolYrYear'];
$query = mysqli_query($con, "Select COUNT(a.tblStudentId) as numstud FROM tblstudent a, tblstudentinfo ti, tblstudenroll se, tbllevel l WHERE a.tblStudentId = ti.tblStudInfo_tblStudentId AND se.tblStudEnroll_tblStudentId=a.tblStudentId and a.tblStudent_tblLevelId=l.tblLevelId and se.tblStudEnroll_tblSchoolYrId='$sy'");
$row2=mysqli_fetch_array($query);
$numstud=$row2['numstud'];

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
    $this->Cell(10,10,"Address",0,0,'C');
    $this->Ln(3);// Line break
    $this->SetX(111);
    $this->Cell(10,10,"Telephone Nos.:",0,0,'C');
    $this->Ln(3);// Line break
    $this->SetX(111);
    $this->Cell(10,10,"E-mail:",0,0,'C');
    $this->Ln(3);// Line break
    $this->SetX(111);
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
    $pdf -> AddPage("P","Letter",0);
    //$pdf -> SetFont('Arial','',8);

    $pdf->SetFont('Arial','B',10);
    $pdf->SetXY(30,50);//X-Left, Y- Down
    $pdf->Cell(10,10,'School Year: '.$syname,0,0,'');
    $pdf->SetXY(30,55);
    $pdf->Cell(10,10,"Total Number of Enrollees: ".$numstud,0,0,'');


    $pdf->SetXY(105,65);
    $pdf->SetFont('Arial','B',15);
    $pdf->Cell(10,10,"Summary of Student Enrollees",0,0,'C');

    $pdf->SetXY(40,80);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(40,5,"Student Id",1,0,'C');
    $pdf->Cell(70,5,"Student Name",1,0,'C');
    $pdf->Cell(40,5,"Level",1,1,'C');


   $query = mysqli_query($con, "Select a.tblStudentId, concat(ti.tblStudInfoLname, ', ', ti.tblStudInfoFname, ' ', ti.tblStudInfoMname) as studentname , tblLevelName FROM tblstudent a, tblstudentinfo ti, tblstudenroll se, tbllevel l WHERE a.tblStudentId = ti.tblStudInfo_tblStudentId AND se.tblStudEnroll_tblStudentId=a.tblStudentId and a.tblStudent_tblLevelId=l.tblLevelId and se.tblStudEnroll_tblSchoolYrId='$sy'");

while($row3=mysqli_fetch_array($query)){
    $pdf->SetX(40);
    $pdf->Cell(40, 5, $row3['tblStudentId'], 1, 0);
    $pdf->Cell(70, 5, $row3['studentname'], 1, 0);
    $pdf->Cell(40, 5, $row3['tblLevelName'], 1, 1);
    
}

  
    $pdf->SetFont('Arial','',10);
    $pdf->SetXY(30,230);//X-Left, Y- Down
    $pdf->Cell(10,10,'',0,0,'');
    $pdf->SetFont('Arial','',8);
    $pdf->SetXY(30,235);//X-Left, Y- Down
    $pdf->Cell(10,10,'School-Head',0,0,'');



    $pdf->SetFont('Arial','',10);
    $pdf->SetXY(150,230);//X-Left, Y- Down
    $pdf->Cell(10,10,'',0,0,'');
    $pdf->SetFont('Arial','',8);
    $pdf->SetXY(150,235);//X-Left, Y- Down
    $pdf->Cell(10,10,'Teacher',0,0,'');






    $pdf -> Output();


?>