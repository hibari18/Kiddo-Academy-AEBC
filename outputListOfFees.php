<?php
require ("fpdf.php");
// $con  = mysqli_connect("localhost","root","");
// mysqli_select_db($con,'dbkadc');
include "db_connect.php";
$query=mysqli_query($con, "Select * FROM tblschoolyear WHERE tblSchoolYrActive='ACTIVE' AND tblSchoolYearFlag = 1");
$row=mysqli_fetch_array($query);
$syid = $row['tblSchoolYrId'];
$syname = $row['tblSchoolYrYear'];


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

    $pdf->SetXY(80,50);
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(60,10,"Option 1 - Cash Payment Scheme",0,0,'C');

    $pdf->Ln(15);// Line break
    $pdf->SetFont('Arial','',8);
    $pdf->SetX(30);
    $pdf->Cell(35,5,"Fee",1,0,'C');
    $pdf->Cell(20,5,"HEADSTART",1,0,'C');
    $pdf->Cell(20,5,"NURSERY",1,0,'C');
    $pdf->Cell(20,5,"KINDER 1",1,0,'C');
    $pdf->Cell(20,5,"KINDER 2",1,0,'C');
    $pdf->Cell(20,5,"INTENSIVE",1,0,'C');
    $pdf->Cell(20,5,"GRADE 1-3",1,0,'C');

    $pdf->Ln(15);// Line break
    $pdf->SetFont('Arial','',8);
    $pdf->SetXY(30, 70);
    $pdf->Cell(35,5,"Tuition Fee",1,0,'C');
    $pdf->Cell(20,5,"24,000.00",1,0,'C');
    $pdf->Cell(20,5,"39,140.00",1,0,'C');
    $pdf->Cell(20,5,"39,655.00",1,0,'C');
    $pdf->Cell(20,5,"40,170.00",1,0,'C');
    $pdf->Cell(20,5,"49,440.00",1,0,'C');
    $pdf->Cell(20,5,"50,000.00",1,0,'C');
    
    $pdf->Ln(15);// Line break
    $pdf->SetFont('Arial','',8);
    $pdf->SetXY(30, 75);
    $pdf->Cell(35,5,"Miscellaneous Fee",1,0,'C');
    $pdf->Cell(20,5,"13,900.00",1,0,'C');
    $pdf->Cell(20,5,"17,650.00",1,0,'C');
    $pdf->Cell(20,5,"17,650.00",1,0,'C');
    $pdf->Cell(20,5,"17,650.00",1,0,'C');
    $pdf->Cell(20,5,"19,850.00",1,0,'C');
    $pdf->Cell(20,5,"16,350.00",1,0,'C');
    

    $pdf->Ln(15);// Line break
    $pdf->SetFont('Arial','B',8);
    $pdf->SetXY(30,80);
    $pdf->Cell(35,5,"TOTAL",1,0,'C');
    $pdf->Cell(20,5,"37,900.00",1,0,'C');
    $pdf->Cell(20,5,"56,790.00",1,0,'C');
    $pdf->Cell(20,5,"57,305.00",1,0,'C');
    $pdf->Cell(20,5,"57,820.00",1,0,'C');
    $pdf->Cell(20,5,"69,290.00",1,0,'C');
    $pdf->Cell(20,5,"56,350.00",1,0,'C');

    $pdf->SetXY(80,90);
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(60,10,"Option 2 - Two (2) Schedules of Payment",0,0,'C');

    $pdf->Ln(15);// Line break
    $pdf->SetFont('Arial','',8);
    $pdf->SetXY(30,105);
    $pdf->Cell(35,5,"Fee",1,0,'C');
    $pdf->Cell(20,5,"HEADSTART",1,0,'C');
    $pdf->Cell(20,5,"NURSERY",1,0,'C');
    $pdf->Cell(20,5,"KINDER 1",1,0,'C');
    $pdf->Cell(20,5,"KINDER 2",1,0,'C');
    $pdf->Cell(20,5,"INTENSIVE",1,0,'C');
    $pdf->Cell(20,5,"GRADE 1-3",1,0,'C');

    $pdf->Ln(15);// Line break
    $pdf->SetFont('Arial','',8);
    $pdf->SetXY(30,110);
    $pdf->Cell(35,5,"Due upon Enrollment",1,0,'C');
    $pdf->Cell(20,5,"20,000.00",1,0,'C');
    $pdf->Cell(20,5,"30,000.00",1,0,'C');
    $pdf->Cell(20,5,"30,000.00",1,0,'C');
    $pdf->Cell(20,5,"30,000.00",1,0,'C');
    $pdf->Cell(20,5,"36,000.00",1,0,'C');
    $pdf->Cell(20,5,"35,000.00",1,0,'C');

    $pdf->Ln(15);// Line break
    $pdf->SetFont('Arial','',8);
    $pdf->SetXY(30,115);
    $pdf->Cell(35,5,"October 15",1,0,'C');
    $pdf->Cell(20,5,"19,416.00",1,0,'C');
    $pdf->Cell(20,5,"28,380.12",1,0,'C');
    $pdf->Cell(20,5,"28,909.54",1,0,'C');
    $pdf->Cell(20,5,"29,438.96",1,0,'C');
    $pdf->Cell(20,5,"35,320.12",1,0,'C');
    $pdf->Cell(20,5,"33,307.80",1,0,'C');

    $pdf->Ln(15);// Line break
    $pdf->SetFont('Arial','B',8);
    $pdf->SetXY(30,120);
    $pdf->Cell(35,5,"TOTAL",1,0,'C');
    $pdf->Cell(20,5,"39,416.00",1,0,'C');
    $pdf->Cell(20,5,"58,380.00",1,0,'C');
    $pdf->Cell(20,5,"58,909.00",1,0,'C');
    $pdf->Cell(20,5,"59,438.00",1,0,'C');
    $pdf->Cell(20,5,"71,230.00",1,0,'C');
    $pdf->Cell(20,5,"68,207.00",1,0,'C');

    $pdf->SetXY(80,130);
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(60,10,"Option 3 - Four (4) Schedules of Payment",0,0,'C');

    $pdf->Ln(15);// Line break
    $pdf->SetFont('Arial','',8);
    $pdf->SetXY(30,145);
    $pdf->Cell(35,5,"Fee",1,0,'C');
    $pdf->Cell(20,5,"HEADSTART",1,0,'C');
    $pdf->Cell(20,5,"NURSERY",1,0,'C');
    $pdf->Cell(20,5,"KINDER 1",1,0,'C');
    $pdf->Cell(20,5,"KINDER 2",1,0,'C');
    $pdf->Cell(20,5,"INTENSIVE",1,0,'C');
    $pdf->Cell(20,5,"GRADE 1-3",1,0,'C');

    $pdf->Ln(15);// Line break
    $pdf->SetFont('Arial','',8);
    $pdf->SetXY(30,150);
    $pdf->Cell(35,5,"Due upon Enrollment",1,0,'C');
    $pdf->Cell(20,5,"15,000.00",1,0,'C');
    $pdf->Cell(20,5,"20,000.00",1,0,'C');
    $pdf->Cell(20,5,"20,000.00",1,0,'C');
    $pdf->Cell(20,5,"20,000.00",1,0,'C');
    $pdf->Cell(20,5,"25,000.00",1,0,'C');
    $pdf->Cell(20,5,"25,000.00",1,0,'C');

    $pdf->Ln(15);// Line break
    $pdf->SetFont('Arial','',8);
    $pdf->SetXY(30,155);
    $pdf->Cell(35,5,"August 15",1,0,'C');
    $pdf->Cell(20,5,"8,391.33",1,0,'C');
    $pdf->Cell(20,5,"13,226.76",1,0,'C');
    $pdf->Cell(20,5,"13,409.19",1,0,'C');
    $pdf->Cell(20,5,"13,589.61",1,0,'C');
    $pdf->Cell(20,5,"15,941.26",1,0,'C');
    $pdf->Cell(20,5,"14,911.28",1,0,'C');

    $pdf->Ln(15);// Line break
    $pdf->SetFont('Arial','',8);
    $pdf->SetXY(30,160);
    $pdf->Cell(35,5,"October 15",1,0,'C');
    $pdf->Cell(20,5,"8,391.33",1,0,'C');
    $pdf->Cell(20,5,"13,226.76",1,0,'C');
    $pdf->Cell(20,5,"13,409.19",1,0,'C');
    $pdf->Cell(20,5,"13,589.61",1,0,'C');
    $pdf->Cell(20,5,"15,941.26",1,0,'C');
    $pdf->Cell(20,5,"14,911.28",1,0,'C');

    $pdf->Ln(15);// Line break
    $pdf->SetFont('Arial','',8);
    $pdf->SetXY(30,165);
    $pdf->Cell(35,5,"December 15",1,0,'C');
    $pdf->Cell(20,5,"8,391.33",1,0,'C');
    $pdf->Cell(20,5,"13,226.76",1,0,'C');
    $pdf->Cell(20,5,"13,409.19",1,0,'C');
    $pdf->Cell(20,5,"13,589.61",1,0,'C');
    $pdf->Cell(20,5,"15,941.26",1,0,'C');
    $pdf->Cell(20,5,"14,911.28",1,0,'C');

    $pdf->Ln(15);// Line break
    $pdf->SetFont('Arial','B',8);
    $pdf->SetXY(30,170);
    $pdf->Cell(35,5,"TOTAL",1,0,'C');
    $pdf->Cell(20,5,"40,173.99",1,0,'C');
    $pdf->Cell(20,5,"59,686.29",1,0,'C');
    $pdf->Cell(20,5,"60,227.56",1,0,'C');
    $pdf->Cell(20,5,"60,768.82",1,0,'C');
    $pdf->Cell(20,5,"72,823.79",1,0,'C');
    $pdf->Cell(20,5,"69,733.85",1,0,'C');


    $pdf->SetXY(80,180);
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(60,10,"Option 3 - Eigth (8) Schedules of Payment",0,0,'C');

    $pdf->Ln(15);// Line break
    $pdf->SetFont('Arial','',8);
    $pdf->SetXY(30,195);
    $pdf->Cell(35,5,"Fee",1,0,'C');
    $pdf->Cell(20,5,"HEADSTART",1,0,'C');
    $pdf->Cell(20,5,"NURSERY",1,0,'C');
    $pdf->Cell(20,5,"KINDER 1",1,0,'C');
    $pdf->Cell(20,5,"KINDER 2",1,0,'C');
    $pdf->Cell(20,5,"INTENSIVE",1,0,'C');
    $pdf->Cell(20,5,"GRADE 1-3",1,0,'C');

    $pdf->Ln(15);// Line break
    $pdf->SetFont('Arial','',8);
    $pdf->SetXY(30,200);
    $pdf->Cell(35,5,"Due Upon Enrollment",1,0,'C');
    $pdf->Cell(20,5,"10,000.00",1,0,'C');
    $pdf->Cell(20,5,"15,000.00",1,0,'C');
    $pdf->Cell(20,5,"15,000.00",1,0,'C');
    $pdf->Cell(20,5,"15,000.00",1,0,'C');
    $pdf->Cell(20,5,"20,000.00",1,0,'C');
    $pdf->Cell(20,5,"20,000.00",1,0,'C');

    $pdf->Ln(15);// Line break
    $pdf->SetFont('Arial','',8);
    $pdf->SetXY(30,205);
    $pdf->Cell(35,5,"Every 15th of the month",1,0,'C');
    $pdf->Cell(20,5,"4,364.71",1,0,'C');
    $pdf->Cell(20,5,"6,530.65",1,0,'C');
    $pdf->Cell(20,5,"6,599.86",1,0,'C');
    $pdf->Cell(20,5,"6,605.61",1,0,'C');
    $pdf->Cell(20,5,"7,830.39",1,0,'C');
    $pdf->Cell(20,5,"7,185.40",1,0,'C');

    $pdf->Ln(15);// Line break
    $pdf->SetFont('Arial','B',8);
    $pdf->SetXY(30,210);
    $pdf->Cell(35,5,"TOTAL",1,0,'C');
    $pdf->Cell(20,5,"40,552.97",1,0,'C');
    $pdf->Cell(20,5,"60,714.65",1,0,'C');
    $pdf->Cell(20,5,"61.199.01",1,0,'C');
    $pdf->Cell(20,5,"61,250.29",1,0,'C');
    $pdf->Cell(20,5,"73,419.76",1,0,'C');
    $pdf->Cell(20,5,"70,297.83",1,0,'C');

    // $pdf->SetXY(80,215);
    // $pdf->SetFont('Arial','',);
    // $pdf->Cell(60,10,"OTHER FEES",0,0,'C');


    $pdf->Ln(15);// Line break
    $pdf->SetFont('Arial','',8);
    $pdf->SetXY(30,220);
    $pdf->Cell(35,5,"Fee",1,0,'C');
    $pdf->Cell(20,5,"HEADSTART",1,0,'C');
    $pdf->Cell(20,5,"NURSERY",1,0,'C');
    $pdf->Cell(20,5,"KINDER 1",1,0,'C');
    $pdf->Cell(20,5,"KINDER 2",1,0,'C');
    $pdf->Cell(20,5,"INTENSIVE",1,0,'C');
    $pdf->Cell(20,5,"GRADE 1-3",1,0,'C');

    $pdf->Ln(15);// Line break
    $pdf->SetFont('Arial','',8);
    $pdf->SetXY(30,225);
    $pdf->Cell(35,5,"School Supplies",1,0,'C');
    $pdf->Cell(20,5,"1,500.00",1,0,'C');
    $pdf->Cell(20,5,"1,500.00",1,0,'C');
    $pdf->Cell(20,5,"1,500.00",1,0,'C');
    $pdf->Cell(20,5,"1,500.00",1,0,'C');
    $pdf->Cell(20,5,"1,800.00",1,0,'C');
    $pdf->Cell(20,5,"1,800.00",1,0,'C');

    $pdf->Ln(15);// Line break
    $pdf->SetFont('Arial','',8);
    $pdf->SetXY(30,230);
    $pdf->Cell(35,5,"Learning Trip",1,0,'C');
    $pdf->Cell(20,5,"1,000.00",1,0,'C');
    $pdf->Cell(20,5,"1,000.00",1,0,'C');
    $pdf->Cell(20,5,"1,000.00",1,0,'C');
    $pdf->Cell(20,5,"1,000.00",1,0,'C');
    $pdf->Cell(20,5,"1,000.00",1,0,'C');
    $pdf->Cell(20,5,"1,000.00",1,0,'C');

    $pdf->Ln(15);// Line break
    $pdf->SetFont('Arial','',8);
    $pdf->SetXY(30,235);
    $pdf->Cell(35,5,"School Uniform",1,0,'C');
    $pdf->Cell(20,5,"650.00/set",1,0,'C');
    $pdf->Cell(20,5,"650.00/set",1,0,'C');
    $pdf->Cell(20,5,"650.00/set",1,0,'C');
    $pdf->Cell(20,5,"650.00/set",1,0,'C');
    $pdf->Cell(20,5,"650.00/set",1,0,'C');
    $pdf->Cell(20,5,"650.00/set",1,0,'C');

    $pdf->Ln(15);// Line break
    $pdf->SetFont('Arial','',8);
    $pdf->SetXY(30,240);
    $pdf->Cell(35,5,"PE Uniform",1,0,'C');
    $pdf->Cell(20,5,"600.00/set",1,0,'C');
    $pdf->Cell(20,5,"600.00/set",1,0,'C');
    $pdf->Cell(20,5,"600.00/set",1,0,'C');
    $pdf->Cell(20,5,"600.00/set",1,0,'C');
    $pdf->Cell(20,5,"600.00/set",1,0,'C');
    $pdf->Cell(20,5,"650.00/set",1,0,'C');

    $pdf->Ln(15);// Line break
    $pdf->SetFont('Arial','',8);
    $pdf->SetXY(30,245);
    $pdf->Cell(35,5,"Hygiene Kit",1,0,'C');
    $pdf->Cell(20,5,"500.00/set",1,0,'C');
    $pdf->Cell(20,5,"500.00/set",1,0,'C');
    $pdf->Cell(20,5,"500.00/set",1,0,'C');
    $pdf->Cell(20,5,"500.00/set",1,0,'C');
    $pdf->Cell(20,5,"500.00/set",1,0,'C');
    $pdf->Cell(20,5,"500.00/set",1,0,'C');

    $pdf->Ln(15);// Line break
    $pdf->SetFont('Arial','',8);
    $pdf->SetXY(30,250);
    $pdf->Cell(155,5,"OTHER FEES",1,0,'C');

    $pdf -> Output();


?>