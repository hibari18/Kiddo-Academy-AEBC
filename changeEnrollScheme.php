<?php
include "db_connect.php";
$studid=$_POST['txtstudid'];
$session=$_POST['s1'];
$schemem=$_POST['selSchemeMand'];
$schemeo=$_POST['selSchemeOpt'];
$optfees=$_POST['optionalfees'];
$lvlid=$_POST['txtlvlid'];

$query=mysqli_query($con, "select * from tblstudscheme where tblStudScheme_tblStudentId='$studid' and tblStudScheme_tblSchoolYrId='$syid' and tblStudSchemeFlag=1");
while($row=mysqli_fetch_array($query))
{
	$ssid=$row['tblStudSchemeId'];
	$query1=mysqli_query($con, "update tblstudscheme set tblStudSchemeFlag=0 where tblStudScheme_tblStudentId='$studid' and tblStudScheme_tblSchoolYrId='$syid' and tblStudSchemeFlag=1");
	$query2=mysqli_query($con, "update tblaccount set tblAccFlag=0 where tblAcc_tblStudSchemeId='$ssid' and tblAccFlag=1");
}

// foreach($schemem as $x)
// {
// 	$query=mysqli_query($con, "select * from tblscheme where tblSchemeId='$x' and tblSchemeFlag=1");
// 	$row=mysqli_fetch_array($query);
// 	$feeid=$row['tblScheme_tblFeeId'];
// }
// foreach($optfees as $z)
// {
// 	foreach($schemeo as $y)
// 	{
// 		$query=mysqli_query($con, "select * from tblscheme where tblSchemeId='$y' and tblSchemeFlag=1 and tblScheme_tblFeeId='$z'");
// 		$row=mysqli_fetch_array($query);
// 		$feeid=$row['tblScheme_tblFeeId'];
// 		if($query->num_rows >= 1)
// 		{
			
// 		}else if($query->num_rows == 0)
// 		{
			
