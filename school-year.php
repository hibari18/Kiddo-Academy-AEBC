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
?><!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AEBC</title>
  <link rel="icon" type="image/gif" href=""/>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="css/select2.min.css">
  <!-- sweetalert -->
  <script src="sweetalert-master/dist/sweetalert-dev.js"></script>
  <link rel="stylesheet" href="sweetalert-master/dist/sweetalert.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]--> 

  <link rel="stylesheet" type="text/css" href="css/validDesignSchoolYr.css">
  <link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">
    <style>
      body {
        font-family: 'Noto Sans', sans-serif;
        font-weight: bold;
      }
    </style>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

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
  function fn1()
    {
    var stat = document.getElementById("selUpdSyAct").value;
    if(stat != "INACTIVE")
    {
      var popup = document.getElementById("pop");
      popup.classList.toggle("show");
    }
  }
  (function(){
  if(window.addEventListener){
    window.addEventListener('load',run,false);
  }else if(window.attachEvent){
    window.attachEvent('onload',run);
  }
function run(){
  var t=document.getElementById('datatable');
  t.onclick=function(event){
    event=event || window.event;
    var target=event.target||event.srcElement;
    while (target&&target.nodeName!='TR'){
      target=target.parentElement;
    }
    var cells=target.cells;
    
    if(!cells.length||target.parentNode.nodeName=='THEAD'){return;}
    var f1=document.getElementById('txtUpdSyId');
    var f2=document.getElementById('txtUpdSyCurrId');
    var f3=document.getElementById('txtUpdSyName');
    var f4=document.getElementById('txtUpdSyYear');
    var f5=document.getElementById('selUpdSyCurr');
    var f6=document.getElementById('selUpdSyAct');
    var f7=document.getElementById('txtDelSyId');
    /*var f8=document.getElementById('temp');*/
    f1.value=cells[0].innerHTML;
    f2.value=cells[1].innerHTML;
    f3.value=cells[3].innerHTML;
    f4.value=cells[2].innerHTML;
    f5.value=cells[4].innerHTML;
    f6.value=cells[5].innerHTML;
    f7.value=cells[0].innerHTML;
    /*f8.value=cells[5].innerHTML;*/
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
    var f1=document.getElementById('NumClassId');
    var f2=document.getElementById('updNumMonth');
    var f3=document.getElementById('updNumDay');
    f1.value=cells[0].innerHTML;
    f2.value=cells[1].innerHTML;
    f3.value=cells[2].innerHTML;
  };
}})();
$(function(){
  $('input[class=form-group]').change(function(){
    $('input[name=updNumMonth]').attr('disabled', 'disabled');
});

  });
function showTblMonth()
{
  var xmlhttp =  new XMLHttpRequest();
  xmlhttp.open("GET","showTblMonth.php?getSySelect="+document.getElementById("getSySelect").value,false);
  xmlhttp.send(null);
    
  document.getElementById("datatable1").innerHTML=xmlhttp.responseText;
}
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
      echo "<script> swal('Record cannot be deleted. School year is active', ' ', 'info'); </script>";
    }
  ?>

