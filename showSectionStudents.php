<?php
    include "db_connect.php";

    $sectid=trim($_GET['id']);

    $query="select s.tblStudentId,  concat(si.tblStudInfoLname, ', ', si.tblStudInfoFname, ' ', si.tblStudInfoMname) as name
        from tblstudent s, tblstudentinfo si
        where s.tblStudentId=si.tblStudInfo_tblStudentId 
        and s.tblStudentType='OFFICIAL'
        and s.tblStudentFlag=1 
        order by tblStudentId";

    $result=mysqli_query($con, $query);
        
    if(mysqli_num_rows($result) == 0){
        header('HTTP/1.1 500 Internal Server Error');
        die('No students registered');
    }

    while($row=mysqli_fetch_array($result)):
        $studid=$row['tblStudentId'];
        $studname = $row['name'];
        if($studid!="")
        {
            echo "$studid - $studname\n";
        }
    endwhile;
?>