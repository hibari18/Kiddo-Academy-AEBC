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
$studid=$_POST['txtstud'];
$query=mysqli_query($con, "select s.tblStudentId, concat(si.tblStudInfoLname, ', ', si.tblStudInfoFname, ' ', si.tblStudInfoMname) as studentname, s.tblStudent_tblLevelId from tblstudent s, tblstudentinfo si where s.tblStudentId=si.tblStudInfo_tblStudentId and s.tblStudentFlag=1 and si.tblStudInfoFlag=1 and s.tblStudentId='$studid'");
$row=mysqli_fetch_array($query);
$studname=$row['studentname'];
$lvlid=$row['tblStudent_tblLevelId'];
?>
<!DOCTYPE html>
<html>

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Kiddo Academy SIS</title>
    <link rel="icon" type="image/gif" href="images/School Logo/symbol.png"/>
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

         <!-- sweetalert -->
         <script src="sweetalert-master/dist/sweetalert-dev.js"></script>
         <link rel="stylesheet" href="sweetalert-master/dist/sweetalert.css">

    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="formwizard2.css">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">
    <style>
      body {
        font-family: 'Noto Sans', sans-serif;
        font-weight: bold;
      }

      fieldset{
        border: 1px solid black;
      }
    </style>
    <script>
    function changeBillingLevel()
    {
      var xmlhttp =  new XMLHttpRequest();
      xmlhttp.open("GET","changeTblBilling.php?selLevel="+document.getElementById("selLevel").value,false);
      xmlhttp.send(null);

      document.getElementById("datatable1").innerHTML=xmlhttp.responseText;

    }
    function addFields()
    {
      var xmlhttp =  new XMLHttpRequest();
      xmlhttp.open('GET','billAdd.php?type='+document.querySelector('input[name="r1"]:checked').value+'&selFee='+document.getElementById('selFee').value,false);
      xmlhttp.send(null);

      document.getElementById("fg1").innerHTML=xmlhttp.responseText;

    }
    function appendScheme(i)
    {
      var level = document.getElementById("txtlvlid").value;
      var objtofld = document.getElementById("fldst2");
      var divingr = document.createElement("div");
      var xmlhttp =  new XMLHttpRequest();
      xmlhttp.open("GET","showScheme.php?optionalfees="+i.value+"&level="+level,false);
      xmlhttp.send(null);
      // document.getElementById("fldst").innerHTML=xmlhttp.responseText;
      divingr.innerHTML =xmlhttp.responseText
      objtofld.appendChild(divingr);
    }
    </script>
    <script>
  function showSchemeDetail(i)
  {
    var level = document.getElementById("txtlevelid").value;
    var xmlhttp =  new XMLHttpRequest();
      xmlhttp.open('GET','showScheme2.php?scheme='+i.value+'&level='+level,false);
      xmlhttp.send(null);

      document.getElementById("datatable2").innerHTML=xmlhttp.responseText;
  }
  function showSchemeDetail2(i)
  {
    var level = document.getElementById("txtlvlid").value;
    var xmlhttp =  new XMLHttpRequest();
      xmlhttp.open('GET','showScheme2.php?scheme='+i.value+'&level='+level,false);
      xmlhttp.send(null);

      document.getElementById("datatable3").innerHTML=xmlhttp.responseText;
  }
  function getSession(x)
  {
    document.getElementById("session").value=x.value;
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
          echo "<script> swal('Student succesfully enrolled!', ' ', 'success'); </script>";
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
                      <!--<?php echo $namess ?>-->
                      <small><?php echo $rolename ?></small>
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                   <!-- <div class="pull-left">
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
        <section class="content-header">

        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <div class="box box-default"  style="margin-top: 10px">
                <div class="box-body">
                  <div class="nav-tabs-custom">
                    <div class="box-header with-border">
                    <h2 class="box-title" style="font-size:25px; margin-top: 10px">ENROLLMENT</h2>
                    <h4 style="margin-top: 3%">Student Name: <?php echo $studname ?></h4>
                  </div>


                  <div class="tab-content">


                    <div class="tab-pane active" id="tab_1">
                          <form method="post" action="changeEnrollScheme.php">
                          <div class="box-body">
                            <span style="color: rgba(255, 0, 0, 0.9); padding:5%;">* <span style="color: rgba(0, 0, 0, 0.9) ; font-size: 12px;">Indicates required fields</span></span>
                            <div class="col-md-12"  style="margin-top: 3%">
                              <!-- <button type="button" class="btn btn-success" name="billAdd" id="billAdd" onclick="addField();">Add Additional Fee</button> -->

                                  <div>
                                  <input type="hidden" value="<?php echo $studid ?>" name="txtstudid" id="txtstudid" />
                                  <input type="hidden" value="<?php echo $lvlid ?>" name="txtlvlid" id="txtlvlid" />
                                  <input type="hidden" value="None" name="selSchemeOpt" id="selSchemeOpt" />
                                  <label>Session:<span style="color:red; padding:5%;">*</span></label>
                                  <input required type="radio" name="s1" id="s1" value="MORNING" style="margin-left: 3%" onclick="getSession(this)"/> Morning
                                  <input type="radio" name="s1" id="s2" value="AFTERNOON" onclick="getSession(this)"/> Afternoon
                                </div>
                                
                              
                                <div class="row" style="margin-top: 3%">
                                  <div class="col-md-6">
                                    <fieldset style="margin: 5px; margin-left: -7px; height: 50%">
                                      <h4 style="font-weight: bold; padding: 3px; margin-left: 2%">Mandatory</h4>
                                      <hr>
                                      <table class="table"><thead>
                                            <th>Fee Name</th><th>Due Date</th><th>Amount on Due Date</th></thead><tbody>
                                      <?php
                                        
                                        $query="select * from tblfee where tblFeeMandatory='Y' and tblFeeFlag=1";
                                        $result=mysqli_query($con, $query);
                                        while($row=mysqli_fetch_array($result)):
                                        ?>
                                        <tr><td>
                                          <?php echo $row['tblFeeName'] ?>
                                        </td>
                                          <?php
                                          $feetype=$row['tblFeeType'];
                                          if($feetype=='GENERAL FEE')
                                          {
                                          ?>
                                          <td><?php echo $row['tblFeeDueDate'] ?></td>
                                          <td><?php echo $row['tblFeeAmnt'] ?></td>
                                          <?php
                                          }else if($feetype=='SPECIFIC FEE')
                                          {?>
                                            <td colspan="2"><button type="button" class="btn btn-info view_section" data-toggle="modal" data-target="#mdlBreakdown" data-id="<?php echo $row['tblFeeId'] ?>">View Fee Breakdown</button></td>
                                          <?php } 
                                          ?>  
                                          </tr>                                        
                                      <?php endwhile; ?>
                                      </tbody></table>
                                    </fieldset>
                                  </div>
                                    <div class="col-md-6">
                                    <fieldset style="margin: 5px; margin-left: -7px;">
                                      <h4 style="font-weight: bold; padding: 3px; margin-left: 2%">Optional</h4>
                                      <hr>
                                     
                                          <table id="datatable5" class="table"><thead>
                                            <th>Fee Name</th><th>Due Date</th><th>Amount on Due Date</th></thead><tbody>
                                      <?php
                                        
                                        $query="select * from tblfee where tblFeeMandatory='N' and tblFeeFlag=1";
                                        $result=mysqli_query($con, $query);
                                        while($row=mysqli_fetch_array($result)):
                                        ?>
                                        <tr><td>
                                          <input type="checkbox" class="optionalfees" name="optionalfees[]" id="optionalfees" value="<?php echo $row['tblFeeId'] ?>" onclick="appendScheme(this)" /> <?php echo $row['tblFeeName'] ?>
                                        </td>
                                          <?php
                                          $feetype=$row['tblFeeType'];
                                          if($feetype=='GENERAL FEE')
                                          {
                                          ?>
                                          <td><?php echo $row['tblFeeDueDate'] ?></td>
                                          <td><?php echo $row['tblFeeAmnt'] ?></td>
                                          <?php
                                          }else if($feetype=='SPECIFIC FEE')
                                          {?>
                                            <td colspan="2"><button type="button" class="btn btn-info view_section" data-toggle="modal" data-target="#mdlBreakdown" data-id="<?php echo $row['tblFeeId'] ?>" data-title="<?php echo $lvlid?>">View Fee Breakdown</button></td>
                                          <?php } 
                                          ?>  
                                          </tr>                                        
                                      <?php endwhile; ?>
                                      </tbody></table>
                                      
                                    </fieldset>
                                  </div>
                          <div class="modal fade" id="mdlBreakdown" role="dialog">
                          <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h3 class="modal-title" style="font-style: bold"><span id="view_students_title"></span></h3>
                              </div>
                                <div class="modal-body">
                                  <div class="box-body table-responsive no-padding" style="margin-top: 2%">
                                    <div class="form-group">
                                      
                                      <label>Fee Breakdown:</label>
                                        <textarea class="form-control" name="section_student_list" id="section_student_list" cols="50" rows="10" readonly style="resize: none;"></textarea>
                                    </div>
                                  </div>
                                </div>
                                <div class="modal-footer" style="float: center">
                                  <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                                </div>
                              
                            </div>

                          </div>
                        </div>

                                  <div class="col-md-12" style="margin-top: 3%">
                                    <h4 style="font-weight: bold">Schemes</h4>
                                        
                                        <h4 style="margin-top: 2%">Mandatory</h4>
                                        <fieldset style="margin-top: 2%; padding: 5px" id="fldst">
                                        <?php
                                        $query="select * from tblfee where tblFeeMandatory='Y' and tblFeeFlag=1";
                                        $result=mysqli_query($con, $query);
                                        while($row=mysqli_fetch_array($result)):
                                          $feeid=$row['tblFeeId'];
                                          $query1=$con->query("select * from tblscheme where tblScheme_tblFeeId='$feeid' and tblSchemeFlag=1");
                                          if($query1->num_rows >=1 )
                                          {
                                        ?> 
                                        <div><input type="hidden" value="<?php echo $lvlid ?>" name="txtlvlid" id="txtlvlid" />
                                          <label> <?php echo $row['tblFeeName'] ?></label><span style="color:red; padding:5%;">*</span>
                                          <select class="form-control" name="selSchemeMand[]" id="selSchemeMand" style="width: 30%;" onchange="showSchemeDetail2(this)">
                                            <option disabled selected value="0">--Select Scheme --</option>
                                            <?php
                                            $query2=mysqli_query($con, "select * from tblscheme where tblScheme_tblFeeId='$feeid' and tblSchemeFlag=1");
                                            while($row2=mysqli_fetch_array($query2))
                                            { 
                                              $schemeid=$row2['tblSchemeId'];
                                              ?>
                                              <option value="<?php echo $row2['tblSchemeId'] ?>"><?php echo $row2['tblSchemeType'] ?></option>
                                            <?php } ?>
                                            ?>
                                          </select>
                                          <div style="margin-top: 5%; margin-bottom: 5%">
                                             <table class="table table-bordered table-striped" id="datatable3">
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
                                          <!-- <table class="table table-bordered table-striped">
                                            <thead>
                                              <tr>
                                                <th>Level</th>
                                                <th>Order of Payment</th>
                                                <th>Due Date</th>
                                                <th>Amount</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                              $query3=mysqli_query($con, "select * from tblschemedetail where tblSchemeDetail_tblScheme='$schemeid' and tblSchemeDetailFlag=1 and tblSchemeDetail_tblLevel='$lvlid'");
                                              while($row3=mysqli_fetch_array($query3)):
                                                $query4=mysqli_query($con, "select * from tbllevel where tblLevelId='$lvlid' and tblLevelFlag=1");
                                                $row4=mysqli_fetch_array($query4);
                                                $lvlname=$row4['tblLevelName'];
                                            ?>
                                              <tr>
                                                <td><?php echo $lvlname ?></td>
                                                <td><?php echo $row3['tblSchemeDetailName'] ?></td>
                                                <td><?php echo $row3['tblSchemeDetailDueDate'] ?></td>
                                                <td><?php echo $row3['tblSchemeDetailAmount'] ?></td>
                                              </tr>
                                            <?php endwhile; ?>
                                            </tbody>
                                          </table> -->
                                        </div>
                                        </div>
                                        <?php }endwhile; ?>
                                      
                                        </fieldset>
                                         <div><h4 style="margin-top: 2%">Optional</h4>
                                          <fieldset style="margin-top: 2%; padding: 5px" id="fldst2">
                                          </fieldset>
                                         </div>
                                        </div>
                                  </div>
                                </div>
                                
                                
                              </div>
                             
                             
                                 <div class="btn-group" style="margin-top: 5%; float: right">
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalEnrollment" style="margin-right: 15px; ">Proceed</button>
                                </div>

              <!-- Modal Enrollment -->
                <div class="modal fade" id="modalEnrollment" role="dialog">
                  <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title" id="deleteModalOne"> PROCEED </h4>
                        </div>
                        <div class="row" style="margin-top: 5%">
                        <div class="col-md-6">
                        <button type="submit" class="btn btn-info" name="btnSave" id="btnSave" href="changeEnrollScheme.php" style="float: right">Enroll Student</button>
                        </div>

                        <div class="col-md-6">
                          <form method="post" action="outputEnrollment.php" target="_blank">
                            <input type="hidden" value="<?php echo $session ?>" name="session">
                            <input type="hidden" id="date" name="date" value="<?php echo date('Y-m-d') ?>" />
                            <input type="hidden" value="<?php echo $studname ?>" name="studname">
                            <input type="hidden" value="<?php echo $studid ?>" name="studid">
                            
                              
                          </form>
                        </div>
                        <div class="col-md-6">
                        <form method="post" action="outputEnrollment.php" target="_blank">
                                <input type="hidden" value="<?php echo $session ?>" name="session" id="session">
                            <input type="hidden" id="date" name="date" value="<?php echo date('Y-m-d') ?>" />
                            <input type="hidden" value="<?php echo $studname ?>" name="studname">
                            <input type="hidden" value="<?php echo $studid ?>" name="studid">
                            <input type="hidden" value="<?php echo $lvlid ?>" name="txtlevel">
                          <button type="submit" class="btn btn-primary" name="btnbtn" id="btnbtn" style="margin-top: 3%;" target="_blank">Print Voucher</button>
                        </form>
                      </div>
                        </div>
                        <div class="modal-footer" style="margin-top: 5%; float: center">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                  </div>
                </div>
                <!--modal end-->
                          </form>

                            </div>
                          </div>
                    </div> <!-- tab_1 -->

                  </div> <!-- tab content -->
                  </div>
                </div> <!-- nav -->
                </div> <!-- box body -->
              </div> <!-- box- box-default-->
            </div> <!-- col-md-12 -->
          </div> <!-- row -->
        </section>
      </div>
      <!-- /.content-wrapper -->

      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> Last na please
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
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

    <!-- Sweetalert -->
    <script src="js/sweetalert.min.js"></script>

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

      $('.view_section').click(function(e){
            var id = $(this).attr('data-id');
            var lvl = $('#txtlvlid').val();
            // $('#view_students_title').text($(this).attr('data-title'));
            
            $.ajax({
                type: 'GET',  
                url: 'showFeeBreakdown.php',
                data: {
                  id: id,
                  level: lvl
                },
                dataType: 'html',
                success: function(data) {
                  console.log(data);
                  $('#section_student_list').val(data);
                },
                error: function (data) {
                    console.log(data);
                    $('#section_student_list').val(data.responseText);
                }
            });
          });

    });
    </script>

  </body>
</html>