// 		}
// 	}
// }
if($optfees != 'None')
{
foreach($optfees as $val)
{
	if($schemeo != 'None')
	{
		foreach($schemeo as $x)
		{
			$query="select * from tblscheme where tblScheme_tblFeeId='$val' and tblSchemeFlag=1";
			$result=$con->query($query);
			
			if($result->num_rows >= 1)
			{
				$query1="select * from tblstudscheme where tblStudScheme_tblFeeId='$val' and tblStudSchemeFlag=1 and tblStudScheme_tblStudentId='$studid' and tblStudScheme_tblSchoolYrId='$syid' and tblStudScheme_tblSchemeId='$x'";
				$result1=$con->query($query1);
				if($result1->num_rows == 0)
				{
				$query1="insert into tblstudscheme(tblStudScheme_tblSchemeId, tblStudScheme_tblFeeId, tblStudScheme_tblStudentId, tblStudSchemeFlag, tblStudScheme_tblSchoolYrId) value ('$x', '$val', '$studid', 1, '$syid')";
				if (!$query1 = mysqli_query($con, $query1)){
    					exit(mysqli_error($con));
    					
				}
				}
			}else if($result->num_rows == 0)
			{
				$query1="select * from tblstudscheme where tblStudScheme_tblFeeId='$val' and tblStudSchemeFlag=1 and tblStudScheme_tblStudentId='$studid' and tblStudScheme_tblSchoolYrId='$syid'";
				$result1=$con->query($query1);
				if($result1->num_rows == 0)
				{
					$query2="insert into tblstudscheme(tblStudScheme_tblFeeId, tblStudScheme_tblStudentId, tblStudSchemeFlag, tblStudScheme_tblSchoolYrId) value ('$val', '$studid', 1, '$syid')";
					if (!$query2 = mysqli_query($con, $query2)){
	    					exit(mysqli_error($con));
	    					
					}
				}
			}
		}
	}else if($schemeo == 'None')
	{
		$query1="select * from tblstudscheme where tblStudScheme_tblFeeId='$val' and tblStudSchemeFlag=1 and tblStudScheme_tblStudentId='$studid' and tblStudScheme_tblSchoolYrId='$syid'";
				$result1=$con->query($query1);
				if($result1->num_rows == 0)
				{
					$query2="insert into tblstudscheme(tblStudScheme_tblFeeId, tblStudScheme_tblStudentId, tblStudSchemeFlag, tblStudScheme_tblSchoolYrId) value ('$val', '$studid', 1, '$syid')";
					if (!$query2 = mysqli_query($con, $query2)){
	    					exit(mysqli_error($con));
	    					
					}
				}
	}
}
}
$query3=mysqli_query($con, "select * from tblfee where tblFeeMandatory='Y' and tblFeeFlag=1");
while($row3=mysqli_fetch_array($query3))
{
	$fee=$row3['tblFeeId'];
	if($schemem != 'None')
	{
		foreach($schemem as $x)
		{
			$query="select * from tblscheme where tblScheme_tblFeeId='$fee' and tblSchemeId='$x' and tblSchemeFlag=1";
			$result=$con->query($query);
			
			if($result->num_rows >= 1)
			{
				$query1="select * from tblstudscheme where tblStudScheme_tblFeeId='$fee' and tblStudSchemeFlag=1 and tblStudScheme_tblStudentId='$studid' and tblStudScheme_tblSchoolYrId='$syid' and tblStudScheme_tblSchemeId='$x'";
				$result1=$con->query($query1);
				if($result1->num_rows == 0)
				{
				
				$query2="insert into tblstudscheme(tblStudScheme_tblSchemeId, tblStudScheme_tblFeeId, tblStudScheme_tblStudentId, tblStudSchemeFlag, tblStudScheme_tblSchoolYrId) value ('$x', '$fee', '$studid', 1, '$syid')";
				if (!$query2 = mysqli_query($con, $query2)){
    					exit(mysqli_error($con));
    					
				}
				
				}
			}else if($result->num_rows == 0)
			{
				$query1="select * from tblstudscheme where tblStudScheme_tblFeeId='$fee' and tblStudSchemeFlag=1 and tblStudScheme_tblStudentId='$studid' and tblStudScheme_tblSchoolYrId='$syid'";
				$result1=$con->query($query1);
				if($result1->num_rows == 0)
				{
					$query2="insert into tblstudscheme(tblStudScheme_tblFeeId, tblStudScheme_tblStudentId, tblStudSchemeFlag, tblStudScheme_tblSchoolYrId) value ('$fee', '$studid', 1, '$syid')";
					if (!$query2 = mysqli_query($con, $query2)){
	    					exit(mysqli_error($con));
	    					
					}
				}
			}
		}
	}
}
$query="select * from tblstudscheme where tblStudScheme_tblStudentId='$studid' and tblStudScheme_tblSchoolYrId='$syid' and tblStudSchemeFlag=1";
	$result=mysqli_query($con, $query);
	while($row=mysqli_fetch_array($result)):
		$studscheme=$row['tblStudSchemeId'];
		$schemeId=$row['tblStudScheme_tblSchemeId'];
		$studfeeid=$row['tblStudScheme_tblFeeId'];
		if(!empty($schemeId))
		{
			$query4="select * from tblschemedetail where tblSchemeDetail_tblScheme='$schemeId' and tblSchemeDetail_tblLevel='$lvlid' and tblSchemeDetailFlag=1";
			$result3=mysqli_query($con, $query4);
			while($row3=mysqli_fetch_array($result3))
			{
				$duedate=$row3['tblSchemeDetailDueDate'];
				$payment=$row3['tblSchemeDetailAmount'];
				$paymentnum=$row3['tblSchemeDetailName'];
				// echo $lvlid."	".$studscheme."/".$schemeId."/".$studfeeid."/".$duedate."/".$payment."/".$paymentnum."<br/>";
				$query5="select * from tblaccount order by tblAccId desc limit 0, 1";
				$result4=mysqli_query($con, $query5);
				$row4=mysqli_fetch_array($result4);
				$accountid=$row4['tblAccId'];
				$accountid ++; 
				$query5="insert into tblaccount(tblAccId, tblAcc_tblStudentId, tblAcc_tblStudSchemeId, tblAccCredit, tblAccDueDate, tblAccPaymentNum, tblAccRunningBal) values ('$accountid', '$studid', '$studscheme', '$payment', '$duedate', '$paymentnum', '$payment')";
				if (!$query5 = mysqli_query($con, $query5)) {
				exit(mysqli_error($con));	
				}
			}

			
		}else if(empty($schemeId))
		{
			$query6=mysqli_query($con, "select * from tblfee where tblFeeId=$studfeeid and tblFeeFlag=1");
			$row6=mysqli_fetch_array($query6);
			$feetype=$row6['tblFeeType'];
			if($feetype=='SPECIFIC FEE')
			{
			$query1="select * from tblfeeamount where tblFeeAmount_tblFeeId='$studfeeid' and tblFeeAmountFlag=1 and tblFeeAmount_tblLevelId='$lvlid'";
			$result1=mysqli_query($con, $query1);
			$row1=mysqli_fetch_array($result1);
			$feeamnt=$row1['tblFeeAmountAmount'];

			$query2="select * from tblaccount order by tblAccId desc limit 0, 1";
			$result2 = mysqli_query($con, $query2);
			$row2 = mysqli_fetch_assoc($result2);
			$id = $row2['tblAccId'];
			$id ++;
			$query3="insert into tblaccount(tblAccId, tblAcc_tblStudentId, tblAcc_tblStudSchemeId, tblAccCredit, tblAccPaymentNum, tblAccRunningBal) values ('$id', '$studid', '$studscheme', '$feeamnt', 1, '$feeamnt')";
			if (!$query3 = mysqli_query($con, $query3)) {
				exit(mysqli_error($con));
			}
			}else if($feetype=='GENERAL FEE')
			{
				$duedue=$row6['tblFeeDueDate'];
				$amntamnt=$row6['tblFeeAmnt'];
				$query2="select * from tblaccount order by tblAccId desc limit 0, 1";
				$result2 = mysqli_query($con, $query2);
				$row2 = mysqli_fetch_assoc($result2);
				$id = $row2['tblAccId'];
				$id ++;
				$query3="insert into tblaccount(tblAccId, tblAcc_tblStudentId, tblAcc_tblStudSchemeId, tblAccCredit, tblAccPaymentNum, tblAccRunningBal, tblAccDueDate) values ('$id', '$studid', '$studscheme', '$amntamnt', 1, '$amntamnt', '$duedue')";
				if (!$query3 = mysqli_query($con, $query3)) {
					exit(mysqli_error($con));
				}
			}

		}
	endwhile;
