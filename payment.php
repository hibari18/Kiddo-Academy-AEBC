<?php
   include('session.php');
   include('db_connect.php');
   $x=substr($login_session,0,1);
   if($x=="P")
   {
    $query="select tblParentId, concat(tblParentLname, ', ', tblParentFname, ' ', tblParentMname) as names from tblparent where tblParent_tblUserId='$user_id' and tblParentFlag=1";
    $result=mysqli_query($con, $query);
    $row=mysqli_fetch_array($result);
    $id=$row['tblParentId'];
    $namess=$row['names'];
    $query1="select * from tbluser where tblUserId='$user_id' and tblUserFlag=1";
    $result1=mysqli_query($con, $query1);
    $row1=mysqli_fetch_array($result1);
    $roleid=$row1['tblUser_tblRoleId'];
   }else if($x=="F")
   {
    $query="select tblFacultyId, concat(tblFacultyLname, ', ', tblFacultyFname, ' ', tblFacultyMname) as names from tblfaculty where tblFaculty_tblUserId='$user_id' and tblFacultyFlag=1";
    $result=mysqli_query($con, $query);
    $row=mysqli_fetch_array($result);
    $id=$row['tblFacultyId'];
    $namess=$row['names'];
    $query1="select * from tbluser where tblUserId='$user_id' and tblUserFlag=1";
    $result1=mysqli_query($con, $query1);
    $row1=mysqli_fetch_array($result1);
    $roleid=$row1['tblUser_tblRoleId'];
    $query="select * from tblrole where tblRoleId='$roleid' and tblRoleFlag=1";
    $result=mysqli_query($con, $query);
    $row=mysqli_fetch_array($result);
    $rolename=$row['tblRoleName'];
   }
?>
<!DOCTYPE html>

<html>

  <head>
    <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Kiddo Academy SIS</title>
  <link rel="icon" type="image/gif" href="images/symbol.png"/>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="css/bootstrap3-wysihtml5.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="css/daterangepicker/daterangepicker.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="css/datepicker/datepicker3.css">
  <link rel="stylesheet" href="css/adminLTEcss/skins/_all-skins.min.css">
  <!-- fullCalendar 2.2.5-->
  <link rel="stylesheet" href="css/fullcalendar.min.css">
  <link rel="stylesheet" href="css/fullcalendar.print.css" media="print">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="css/iCheck/all.css">

  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="css/select2.min.css">
  <!-- sweetalert -->
  <script src="sweetalert-master/dist/sweetalert-dev.js"></script>
  <link rel="stylesheet" href="sweetalert-master/dist/sweetalert.css">

  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

  <!--  Validations Design Keme  -->
  <link rel="stylesheet" type="text/css" href="css/validDesignPayment.css">
  <link rel="stylesheet" type="text/css" href="css/validDesignScheme.css">
   <link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">
    <style>
      body {
        font-family: 'Noto Sans', sans-serif;
        font-weight: bold;
      }
    </style>

<script>
  $(document).ready(function(){
  $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
    localStorage.setItem('activeTab', $(e.target).attr('href'));
  });
  var activeTab = localStorage.getItem('activeTab');
  if(activeTab){
    $('#myTab a[href="' + activeTab + '"]').tab('show');
  }
});
</script>

