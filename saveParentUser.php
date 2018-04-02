<?php
include "db_connect.php";
$parentid=$_POST['txtParentId'];
$parentpass=$_POST['txtParentPass'];
$parentid= 'P-'.$parentid;

$query="select * from tbluser order by tblUserId desc limit 0, 1";
$result=mysqli_query($con, $query);
$row=mysqli_fetch_array($result);
$id=$row['tblUserId'];
$id++;
$query="insert into tbluser values ('$id', '$parentid', '$parentpass', 4, 1)";
if (!$query = mysqli_query($con, $query)) {
   exit(mysqli_error($con));
}else{
   $query="update tblparent set tblParent_tblUserId='$id' where tblParentId='$parentid' and tblParentFlag=1";
   if (!$query = mysqli_query($con, $query)) {
    exit(mysqli_error($con));
	}else{
    header('location:enrollmentmain.php');
	}
}

?>