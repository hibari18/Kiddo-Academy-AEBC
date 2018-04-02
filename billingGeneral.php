<?php
include "db_connect.php";
$lvl=$_POST['txtLevel'];
$type=$_POST['txtFeeType'];
$feeid=$_POST['txtFeeId'];
$scheme=$_POST['selScheme'];
if($type=='PER LEVEL')
{
foreach($lvl as $x)
{
	$query="select s.tblStudentId from tblstudent s, tblstudenroll se where se.tblStudEnroll_tblStudentId=s.tblStudentId
	and s.tblStudent_tblLevelId='$x' and s.tblStudentFlag=1 and s.tblStudentType='OFFICIAL'
	and se.tblStudEnroll_tblSchoolYrId='$syid'";
	$result=mysqli_query($con, $query);
	while($row=mysqli_fetch_array($result)):
		$studid=$row['tblStudentId'];
		$query1="select tblStudSchemeId from tblstudscheme where tblStudScheme_tblStudentId='$studid'
		and tblStudScheme_tblFeeId='$feeid' and tblStudScheme_tblSchoolYrId='$syid'";
		$result1=$con->query($query1);
		if($result1->num_rows == 0)
		{
			$query6="select tblStudSchemeId from tblstudscheme order by tblStudSchemeId desc limit 0, 1";
			$result6=mysqli_query($con, $query6);
			$row6=mysqli_fetch_array($result6);
			$studscheme=$row6['tblStudSchemeId'];
			$studscheme ++;
			$query2="insert into tblstudscheme(tblStudSchemeId, tblStudScheme_tblSchemeId, tblStudScheme_tblFeeId,
				tblStudScheme_tblStudentId, tblStudScheme_tblSchoolYrId) values ('$studscheme','$scheme','$feeid','$studid','$syid')";
			if (!$query2 = mysqli_query($con, $query2)) {
			    exit(mysqli_error($con));
			}else{
			    $query3="select * from tblschemedetail where tblSchemeDetail_tblScheme='$scheme' and tblSchemeDetail_tblLevel='$x' and tblSchemeDetailFlag=1";
				$result3=mysqli_query($con, $query3);
				while($row3=mysqli_fetch_array($result3))
				{
					$duedate=$row3['tblSchemeDetailDueDate'];
					$payment=$row3['tblSchemeDetailAmount'];
					$paymentnum=$row3['tblSchemeDetailName'];
					$query4="select * from tblaccount order by tblAccId desc limit 0, 1";
					$result4=mysqli_query($con, $query4);
					$row4=mysqli_fetch_array($result4);
					$accountid=$row4['tblAccId'];
					$accountid ++;
					$query5="insert into tblaccount(tblAccId, tblAcc_tblStudentId, tblAcc_tblStudSchemeId, tblAccCredit, tblAccDueDate, tblAccPaymentNum, tblAccRunningBal) values
					('$accountid', '$studid', '$studscheme', '$payment', '$duedate', '$paymentnum', '$payment')";
					if (!$query5 = mysqli_query($con, $query5)) {
					exit(mysqli_error($con));
					}
				}
			}
		}
	endwhile;
}
}else if($type=='GENERAL')
{
	$query="select s.tblStudentId, s.tblStudent_tblLevelId from tblstudent s, tblstudenroll se where se.tblStudEnroll_tblStudentId=s.tblStudentId
	and s.tblStudentFlag=1 and s.tblStudentType='OFFICIAL'
	and se.tblStudEnroll_tblSchoolYrId='$syid'";
	$result=mysqli_query($con, $query);
	while($row=mysqli_fetch_array($result)):
		$studid=$row['tblStudentId'];
		$x=$row['tblStudent_tblLevelId'];
		$query1="select tblStudSchemeId from tblstudscheme where tblStudScheme_tblStudentId='$studid'
		and tblStudScheme_tblFeeId='$feeid' and tblStudScheme_tblSchoolYrId='$syid'";
		$result1=$con->query($query1);
		if($result1->num_rows == 0)
		{
			$query6="select tblStudSchemeId from tblstudscheme order by tblStudSchemeId desc limit 0, 1";
			$result6=mysqli_query($con, $query6);
			$row6=mysqli_fetch_array($result6);
			$studscheme=$row6['tblStudSchemeId'];
			$studscheme ++;
			$query2="insert into tblstudscheme(tblStudSchemeId, tblStudScheme_tblSchemeId, tblStudScheme_tblFeeId,
				tblStudScheme_tblStudentId, tblStudScheme_tblSchoolYrId) values ('$studscheme','$scheme','$feeid','$studid','$syid')";
			if (!$query2 = mysqli_query($con, $query2)) {
			    exit(mysqli_error($con));
			}else{
			    $query3="select * from tblschemedetail where tblSchemeDetail_tblScheme='$scheme' and tblSchemeDetail_tblLevel='$x' and tblSchemeDetailFlag=1";
				$result3=mysqli_query($con, $query3);
				while($row3=mysqli_fetch_array($result3))
				{
					$duedate=$row3['tblSchemeDetailDueDate'];
					$payment=$row3['tblSchemeDetailAmount'];
					$paymentnum=$row3['tblSchemeDetailName'];
					$query4="select * from tblaccount order by tblAccId desc limit 0, 1";
					$result4=mysqli_query($con, $query4);
					$row4=mysqli_fetch_array($result4);
					$accountid=$row4['tblAccId'];
					$accountid ++;
					$query5="insert into tblaccount(tblAccId, tblAcc_tblStudentId, tblAcc_tblStudSchemeId, tblAccCredit, tblAccDueDate, tblAccPaymentNum, tblAccRunningBal) values
					('$accountid', '$studid', '$studscheme', '$payment', '$duedate', '$paymentnum', '$payment')";
					if (!$query5 = mysqli_query($con, $query5)) {
					exit(mysqli_error($con));
					}
				}
			}
		}
	endwhile;
}else if($type=='PER STUDENT')
{
	$stud=$_POST['c1'];
	if($scheme==0)
	{
	foreach($stud as $s)
	{
		$query="select * from tblstudent where tblStudentId='$s' and tblStudentFlag=1";
		$row=mysqli_fetch_array(mysqli_query($con, $query));
		$x=$row['tblStudent_tblLevelId'];
		$query1="select tblStudSchemeId from tblstudscheme where tblStudScheme_tblStudentId='$s'
		and tblStudScheme_tblFeeId='$feeid' and tblStudScheme_tblSchoolYrId='$syid'";
		$result1=$con->query($query1);
		if($result1->num_rows == 0)
		{
			$query6="select tblStudSchemeId from tblstudscheme order by tblStudSchemeId desc limit 0, 1";
			$result6=mysqli_query($con, $query6);
			$row6=mysqli_fetch_array($result6);
			$studscheme=$row6['tblStudSchemeId'];
			$studscheme ++;
			$query2="insert into tblstudscheme(tblStudSchemeId, tblStudScheme_tblFeeId,
				tblStudScheme_tblStudentId, tblStudScheme_tblSchoolYrId) values ('$studscheme','$feeid','$s','$syid')";
			if (!$query2 = mysqli_query($con, $query2)) {
			    exit(mysqli_error($con));
			}else{
				$query7=mysqli_query($con, "select * from tblfee where tblFeeId='$feeid' and tblFeeFlag=1");
				$row7=mysqli_fetch_array($query7);
				$duedue=$row7['tblFeeDueDate'];
				$amntamnt=$row7['tblFeeAmnt'];
				$stat=$row7['tblFeeType'];
				if($stat=='SPECIFIC FEE')
				{
			    $query1="select * from tblfeeamount where tblFeeAmount_tblFeeId='$feeid' and tblFeeAmountFlag=1 and tblFeeAmount_tblLevelId='$x'";
			$result1=mysqli_query($con, $query1);
			$row1=mysqli_fetch_array($result1);
			$feeamnt=$row1['tblFeeAmountAmount'];
			$query2="select * from tblaccount order by tblAccId desc limit 0, 1";
			$result2 = mysqli_query($con, $query2);
			$row2 = mysqli_fetch_assoc($result2);
			$id = $row2['tblAccId'];
			$id ++;
			$query3="insert into tblaccount(tblAccId, tblAcc_tblStudentId, tblAcc_tblStudSchemeId, tblAccCredit, tblAccPaymentNum, tblAccRunningBal) values ('$id', '$s', '$studscheme', '$feeamnt', 1, '$feeamnt')";
			if (!$query3 = mysqli_query($con, $query3)) {
				exit(mysqli_error($con));
			}
			}else if($stat=='GENERAL FEE')
			{
				$query2="select * from tblaccount order by tblAccId desc limit 0, 1";
			$result2 = mysqli_query($con, $query2);
			$row2 = mysqli_fetch_assoc($result2);
			$id = $row2['tblAccId'];
			$id ++;
			$query3="insert into tblaccount(tblAccId, tblAcc_tblStudentId, tblAcc_tblStudSchemeId, tblAccCredit, tblAccPaymentNum, tblAccRunningBal, tblAccDueDate) values ('$id', '$s', '$studscheme', '$amntamnt', 1, '$amntamnt', '$duedue	')";
			if (!$query3 = mysqli_query($con, $query3)) {
				exit(mysqli_error($con));
			}
			}
			}
		}

	}//foreach
	}else if($scheme != 0)
	{
	foreach($stud as $s)
	{
		$query="select * from tblstudent where tblStudentId='$s' and tblStudentFlag=1";
		$row=mysqli_fetch_array(mysqli_query($con, $query));
		$x=$row['tblStudent_tblLevelId'];
		$query1="select tblStudSchemeId from tblstudscheme where tblStudScheme_tblStudentId='$s'
		and tblStudScheme_tblFeeId='$feeid' and tblStudScheme_tblSchoolYrId='$syid'";
		$result1=$con->query($query1);
		if($result1->num_rows == 0)
		{
			$query6="select tblStudSchemeId from tblstudscheme order by tblStudSchemeId desc limit 0, 1";
			$result6=mysqli_query($con, $query6);
			$row6=mysqli_fetch_array($result6);
			$studscheme=$row6['tblStudSchemeId'];
			$studscheme ++;
			$query2="insert into tblstudscheme(tblStudSchemeId, tblStudScheme_tblSchemeId, tblStudScheme_tblFeeId,
				tblStudScheme_tblStudentId, tblStudScheme_tblSchoolYrId) values ('$studscheme','$scheme','$feeid','$s','$syid')";
			if (!$query2 = mysqli_query($con, $query2)) {
			    exit(mysqli_error($con));
			}else{
			    $query3="select * from tblschemedetail where tblSchemeDetail_tblScheme='$scheme' and tblSchemeDetail_tblLevel='$x' and tblSchemeDetailFlag=1";
				$result3=mysqli_query($con, $query3);
				while($row3=mysqli_fetch_array($result3))
				{
					$duedate=$row3['tblSchemeDetailDueDate'];
					$payment=$row3['tblSchemeDetailAmount'];
					$paymentnum=$row3['tblSchemeDetailName'];
					$query4="select * from tblaccount order by tblAccId desc limit 0, 1";
					$result4=mysqli_query($con, $query4);
					$row4=mysqli_fetch_array($result4);
					$accountid=$row4['tblAccId'];
					$accountid ++;
					$query5="insert into tblaccount(tblAccId, tblAcc_tblStudentId, tblAcc_tblStudSchemeId, tblAccCredit, tblAccDueDate, tblAccPaymentNum, tblAccRunningBal, tblAccPaid) values
					('$accountid', '$s', '$studscheme', '$payment', '$duedate', '$paymentnum', '$payment', 'UNPAID')";
					if (!$query5 = mysqli_query($con, $query5)) {
					exit(mysqli_error($con));
					}
				}
			}
		}

	}
	}
}
header('location:billing.php?message=2');
?>