<script>
    function changeTblFee()
  {
    var lvl = document.getElementById("selFeeLvl").value;
    var xmlhttp =  new XMLHttpRequest();
    xmlhttp.open("GET","changeTblFee.php?selFeeLvl="+document.getElementById("selFeeLvl").value,false);
    xmlhttp.send(null);

    document.getElementById("datatable").innerHTML=xmlhttp.responseText;

  }

  function changeSchedSchemeLvl()
  {
    document.getElementById("selSchedFee").disabled = false;
    var xmlhttp =  new XMLHttpRequest();
    xmlhttp.open("GET","changeSchedSchemeLvl.php?selSchedLvl="+document.getElementById("selSchedLvl").value,false);
    xmlhttp.send(null);
  }

  function changeTblMass()
  {

    var xmlhttp =  new XMLHttpRequest();
    xmlhttp.open("GET","changeTblMass.php?chkPSchedStat="+document.getElementById("chkPSchedStat1").value,false);
    xmlhttp.send(null);
    document.getElementById("datatable2").innerHTML=xmlhttp.responseText;
  }
  function enable()
  {
    document.getElementById("selSchedLvl").disabled = false;
  }
    function changeFee()
  {
    document.getElementById("selSchedScheme").disabled = false;
    var xmlhttp =  new XMLHttpRequest();
    xmlhttp.open("GET","changeSchedFee.php?selSchedFee="+document.getElementById("selSchedFee").value,false);
    xmlhttp.send(null);

    document.getElementById("selSchedScheme").innerHTML=xmlhttp.responseText;

  }
  function changeTblSchedScheme()
  {
    var xmlhttp =  new XMLHttpRequest();
    xmlhttp.open("GET","changeTblSchedScheme.php?selSchedScheme="+document.getElementById("selSchedScheme").value,false);
    xmlhttp.send(null);

    document.getElementById("datatable2").innerHTML=xmlhttp.responseText;

  }
  function changeTblFeeType()
  {
    document.getElementById("selFee").disabled=false;
    var xmlhttp =  new XMLHttpRequest();
    xmlhttp.open("GET","changeTblFeeType.php?selFeeType="+document.getElementById("selFeeType").value,false);
    xmlhttp.send(null);

    document.getElementById("selFee").innerHTML=xmlhttp.responseText;

  }
  function changeTblFeeDetail()
  {
    document.getElementById("btnbtn").disabled=false;
    var feeId2 = document.getElementById("selFee").value;
    document.getElementById("txtUpdDetFeeId").value = feeId2;
    var xmlhttp =  new XMLHttpRequest();
    xmlhttp.open("GET","changeTblFeeDetail.php?selFee="+document.getElementById("selFee").value,false);
    xmlhttp.send(null);

    document.getElementById("datatable4").innerHTML=xmlhttp.responseText;

  }
  (function(){
  if(window.addEventListener){
    window.addEventListener('load',run,false);
  }else if(window.attachEvent){
    window.attachEvent('onload',run);
  }
function run(){
  var t=document.getElementById('datatable3');
  t.onclick=function(event){
    event=event || window.event;
    var target=event.target||event.srcElement;
    while (target&&target.nodeName!='TR'){
      target=target.parentElement;
    }
    var cells=target.cells;

    if(!cells.length||target.parentNode.nodeName=='THEAD'){return;}
    var f1=document.getElementById('txtUpdFeeId');
    var f2=document.getElementById('txtUpdFee');
    var f3=document.getElementById('txtDelFee');
    var f4=document.getElementById('selUpdFeeType');
    var f5=document.getElementById('selUpdFeeMand');
    var f6=document.getElementById('txtUpdFeeCode');
    var f7=document.getElementById('txtFdFeeCode');
    f1.value=cells[2].innerHTML;
    f2.value=cells[3].innerHTML;
    f3.value=cells[0].innerHTML;
    f4.value=cells[4].innerHTML;
    f5.value=cells[5].innerHTML;
    f6.value=cells[2].innerHTML;
    f7.value=cells[2].innerHTML;
  };
}})();
 (function(){
  if(window.addEventListener){
    window.addEventListener('load',run,false);
  }else if(window.attachEvent){
    window.attachEvent('onload',run);
  }
function run(){
  var t=document.getElementById('datatable1');
  t.onclick=function(event){
    event=event || window.event;
    var target=event.target||event.srcElement;
    while (target&&target.nodeName!='TR'){
      target=target.parentElement;
    }
    var cells=target.cells;

    if(!cells.length||target.parentNode.nodeName=='THEAD'){return;}
    var f1=document.getElementById('txtUpdSchemeId');
    var f2=document.getElementById('txtUpdFeeName');
    var f3=document.getElementById('txtUpdScheme');
    var f4=document.getElementById('txtUpdSchemeNo');
    var f5=document.getElementById('txtDelScheme');
    f1.value=cells[0].innerHTML;
    f2.value=cells[1].innerHTML;
    f3.value=cells[2].innerHTML;
    f4.value=cells[3].innerHTML;
    f5.value=cells[0].innerHTML;
  };
}})();
  (function(){
  if(window.addEventListener){
    window.addEventListener('load',run,false);
  }else if(window.attachEvent){
    window.attachEvent('onload',run);
  }
function run(){
  var t=document.getElementById('datatable4');
  t.onclick=function(event){
    event=event || window.event;
    var target=event.target||event.srcElement;
    while (target&&target.nodeName!='TR'){
      target=target.parentElement;
    }
    var cells=target.cells;

    if(!cells.length||target.parentNode.nodeName=='THEAD'){return;}
    var f1=document.getElementById('txtUpdDetLvl');
    var f2=document.getElementById('txtUpdDetName');
    var f3=document.getElementById('txtUpdDetAmnt');
    var f4=document.getElementById('txtUpdDetLvlId');
    var f5=document.getElementById('txtTempDetName');
    var f6=document.getElementById('txtDelFeeDet');
    var f7=document.getElementById('txtDelAmnt');
    f1.value=cells[1].innerHTML;
    f2.value=cells[2].innerHTML;
    f3.value=cells[3].innerHTML;
    f4.value=cells[0].innerHTML;
    f5.value=cells[2].innerHTML;
    f6.value=cells[2].innerHTML;
    f7.value=cells[3].innerHTML;
  };
}})();

  (function(){
    if(window.addEventListener){
      window.addEventListener('load',run,false);
    }else if(window.attachEvent){
      window.attachEvent('onload',run);
    }
  function run(){
    var t=document.getElementById('datatable2');
    t.onclick=function(event){
      event=event || window.event;
      var target=event.target||event.srcElement;
      while (target&&target.nodeName!='TR'){
        target=target.parentElement;
      }
      var cells=target.cells;

      if(!cells.length||target.parentNode.nodeName=='THEAD'){return;}
      var f1=document.getElementById('txtDetId');
      var f2=document.getElementById('txtDetNo');
      var f3=document.getElementById('txtDetDueDate');
      var f4=document.getElementById('txtDetAmount');
      var f5=document.getElementById('txtDetDelId');
      var f6=document.getElementById('txtDetId1');
      var f7=document.getElementById('txtDetNo1');
      var f8=document.getElementById('txtDetDueDate1');
      var f9=document.getElementById('txtDetAmount1');
      f1.value=cells[0].innerHTML;
      f2.value=cells[1].innerHTML;
      f3.value=cells[2].innerHTML;
      f4.value=cells[3].innerHTML;
      f5.value=cells[0].innerHTML;
      f6.value=cells[0].innerHTML;
      f7.value=cells[4].innerHTML;
      f8.value=cells[5].innerHTML;
      f9.value=cells[6].innerHTML;
    };
  }})();

function getFeeId()
{
  var fee = document.getElementById("txtFeeDetName").value;
  document.getElementById("txtFeeDet").value = fee;
  var feeId = document.getElementById("selFee").value;
  document.getElementById("txtFeeDetFee").value = feeId;

}

$(document).ready(function(){
  $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
    localStorage.setItem('activeTab', $(e.target).attr('href'));
  });
  var activeTab = localStorage.getItem('activeTab');
  if(activeTab){
    $('#myTab a[href="' + activeTab + '"]').tab('show');
  }
});
</script>

</head>
<body class="hold-transition skin-green-light sidebar-mini">

<?php
    $message = isset($_GET['message'])?intval($_GET['message']):0;

    if($message == 1) {
      echo "<script> swal('Data insertion failed!', ' ', 'error'); </script>";
    }

    if($message == 2) {
      echo "<script> swal('Added succesfully!', ' ', 'success'); </script>";
    }

    if($message == 3) {
      echo "<script> swal('Data update failed!', ' ', 'error'); </script>";
    }

    if($message == 4) {
      echo "<script> swal('Updated succesfully!', ' ', 'success'); </script>";
    }

    if($message == 5) {
      echo "<script> swal('Data deletion failed!', ' ', 'error'); </script>";
    }

    if($message == 6) {
      echo "<script> swal('Deleted succesfully!', ' ', 'success'); </script>";
    }
    if($message == 7) {
      echo "<script> swal('Reset succesful!', ' ', 'success'); </script>";
    }
  ?>

