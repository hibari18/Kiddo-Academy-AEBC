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

$studid=$_POST['txtStudId'];
$query="select * from tblschoolyear where tblSchoolYrActive='ACTIVE'";
$result=mysqli_query($con, $query);
$row=mysqli_fetch_array($result);
$syid=$row['tblSchoolYrId'];
$query="select * from tblstudent where tblStudentId='$studid' and tblStudentFlag=1";
$result=mysqli_query($con, $query);
$row=mysqli_fetch_array($result);
$lvlid=$row['tblStudent_tblLevelId'];
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
    <link rel="stylesheet" type="text/css" href="formwizard2.css">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">
    <style>
      body {
        font-family: 'Noto Sans', sans-serif;
        font-weight: bold;
      }
    </style>
    <script>
    function changeScheme()
    {
      var xmlhttp =  new XMLHttpRequest();
      xmlhttp.open("GET","changeScheme.php?selAddFee="+document.getElementById("selAddFee").value,false);
      xmlhttp.send(null);
      document.getElementById("selAddScheme").innerHTML=xmlhttp.responseText;
    }
    function disableProceed()
    {
      document.getElementById('proceed').disabled=false;
    }
    </script>
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
        <!-- Content Header (Page header) -->
        <section class="content-header">

        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <div class="box box-default"  style="margin-top: 10px">
                <div class="box-body">
                  <div class="box-header with-border">
                    <h2 class="box-title" style="font-size:25px; margin-top: 10px">Collection</h2>
                    <hr>
                    <?php
                            $query="select concat(tblstudentinfo.tblStudInfoLname, ', ', tblstudentinfo.tblStudInfoFname, ' ', tblstudentinfo.tblStudInfoMname) as name from tblstudentinfo join tblstudent on tblstudent.tblStudentId=tblstudentinfo.tblStudInfo_tblStudentId where tblstudent.tblStudentId='$studid' and tblstudent.tblStudentFlag=1";
                            $result=mysqli_query($con, $query);
                            $row=mysqli_fetch_array($result);
                            ?> 
                    <h4 style="font-weight: bold">Student: <?php echo $row['name'] ?></h4>
                  </div>


                  <div class="tab-content">

                    <div class="tab-pane active" id="tab_1">
                        <div class="box-body">
                          <form action="reportstatementofaccount.php" method="post" target="_blank"><input type="hidden" value="<?php echo $studid ?>" name="studentid" id="studentid"/><button class="btn btn-info" type="submit">Get Statement of Account</button></form>
                          <form action="collection.php" method="post">
                            <div class="box-body">
                            <div class="col-md-6" style="margin-top: 2%">
                              <!-- <button type="button" class="btn btn-info" data-toggle="modal" value="Reset form" data-target="#addFeesModal" style="margin-bottom: 3%">Add Bill</button> -->
                              <button type="submit" class="btn btn-success" id="proceed" name="proceed" disabled style="margin-bottom: 3%">Proceed to Payment</button>
                            </div>

                              <div class="col-md-12" style="margin-top: 5%">
                                <table id="datatable1" class="table table-bordered table-striped">
                                  <thead>
                                    <tr>
                                      <th></th>
                                      <th>Overdue</th>
                                      <th>Due Date</th>
                                      <th>Fee Code</th>
                                      <th>Details</th>
                                      <th>Credit</th>
                                      <th>Running Balance</th>
                                      <th>Remarks</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                  <?php
                                    $overdue=0;
                                    $query="select * from tblaccount a, tblstudscheme s where a.tblAcc_tblStudSchemeId=s.tblStudSchemeId and a.tblAcc_tblStudentId='$studid' and s.tblStudScheme_tblSchoolYrId='$syid' and a.tblAccPaid='UNPAID' and a.tblAccFlag=1 and s.tblStudSchemeFlag=1 group by a.tblAccPaymentNum, a.tblAcc_tblStudSchemeId";
                                    $result=mysqli_query($con, $query);
                                    while($row=mysqli_fetch_array($result)):
                                      $payment=$row['tblAccCredit'];
                                      $feeId=$row['tblStudScheme_tblFeeId'];
                                      $query1="select * from tblfee where tblFeeId='$feeId'";
                                      $result1=mysqli_query($con, $query1);
                                      $row1=mysqli_fetch_array($result1);
                                      $fee=$row1['tblFeeCode'];
                                      $feename=$row1['tblFeeName'];
                                      $duedate=$row['tblAccDueDate'];
                                      $curdate=date('Y-m-d');
                                      $end_ts = strtotime($duedate);
                                      $now_ts = strtotime($curdate);
                                      if($now_ts > $end_ts)
                                      {
                                        $over="Y";
                                      }else
                                      {
                                        $over="N";
                                      }
                                  ?>
                                    <tr>
                                      <td><input type="checkbox" name="chkbills[]" id="chkbills" value="<?php echo $row['tblAccId'] ?>" onclick="disableProceed()"/></td>
                                      <td><?php echo $over ?></td>
                                      <td><?php echo $row['tblAccDueDate'] ?></td>
                                      <td><?php echo $fee ?></td>
                                      <td><?php echo $feename ?></td>
                                      <td><?php echo $row['tblAccCredit'] ?></td>
                                      <td><?php echo $row['tblAccRunningBal'] ?></td>
                                      <td><?php echo $row['tblAccRemark'] ?></td>
                                     <?php
                                      if($over=='Y')
                                      {
                                        $overdue+=$payment;
                                      }
                                     ?>
                                    </tr>
                                  <?php endwhile; ?>
                                  </tbody>
                                </table>
                                <input type="hidden" value="<?php echo $overdue ?>" name="txtoverdue" id="txtoverdue"/>
                              </div> <!-- col-md-12 -->
                            </div> <!-- box body -->
                          </form>


                          <!-- Modal starts here-->
                          <div class="modal fade" id="addFeesModal" role="dialog">
                            <div class="modal-dialog">
                            
                              <!-- Modal content-->
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h3 class="modal-title" style="font-style: bold">Add Bill</h3>
                                </div>
                                <form autocomplete="off" method="post" data-toggle="validator" role="form" action="addFees.php">
                                <div class="modal-body">
                                 
                                <div class="form-group" style="margin-top: 5%">
                                        <input type="hidden" name="txtStud" id="txtStud" value="<?php echo $studid ?>"/>
                                        <label class="col-sm-4" style="text-align: right">Fee Description</label>
                                        <div class="col-sm-7 selectContainer">
                                         <select class="form-control choose" name="selAddFee" id="selAddFee" style="width: 100%;" onclick="changeScheme()">
                                          <option selected disabled>--Select Fee--</option>
                                          <?php
                                          $query="select * from tblfee where tblFeeMandatory='N' and tblFeeFlag=1";
                                          $result=mysqli_query($con, $query);
                                          while($row=mysqli_fetch_array($result)):
                                          ?>
                                          <option value="<?php echo $row['tblFeeId'] ?>"><?php echo $row['tblFeeName'] ?></option>
                                        <?php endwhile; ?>
                                        </select>
                                        </div>
                                </div> 
                                <div class="form-group" style="margin-top: 15%">
                                        <label class="col-sm-4" style="text-align: right">Payment Scheme</label>
                                        <div class="col-sm-7 selectContainer">
                                        <select class="form-control choose" name="selAddScheme" id="selAddScheme" style="width: 100%;">
                                        <option selected disabled>--Select Schemes--</option>
                                        </select>
                                        </div>
                                </div> 
                                <div class="form-group" style="margin-top: 25%">
                                        <label class="col-sm-4" style="text-align: right">Due Date</label>
                                        <div class="col-sm-7 selectContainer" name="divDate" id="divDate">
                                        <input type="date" class="form-control" disabled value="<?php echo date('Y-m-d') ?>">
                                        </div>       
                                </div>
                                <div class="form-group" style="margin-top: 35%">
                                        <label class="col-sm-4" style="text-align: right">Amount</label>
                                        <div class="col-sm-7 selectContainer">
                                        <input type="text" class="form-control" disabled>
                                        </div>       
                                </div>
                                    <div class="modal-footer" style="margin-top: 50%">
                                    <button type="submit" class="btn btn-info" name="btnAddLvl" id="btnAddLvl">Save</button>
                                      <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    </div>
                              </form>
                              </div>    
                            </div>
                          </div>

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
    <script type="text/javascript" src="formwizard.js"></script>

    <script>
      $(function () {
        $("#datatable").DataTable();
        $("#datatable1").DataTable();
        $("#datatable2").DataTable();
        $("#datatable3").DataTable();
        $("#datatable4").DataTable();
      });
      
    </script>
    
  </body>
</html>
