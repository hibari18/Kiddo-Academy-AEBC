<?php
include "db_connect.php";
	$id=$_POST['txtDetId'];
	
	$no=$_POST['txtDetNo'];
	$due=$_POST['txtDetDueDate'];
	if(empty($due))
	{
		$due="0000-00-00";
	}
	$amount=$_POST['txtDetAmount'];
	if(isset($_POST['btnDetSave']))
	{
	$arrLvl = array();
	$query  = "select * from tbllevel where tblLevelFlag = 1";
	$result = mysqli_query($con, $query);
	while($row = mysqli_fetch_array($result))
	{
		array_push($arrLvl, $row['tblLevelId']);
	}
	if(empty($id))
	{
		//create new scheme
		$insertSchemeQuery  = "INSERT INTO tblscheme (tblSchemeId, tblSchemeType, tblSchemeNoOfPayment, tblScheme_tblFeeId, tblSchemeFlag)
								SELECT tblSchemeId + 1, 'NO SCHEME', 1, '$feeid', 1 FROM tblscheme ORDER BY tblSchemeId DESC LIMIT 1";
		mysqli_query($con, $insertSchemeQuery);
		//get id of that new scheme
		$scheme_id = mysqli_insert_id($con);
		//insert scheme detail per level
		foreach($arrLvl as $level)
		{
			for($i = 1; $i <= $no; $i++)
			{
		
				$insertSchemeDetailQuery = "INSERT INTO tblschemedetail (
											tblSchemeDetailId, 
											tblSchemeDetailName, 
											tblSchemeDetailDueDate, 
											tblSchemeDetailAmount, 
											tblSchemeDetail_tblLevel, 
											tblSchemeDetail_tblScheme,
											tblSchemeDetail_tblFee
											)
										SELECT 
											tblSchemeDetailId + 1,
											'$i',
											'$due',
											'$amount',
											'$level',
											'$scheme_id',
											'$feeid'
										FROM tblschemedetail ORDER BY tblSchemeDetailId DESC LIMIT 1
										";
				$result = mysqli_query($con, $insertSchemeDetailQuery);
			}
		}
	}
	else {
		//update all levels
		$query="update tblschemedetail set tblSchemeDetailDueDate='$due', tblSchemeDetailAmount='$amount' where tblSchemeDetailId = '$id' and tblSchemeDetailFlag = 1 and tblSchemeDetailName='$no'";
		$result = mysqli_query($con, $query);
	}
	}else if(isset($_POST['btnDetSave1']))
	{
		$feeid=$_POST['txtFeeIdUpdateSched'];
		$query="update tblfee set tblFeeDueDate='$due', tblFeeAmnt='$amount' where tblFeeId='$feeid' and tblFeeFlag=1";
	}
	if (!$query = mysqli_query($con, $query)) {
				   exit(mysqli_error($con));
	 } else {
		 header("location:payment.php?message=4");
	 }
?>