<div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="dashboard.php" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><image src="images/School Logo/logo.ico" style="width: 50px; padding: 3px"></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><image src="images/School Logo/logo.png" style="width: 200px; padding: 3px;"></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>

          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="images/Employees/admin.png" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?php echo $namess ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="images/Employees/admin.png" class="img-circle" alt="User Image">

                    <p>
                      <!-- <?php echo $namess ?> -->
                      <small><?php echo $rolename ?></small>
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <!-- <div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat">Profile</a>
                    </div> -->
                    <div class="pull-right">
                      <a href="logout.php" class="btn btn-default btn-flat">Logout</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
          <p style="text-align: center; font-size: 14px; padding-top: 15px; color: white">Kiddo Academy Admission and Enrollment with Billing and Collection</p>

        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="images/Employees/admin.png" class="img-circle" alt="User Image">
            </div>

            <div class="pull-left info" style="margin-top: 3%">
              <p><?php echo $namess ?><i class="fa fa-circle text-success" style="margin-left: 7px"></i></p>
              <p style="padding: 3px 30px; font-size: 12px;"><?php echo $rolename ?></p>
            </div>
          </div>

          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu" style="font-size:15px;">
                   <li class="header" style="color:black;">
               <div>
           <?php
             $query="select * from tblschoolyear where tblSchoolYrActive='ACTIVE' and tblSchoolYearFlag=1";
             $result=mysqli_query($con, $query);
             $row=mysqli_fetch_array($result);
             $sy=$row['tblSchoolYrYear'];
           ?>
           <h4 style="padding-left:5%;"><?php echo $sy ?></h4>
           <p style="font-size: 12px; padding-left:5%;">Welcome!</p>

       </div>
            </li>
           <?php
        $query="select * from tblrole where tblRoleFlag=1 and tblRoleId='$roleid'";
        $result=mysqli_query($con, $query);
        $row=mysqli_fetch_array($result);
          $rolename=$row['tblRoleName'];
          if($rolename=='ADMIN' || $rolename=='REGISTRAR')
          {
            $query1="select distinct(m.tblModuleType) from tblmodule m, tblrole r, tblrolemodule rm where r.tblRoleId='$roleid' and r.tblRoleId=rm.tblRoleModule_tblRoleId and m.tblModuleId=rm.tblRoleModule_tblModuleId and m.tblModuleFlag=1 group by m.tblModuleId";
            $result1=mysqli_query($con, $query1);
            while($row1=mysqli_fetch_array($result1))
            {
              $modulename=$row1['tblModuleType'];

        ?>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-gears"></i> <span><?php echo $modulename ?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
           <?php
              $query2="select * from tblrolemodule rm, tblmodule m where m.tblModuleId=rm.tblRoleModule_tblModuleId and rm.tblRoleModule_tblRoleId='$roleid' and m.tblModuleType='$modulename' and m.tblModuleFlag=1 group by m.tblModuleId";
              $result2=mysqli_query($con, $query2);
              while($row2=mysqli_fetch_array($result2)):
            ?>
            <li><a href="<?php echo $row2['tblModuleLinks'] ?>"><i class="fa fa-circle-o"></i><?php echo $row2['tblModuleName'] ?></a></li>
            <?php endwhile; ?>
          </ul>
        </li>
      <?php
      }//while
      }else
      {
              $query="select * from tblrolemodule rm, tblmodule m where m.tblModuleId=rm.tblRoleModule_tblModuleId and rm.tblRoleModule_tblRoleId='$roleid'";
              $result=mysqli_query($con, $query);
              while($row=mysqli_fetch_array($result)):
      ?>
           <li class="treeview">
              <a href="<?php echo $row['tblModuleLinks'] ?>">
                <i class="fa fa-list"></i> <span><?php echo $row['tblModuleName'] ?></span>
              </a>
            </li>
      <?php
       endwhile; }
      ?>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-default" style="margin-top: 25px">
            <div class="box-body">
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#tab_1" data-toggle="tab">Fees</a></li>
                  <li><a href="#tab_2" data-toggle="tab">Payment Scheme Type</a></li>
                  <li><a href="#tab_3" data-toggle="tab">Payment Schedule</a></li>
                </ul>


                <div class="tab-content">


                <div class="tab-pane active" id="tab_1" style="padding: 3%">
                    <div class="btn-group" style="margin-bottom: 3%">
                      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalList"><i class="fa fa-list"></i>  View Fee List</button>
                    </div>
                    <div class="btn-group" style="margin-bottom: 3%">
                      <button type="button" class="btn btn-info" data-toggle="modal" data-target="#addModalOne"><i class="fa fa-plus"></i>Add</button>
                    </div>


                   <!-- Fee List Modal -->
                  <div class="modal fade" id="modalList" role="dialog">
                    <div class="modal-dialog">
                      <div class="modal-content" style="width: 150%;">
                          <div class="modal-header">
                            <h4 class="modal-title" id="modalList"> LIST OF FEES </h4>
                          </div>

                          <div class="modal-body">

                            <table id="datatable" class="table table-bordered table-striped">
                                  <thead>
                                  <tr>
                                    <th>Fee Code</th>
                                    <th>Fee Name</th>
                                    <th>Level Name</th>
                                    <th>Fee Type</th>
                                    <th>Fee Amount</th>
                                  </tr>
                                  </thead>
                                  <tbody>
                                      <?php
                                      $query="select f.tblFeeCode, f.tblFeeName, f.tblFeeType, l.tblLevelName, fa.tblFeeAmountAmount from tblfee f, tbllevel l, tblfeeamount fa where fa.tblFeeAmount_tblFeeId=f.tblFeeId and fa.tblFeeAmount_tblLevelId=l.tblLevelId and f.tblFeeFlag=1";
                                      $result=mysqli_query($con, $query);
                                      while($row=mysqli_fetch_array($result)):
                                      ?>
                                      <tr>
                                      <td><?php echo $row['tblFeeCode'] ?></td>
                                      <td><?php echo $row['tblFeeName'] ?></td>
                                      <td><?php echo $row['tblLevelName'] ?></td>
                                      <td><?php echo $row['tblFeeType'] ?></td>
                                      <td><?php echo $row['tblFeeAmountAmount'] ?></td>
                                      </tr>
                                    <?php endwhile; ?>
                                  </tbody>
                            </table>

                            <div class="modal-footer" style="margin-top: 7%">
                              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                          </div>
                        </div>
                      </div>
                  </div>

                  <!-- Add Modal -->
                  <div class="modal fade" id="addModalOne" role="dialog">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <form autocomplete="off" id = "addFee" name="addFee" role="form" method="POST" action="saveFee.php" class="form-horizontal">
                          <div class="modal-header">
                            <h4 class="modal-title" id="addModalFour"> ADD FEE </h4>
                          </div>

                          <div class="modal-body">

                            <div class="form-group" style="margin-top:5%">
                              <b><label class="col-sm-4 control-label"> Fee Code </label></b>
                              <div class="col-sm-6 selectContainer">
                                <div class="input-group" style="width:100%;">
                                  <input type="text" class="form-control" name="txtAddFeeCode" id="txtAddFeeCode" style="text-transform:uppercase ;">

                                </div>
                              </div>
                            </div>
                            <div class="form-group" style="margin-top:6%">
                              <b><label class="col-sm-4 control-label"> Fee Name </label></b>
                              <div class="col-sm-6 selectContainer">
                                <div class="input-group" style="width:100%;">
                                  <input type="text" class="form-control" name="txtAddFeeName" id="txtAddFeeName" style="text-transform:uppercase ;">

                                </div>
                              </div>
                            </div>

                            <div class="form-group" style="margin-top:7%">
                              <b><label class="col-sm-4 control-label">Fee Status:</label></b>
                              <div class="col-sm-6 selectContainer">
                                <div class="input-group" style="width:100%;">
                                  <select class="form-control" name="selAddFeeMand" id="selAddFeeMand" style="text-transform:uppercase ;">
                                  <option selected disabled value="">-- Select Fee Status --</option>
                                  <option value='Y'>Mandatory</option>
                                  <option value='N'>Optional</option>
                                  </select>

                                </div>
                              </div>
                            </div>

                            <div class="form-group" style="margin-top:7%">
                              <b><label class="col-sm-4 control-label">Fee Type:</label></b>
                              <div class="col-sm-6 selectContainer">
                                <div class="input-group" style="width:100%;">
                                  <select class="form-control" name="selAddFeeType" id="selAddFeeType" style="text-transform:uppercase ;">
                                  <option selected disabled value="">-- Select Fee Status --</option>
                                  <option value='GENERAL FEE'>GENERAL FEE</option>
                                  <option value='SPECIFIC FEE'>SPECIFIC FEE</option>
                                  </select>

                                </div>
                              </div>
                            </div>

                            <div class="modal-footer" style="margin-top: 7%">
                              <button type="submit" class="btn btn-info">Save</button>
                              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>

                  <!-- Update Modal -->
                  <div class="modal fade" id="updateModalOne" role="dialog">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <form autocomplete="off" id = "UpdFee" name="UpdFee" role="form" method="POST" action="updateFee.php" class="form-horizontal">
                          <div class="modal-header">
                            <h4 class="modal-title" id="updateModalOne"> UPDATE FEE NAME </h4>
                          </div>

                          <div class="modal-body">
                            <div class="form-group" style="display: none;">
                              <label class="col-sm-4 control-label">Fee ID</label>
                              <div class="col-sm-6">
                                <div class = "input-group">
                                  <span class="input-group-addon"><i class="fa fa-list" aria-hidden="true"></i></span>
                                  <input type="text" class="form-control" name="txtUpdFeeId" id="txtUpdFeeId" readonly="">
                                </div>
                              </div>
                            </div>

                            <div class="form-group" style="margin-top:7%">
                              <b><label class="col-sm-4 control-label"> Fee Code </label></b>
                              <div class="col-sm-6 selectContainer">
                                <div class="input-group" style="width:100%;">
                                  <input type="text" class="form-control" name="txtUpdFeeCode" id="txtUpdFeeCode" style="text-transform:uppercase ;" disabled>
                                </div>
                              </div>
                            </div>

                            <div class="form-group" style="margin-top:7%">
                              <b><label class="col-sm-4 control-label"> Fee Name </label></b>
                              <div class="col-sm-6 selectContainer">
                                <div class="input-group" style="width:100%;">
                                  <input type="text" class="form-control" name="txtUpdFee" id="txtUpdFee" style="text-transform:uppercase ;">
                                </div>
                              </div>
                            </div>

                            <div class="form-group" style="margin-top:7%">
                              <b><label class="col-sm-4 control-label">Fee Status:</label></b>
                              <div class="col-sm-6 selectContainer">
                                <div class="input-group" style="width:100%;">
                                  <select class="form-control" name="selUpdFeeMand" id="selUpdFeeMand" style="text-transform:uppercase ;">
                                  <option selected disabled>--Select Fee Status--</option>
                                  <option value='Mandatory'>Mandatory</option>
                                  <option value='Optional'>Optional</option>
                                  </select>

                                </div>
                              </div>
                            </div>

                            <div class="form-group" style="margin-top:7%">
                              <b><label class="col-sm-4 control-label">Fee Type:</label></b>
                              <div class="col-sm-6 selectContainer">
                                <div class="input-group" style="width:100%;">
                                  <select class="form-control" name="selUpdFeeType" id="selUpdFeeType" style="text-transform:uppercase ;">
                                  <option selected disabled>--Select Fee Status--</option>
                                  <option value='GENERAL FEE'>GENERAL FEE</option>
                                  <option value='SPECIFIC FEE'>SPECIFIC FEE</option>
                                  </select>

                                </div>
                              </div>
                            </div>

                            <div class="modal-footer" style="margin-top: 7%">
                              <button type="submit" class="btn btn-info" name="btnUpdFee" id="btnUpdFee">Save</button>
                              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>

                  <!-- Delete Modal -->
                  <div class="modal fade" id="deleteModalOne" role="dialog">
                    <div class="modal-dialog">

                      <!-- Modal content-->
                      <div class="modal-content">
                        <form method="POST" action="deleteFee.php" class="form-horizontal">
                          <div class="modal-header">
                            <h4 class="modal-title" id="deleteModalOne"> DELETE FEE </h4>
                          </div>

                          <div class="modal-body">
                            <div class="form-group" style="display: none">
                              <label class="col-sm-4 control-label">Fee ID</label>
                              <div class="col-sm-5 input-group">
                                <span class="input-group-addon"><i class="fa fa-list" aria-hidden="true"></i></span>
                                <input type="text" name="txtDelFee" id="txtDelFee" readonly="" />
                              </div>
                            </div>

                            <div class="form-group">
                              <h4 align="center" style="margin-top: 5%">Are you sure you want to delete this record?</h4>
                            </div>
                          </div>

                          <div class="modal-footer" style="margin-top: 5%; float: center">
                            <button type="submit" class="btn btn-danger" name="btnDelFee" id="btnDelFee">Delete</button>
                            <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                 <!--modal delete end-->

                  <table id="datatable3" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th hidden>Fee Id</th>
                      <th hidden>Level Id</th>
                      <th>Fee Code</th>
                      <th>Fee Name</th>
                      <th>Fee Type</th>
                      <th>Fee Status</th>
                      <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                     <?php
                     $query = "select distinct(tblFeeCode), tblFeeName, tblFeeId, tblFeeType, tblFeeMandatory from tblfee where tblFeeFlag=1";
                      $result = mysqli_query($con, $query);
                      while($row = mysqli_fetch_array($result)):
                        $type=$row['tblFeeType'];
                        $stat=$row['tblFeeMandatory'];
                        if($stat=='Y')
                        {
                            $stat1='Mandatory';
                        }else if($stat=='N')
                        {
                            $stat1='Optional';
                        }
                      ?>
                      <tr>
                      <td hidden><?php echo $row['tblFeeId'] ?></td>
                      <td hidden></td>
                      <td><?php echo $row['tblFeeCode'] ?></td>
                      <td><?php echo $row['tblFeeName'] ?></td>
                      <td><?php echo $row['tblFeeType'] ?></td>
                      <td><?php echo $stat1 ?></td>
                      <td><button type="button" class="btn btn-success" data-toggle="modal" data-target="#updateModalOne"><i class="fa fa-edit"></i></button>
                      <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModalOne"><i class="fa fa-trash"></i></button>

                      <a href = "feedetails.php"><form method="post" action="feedetails.php">
                      <input type="hidden" name="txtFdFeeId" id="txtFdFeeId" value="<?php echo $row['tblFeeId'] ?>"/>
                      <input type="hidden" name="txtFdFeeType" id="txtFdFeeType" value="<?php echo $row['tblFeeType'] ?>"/>
                      <button type="submit" class="btn btn-success" name="btnFeeDetails" id="btnFeeDetails" style="margin-top: 4px;"><i class="fa fa-edit"></i>Fee Details</button>
                      </form></a>
                      </td>
                      </tr>
                    <?php endwhile; ?>
                    </tbody>
                  </table>

              </div>
              <!-- /.tab-pane -->

        <div class="tab-pane" id="tab_2" style="padding: 3%">
             <div class="btn-group" style="margin-bottom: 3%; margin-top: 1%">
                  <button type="button" class="btn btn-info" data-toggle="modal" data-target="#addModalTwo"><i class="fa fa-plus"></i>Add</button>
             </div>

            <!-- Add Modal -->
            <div class="modal fade" id="addModalTwo" role="dialog">
              <div class="modal-dialog">
                <div class="modal-content">
                  <form autocomplete="off" id = "addScheme" name="addScheme" role="form" method="POST" action="saveScheme.php" class="form-horizontal">
                    <div class="modal-header">
                      <h4 class="modal-title" id="addModalTwo"> ADD PAYMENT SCHEME </h4>
                    </div>

                    <div class="modal-body">

                      <div class="form-group" style="margin-top: 7%;">
                        <label class="col-sm-4 control-label"> Payment Scheme </label>
                        <div class="col-sm-6 selectContainer">
                          <div class="input-group">
                            <div class="input-group-addon">
                              <i class="fa fa-clone" aria-hidden="true"></i>
                            </div>
                            <select class="form-control choose" style="width: 100%;" name="selAddSchemeFee" id="selAddSchemeFee">
                              <option selected="selected" value="-1">--Select Fee--</option>
                              <?php
                                $query = "select distinct tblFeeName, tblFeeMandatory from tblfee where tblFeeFlag = 1";
                                $result = mysqli_query($con, $query);
                                while($row = mysqli_fetch_array($result))
                                {
                              ?>
                              <option value="<?php echo $row['tblFeeName'] ?>" data-feemandatory="<?php echo $row['tblFeeMandatory'] ?>"><?php echo $row['tblFeeName'] ?></option>
                              <?php } ?>
                            </select>
                          </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <b><label class="col-sm-4 control-label"> Scheme Name </label></b>
                        <div class="col-sm-6 selectContainer">
                          <div class="input-group" style="width:100%;">
                              <input type="text" class="form-control" name="txtAddScheme" id="txtAddScheme" style="text-transform:uppercase;">
                          </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <b><label class="col-sm-4 control-label"> No. of Payments </label></b>
                        <div class="col-sm-6 selectContainer">
                          <div class="input-group" style="width:100%;">
                            <input class="rem" type="number" value="1" min="1" max="31" name="txtAddSchemeNo" id="txtAddSchemeNo">
                          </div>
                        </div>
                      </div>

                      <div class="modal-footer" style="margin-top: 7%">
                        <button type="submit" class="btn btn-info">Save</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <!-- Update Modal -->
            <div class="modal fade" id="updateModalTwo" role="dialog">
              <div class="modal-dialog">
                <div class="modal-content">
                  <form autocomplete="off" id = "UpdScheme" name="UpdScheme" role="form" method="POST" action="updateScheme.php" class="form-horizontal">
                    <div class="modal-header">
                      <h4 class="modal-title" id="updateModalTwo"> UPDATE PAYMENT SCHEME </h4>
                    </div>

                    <div class="modal-body">
                      <div class="form-group" style="display: none;">
                        <label class="col-sm-4 control-label">Scheme ID</label>
                        <div class="col-sm-6">
                          <div class = "input-group">
                            <span class="input-group-addon"><i class="fa fa-list" aria-hidden="true"></i></span>
                            <input type="text" name="txtUpdSchemeId" id="txtUpdSchemeId" readonly="" />
                          </div>
                        </div>
                      </div>

                      <div class="form-group" style="margin-top:7%">
                        <label class="col-sm-4 control-label"> Fee </label>
                        <div class="col-sm-6 selectContainer">
                          <div class="input-group">
                            <div class="input-group-addon">
                              <i class="fa fa-clone" aria-hidden="true"></i>
                            </div>
                            <input type="text" class="form-control" name="txtUpdFeeName" id="txtUpdFeeName" disabled>
                          </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <b><label class="col-sm-4 control-label"> Scheme Name </label></b>
                        <div class="col-sm-6 selectContainer">
                          <div class="input-group" style="width:100%;">
                            <input type="text" class="form-control" name="txtUpdScheme" id="txtUpdScheme" style="text-transform:uppercase;">
                          </div>
                        </div>
                      </div>

                      <div class="form-group" >
                        <b><label class="col-sm-4 control-label"> No. of Payment </label></b>
                        <div class="col-sm-6 selectContainer">
                          <div class="input-group" style="width:100%;">
                            <input class="rem" type="number" min="1" max="31" name="txtUpdSchemeNo" id="txtUpdSchemeNo">
                          </div>
                        </div>
                      </div>

                      <div class="modal-footer" style="margin-top: 7%">
                        <button type="submit" class="btn btn-info" name="btnUpdScheme" id="btnUpdScheme">Save</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <!-- Delete Modal -->
            <div class="modal fade" id="deleteModalTwo" role="dialog">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                  <form method="POST" action="deleteScheme.php" class="form-horizontal">
                    <div class="modal-header">
                      <h4 class="modal-title" id="deleteModalTwo"> DELETE PAYMENT SCHEME </h4>
                    </div>

                    <div class="modal-body">
                      <div class="form-group" style="display: none;">
                        <label class="col-sm-4 control-label">Scheme ID</label>
                        <div class="col-sm-5 input-group">
                          <span class="input-group-addon"><i class="fa fa-list" aria-hidden="true"></i></span>
                          <input type="text" name="txtDelScheme" id="txtDelScheme" readonly="" />
                        </div>
                      </div>

                      <div class="form-group">
                        <h4 align="center" style="margin-top: 5%">Are you sure you want to delete this record?</h4>
                      </div>
                    </div>

                    <div class="modal-footer" style="margin-top: 5%; float: center">
                      <button type="submit" class="btn btn-danger" name="btnDelScheme" id="btnDelScheme">Delete</button>
                      <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <!--modal delete end-->


            <table id="datatable1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th hidden>Scheme Id</th>
                <th>Fee</th>
                <th>Scheme</th>
                <th>No. of Payments</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
              <?php
              $query = "select s.tblSchemeId, f.tblFeeName, s.tblSchemeType, s.tblSchemeNoOfPayment from tblscheme s, tblfee f where s.tblScheme_tblFeeId = f.tblFeeId and f.tblFeeFlag = 1 and s.tblSchemeFlag=1";
              $result = mysqli_query($con, $query);
              while($row = mysqli_fetch_array($result))
              {
              ?>
              <tr>
                <td hidden><?php echo $row['tblSchemeId'] ?></td>
                <td><?php echo $row['tblFeeName'] ?></td>
                <td><?php echo $row['tblSchemeType'] ?></td>
                <td><?php echo $row['tblSchemeNoOfPayment'] ?></td>
                 <td>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#updateModalTwo"><i class="fa fa-edit"></i></button>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModalTwo"><i class="fa fa-trash"></i></button>
                 </td>
              </tr>
              <?php } ?>
              </tbody>
            </table>

        </div>
        <!-- /.tab-pane -->


        <div class="tab-pane" id="tab_3" style="padding: 3%">
          <div class="form-inline">
            <div class="container" style="margin-bottom: 15px">
                  <label class="col-sm-1">Fee Type: </label>

                        <input type="radio" name="chkPSchedStat" id="chkPSchedStat1" value="GENERAL FEE" onclick="changeTblMass()">  GENERAL FEE
                        <input type="radio" name="chkPSchedStat" id="chkPSchedStat" value="SPECIFIC FEE" onclick="enable()" style="margin-left: 10px;">  SPECIFIC FEE
              </div>
          </div>

          <div class="form-inline">
            <div class="container">
              <label class="col-sm-1">Level: </label>
                    <select class="form-control" style="width: 30%; margin-bottom: 1%" name="selSchedLvl" id="selSchedLvl" onchange="changeSchedSchemeLvl()" disabled>
                      <option>--Select Here--</option>
                    <?php
                    $query="select * from tbllevel where tblLevelFlag=1";
                    $result=mysqli_query($con, $query);
                    while($row=mysqli_fetch_array($result))
                    {
                    ?>
                    <option value="<?php echo $row['tblLevelId']; ?>"><?php echo $row['tblLevelName'] ?></option>
                    <?php } ?>
                    </select>
              </div>
          </div>

          <div class="form-inline">
            <div class="container">
                <label class="col-sm-1">Fee: </label>
                <select class="form-control" style="width: 30%; margin-bottom: 1%" name="selSchedFee" id="selSchedFee" onchange="changeFee()" disabled>
                  <option>--Select Here--</option>
                  <?php
                    $query = "select tblFeeId, tblFeeName from tblfee where tblFeeFlag = 1 and tblFeeType='SPECIFIC FEE'";
                    $result = mysqli_query($con, $query);
                    while($row = mysqli_fetch_array($result))
                    {
                  ?>
                  <option value="<?php echo $row['tblFeeId'] ?>"><?php echo $row['tblFeeName'] ?></option>
                  <?php } ?>
                </select>
            </div>
          </div>

          <div class="form-inline">
            <div class="container">
                      <label class="col-sm-1">Scheme: </label>
                      <select class="form-control" style="width: 30%; margin-bottom: 1%" disabled name="selSchedScheme" id="selSchedScheme" onchange="changeTblSchedScheme()">
                        <option>--Select Here--</option>
                      </select>
            </div>
          </div>

          <!-- Update Modal -->
          <div class="modal fade" id="updateModalThree" role="dialog">
            <div class="modal-dialog">
              <div class="modal-content">
                <form autocomplete="off" data-toggle="validator" method="post" action="updateSchemeDetail.php" name="UpdSchemeDetail" id="UpdSchemeDetail" class="form-horizontal">
                  <div class="modal-header">
                      <h4 class="modal-title" id="myModalLabel"> UPDATE SCHEDULE </h4>
                  </div>

                  <div class="modal-body">

                    <div class="form-group" style="display: none;">
                      <label class="col-sm-4 control-label">Payment Scheme ID</label>
                      <div class="col-sm-6">
                        <div class = "input-group">
                          <span class="input-group-addon"><i class="fa fa-list" aria-hidden="true"></i></span>
                          <input type="text" class="form-control" name="txtDetId" id="txtDetId" readonly="" />
                        </div>
                      </div>
                    </div>

                    <div class="form-group" style="margin-top: 7%;">
                      <label class="col-sm-4 control-label" style="text-align: right">Payment Order</label>
                      <div class="col-sm-6 selectContainer">
                        <div class = "input-group" style="width:100%;">
                          <input type="text" class="form-control" readonly name="txtDetNo" id="txtDetNo">
                        </div>
                      </div>
                    </div>

                    <div class="form-group" style="margin-top: 7%;">
                      <label class="col-sm-4 control-label" for="textinput">Due Date</label>
                      <div class="col-sm-6 selectContainer">
                        <div class = "input-group" style="width:100%;">
                          <input type="text" class="form-control" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask name="txtDetDueDate" id="txtDetDueDate">
                        </div>
                      </div>
                    </div>

                    <div class="form-group" style="margin-top: 7%;">
                      <label class="col-sm-4 control-label" for="textinput">Amount on Due Date</label>
                      <div class="col-sm-6 selectContainer">
                        <div class = "input-group" style="width:100%;">
                          <input type="text" class="form-control" name="txtDetAmount" id="txtDetAmount">
                        </div>
                      </div>
                    </div>

                    <div class="modal-footer" style="margin-top: 7%">
                      <button type="submit" class="btn btn-info"  name="btnDetSave" id="btnDetSave">Save</button>
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <div class="modal fade" id="mdlUpdateSched" role="dialog">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title" style="font-style: bold">Update Schedule</h3>
                  </div>
                  <form method="post" action="updateSchemeDetail.php">
                  <div class="modal-body">
                  <input type="hidden" class="form-control" name="txtDetId" id="txtDetId1">
                  <input type="hidden" class="form-control" name="txtFeeIdUpdateSched" id="txtFeeIdUpdateSched">
                  <div class="form-group" style="margin-top: 5%">
                          <label class="col-sm-4" style="text-align: right">Payment Order</label>
                          <div class="col-sm-7">
                          <input type="text" class="form-control" readonly name="txtDetNo" id="txtDetNo1">
                          </div>
                  </div>
                  <div class="form-group"  style="margin-top: 15%">

                      <label class="col-sm-4 control-label" for="textinput" style="text-align: right">Due Date</label>
                      <div class="col-sm-7">
                        <input type="text" class="form-control" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask name="txtDetDueDate" id="txtDetDueDate1">
                      </div>
                  </div>
                  <div class="form-group"  style="margin-top: 25%">

                      <label class="col-sm-4 control-label" for="textinput" style="text-align: right">Amount on Due Date</label>
                      <div class="col-sm-7">
                        <input type="text" class="form-control" name="txtDetAmount" id="txtDetAmount1">
                      </div>
                  </div>
                  </div>
                  <div class="modal-footer" style="margin-top: 10%">
                  <button type="submit" class="btn btn-info"  name="btnDetSave1" id="btnDetSave1">Save</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                  </div>
                  </form>
                </div>

              </div>
          </div>


          <!-- Delete Modal -->
          <div class="modal fade" id="deleteModalThree" role="dialog">
            <div class="modal-dialog">

              <!-- Modal content-->
              <div class="modal-content">
                <form method="POST" action="deleteSchemeDetail.php" class="form-horizontal">
                  <div class="modal-header">
                    <h4 class="modal-title" id="deleteModalOne"> RESET </h4>
                  </div>

                  <div class="modal-body">
                    <div class="form-group" style="display: none;">
                      <label class="col-sm-4 control-label">Payment Sched ID</label>
                      <div class="col-sm-5 input-group">
                        <span class="input-group-addon"><i class="fa fa-list" aria-hidden="true"></i></span>
                        <input type="hidden" class="form-control" name="txtDetDelId" id="txtDetDelId" readonly =""/>
                      </div>
                    </div>

                    <div class="form-group">
                      <h4 align="center" style="margin-top: 5%">Are you sure you want to reset fields?</h4>
                    </div>
                  </div>

                  <div class="modal-footer" style="margin-top: 5%; float: center">
                    <button type="submit" class="btn btn-danger" name="btnReset" id="bnReset">Reset</button>
                      <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <!--modal delete end-->


          <table id="datatable2" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>Payment</th>
              <th>Due Date</th>
              <th>Amount on Due Date</th>
              <th>Action</th>
            </tr>
            </thead>
          </table>

      </div>
      <!-- /.tab-pane -->


            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->
          </div>
          <!-- box body -->
         </div>
         <!-- box box-default -->
        </div>
        <!-- col-md-12 -->
      </div>
      <!-- row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

 <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2017
    </div>
    <strong>Copyright &copy; 2017 <a href="http://www.kiddoacademy.com/">Kiddo Academy and Development Center</a>.</strong> All rights
    reserved.
  </footer>


