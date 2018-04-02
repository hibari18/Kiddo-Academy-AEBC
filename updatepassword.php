<?php
include "db_connect.php";
if(isset($_POST['changePW']))
{
	$id = $_POST['txtUserId'];
	$pw = $_POST['password'];

	$query = "update tbluser set tblUserPassword = '$pw' where tblUserId = '$id'";
	if (!$query = mysqli_query($con, $query)) {
    exit(mysqli_error($con));
	}else{
    header('location:changepassword.php');
	}
}
?>