<div class="wrapper">

  <header class="main-header">
        <!-- Logo -->
        <a href="dashboard.php" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><image src="" style="width: 50px; padding: 3px"></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><image src="" style="width: 200px; padding: 3px;"></span>
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
                      <!--<?php echo $namess ?>-->
                      <small><?php echo $rolename ?></small>
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <!--<div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat">Profile</a>
                    </div>-->
                    <div class="pull-right">
                      <a href="logout.php" class="btn btn-default btn-flat">Logout</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
          
          
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


    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-default"  style="margin-top: 25px">
            <!-- /.box-header -->
        <div class="box-body">
          <div class="box-header with-border">
            <h2 class="box-title" style="font-size:25px; margin-top: 10px">SCHOOL YEAR</h2>
          </div>

              <div class="box-body"  style="margin-top: 3%">
                    <div class="btn-group" style="margin-bottom: 3%">
                      <button type="button" class="btn btn-info" data-toggle="modal" data-target="#addModalOne"><i class="fa fa-plus"></i>Add</button>
                    </div>

              
              <table id="datatable" name="datatable" class="table table-bordered table-striped">
                <thead>
                 <?php
                    $query = "select s.tblSchoolYrId, s.tblSchoolYrYear, s.tblSchoolYrActive, s.tblSchoolYr_tblCurriculumId, s.tblSchoolYrStart, c.tblCurriculumName FROM tblschoolyear s, tblcurriculum c WHERE s.tblSchoolYr_tblCurriculumId = c.tblCurriculumId and s.tblSchoolYearFlag=1 group by s.tblSchoolYrYear asc";
                    $result = mysqli_query($con, $query);
                  ?>
                <tr>
                  <th hidden></th>
                  <th hidden>Curriculum Id</th>
                  <th>Start of Year</th>
                  <th>School Year</th>
                  <th>Curriculum Name</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    while($row = mysqli_fetch_array($result))
                    {
                    ?>
                    <tr>
                    <td hidden><?php echo $row['tblSchoolYrId'] ?></td>
                    <td hidden><?php echo $row['tblSchoolYr_tblCurriculum'] ?></td>
                    <td style="width: 100px"><?php echo $row['tblSchoolYrStart'] ?></td>
                    <td style="width: 100px"><?php echo$row['tblSchoolYrYear'] ?></td>
                    <td style="width: 100px"><?php echo$row['tblCurriculumName'] ?></td>
                    <td style="width: 100px"><?php echo $row['tblSchoolYrActive'] ?></td>
                    <td style="width: 50px">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#updateModalOne"><i class="fa fa-edit"></i></button>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModalOne"><i class="fa fa-trash"></i></button></td>
                    </tr>
                   <?php } ?>
                </tbody>
              </table>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.tab-pane -->

  <!-- Modal starts here-->
  <div class="modal fade" id="addModalOne" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title" style="font-style: bold">Add School Year</h3>
        </div>
        <form data-toggle="validator" role="form" method="post" action="actionSchoolYear.php" name="addSchoolYr" id="addSchoolYr">
        <div class="modal-body inline">
         
        <div class="form-group">
                <label class="col-sm-4" style="text-align: right">Start of school year</label>
                <div class="col-sm-7 selectContainer">
                <div class="input-group" style="width: 100%">
                <input type="text" class="form-control" id="txtAddSy" name="txtAddSy" maxlength="4"  style="margin-bottom: 20px">
                </div>
                </div>
        </div> 
        <div class="form-group">
          <label class="col-sm-4" style="text-align: right">Curriculum</label>
            <div class="col-sm-7 selectContainer">
              <div class="input-group" style="width: 100%; margin-bottom: 15px">
                <select class="form-control choose" name="selAddSyCurr" id="selAddSyCurr" >
                  <option disabled="disabled" selected="selected">--SELECT CURRICULUM--</option>
                  <?php
                  $query = "select tblCurriculumId, tblCurriculumName from tblcurriculum where tblCurriculumFlag=1";
                  $result = mysqli_query($con, $query);
                  while($row = mysqli_fetch_array($result))
                  {
                  ?>
                  <option value="<?php echo $row['tblCurriculumId'] ?>"><?php echo $row['tblCurriculumName'] ?></option>
                  <?php } ?>
                </select>
            </div>
          </div>
        </div>        
        </div>
        <div class="modal-footer" style="margin-top: 20%">
        <button type="submit" class="btn btn-info" name="btnAddSy" id="btnAddSy">Save</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        </form>
      </div>
      
    </div>
  </div>
  <div class="modal fade" id="updateModalOne" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title" style="font-style: bold">Update School Year</h3>
        </div>
        <form data-toggle="validation" role="form" method="post" action="actionSchoolYear.php" name="UpdSchoolYr" id="UpdSchoolYr">
        <div class="modal-body">
        <div class="form-group">
            <div><input type="hidden" id="txtUpdSyId" name="txtUpdSyId">
            <input type="hidden" id="txtUpdSyCurrId" name="txtUpdSyCurrId"></div>   
            <label class="col-sm-4 control-label" for="textinput" style="text-align: right" >School Year</label>
            <div class="col-sm-7 selectContainer">
              <input type="text" placeholder="S.Y." name="txtUpdSyName" id="txtUpdSyName" class="form-control" disabled>
            </div>
        </div>
        <div class="form-group" style="margin-top: 10%">  
            <label class="col-sm-4 control-label" for="textinput" style="text-align: right" >Start of school year</label>
            <div class="col-sm-7 selectContainer">
              <input type="text" name="txtUpdSyYear" id="txtUpdSyYear" class="form-control" maxlength="4">
            </div>
        </div>
        <div class="form-group" style="margin-top: 20%">
                <label class="col-sm-4" style="text-align: right">Curriculum</label>
                <div class="col-sm-7 selectContainer">
                <select class="form-control choose" style="width: 100%;" name="selUpdSyCurr" id="selUpdSyCurr">
                  <option selected="selected">--SELECT CURRICULUM--</option>
                  <?php
                  $query = "select tblCurriculumId, tblCurriculumName from tblcurriculum where tblCurriculumFlag=1";
                  $result = mysqli_query($con, $query);
                  while($row = mysqli_fetch_array($result))
                  {
                  ?>
                  <option value="<?php echo $row['tblCurriculumName'] ?>"><?php echo $row['tblCurriculumName'] ?></option>
                  <?php } ?>
                </select>
                </div>
        </div> 
        <div class="form-group" style="margin-top: 30%">
                <label class="col-sm-4" style="text-align: right">Status</label>
                
                <div class="popup col-sm-7 selectContainer">
                <select class="form-control choose" style="width: 100%;" name="selUpdSyAct" id="selUpdSyAct" onmouseover="fn1()">
                  <option value="selected" selected>--Select--</option>
                  <?php
                  $query ="select distinct tblSchoolYrActive from tblschoolyear where tblSchoolYearFlag = 1";
                  $result = mysqli_query($con, $query);
                  while($row = mysqli_fetch_array($result)){
                  ?>
                  <option value="<?php echo $row['tblSchoolYrActive'] ?>"><?php echo $row['tblSchoolYrActive'] ?></option>
                  <?php } ?>
                </select>
                
                </div>
                
        </div>       
        </div>
        <div class="modal-footer" style="margin-top: 10%">
        <button type="submit" class="btn btn-info" name="btnUpdSy" id="btnUpdSy">Save</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        </form>
      </div>
      
    </div>
  </div>
  <div class="modal fade" id="deleteModalOne" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title" style="font-style: bold">Delete Requirement</h3>
        </div>
        <form action="actionSchoolYear.php" method="post">
        <div class="modal-body">
        <div class="box-body table-responsive no-padding"   style="margin-top: 2%">
              <div><input type="hidden" name="txtDelSyId" id="txtDelSyId"/></div>
        <div>
        <h4 align="center" style="margin-top: 5%">Are you sure you want to delete this record?</h4>
        </div>
            </div>
                  
        </div>
        <div class="modal-footer" style="margin-top: 5%; float: center">
        <button type="submit" class="btn btn-danger" name="btnDelSy" id="btnDelSy">Delete</button>
          <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
        </div>
        </form>
      </div>
      
    </div>
  </div>
  <!--modal delete end--> 
              
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
    <strong>Copyright &copy; 2017 <a href="http://almsaeedstudio.com">Kiddo Academy and Development Center</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>

      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <h3 class="control-sidebar-heading">Message Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>

