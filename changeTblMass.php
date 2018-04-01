<?php
include "db_connect.php";
$feetype=$_GET['chkPSchedStat'];
echo '<thead>
            <tr>
            <th hidden>SchemeDetailId</th>
            <th>Fee Code</th>
            <th>Fee Name</th>
            <th>Scheme Type</th>
            <th>Scheme Payment Order</th>
            <th>Due Date</th>
            <th>Amount on Due Date</th>
            <th>Action</th>
            </tr>
            </thead>
            <tbody>';
 $query1=mysqli_query($con, "select tblFeeId from tblfee where tblFeeType='GENERAL FEE' and tblFeeFlag=1");
 while($row1=mysqli_fetch_array($query1))
 {
      $feeid=$row1['tblFeeId'];
      $query2=mysqli_query($con, "select tblSchemeId from tblscheme where tblScheme_tblFeeId='$feeid' and tblSchemeFlag=1");
      if($query2->num_rows == 0)
      {
            $query=mysqli_query($con, "select * from tblfee where tblFeeId='$feeid' and tblFeeFlag=1");
            $row=mysqli_fetch_array($query);
            echo '<tr><td hidden></td><td class="feecode-cell" data-nodetails="1" data-feeid="'.$row["tblFeeId"].'">'.$row["tblFeeCode"].'</td><td>'.$row["tblFeeName"].'</td>';
            echo '<td>NO SCHEME</td><td>1</td><td></td><td></td><td><button type="button" class="btn btn-success btnUpdateSched" data-toggle="modal"><i class="fa fa-edit"></i></button>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModalThree"><i class="fa fa-undo"></i></button></td></tr>';
      }else if($query2->num_rows >=1)
      {
           
             $query="
                  select 
                        distinct(s.tblSchemeType), 
                        f.tblFeeCode, 
                        sd.tblSchemeDetailId, 
                        f.tblFeeId, 
                        f.tblFeeName, 
                        s.tblSchemeType,
                        sd.tblSchemeDetailName, 
                        sd.tblSchemeDetailDueDate,
                        sd.tblSchemeDetailAmount 
                  from 
                        tblfee f, 
                        tblscheme s, 
                        tblschemedetail sd 
                  where 
                        s.tblScheme_tblFeeId=f.tblFeeId 
                        and sd.tblSchemeDetail_tblScheme=s.tblSchemeId 
                        and f.tblFeeFlag=1 and f.tblFeeType='$feetype' 
                        and f.tblFeeId='$feeid' 
                  group by 
                        s.tblSchemeType, 
                        sd.tblSchemeDetailName";
             $result=mysqli_query($con, $query);
             while($row=mysqli_fetch_array($result)){
                  $due=$row['tblSchemeDetailDueDate'];
                  if($due=='0000-00-00')
                  {
                        $due="";
                  }
            echo '<tr>
            <td hidden>'; echo $row['tblSchemeDetailId']; echo '</td>
            <td class="feecode-cell" data-feeid="'.$row["tblFeeId"].'">'; echo $row['tblFeeCode']; echo '</td>
            <td>'; echo $row['tblFeeName']; echo '</td>
            <td>'; echo $row['tblSchemeType']; echo '</td>
            <td>'; echo $row['tblSchemeDetailName']; echo '</td>
            <td>'; echo $due; echo '</td>
            <td>'; echo $row['tblSchemeDetailAmount']; echo '</td>
            <td><button type="button" class="btn btn-success btnUpdateSched" data-toggle="modal"><i class="fa fa-edit"></i></button>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModalThree"><i class="fa fa-undo"></i></button></td>
            </tr>'; }
      }
 }
  echo '</tbody>';
?>