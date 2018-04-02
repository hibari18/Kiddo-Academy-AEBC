<?php
 include "db_connect.php";
 $feeid=trim($_GET['id']);
 $lvlid=trim($_GET['level']);
 // echo "Fee Detail Name\t\t\t\t\tFee Detail Amount\n\n";
 $query=mysqli_query($con, "select * from tblfeedetail where tblFeeDetail_tblFeeId='$feeid' and tblFeeDetail_tblLevelId='$lvlid' and tblFeeDetailFlag=1");
 while($row=mysqli_fetch_array($query))
 {
 	$name = $row['tblFeeDetailName'];
 	$amnt = $row['tblFeeDetailAmount'];
 	echo "$name - $amnt \n";
 }
?>