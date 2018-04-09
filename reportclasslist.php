<?php
require ("fpdf.php");
// $con  = mysqli_connect("localhost","root","");
// mysqli_select_db($con,'dbkadc');
include "db_connect.php";
$sect=$_POST['txtsect'];
$sysy=$_POST['txtSy'];

$query=mysqli_query($con, "Select * FROM tblsection WHERE tblSectionId='$sect' AND tblSectionFlag = 1");
$row=mysqli_fetch_array($query);
$lvlid = $row['tblSection_tblLevelId'];
$faculty=$row['tblSection_tblFacultyId'];
$sectname=$row['tblSectionName'];
$query1=mysqli_query($con, "select tblLevelName from tbllevel where tblLevelId='$lvlid' and tblLevelFlag=1");
$row1=mysqli_fetch_array($query1);
$lvlname=$row1['tblLevelName'];
$query2=mysqli_query($con, "select concat(tblFacultyLname, ', ', tblFacultyFname, ' ', tblFacultyMname) as facultyname from tblfaculty where tblFacultyId='$faculty'");
$row2=mysqli_fetch_array($query2);
$facultyname=$row2['facultyname'];
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
    $pdf->Cell(10,10,'Level: '.$lvlname,0,0,'');
    $pdf->SetXY(150,50);
    $pdf->Cell(10,10,"Section: ".$sectname,0,0,'');
    $pdf->SetXY(30,55);
    $pdf->Cell(10,10,"Teacher: ".$facultyname,0,0,'');


    $pdf->SetXY(105,65);
    $pdf->SetFont('Arial','B',15);
    $pdf->Cell(10,10,"Class List",0,0,'C');

    $pdf->SetXY(40,80);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(40,5,"Student Id",1,0,'C');
    $pdf->Cell(100,5,"Student Name",1,1,'C');

   $query = mysqli_query($con, "select * from tblsectionstud where tblSectStud_tblSectionId='$sect' and tblSectStud_tblSchoolYrId='$sysy'");
    while($row=mysqli_fetch_array($query)):
        $studid=$row['tblSectStud_tblStudentId'];
        $query1=mysqli_query($con, "select concat(ti.tblStudInfoLname, ', ', ti.tblStudInfoFname, ' ', ti.tblStudInfoMname) as studentname, s.tblStudentId from tblstudent s, tblstudentinfo ti where ti.tblStudInfo_tblStudentId=s.tblStudentId and s.tblStudentId='$studid'");

while($row3=mysqli_fetch_array($query1)){
    $pdf->SetX(40);
    $pdf->Cell(40, 5, $row3['tblStudentId'], 1, 0);
    $pdf->Cell(100, 5, $row3['studentname'], 1, 1);
    // $pdf->SetXY(50,55);
    // $pdf->Cell(10, 10, 'STANDBY', 0, 0);
} endwhile;

  
    $pdf->SetFont('Arial','',10);
    $pdf->SetXY(30,230);//X-Left, Y- Down
    $pdf->Cell(10,10,'Aimee Tayag-Ang',0,0,'');
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