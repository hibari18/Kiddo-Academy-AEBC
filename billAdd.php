<?php
include "db_connect.php";
$feeid=$_GET['selFee'];
$type=$_GET['type'];
	echo '<input type="hidden" value="'.$feeid.'" name="txtFeeId" id="txtFeeId" />';
	if(!empty($feeid))
	{
	$query1=mysqli_query($con, "select * from tblscheme where tblScheme_tblFeeId='$feeid' and tblSchemeFlag=1");
	if($query1->num_rows >= 1)
	{
	echo '<select name="selScheme" id="selScheme"><option selected disabled>--Select Scheme--</option>';
	$query="select tblSchemeId, tblSchemeType from tblscheme where tblScheme_tblFeeId='$feeid' and tblSchemeFlag=1";
	$result=mysqli_query($con, $query);
	while($row=mysqli_fetch_array($result)):
		echo '<option value="'; echo $row["tblSchemeId"]; echo '">'; echo $row["tblSchemeType"]; echo '</option>';
	endwhile;
	echo '</select>';
	}else if($query1->num_rows == 0)
	{
		echo '<input type="hidden" name="selScheme" id="selScheme" value="0" />';
	}
	}
	if($type=='0')
	{
		echo '<h4>Levels: </h4>';
		echo '<input type="hidden" value="PER LEVEL" name="txtFeeType" id="txtFeeType" />';
		$query=mysqli_query($con, "select tblLevelId, tblLevelName from tbllevel where tblLevelFlag=1");
		while($row=mysqli_fetch_array($query))
		{
			echo '<div><input type="checkbox" name="txtLevel[]" value="'.$row["tblLevelId"].'"/><label>'.$row['tblLevelName'].' </label><div>';
		}
	}else if($type==1)
	{
		echo '<input type="hidden" value="GENERAL" name="txtFeeType" id="txtFeeType"/>';
		echo '<input type="hidden" name="txtLevel" id="txtLevel" value="None"/>';
	}else if($type==2)
	{
		echo '<div class="col-md-12" style="margin-top: 5%">';
		echo '<table id="datatable1" class="table table-bordered table-striped">
              <thead>
              <tr>
              <th></th>
              <th>Student ID</th>
              <th>Student Name</th>
              </tr>
              </thead> 
              <tbody>';
        $query="select s.tblStudentId, concat(si.tblStudInfoLname, ', ', si.tblStudInfoFname, ' ', si.tblStudInfoMname) as studentname from tblstudent s, tblstudentinfo si where s.tblStudentId=si.tblStudInfo_tblStudentId and s.tblStudentType='OFFICIAL' and s.tblStudentFlag=1;";
        $result=mysqli_query($con, $query);
        while($row=mysqli_fetch_array($result)):
        echo '<tr><td><input type="checkbox" id="c1" name="c1[]" value="'.$row["tblStudentId"].'" /></td>';
        echo '<td>'.$row["tblStudentId"].'</td>';
        echo '<td>'.$row["studentname"].'</td></tr>';
    	endwhile;
    	echo '</tbody></table></div>';
    	echo '<input type="hidden" value="PER STUDENT" name="txtFeeType" id="txtFeeType"/>';
    	echo '<input type="hidden" name="txtLevel" id="txtLevel" value="None"/>';
	}

?>