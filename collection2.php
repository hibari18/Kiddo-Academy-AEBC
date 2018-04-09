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
  $query="select s.tblStudentId, concat(si.tblStudInfoLname, ', ', si.tblStudInfoFname, ' ', si.tblStudInfoMname) as name, s.tblStudent_tblLevelId from tblstudent s, tblstudentinfo si where s.tblStudentId='$studid' and s.tblStudentId=si.tblStudInfo_tblStudentId and s.tblStudentFlag=1";
  $result=mysqli_query($con, $query);
  $row=mysqli_fetch_array($result);
  $name=$row['name'];
  $lvlid=$row['tblStudent_tblLevelId'];
  $query="select * from tblschoolyear where tblSchoolYrActive='ACTIVE' and tblSchoolYearFlag=1";
  $result=mysqli_query($con, $query);
  $row=mysqli_fetch_array($result);
  $syid=$row['tblSchoolYrId'];
  $total=0;
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
    <style type="text/css">
      td:empty:before{
        content: attr(placeholder);
        display: block;
        color:#ff8080;
      }
    </style>
    <script>
      function showCheck()
      {
        if(document.getElementById('chkCheck').checked) {
            $("#txtAmount").prop('disabled', false);
            $("#txtBankName").prop('disabled', false);
            $("#num").prop('disabled', false);
            document.getElementById("chkCheck1").value=1;
        } else {
            $("#txtAmount").prop('disabled', true);
            $("#txtBankName").prop('disabled', true);
            $("#num").prop('disabled', true);
        }
      }
      function checkamnt()
      {
        var val=document.getElementById("txtAmount").value;
        document.getElementById("checkamount").value=val;
      }
      function bank()
      {
        var val=document.getElementById("txtBankName").value;
        document.getElementById("bankname").value=val;
      }
      function checknum()
      {
        var val=document.getElementById("num").value;
        document.getElementById("chknum").value=val;
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
        <section class="content-header">
          
        </section>

        <!-- Main content -->
        <section class="content"  style="margin-top: 4%">
          <div class="row">
            <div class="col-md-12">
              <div class="box box-default">
                <div class="box-header with-border"></div>
                <div class="box-body">
                  <div class="box-header with-border">
                    <h2 class="box-title" style="font-size:20px;">Collection</h2>
                    <div class="form-group" style="margin-top: 3%; margin-left: 2%"></div>
                  </div>

                  <div class="tab-content">

                    <div class="tab-pane active" id="tab_1">
                      <div class="box">
                        <div class="box-header"></div>
                        <div class="box-body">
                          
                          <div class="container">
  <div class="row">

        <div class="col-sm-11">
            <legend style="font-weight: bold;">Student Name: <?php echo $name ?></legend>
        </div>
        <div class="col-sm-10">
            <h4>Evaluation:</h4>
            <div class="row">
                <div class="col-xs-12">
                <form action="trytry.php" method="post">
                    <div class="table-responsive" class="table-editable">
                        <table class="table preview-table">
                            <thead>
                                <tr>
                                    <th hidden>Account Id</th>
                                    <th>Due Date</th>
                                    
                                    <th>Fee Code</th>
                                    <th>Fee Description</th>
                                    <th>Amount</th>
                                    <th>Payment</th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php
                              $totalamountdue=0;
                              $totalamountpaid=0;
                              $query="select * from tblstudscheme where tblStudScheme_tblStudentId='$studid' and tblStudSchemeFlag=1";
                              $result=mysqli_query($con, $query);
                              while($row1=mysqli_fetch_array($result))
                              {
                                $studschemeid=$row1['tblStudSchemeId'];
                                $query1="select * from tblaccount where tblAcc_tblStudSchemeId='$studschemeid' and tblAcc_tblStudentId='$studid' and tblAccFlag=1 and tblAccPaymentNum=1";
                                $result1=mysqli_query($con, $query1);
                                while($row2=mysqli_fetch_array($result1))
                                {
                                  $credit=$row2['tblAccCredit'];
                                  $query2="select * from tblstudscheme where tblStudSchemeId='$studschemeid' and tblStudScheme_tblSchoolYrId='$syid' and tblStudSchemeFlag=1";
                                  $result2=mysqli_query($con, $query2);
                                  $row3=mysqli_fetch_array($result2);
                                  $fee=$row3['tblStudScheme_tblFeeId'];
                                  $query3="select * from tblfee where tblFeeId='$fee' and tblFeeFlag=1";
                                  $result3=mysqli_query($con, $query3);
                                  $row4=mysqli_fetch_array($result3);
                                  $feecode=$row4['tblFeeCode'];
                                  $feename=$row4['tblFeeName'];
                                ?>
                                
                            <tr>
                              <td hidden><input type="hidden" name="txtAccId[]" id="txtAccId" value="<?php echo $row2['tblAccId'] ?>"/>
                              <td><?php echo $row2['tblAccDueDate'] ?></td>
                              
                              <td><?php echo $feecode ?></td>
                              <td><?php echo $feename ?></td>
                              <td><?php echo $credit ?></td>
                              <td><?php echo $credit ?></td>
                            </tr>
                            <?php
                            $totalamountdue += $credit;
                            $totalamountpaid += $credit;
                              }} 
                            ?>
                            </tbody> <!-- preview content goes here-->
                        </table>
                    </div>
                                             
                </div>
            </div>

        </div>
        <!-- panel preview -->
        <div class="col-sm-6" style="margin-top: 5%; margin-left: 40%">
            <h4>Total:</h4>
            <div class="panel panel-default">
                <div class="panel-body form-horizontal payment-form">
                    <div class="form-group">
                        <label for="amount" class="col-sm-3 control-label">O.R. Number:</label>
                        <div class="col-sm-9">
                          <?php
                                        $query=mysqli_query($con, "select * from tblornumber where tblOrFlag=1");
                                        $row=mysqli_fetch_array($query);
                                        $ornum=$row['tblOrCurrent'];
                                        $ornum++;
                                        $query1=mysqli_query($con, "update tblornumber set tblOrCurrent='$ornum' where tblOrFlag=1");
                                      ?>
                            <input type="text" class="form-control" id="txtOR" name="txtOR" value="<?php echo $ornum ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="amount" class="col-sm-3 control-label">Total Amount Due</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" id="amount" name="amount" disabled value="<?php echo $totalamountdue ?>">
                        </div>
                    </div> 
                    <div class="form-group">
                        <label for="amount" class="col-sm-3 control-label">Total Amount Paid</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" id="amountp" name="amountp" value="<?php echo $totalamountpaid ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="amount" class="col-sm-3 control-label">Total Running Balance</label>
                        <div class="col-sm-9">
                            <?php
                              $query=mysqli_query($con, "select SUM(a.tblAccCredit) as bal from tblaccount a, tblstudscheme s where a.tblAcc_tblStudentId='$studid' and a.tblAcc_tblStudSchemeId=s.tblStudSchemeId and a.tblAccPaid='UNPAID' and a.tblAccFlag=1 and s.tblStudSchemeFlag=1 and s.tblStudScheme_tblSchoolYrId='$syid'");
                              $row=mysqli_fetch_array($query);
                              $runningbal=$row['bal'];
                            ?>
                            <input type="text" class="form-control" id="bal" name="bal" value="<?php echo number_format((float)$runningbal, 2, '.', ''); ?>" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="date" class="col-sm-3 control-label">Date</label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control" id="date" name="date" disabled value="<?php echo date('Y-m-d') ?>">
                        </div>
                    </div>  
                    <input type="hidden" name="ind" id="ind" value="1"/>  


                </div>
            </div>            
        </div> <!-- / panel preview -->
                            <div class="form-group col-md-9" style="margin-top: 5%">
                            <input type="checkbox" name="chkCheck" id="chkCheck" onchange="showCheck()"> Check
                            <input type="hidden" name="chkCheck1" id="chkCheck1" value="0">
                              </label>
                            </div>
                            <div class="col-md-12" style="margin-top: 3%">
                              <label class="col-md-2">Check Number:</label>
                              <input type="text" name="num" id="num" class="col-md-3" disabled onkeyup="checknum()">
                            </div>
                            <div class="col-md-12" style="margin-top: 3%">
                              <label class="col-md-2">Check Amount:</label>
                              <input type="number" name="txtAmount" id="txtAmount" class="col-md-3" disabled onkeyup="checkamnt()">
                              <label class="col-md-2" style="text-align: right">Date:</label>
                              <input type="date" name="txtDate" id="txtDate" class="col-md-3" value="<?php echo date('Y-m-d') ?>">
                            </div>
                            <div class="col-md-12" style="margin-top: 3%">
                              <label class="col-md-2">Bank Name:</label>
                              <input type="text" name="txtBankName" id="txtBankName" class="col-md-8" disabled onkeyup="bank()">
                            </div>
                          </div>
        <button type="submit" class="btn btn-success btn-block" style="width: 10%; float: right; margin-top: 5%; margin-right: 12%">SAVE</button>
                    </form>
        <form method="post" action="reportreceipt.php" target="_blank">
      <input type="hidden" value="<?php echo $totalamountpaid ?>" id="amnt" name="amnt" />
      <input type="hidden" value="<?php echo $name ?>" id="name" name="name" />
      <input type="hidden" value="<?php echo $studid ?>" id="student" name="student" />
      <input type="hidden" id="checkamount" name="checkamount" />
      <input type="hidden" id="bankname" name="bankname" />
      <input type="hidden" id="date" name="date" value="<?php echo date('Y-m-d') ?>" />
      <input type="hidden" id="chknum" name="chknum" />
      <input type="hidden" id="txtor" name="txtor" value="<?php echo $ornum ?>" />
      <button type="submit" class="btn btn-info btn-block" style="width: 10%; float: right; margin-top: 5%; margin-right: 12%">Print Receipt</button>
    </form> 
  </div>
</div>
                          

                        </div> <!-- box-body -->
                      </div> <!-- box -->
                    </div> <!-- tab pane tab_1 -->
                  </div> <!-- tab content -->
                </div> <!-- box body -->
              </div> <!-- box box-default -->
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
    $(document).ready(function() {
    $(".choose").select2();
  });
  </script>

<!-- <script>
  function calc_total(){
    var sum = 0;
    $('.input-amount').each(function(){
        sum += parseFloat($(this).text());
    });
    $(".preview-total").text(sum);    
}
$(document).on('click', '.input-remove-row', function(){ 
    var tr = $(this).closest('tr');
    tr.fadeOut(200, function(){
      tr.remove();
      calc_total()
  });
});

$(function(){
    $('.preview-add-button').click(function(){
        var form_data = {};
        form_data["code"] = $('.payment-form input[name="code"]').val();
        form_data["desc"] = $('.payment-form input[name="desc"]').val();
        form_data["concept"] = $('.payment-form input[name="concept"]').val();
        form_data["description"] = $('.payment-form input[name="description"]').val();
        form_data["amount"] = parseFloat($('.payment-form input[name="amount"]').val()).toFixed(2);
        form_data["status"] = $('.payment-form #status option:selected').text();
        form_data["date"] = $('.payment-form input[name="date"]').val();
        form_data["remove-row"] = '<span class="glyphicon glyphicon-remove"></span>';
        var row = $('<tr></tr>');
        $.each(form_data, function( type, value ) {
            $('<td class="input-'+type+'"></td>').html(value).appendTo(row);
        });
        $('.preview-table > tbody:last').append(row); 
        calc_total();
    });  
});
</script> -->
  </body>
</html>
