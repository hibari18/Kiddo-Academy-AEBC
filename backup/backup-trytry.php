<?php
include "db_connect.php";
$ind=$_POST['ind'];
$or=$_POST['txtOR'];
$id=$_POST['txtAccId'];
$pr="";
$chk=$_POST['chkCheck'];
if($chk==1)
{
$camnt=$_POST['txtAmount'];
$bank=$_POST['txtBankName'];
$chknum=$_POST['num'];
}
$tamount=$_POST['amountp'];
$dates=date('Y-m-d');
$i=0;
foreach($id as $x)
{
	$datenow=date('Y-m-d');
	$query="select * from tblaccount where tblAccId='$x' and tblAccFlag=1";
	$result=mysqli_query($con, $query);
	$row=mysqli_fetch_array($result);
	$payment=$row['tblAccCredit'];
	$num=$row['tblAccPaymentNum'];
	$studid=$row['tblAcc_tblStudentId'];
	$query="update tblaccount set tblAccOR='$or', tblAccPR='$pr', tblAccPayment='$payment', tblAccRunningBal=null, tblAccPaid='PAID', tblAccPaymentDate='$datenow' where tblAccId='$x' and tblAccFlag=1";
	if (!$query = mysqli_query($con, $query)) {
		exit(mysqli_error($con));
	}
	$i++;
}
if($chk==1)
{
	$query="insert into tblcheck(tblChkAmount, tblChkBank, tblChkDate, tblChk_tblStudentId, tblChk_tblSchoolYrId, tblChkRTag, tblChkNum) values ('$camnt', '$bank', '$datenow', '$studid', '$syid', 'PENDING', '$chknum')";
	if (!$query = mysqli_query($con, $query)) {
		exit(mysqli_error($con));
	}
}
$query=mysqli_query($con, "insert into tblreceipt(tblRecAmount, tblRecDate, tblRec_tblStudentId, tblRecOR) values ('$tamount','$dates','$studid', '$or')");
if($ind == 1)
{
	$query1="select tblStudentType from tblstudent where tblStudentFlag=1 and tblStudentId='$studid'";
	$row1=mysqli_fetch_array(mysqli_query($con, $query1));
	$studtype=$row1['tblStudentType'];
	if($studtype=='ENROLLEE')
	{
	$query="update tblstudent set tblStudentType='OFFICIAL' where tblStudentId='$studid' and tblStudentFlag=1";
	if (!$query = mysqli_query($con, $query)) {
				exit(mysqli_error($con));
	}else
	{
		header("location:collectionMain.php");
	}
	}else if($studtype=='PROMOTED') 
	{
		$query="update tblstudent set tblStudentType='OFFICIAL' where tblStudentId='$studid' and tblStudentFlag=1";
		if (!$query = mysqli_query($con, $query)) {
					exit(mysqli_error($con));
		}else
		{
			header("location:collectionMain.php");
		}
	}
	
}else if($ind == 0)
{
	header("location:collectionMain.php");
}

include "studentClearance.php";
?>