<!-- DataTables -->
<script>
  $(function () {
    //Add text editor
    $("#compose-textarea").wysihtml5();
  $(".choose").select2();
  });
</script>

  <!-- jQuery 2.2.3 -->
  <script src="js/jQuery/jquery-2.2.3.min.js"></script>
  <!-- Bootstrap 3.3.6 -->
  <script src="js/js/bootstrap.min.js"></script>
  <!-- FastClick -->
  <script src="js/fastclick/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="js/distjs/app.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="js/distjs/demo.js"></script>
  <!-- Bootstrap WYSIHTML5 -->
  <script src="js/bootstrap3-wysihtml5.all.min.js"></script>
  <!-- Sweetalert -->
  <script src="js/sweetalert.min.js"></script>
  <!-- Bootstrap validator -->
  <script src="js/bootstrapValidator.min.js"></script>
  <!-- DataTables -->
  <script src="plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
  <script src="js/select2.full.min.js"></script>
  <!-- InputMask -->
  <script src="js/input-mask/jquery.inputmask.js"></script>
  <script src="js/input-mask/jquery.inputmask.date.extensions.js"></script>
  <script src="js/input-mask/jquery.inputmask.extensions.js"></script>
  <!-- iCheck 1.0.1 -->
  <script src="js/icheck.min.js"></script>
  <!-- Du no what is this for -->
  <script type="text/javascript" src="js/formwizard.js"></script>
  <script src="js/selectjs/select2.full.min.js"></script>

