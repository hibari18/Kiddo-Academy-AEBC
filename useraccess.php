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

    <style type="text/css">
      fieldset 
        {
          border: 1px solid #ddd !important;
          margin: 0;
          xmin-width: 0;
          padding: 10px;       
          position: relative;
          border-radius:4px;
          background-color:#f5f5f5;
          padding-left:10px!important;
        } 
        
          legend
          {
            font-size:14px;
            font-weight:bold;
            margin-bottom: 0px; 
            width: 35%; 
            border: 1px solid #ddd;
            border-radius: 4px; 
            padding: 5px 5px 5px 10px; 
            background-color: #ffffff;
          }
    </style>
    </head>

 
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
          <div class="user-panel"  style="margin-top: 8%">
            <div class="pull-left image">
              <img src="images/Employees/admin.png" class="img-circle" alt="User Image">
            </div>

            <div class="pull-left info">
              <p><?php echo $namess ?><i class="fa fa-circle text-success" style="margin-left: 7px"></i></p>
              <p style="padding: 3px 30px; font-size: 12px;"><?php echo $rolename ?></p>
            </div>
          </div>
         
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu" style="font-size:17px;">
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
        <section class="content-header"></section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <div class="box box-default">
                <div class="box-header with-border"></div>
                <div class="box-body">
                  <div class="box-header with-border">
                    <h2 class="box-title" style="font-size:20px;">User Access</h2>
                    <div class="form-group" style="margin-top: 3%; margin-left: 2%"></div>
                  </div>

                  <div class="tab-content">

                    <div class="tab-pane active" id="tab_1">
                      <div class="box">
                        <div class="box-header"></div>
                        <div class="box-body">
                          
                            <div class="box-body">
                            <form action="updateAccess.php" method="post">
                            <div class="col-md-6">
                              <div class="form-group">
                                  <h4 style="font-weight: bold">User roles:</h4>
                                  <select class="form-control select2" name="selRole" id="selRole" style="width: 50%;">
                                    <option selected="selected" disabled>--Select Role--</option>
                                    <?php
                                    $query="select * from tblRole where tblRoleFlag=1";
                                    $result=mysqli_query($con, $query);
                                    while($row=mysqli_fetch_array($result)):
                                    ?>
                                    <option value="<?php echo $row['tblRoleId'] ?>"><?php echo $row['tblRoleName'] ?></option>
                                  <?php endwhile; ?>
                                  </select>
                                </div>
                              </div>

                            <div class="container col-lg-9" style="margin-top: 2%">
                            <br/>
                            <div class="panel panel-default">
                                  
                                  <div class="panel-heading">Modules</div>
                                  <div class="panel-body">
                                        
                                    <fieldset class="col-md-6">     
                                      <legend>Home</legend>
                                      
                                      <div class="panel panel-default">
                                        <div class="panel-body">
                                          <div class="btn-group" data-toggle="buttons">
                                            <?php
                                              $query="select * from tblmodule where tblModuleFlag=1 and tblModuleType='Home' group by tblModuleOrder";
                                              $result=mysqli_query($con, $query);
                                              while($row=mysqli_fetch_array($result)):
                                            ?>
                                            <div style="margin-top: 10%">
                                              <input type="checkbox" id="home" name="home[]" value="<?php echo $row['tblModuleId'] ?>">
                                              <label style="font-size: 16px"><?php echo $row['tblModuleName'] ?></label>
                                            </div>
                                          <?php endwhile; ?>
                                          </div>
                                        </div>
                                      </div>
                                      
                                    </fieldset>       
                                    
                                    <div class="clearfix"></div>
                                        </div>
                                  <div class="panel-body">
                                        
                                    <fieldset class="col-md-6">     
                                      <legend>Maintenance</legend>
                                      
                                      <div class="panel panel-default">
                                        <div class="panel-body">
                                          <div class="btn-group" data-toggle="buttons">
                                            <?php
                                              $query="select * from tblmodule where tblModuleFlag=1 and tblModuleType='Maintenance' group by tblModuleOrder";
                                              $result=mysqli_query($con, $query);
                                              while($row=mysqli_fetch_array($result)):
                                            ?>
                                            <div style="margin-top: 10%">
                                              <input type="checkbox" id="maintenance" name="maintenance[]" value="<?php echo $row['tblModuleId'] ?>">
                                              <label style="font-size: 16px"><?php echo $row['tblModuleName'] ?></label>
                                            </div>
                                          <?php endwhile; ?>
                                          </div>
                                        </div>
                                      </div>
                                      
                                    </fieldset>       
                                    
                                    <div class="clearfix"></div>
                                        </div>


                                  <div class="panel-body">
                                        
                                    <fieldset class="col-md-6">     
                                      <legend>Transaction</legend>
                                      
                                      <div class="panel panel-default">
                                        <div class="panel-body">
                                           <div class="btn-group" data-toggle="buttons">
                                           <?php
                                              $query="select * from tblmodule where tblModuleFlag=1 and tblModuleType='Transaction' group by tblModuleOrder";
                                              $result=mysqli_query($con, $query);
                                              while($row=mysqli_fetch_array($result)):
                                            ?>
                                            <div style="margin-top: 10%">
                                              <input type="checkbox" id="transaction" name="transaction[]" value="<?php echo $row['tblModuleId'] ?>">
                                              <label style="font-size: 16px"><?php echo $row['tblModuleName'] ?></label>
                                            </div>
                                          <?php endwhile; ?>
                                    </div>
                                        </div>
                                      </div>
                                      
                                    </fieldset>       
                                    
                                    <div class="clearfix"></div>
                                        </div>


                                  <div class="panel-body">
                                        
                                    <fieldset class="col-md-6">     
                                      <legend>Reports</legend>
                                      
                                      <div class="panel panel-default">
                                        <div class="panel-body">
                                           <div class="btn-group" data-toggle="buttons">
                                           <?php
                                              $query="select * from tblmodule where tblModuleFlag=1 and tblModuleType='Report' group by tblModuleOrder";
                                              $result=mysqli_query($con, $query);
                                              while($row=mysqli_fetch_array($result)):
                                            ?>
                                            <div style="margin-top: 10%">
                                              <input type="checkbox" id="report" name="report[]" value="<?php echo $row['tblModuleId'] ?>">
                                              <label style="font-size: 16px"><?php echo $row['tblModuleName'] ?></label>
                                            </div>
                                          <?php endwhile; ?>
                                    </div>
                                        </div>
                                      </div>
                                      
                                    </fieldset>        
                                    
                                    <div class="clearfix"></div>
                                        </div>



                                    <div class="panel-body">
                                        
                                    <fieldset class="col-md-6">     
                                      <legend>Queries</legend>
                                      
                                      <div class="panel panel-default">
                                        <div class="panel-body">
                                           <div class="btn-group" data-toggle="buttons">
                                           <?php
                                              $query="select * from tblmodule where tblModuleFlag=1 and tblModuleType='Queries' group by tblModuleOrder";
                                              $result=mysqli_query($con, $query);
                                              while($row=mysqli_fetch_array($result)):
                                            ?>
                                            <div style="margin-top: 10%">
                                              <input type="checkbox" id="query" name="query[]" value="<?php echo $row['tblModuleId'] ?>">
                                              <label style="font-size: 16px"><?php echo $row['tblModuleName'] ?></label>
                                            </div>
                                          <?php endwhile; ?>
                                    </div>
                                        </div>
                                      </div>
                                      
                                    </fieldset>      
                                    
                                    <div class="clearfix"></div>
                                        </div>


                                  <div class="panel-body">
                                        
                                    <fieldset class="col-md-6">     
                                      <legend>Utilities</legend>
                                      
                                      <div class="panel panel-default">
                                        <div class="panel-body">
                                           <div class="btn-group" data-toggle="buttons">
                                           <?php
                                              $query="select * from tblmodule where tblModuleFlag=1 and tblModuleType='Utilities' group by tblModuleOrder";
                                              $result=mysqli_query($con, $query);
                                              while($row=mysqli_fetch_array($result)):
                                            ?>
                                            <div style="margin-top: 10%">
                                              <input type="checkbox" id="utility" name="utility[]" value="<?php echo $row['tblModuleId'] ?>">
                                              <label style="font-size: 16px"><?php echo $row['tblModuleName'] ?></label>
                                            </div>
                                          <?php endwhile; ?>
                                    </div>
                                        </div>
                                      </div>
                                      
                                    </fieldset>         
                                    
                                    <div class="clearfix"></div>
                                        </div>


                            </div>
                            <button type="submit">SUBMIT</button>
                            
                            </div>
                    </form>
                    </div> <!-- box body -->
                          
                        </div> <!-- box-body -->
                      </div> <!-- box-->
                    </div> <!--tab pane tab_1 -->
                  </div> <!-- tab content -->
                </div> <!-- box body -->
              </div> <!-- box- box-default-->
            </div> <!-- col-md-12 -->
          </div> <!-- row -->
        </section>
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
<!-- DataTables -->
    <script>
      $(function () {
        //Add text editor
        $("#compose-textarea").wysihtml5();
      $(".choose").select2();
      });
    </script>

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
    <!-- InputMask -->
    <script src="js/input-mask/jquery.inputmask.js"></script>
    <script src="js/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="js/input-mask/jquery.inputmask.extensions.js"></script>
    <!-- iCheck 1.0.1 -->
    <script src="js/icheck.min.js"></script>

<script>
  $(function () {
   //Datemask dd/mm/yyyy
    $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
    //Datemask2 mm/dd/yyyy
    $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
     $("#datemask3").inputmask("yyyy-mm-dd", {"placeholder": "yyyy-mm-dd"});
    //Money Euro
    $("[data-mask]").inputmask();
    $("#datatable").DataTable();
    $("#datatable1").DataTable();
    $("#datatable2").DataTable();
    $("#datatable3").DataTable();
    $("#datatable4").DataTable();
  });
  $(document).ready(function() {
  $(".choose").select2();
});
</script>
    
  </body>
</html>
