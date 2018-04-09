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
<?php
  if(isset($_GET['msg']))
  {
    $msg = $_GET['msg'];
    if ($msg == 1)
    {
    echo "<script> swal('Data already exist', ' ', 'info'); </script>";
    }else if($msg == 2)
    {
    echo '<script>alert("Success"); </script>';
    }
  }
?>
<!DOCTYPE html>

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

    <link rel="stylesheet" type="text/css" href="css/validDesignSection.css">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">
    <style>
      body {
        font-family: 'Noto Sans', sans-serif;
        font-weight: bold;
      }
    </style>
    <script type="text/javascript">
      function myFunction() {
      document.getElementById("addCurriculum").reset();
      }
    </script>
    <script>
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
      var f1=document.getElementById('txtUpdDivId');
      var f2=document.getElementById('txtUpdDiv');
      var f3=document.getElementById('selUpdDivAct');
      var f4=document.getElementById('txtDelId');
      f1.value=cells[0].innerHTML;
      f2.value=cells[1].innerHTML;
      f3.value=cells[2].innerHTML;
      f4.value=cells[0].innerHTML;
    };
  }})();
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
              <!-- User Account -->
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
              <p><?php echo $namess ?><i class="fa fa-circle text-success" style="margin-left: 5px"></i></p>
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
   <!-- Main content -->
    <section class="content">
      <div class="row">
          <div class="col-md-12">
            <div class="box box-default" style="margin-top: 25px">
              <div class="box-body" style="padding: 20px">
                <div class="box-header with-border" style="padding: 0px 2px 10px 2px">
                    <h2 class="box-title" style="font-size:23px; margin-top: 10px;">DIVISION</h2>
                </div>

              <div class="box-body" style="margin-top: 3%;">
                <div class="btn-group" style="float: left;  margin-bottom: 2%;">
                  <button type="reset" onclick="myFunction()" value="Reset form"  class="btn btn-info" data-toggle="modal" data-target="#addModalOne"><i class="fa fa-plus"></i>Add</button>
                </div>
              </div>

<!-- Modal starts here-->
  <div class="modal fade" id="addModalOne" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title" style="font-style: bold">Add Division</h3>
        </div>
        <form autocomplete="off" method="post" action="actionCurriculum.php" name="AddDivision" id="AddDivision"
        <div class="modal-body">
        <div class="form-group"  style="margin-top: 5%">
            <label class="col-sm-4 control-label" for="textinput" style="text-align: right">Division Name</label>
            <div class="col-sm-7 selectContainer">
              <input type="text" class="form-control" name="txtAddDiv" id="txtAddDiv" style="text-transform:uppercase ;">
            </div>
        </div> 
        <div class="form-group" style="margin-top: 15%">
                <label class="col-sm-4" style="text-align: right">Status</label>
                <div class="col-sm-7 selectContainer">
                <select class="form-control choose" style="width: 100%;" name="selAddDivAct" id="selAddDivAct">
                  <option selected value="ACTIVE">ACTIVE</option>
                  <option value="INACTIVE">INACTIVE</option>
                </select>
                </div>
              
        </div>
        <div class="modal-footer" style="margin-top: 25%">
        <button type="submit" class="btn btn-info" name="btnAddDiv" id="btnAddDiv">Save</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        </form>
      </div>
      
    </div>
  </div>

