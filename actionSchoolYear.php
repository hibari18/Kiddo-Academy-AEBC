<?php
include "db_connect.php";
if(isset($_POST['btnAddSy']))
{
	$yr = $_POST['txtAddSy'];
	$currId = $_POST['selAddSyCurr'];
	$yr2 = $yr + 1;
	$year = 'S.Y. '.$yr.'-'.$yr2;
	$search = "select * from tblschoolyear where tblSchoolYrStart = '$yr'";
	$result = $con->query($search);
	if ($result->num_rows == 0) 
	{
		$query = "select * from tblschoolyear order by tblSchoolYrId desc limit 0, 1";
	$res = mysqli_query($con, $query);
	$row = mysqli_fetch_assoc($res);
	$id = $row['tblSchoolYrId'];
	$query = "UPDATE tblschoolyear SET tblSchoolYrActive = 'INACTIVE' WHERE tblSchoolYrActive = 'ACTIVE'";
	$res2 = mysqli_query($con, $query);
	$id ++;
	$query = "INSERT INTO tblschoolyear(tblSchoolYrId,tblSchoolYrYear, tblSchoolYr_tblCurriculumId, tblSchoolYrStart, tblSchoolYrActive) VALUES('$id', '$year', '$currId', '$yr', 'ACTIVE')";
	if (!$query = mysqli_query($con, $query)) {
	    exit(mysqli_error($con));
	}else{
	    header('location:school-year.php?mesage=2');
	}
	}else if($result->num_rows > 0){
		$search="select tblSchoolYrId from tblschoolyear where tblSchoolYrYear='$year' and tblSchoolYearFlag=0";
		$find=$con->query($search);
		if($find->num_rows == 0)
		{
			header('Location: school-year.php?message=1');
		}else if($find->num_rows == 1)
		{
			$query="update tblschoolyear set tblSchoolYearFlag=1 where tblSchoolYrYear='$year'";
			$result=mysqli_query($con, $query);
			header('Location: school-year.php?message=2');
		}
	}
	$arrPeriod = array("1st Quarter","2nd Quarter","3rd Quarter","4th Quarter");
	foreach($arrPeriod as $value){
		$query = "select * from tblgradingperiod order by tblGradingId desc limit 0, 1";
		$result = mysqli_query($con, $query);
		$row = mysqli_fetch_assoc($result);
		$gradingid = $row['tblGradingId'];
		$gradingid ++;
		$query = "INSERT INTO tblgradingperiod(tblGradingId,tblGradingPeriod,tblGrading_tblSchoolYrId) VALUES ('$gradingid','$value','$id')";
		if (!$query = mysqli_query($con, $query)) {
		    exit(mysqli_error($con));
		}else{
		    header('location:school-year.php?message=2');
		}
}
}else if(isset($_POST['btnUpdSy']))
{
	$id = ($_POST['txtUpdSyId']);
		$yr = $_POST['txtUpdSyYear'];
		$curr = $_POST['selUpdSyCurr'];
		$active = $_POST['selUpdSyAct'];
		$yr2 = $yr + 1;
		$year = 'S.Y. '.$yr.'-'.$yr2;
		$search = "select tblSchoolYrYear from tblschoolyear where tblSchoolYrYear = '$year' and tblSchoolYrId <> '$id' and tblSchoolYearFlag = 1";
		$result = $con->query($search);
		if ($result->num_rows > 0) 
		{
			header('Location: school-year.php?msg=1');
		}else{
		$query = "select tblCurriculumId from tblcurriculum where tblCurriculumName = '$curr'";
		$result = mysqli_query($con, $query);
		$row = mysqli_fetch_array($result);
		$currId = $row['tblCurriculumId'];
		$query = "UPDATE tblschoolyear SET tblSchoolYrStart='$yr', tblSchoolYrYear='$year', tblSchoolYr_tblCurriculumId = '$currId' WHERE tblSchoolYrId = '$id'";
		$result = mysqli_query($con, $query);
		/*if (!$query = mysqli_query($con, $query)) {
	        exit(mysqli_error($con));
	    }else
	    {
	    	header('Location: school-year.php?msg=2');
	    }
*/		
		if($active=='ACTIVE')
			mysqli_query($con, "UPDATE tblschoolyear SET tblSchoolYrActive = 'INACTIVE'");
		$query = "update tblschoolyear set tblSchoolYrActive = '$active' where tblSchoolYrId = '$id'";
		if (!$query = mysqli_query($con, $query)) {
	   			exit(mysqli_error($con));
		}else{
			header('location:school-year.php?message=4');
		}	
		}
}else if(isset($_POST['btnDelSy']))
{
		$id = $_POST['txtDelSyId'];
        $query="select tblSchoolYrActive from tblschoolyear where tblSchoolYrId='$id'";
        $result=mysqli_query($con, $query);
        $row=mysqli_fetch_assoc($result);
        $active=$row['tblSchoolYrActive'];
        if($active=="INACTIVE")
        {
            $query="update tblgradingperiod set tblGradingFLag = 0 where tblGrading_tblSchoolYrId = '$id'";
            $result=mysqli_query($con, $query);
        	$query="update tblschoolyear set tblSchoolYearFlag = 0 where tblSchoolYrId = '$id'";
			if (!$query = mysqli_query($con, $query)) {
	   			exit(mysqli_error($con));
			}else{
	   			header('location:school-year.php?message=6');
			}
        }else if($active=="ACTIVE")
        {
        	header('location:school-year.php?message=7');
        }
}
?>