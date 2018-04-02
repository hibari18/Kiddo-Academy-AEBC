
<?php
include "db_connect.php";
$feeid=$_GET['optionalfees'];
$lvlid=$_GET['level'];
$query=mysqli_query($con, "select * from tblfee where tblFeeId='$feeid' and tblFeeFlag=1");
$row=mysqli_fetch_array($query);
$fee=$row['tblFeeName'];
$query="select * from tblscheme where tblScheme_tblFeeId='$feeid' and tblSchemeFlag=1";
$result=$con->query($query);
if($result->num_rows >= 1)
{ 
?>
<div><label><?php echo $fee ?></label>
<select class="form-control" style="width:30%" name="selSchemeOpt[]" id="selSchemeOpt" onchange="showSchemeDetail(this)">
	<option disabled selected>--Select Scheme--</option>
<?php
$query1=mysqli_query($con, "select * from tblscheme where tblScheme_tblFeeId='$feeid' and tblSchemeFlag=1");
while($row=mysqli_fetch_array($result))
{ 
?>
<option value="<?php echo $row['tblSchemeId'] ?>" ><?php echo $row['tblSchemeType'] ?></option>
<?php } ?>
</select>
</div>


<div style="margin-top: 5%; margin-bottom: 5%">
 <table class="table table-bordered table-striped" id="datatable2">
   <thead>
     <tr>
       <th>Level</th>
       <th>Order of Payment</th>
       <th>Due Date</th>
       <th>Amount</th>
     </tr>
   </thead>
   <tbody>
   </tbody>
 </table>
</div>
<input type="hidden" value="<?php echo $lvlid ?>" name="txtlevelid" id="txtlevelid" />
<?php } ?>
<!--   -->