<!-- Modal starts here-->
  <div class="modal fade" id="updateModalOne" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title" style="font-style: bold">Update Division</h3>
        </div>
        <form autocomplete="off" method="post" action="actionCurriculum.php" name="UpdDivision" id="UpdDivision"
        <div class="modal-body">
        <div class="form-group"  style="margin-top: 5%">
             <div><input type="hidden" name="txtUpdDivId" id="txtUpdDivId"></div>
            <label class="col-sm-4 control-label" for="textinput" style="text-align: right">Division Name</label>
            <div class="col-sm-7 selectContainer">
              <input type="text" class="form-control" name="txtUpdDiv" id="txtUpdDiv" style="text-transform:uppercase ;">
            </div>
        </div> 
        <div class="form-group" style="margin-top: 15%">
                <label class="col-sm-4" style="text-align: right">Status</label>
                <div class="col-sm-7 selectContainer">
                <select class="form-control choose" style="width: 100%;" name="selUpdDivAct" id="selUpdDivAct">
                  <option selected value="ACTIVE">ACTIVE</option>
                  <option value="INACTIVE">INACTIVE</option>
                </select>
                </div>
              
        </div>
        <div class="modal-footer" style="margin-top: 25%">
        <button type="submit" class="btn btn-info" name="btnUpdDiv" id="btnUpdDiv">Save</button>
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
          <h3 class="modal-title" style="font-style: bold">Delete Division</h3>
        </div>
        <form action="actionCurriculum.php" method="post">
        <div class="modal-body">
        <div class="box-body table-responsive no-padding"   style="margin-top: 2%">
        <div><input type="hidden" name="txtDelId" id="txtDelId"/></div>
        <div>
        <h4 align="center" style="margin-top: 5%">Are you sure you want to delete this record?</h4>
        </div>
        </div>
        </div>
        <div class="modal-footer" style="margin-top: 5%; float: center">
        <button type="submit" class="btn btn-danger" name="btnDelDivision" id="btnDelDivision">Delete</button>
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
                  <th hidden></th>
                  <th>Division Name</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $query = "select * from tbldivision where tblDivisionFlag=1";
                $result = mysqli_query($con, $query);
                while($row = mysqli_fetch_array($result))
                {
                ?>
                <tr>
                <td hidden><?php echo $row['tblDivisionId']; ?></td>
                <td><?php echo $row['tblDivisionName']; ?></td>
                <td><?php echo $row['tblDivisionActive']; ?></td>
                <td><button type="button" class="btn btn-success" data-toggle="modal" data-target="#updateModalOne"><i class="fa fa-edit"></i></button>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModalOne"><i class="fa fa-trash"></i></button></td>
                </tr>
                <?php } ?>
                </tbody>
              </table>
                </form>

              </div> <!-- /. box-body -->
            </div> <!-- /.boc-default -->
          </div> <!-- col-md -->
        </div> <!--/.row -->
      </section>
    </div> <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2017
    </div>
    <strong>Copyright &copy; 2017 <a href="http://www.kiddoacademy.com/">Kiddo Academy and Development Center</a>.</strong> All rights
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
<script>
  function changeDiv()
  {
    document.getElementById('addLvlSelect').disabled = false;
    var xmlhttp =  new XMLHttpRequest();
    xmlhttp.open("GET","changeDivSect.php?addDivSelect="+document.getElementById("addDivSelect").value,false);
    xmlhttp.send(null);

    document.getElementById("addLvlSelect").innerHTML=xmlhttp.responseText;

  }
  function changeDivUpd()
  {
    document.getElementById('updLvlName').disabled = false;
    var xmlhttp =  new XMLHttpRequest();
    xmlhttp.open("GET","changeDivUpdSect.php?updDivSelect="+document.getElementById("updDivSelect").value,false);
    xmlhttp.send(null);

    document.getElementById("updLvlName").innerHTML=xmlhttp.responseText;

  }
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
  $(function () {
    $("#datatable").DataTable();
    $("#datatable1").DataTable();
    $("#datatable2").DataTable();
    $("#datatable3").DataTable();
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

<script src='http://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.4.5/js/bootstrapvalidator.min.js'></script>

<script>
   $(document).ready(function() {
    $('#formAdd').bootstrapValidator({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            addDivSelect: {
                validators: {
                  notEmpty: {
                      message: 'Division name is required.'
                  },
                }
            },
             addLvlSelect: {
                validators: {
                  notEmpty: {
                      message: 'Level name is required.'
                  },
                }
            },
            addSectTxt: {
                validators: {
                    stringLength: {
                        min: 3,
                        max: 30,
                        message: 'Please enter at least 3 characters'
                    },

                     regexp: {
                        regexp: /^[a-zA-Z_0-9\w-][0-9a-zA-Z_\w-\s][\w-'\s]+$/,
                        message: 'This field does not allow special characters'
                    },
                        notEmpty: {
                        message: 'Section name is required'
                    }
                }
            },
            addSesSelect: {
                validators: {
                  notEmpty: {
                      message: 'Session is required.'
                  },
                }
            },
            addMaxCap:{
              validators:{
                   notEmpty: {
                   message: 'Maximum slot is required'
               }
              }
            },
            addMinCap:{
              validators:{
                   notEmpty: {
                   message: 'Minimum slot is required'
               }
              }
            },
            }
        })

    .on('success.form.bv', function (e) {
        // Prevent form submission
        //e.preventDefault();
    });

    $('#addModalOne')
       .on('shown.bs.modal', function () {
           $('#formAdd').find().focus();
        })
        .on('hidden.bs.modal', function () {
            $('#formAdd').bootstrapValidator('resetForm', true);
        });


      //<!-- Update -->

      $('#updSection').bootstrapValidator({
      feedbackIcons: {
          valid: 'glyphicon glyphicon-ok',
          invalid: 'glyphicon glyphicon-remove',
          validating: 'glyphicon glyphicon-refresh'
      },
      fields: {
           updLvlName: {
              validators: {
                notEmpty: {
                    message: 'Level name is required.'
                },
              }
          },
          updSectName: {
              validators: {
                  stringLength: {
                      min: 3,
                      max: 30,
                      message: 'Please enter at least 3 characters'
                  },

                   regexp: {
                      regexp: /^[a-zA-Z_0-9\w-][0-9a-zA-Z_\w-\s][\w-'\s]+$/,
                      message: 'This field does not allow special characters'
                  },
                      notEmpty: {
                      message: 'Section name is required'
                  }
              }
          },
          updSesSelect: {
              validators: {
                notEmpty: {
                    message: 'Session is required.'
                },
              }
          },
          updMaxCap:{
            validators:{
                 notEmpty: {
                 message: 'Maximum slot is required'
             }
            }
          },
          updMinCap:{
            validators:{
                 notEmpty: {
                 message: 'Minimum slot is required'
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
           $('#updSection').find().focus();
        })
        .on('hidden.bs.modal', function () {
            $('#updSection').bootstrapValidator('resetForm', true);
        });

  });
</script>

</body>
</html>
