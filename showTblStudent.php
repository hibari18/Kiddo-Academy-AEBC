<?php
include "db_connect.php";
$lvl = $_GET['selLevel'];
echo '<thead>
 <tr>
<th>Student Id</th>
<th>Student Name</th>
<th>Type</th>
<th>Action</th>
</tr>
</thead>
<tbody>';

$query="
    select 
        distinct s.tblStudentId, 
        concat(si.tblStudInfoLname, ', ', si.tblStudInfoFname, ' ', si.tblStudInfoMname) as name, 
        s.tblStudentType 
    from tblstudent s
    left join tblstudentinfo si on s.tblStudentId=si.tblStudInfo_tblStudentId
    where 
        s.tblStudentFlag=1 and 
        si.tblStudInfoFlag=1 and 
        s.tblStudent_tblLevelId='$lvl' and 
        (s.tblStudentType='APPLICANT' or
        s.tblStudentType='PROMOTED' or 
        s.tblStudentType='FAILED')
    ";
$result=mysqli_query($con, $query);
while($row = mysqli_fetch_array($result)):
echo '<tr><td>'; echo $row['tblStudentId']; echo '</td>';
echo '<td>'; echo $row['name']; echo '</td>';
echo '<td>'; echo $row['tblStudentType']; echo '</td>';
echo '<td><button type="button" class="btn btn-success" data-toggle="modal" data-target="#mdlEnrollment">Enroll Student</button></td>
</tr>';
endwhile;
echo '</tbody>';
?>