<script src="js/select2.full.min.js"></script>
<script>
  $(function () {
    $("#datatable").DataTable();
    $("#datatable1").DataTable();
    $("#datatable2").DataTable();
    $("#datatable3").DataTable();
  });

</script>

<script src='http://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.4.5/js/bootstrapvalidator.min.js'></script>

<script>
   $(document).ready(function() {
    $('#addSchoolYr').bootstrapValidator({
        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            txtAddSy: {
                validators: {
                    stringLength: {  
                        min: 4,
                        max: 4,
                        message: 'Please enter 4 numeric characters only'
                    },

                    regexp: {
                        regexp: /^[0-9]+$/,
                        message: 'Please enter numeric characters only.'
                    },
                        notEmpty: {
                        message: 'School year is required'
                    }
                }
            },
            selAddSyCurr: {
                validators: {
                  notEmpty: {
                      message: 'Curriculum name is required.'
                  },
                }
            },
            }
        })
            .on('success.form.bv', function (e) {
        // Prevent form submission
        e.preventDefault();
    });

    $('#addModalOne')
       .on('shown.bs.modal', function () {
           $('#addSchoolYr').find().focus();
        })
        .on('hidden.bs.modal', function () {
            $('#addSchoolYr').bootstrapValidator('resetForm', true);
        });
});
</script>

<!--UPDATE VALIDATOR-->
  <script>
   $(document).ready(function() {
    $('#UpdSchoolYr').bootstrapValidator({
        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            txtUpdSyYear: {
                validators: {
                    stringLength: {  
                        min: 4,
                        max: 4,
                        message: 'Please enter 4 numeric characters only'
                    },

                    regexp: {
                        regexp: /^[0-9]+$/,
                        message: 'Please enter numeric characters only.'
                    },
                        notEmpty: {
                        message: 'School year is required'
                    }
                }
            },
            }
        })
             .on('success.form.bv', function (e) {
        // Prevent form submission
        e.preventDefault();
    });

    $('#updateModalOne')
       .on('shown.bs.modal', function () {
           $('#UpdSchoolYr').find().focus();
        })
        .on('hidden.bs.modal', function () {
            $('#UpdSchoolYr').bootstrapValidator('resetForm', true);
        });
});
</script>

</body>
</html>
