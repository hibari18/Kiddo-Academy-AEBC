<?php
 
// Connection variables 
$host = "127.0.0.1"; // MySQL host name eg. localhost
$user = "root"; // MySQL user. eg. root ( if your on localserver)
$password = ""; // MySQL user password  (if password is not set for your root user then keep it empty )
$database = "dbkadc"; // MySQL Database name
 
// Connect to MySQL Database
$con = new mysqli($host, $user, $password, $database);
 
// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}else
{
	$query="select tblSchoolYrId from tblschoolyear where tblSchoolYrActive='ACTIVE' and tblSchoolYearFlag=1";
	$row=mysqli_fetch_array(mysqli_query($con, $query));
	$syid=$row['tblSchoolYrId'];
}
 
?>