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
    <title>AEBC</title>
    <link rel="icon" type="image/gif" href="">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="css/bootstrapcss/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="css/adminLTEcss/AdminLTE.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="css/datatables/dataTables.bootstrap.css">
    <!-- bootstrap wysihtml5 - tex
    t editor -->
    <link rel="stylesheet" href="css/bootstrap3-wysihtml5.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="css/daterangepicker/daterangepicker.css">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="css/datepicker/datepicker3.css">
    <link rel="stylesheet" href="css/adminLTEcss/skins/_all-skins.min.css">
    <link rel="stylesheet" href="css/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="css/formwizard2.css">
    <link rel="stylesheet" type="text/css" href="css/sweetalert.css">
    <link rel="stylesheet" type="text/css" href="css/css/validDesignReq.css">
    <!-- fullCalendar 2.2.5-->
    <link rel="stylesheet" href="css/fullcalendar.min.css">
    <link rel="stylesheet" href="css/fullcalendar.print.css" media="print">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="css/iCheck/all.css">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">
    <style>
      body {
        font-family: 'Noto Sans', sans-serif;
        font-weight: bold;
        padding-right: 0 !important }
    </style>

    </head>
  <script>
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
    var f1=document.getElementById('txtStudId');
    var f2=document.getElementById('txtStudName');
    f1.value=cells[0].innerHTML;
    f2.value=cells[1].innerHTML;
  };
}})();
  </script>

  <body class="hold-transition skin-green-light sidebar-mini">
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
      <div class="content-wrapper" style="height: 100%">
       <!-- Main content -->
        <section class="content">
          <div class="row">
              <div class="col-md-12">
                <div class="box box-default" style="margin-top: 25px">
                    <div class="box-body">
                       <div class="box-header with-border">
                          <h2 class="box-title" style="font-size:21px; margin-top: 10px">DISMISS/ WITHDRAW</h2>
                        </div>
                      

                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                          <form role="form">
                            <div class="box-body" style="margin-top: 3%">
                         
                            
                             <table id="datatable1" class="table table-bordered table-striped">
                             <thead>
                              <tr>
                                <th>Student ID</th>
                                <th>Student Name</th>
                                <th>Level</th>
                                <th>Action</th>
                              </tr>
                              </thead>
                              <tbody>
                              <?php
                                $query="select s.tblStudentId, concat(si.tblStudInfoLname, ', ', si.tblStudInfoFname, ' ', si.tblStudInfoMname) as name, l.tblLevelName from tblstudent s, tblstudentinfo si, tbllevel l where s.tblStudent_tblLevelId=l.tblLevelId and si.tblStudInfo_tblStudentId=s.tblStudentId and s.tblStudentFlag=1 and s.tblStudentType = 'OFFICIAL' group by s.tblStudentId";
                                $result=mysqli_query($con, $query);
                                while($row=mysqli_fetch_array($result)) :
                              ?>
                              <tr>
                                <td><?php echo $row['tblStudentId'] ?></td>
                                <td><?php echo $row['name'] ?></td>
                                <td><?php echo $row['tblLevelName'] ?></td>
                                <td><button type="button" class="btn btn-success" data-toggle="modal" data-target="#ModalOne"><i class="fa fa-edit"></i></button></td>
                                </tr>
                              <?php endwhile; ?>
                              </tbody>
                            </table>
                          </div> 
                          </form>   


                  <div class="modal fade" id="ModalOne" role="dialog">
                    <div class="modal-dialog">
                    
                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h3 class="modal-title" style="font-style: bold">Student Status</h3>
                        </div>
                        <form autocomplete="off" method="post" action="dismissWithdrawStudent.php">
                        <div class="modal-body">
                        <div class="form-group"  style="margin-top: 5%">
                            <label class="col-sm-4 control-label" for="textinput" style="text-align: right">Student Id</label>
                            <div class="col-sm-7">
                              <input type="text" class="form-control" style="text-transform:uppercase ;" name="txtStudId" id="txtStudId" readonly>
                            </div>
                        </div> 
                        <div class="form-group"  style="margin-top: 15%">
                            <label class="col-sm-4 control-label" for="textinput" style="text-align: right">Student Name</label>
                            <div class="col-sm-7">
                              <input type="text" class="form-control" style="text-transform:uppercase ;" name="txtStudName" id="txtStudName" disabled="disabled">
                            </div>
                        </div> 
                        <div class="form-group" style="margin-top: 25%">
                                <label class="col-sm-4" style="text-align: right">Action</label>
                                <div class="col-sm-7 selectContainer">
                                <select class="form-control" style="width: 100%;" name="selChoose" id="selChoose">
                                  <option selected disabled>--Select--</option>
                                  <option>DISMISS</option>
                                  <option>WITHDRAW</option>
                                </select>
                                </div>
                              
                        </div>
                        <div class="form-group" style="margin-top: 35%">
                                <label class="col-sm-4" style="text-align: right">Reason</label>
                                <div class="col-sm-7 selectContainer">
                                <div class="form-group">
                                  
                                  <textarea class="form-control" rows="3" placeholder="Enter ..." name="taReason" id="taReason" ></textarea>
                                </div>
                                </div>
                              
                        </div>
                        <div class="modal-footer" style="margin-top: 50%">
                          <button type="submit" class="btn btn-info" name="btnDismiss" id="btnDismiss">Save</button>
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                        </form>
                      </div>
                      
                    </div>
                  </div>
          
                  </div>
                  </div>
                </div>
                </div>
              </div>
            </div>
          <!-- /.row -->
        </section>  
      </div><!-- ./content-wrapper -->
    </div><!-- ./wrapper -->

    <?php include 'footer.php';?>
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
    </body>
</html>