<script>
$(document).ready(function(){
$('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
  localStorage.setItem('activeTab', $(e.target).attr('href'));
});
var activeTab = localStorage.getItem('activeTab');
  if(activeTab){
    $('#myTab a[href="' + activeTab + '"]').tab('show');
  }
});
</script>
<!-- DataTables -->
  <script src="js/datatables/jquery.dataTables.min.js"></script>
  <script src="js/datatables/dataTables.bootstrap.min.js"></script>
  <script>
  $(function () {
    $("#datatable").DataTable();
    $("#datatable1").DataTable();
    $("#datatable2").DataTable();
    $("#datatable3").DataTable();
    $("#tblReq").DataTable();
    $("#tblGrading").DataTable();
  });

  //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass: 'iradio_minimal-red'
    });
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });
</script>

  <script>
    $(function () {
      $("#datatable").DataTable();
      $("#datatable1").DataTable();
      $("#datatable2").DataTable();
      $("#datatable3").DataTable();
    });

  </script>

  <script src='http://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.4.5/js/bootstrapvalidator.min.js'></script>

  <script type="text/javascript">
    $(document).ready(function() {
    $('#addFee').bootstrapValidator({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            txtAddFeeCode: {
                validators: {
                    stringLength: {
                        min: 3,
                        message: 'Please enter at least 3 characters'
                    },
                       regexp: {
                        regexp: /^[a-zA-Z_\w-][0-9a-zA-Z_\w-\s][\w-'\s]+$/,
                        message: 'The first character must be an alphabet or does not allow special character'
                    },
                        notEmpty: {
                        message: 'Fee name is required'
                    }
                }
            },
            txtAddFeeName: {
                validators: {
                    stringLength: {
                        min: 3,
                        message: 'Please enter at least 3 characters'
                    },
                       regexp: {
                        regexp: /^[a-zA-Z_\w-][0-9a-zA-Z_\w-\s][\w-'\s]+$/,
                        message: 'The first character must be an alphabet or does not allow special character'
                    },
                        notEmpty: {
                        message: 'Fee name is required'
                    }
                }
            },
            selAddFeeMand: {
                validators: {
                  notEmpty: {
                      message: 'Division is required.'
                  },
                }
            },
            selAddFeeType: {
                validators: {
                  notEmpty: {
                      message: 'Division is required.'
                  },
                }
            }
          }
        })
         .on('success.form.bv', function (e) {
        // Prevent form submission
        //e.preventDefault();
    });

    $('#addModalOne')
       .on('shown.bs.modal', function () {
           $('#addFee').find().focus();
        })
        .on('hidden.bs.modal', function () {
            $('#addFee').bootstrapValidator('resetForm', true);
        });

  $('#UpdFee').bootstrapValidator({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            txtUpdFee: {
                validators: {
                    stringLength: {
                        min: 3,
                        max: 20,
                        message: 'Please enter at least 3 characters'
                    },

                    regexp: {
                        regexp: /^[a-zA-Z_\w-][0-9a-zA-Z_\w-\s][\w-'\s]+$/,
                        message: 'The first character must be an alphabet or does not allow special character'
                    },
                        notEmpty: {
                        message: 'Curriculum name is required'
                    }
                }
            },
            }
        })

     .on('success.form.bv', function (e) {
        // Prevent form submission
        //e.preventDefault();
    });

    $('#updateModalOne')
       .on('shown.bs.modal', function () {
           $('#UpdFee').find().focus();
        })
        .on('hidden.bs.modal', function () {
            $('#UpdFee').bootstrapValidator('resetForm', true);
        });

    // <!--   Payment Scheme   -->
    $('#addScheme').bootstrapValidator({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            selAddSchemeFee: {
                validators: {
                  notEmpty: {
                      message: 'Payment Scheme is required.'
                  },
                }
            },
            txtAddScheme: {
                validators: {
                    stringLength: {
                        min: 3,
                        max: 20,
                        message: 'Please enter at least 3 characters'
                    },
                       regexp: {
                        regexp: /^[a-zA-Z_\w-][0-9a-zA-Z_\w-\s][\w-'\s]+$/,
                        message: 'The first character must be an alphabet or does not allow special character'
                    },
                        notEmpty: {
                        message: 'Scheme name is required'
                    }
                }
            },
            txtAddSchemeNo: {
                validators: {
                  notEmpty: {
                      message: 'No. of payments is required.'
                  },
                }
            },
          }
        })
         .on('success.form.bv', function (e) {
        // Prevent form submission
        //e.preventDefault();
    });

    $('#addModalTwo')
       .on('shown.bs.modal', function () {
           $('#addScheme').find().focus();
        })
        .on('hidden.bs.modal', function () {
            $('#addScheme').bootstrapValidator('resetForm', true);
        });

    $('#UpdScheme').bootstrapValidator({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            txtUpdScheme: {
                validators: {
                    stringLength: {
                        min: 3,
                        max: 20,
                        message: 'Please enter at least 3 characters'
                    },
                       regexp: {
                        regexp: /^[a-zA-Z_\w-][0-9a-zA-Z_\w-\s][\w-'\s]+$/,
                        message: 'The first character must be an alphabet or does not allow special character'
                    },
                        notEmpty: {
                        message: 'Scheme name is required'
                    }
                }
            },
            txtUpdSchemeNo: {
                validators: {
                  notEmpty: {
                      message: 'No. of payments is required.'
                  },
                }
            },
          }
        })
         .on('success.form.bv', function (e) {
        // Prevent form submission
        //e.preventDefault();
    });

    $('#updateModalTwo')
       .on('shown.bs.modal', function () {
           $('#UpdScheme').find().focus();
        })
        .on('hidden.bs.modal', function () {
            $('#UpdScheme').bootstrapValidator('resetForm', true);
        });
    $('#selAddSchemeFee').attr('prev', $('#selAddSchemeFee').val());
    $('#selAddSchemeFee').on('change', function() {
        var feemandatory = $('option:selected', this).attr('data-feemandatory');
        if(feemandatory == 'N') {
          //not mandatory
            $('#txtAddScheme').val('NO SCHEME').addClass('c-readonly');
        } else {
          //mandatory
           $('#txtAddScheme').val('').removeClass('c-readonly');
        }
          setTimeout(function() {
            $('#addScheme').bootstrapValidator('revalidate','txtAddScheme');
        }, 500);
      $('#selAddSchemeFee').attr('prev', $('#selAddSchemeFee').val());
        
    });

    $('.input-group').on('keydown', '.c-readonly' ,function(e) {
        e.preventDefault();
        console.log('testing');
    });

    $('#datatable2').on('click', 'td button.btnUpdateSched', function(){
        var feeid = $(this).parent().siblings('.feecode-cell').data('feeid');
        var nodetails = $(this).parent().siblings('.feecode-cell').data('nodetails');
        $('#txtFeeIdUpdateSched').val(feeid);
        $('#mdlUpdateSched').modal('show');
    });

});
  </script>

</body>
</html>
