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

    // $this->SetFont('Arial','B',10);
    // $this->SetXY(30,50);//X-Left, Y- Down
    // $this->Cell(10,10,'Level: ',0,0,'');
    // $this->SetXY(150,50);
    // $this->Cell(10,10,"Section:",0,0,'');
    // $this->SetXY(30,55);
    // $this->Cell(10,10,"Teacher:",0,0,'');


    $this->SetXY(105,65);
    $this->SetFont('Arial','B',15);
    $this->Cell(10,10,"Unenrolled Students",0,0,'C');

    $this->SetXY(40,80);
    $this->SetFont('Arial','B',8);
    $this->Cell(40,5,"Student Id",1,0,'C');
    $this->Cell(100,5,"Student Name",1,1,'C');

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

   $query = mysqli_query($con, "select concat(si.tblStudInfoLname, ', ', si.tblStudInfoFname, ' ', si.tblStudInfoMname) as studentname, s.tblStudentId, s.tblStudent_tblLevelId from tblstudent s, tblstudentinfo si where si.tblStudInfo_tblStudentId=s.tblStudentId and (s.tblStudentType='OFFICIAL' or s.tblStudentType='APPLICANT') group by s.tblStudentId");
   while($row=mysqli_fetch_array($query)){
    $studid=$row['tblStudentId'];
    $query1="select * from tblsectionstud where tblSectStud_tblStudentId='$studid' and tblSectStud_tblSchoolYrId='$syid'";
    $result1=$con->query($query1);
    if ($result1->num_rows == 0)
    {
      $query2 = mysqli_query($con, "select concat(si.tblStudInfoLname, ', ', si.tblStudInfoFname, ' ', si.tblStudInfoMname) as studentname, s.tblStudentId, s.tblStudent_tblLevelId from tblstudent s, tblstudentinfo si where si.tblStudInfo_tblStudentId=s.tblStudentId and s.tblStudentId='$studid' group by s.tblStudentId");
      $row1=mysqli_fetch_array($query2);
    $pdf->SetX(40);
    $pdf->Cell(40, 5, $row['tblStudentId'], 1, 0);
    $pdf->Cell(100, 5, $row['studentname'], 1, 1);
    // $pdf->SetXY(50,55);
    // $pdf->Cell(10, 10, 'STANDBY', 0, 0);

   } }
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