$query9="select * from tblstudenroll where tblStudEnroll_tblStudentId='$studid' and tblStudEnroll_tblSchoolYrId='$syid'";
	$result9=$con->query($query9);
	if($result9->num_rows == 0)
	{
	$query="select * from tblstudenroll order by tblStudEnrollId desc limit 0, 1";
	$result = mysqli_query($con, $query);
	$row = mysqli_fetch_assoc($result);
	$enrollid = $row['tblStudEnrollId'];
	$enrollid++;
	$query="insert into tblstudenroll(tblStudEnrollId, tblStudEnrollPreferedSession, tblStudEnroll_tblStudentId, tblStudEnroll_tblSchoolYrId) values ('$enrollid', '$session', '$studid', '$syid')";
	if (!$query = mysqli_query($con, $query)) {
	   exit(mysqli_error($con));
		}
	}else if($result9->num_rows >= 1)
	{
		$query="update tblstudenroll set tblStudEnrollPreferedSession = '$session' where  tblStudEnroll_tblStudentId='$studid' and tblStudEnroll_tblSchoolYrId='$syid'";
		if (!$query = mysqli_query($con, $query)) {
	   exit(mysqli_error($con));
		}
	}
$query="update tblstudent set tblStudentPreferSession='$session', tblStudentType='ENROLLEE' where tblStudentId='$studid' and tblStudentFlag=1";
	if (!$query = mysqli_query($con, $query)) {
				exit(mysqli_error($con));
	}else
	{
		
		header("location:enrollmentmain.php");
		}
?>