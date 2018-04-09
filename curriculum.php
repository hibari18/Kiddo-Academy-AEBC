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
    <link rel="stylesheet" href="css/adminLTEcss/AdminLTE.min.css">
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

    <link rel="stylesheet" type="text/css" href="css/formwizard2.css">

    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="css/select2.min.css">

    <!-- sweetalert -->
    <script src="sweetalert-master/dist/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="sweetalert-master/dist/sweetalert.css">
    <link rel="stylesheet" type="text/css" href="css/sweetalert.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- Validations Keme -->
    <link rel="stylesheet" type="text/css" href="css/validDesignCurriculum.css">
    <link rel="stylesheet" type="text/css" href="css/validDesignSubject.css">
    <link rel="stylesheet" type="text/css" href="css/validDesignLevel.css">
    <link rel="stylesheet" type="text/css" href="css/validDesignDetails.css">
    <link rel="stylesheet" type="text/css" href="css/validDesignDivision.css">

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">
    <style>
      body {
        font-family: 'Noto Sans', sans-serif;
        font-weight: bold;
        padding-right: 0 !important }
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
      //CURRICULUM
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
        var f1=document.getElementById('txtUpdCurrId');
        var f2=document.getElementById('txtUpdCurr');
        // var f3=document.getElementById('selUpdActive');
        var f4=document.getElementById('txtDelCurrId');
        var f5=document.getElementById('txtDetCurrId');
        f1.value=cells[0].innerHTML;
        f2.value=cells[1].innerHTML;
        // f3.value=cells[2].innerHTML;
        f4.value=cells[0].innerHTML;
        f5.value=cells[0].innerHTML;
      };
    }})();
    //CURRICULUM DETAIL
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
        var f1=document.getElementById('txtUpdDetCurrId');
        var f2=document.getElementById('txtUpdDetId');
        var f3=document.getElementById('txtUpdDetDivId');
        var f4=document.getElementById('txtUpdDetLvlId');
        var f5=document.getElementById('selUpdDetDiv');
        var f6=document.getElementById('selUpdDetLvl');
        var f7=document.getElementById('selUpdDetSubj');
        var f8=document.getElementById('txtUpdDetSubj');
        var f9=document.getElementById('txtDelDetId');
        f1.value=cells[0].innerHTML;
        f2.value=cells[1].innerHTML;
        f3.value=cells[2].innerHTML;
        f4.value=cells[3].innerHTML;
        f5.value=cells[4].innerHTML;
        f6.value=cells[5].innerHTML;
        f7.value=cells[6].innerHTML;
        f8.value=cells[7].innerHTML;
        f9.value=cells[1].innerHTML;
      };
    }})();
      //DIVISION
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
        f1.value=cells[0].innerHTML;
        f2.value=cells[1].innerHTML;
      };
    }})();
    //LEVEL
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
        var f1=document.getElementById('txtUpdLvlId');
        var f2=document.getElementById('txtUpdLvl');
        var f3=document.getElementById('selUpdLvlDiv');
        var f5=document.getElementById('txtDelLvlId');
        f1.value=cells[0].innerHTML;
        f2.value=cells[1].innerHTML; f3.value=cells[2].innerHTML;
        f5.value=cells[0].innerHTML;
      };
    }})();
    //SUBJECT
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
        document.getElementById("txtUpdSubjId2").disabled=true;
        var target=event.target||event.srcElement;
        while (target&&target.nodeName!='TR'){
          target=target.parentElement;
        }
        var cells=target.cells;

        if(!cells.length||target.parentNode.nodeName=='THEAD'){return;}
        var f1=document.getElementById('txtUpdSubjId');
        var f2=document.getElementById('txtUpdSubjId2');
        var f3=document.getElementById('txtUpdSubj');
        var f5=document.getElementById('txtDelSubjId');
        f1.value=cells[0].innerHTML;
        f2.value=cells[0].innerHTML;
        f3.value=cells[1].innerHTML;
        f5.value=cells[0].innerHTML;
      };
    }})();
    </script>
  </head>

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
        echo "<script> swal('Deletion Failed. Curriculum is in use', ' ', 'error'); </script>";
      }
      if($message == 8) {
        echo "<script> swal('Deletion Failed. Level is in use', ' ', 'error'); </script>";
      }
      if($message == 9) {
        echo "<script> swal('Deletion Failed. Subject is in use', ' ', 'error'); </script>";
      }
    ?>


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
                     <!--  <?php echo $namess ?> -->
                      <small><?php echo $rolename ?></small>
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <!-- <div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat">Profile</a>
                    </div> -->
                    <div class="pull-right">
                      <a href="#" class="btn btn-default btn-flat">Logout</a>
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
              <div class="box box-default" style="margin-top: 25px">
                <div class="box-body">
                  <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs" id="myTab">
                      <li class="active"><a href="#tab_1" data-toggle="tab">Curriculum</a></li>
                      <li><a href="#tab_2" data-toggle="tab">Level</a></li>
                      <li><a href="#tab_3" data-toggle="tab">Subject</a></li>
                      <!-- <li><a href="#tab_4" data-toggle="tab">Curriculum Details</a></li> -->
                    </ul>



                  <div class="tab-content">


                  <div class="tab-pane fade in active" id="tab_1" style="padding: 3% 3%;">
                    <div class="btn-group" style="margin-bottom: 3%;">
                      <button id="addCurrName" type="reset" class="btn btn-info" onclick="myFunction()" value="Reset form" data-toggle="modal" data-target="#addModalOne"><i class="fa fa-plus"></i>Add</button>
                    </div>

                  <!-- Modal starts here-->

                  <!-- Add Modal -->
                  <div class="modal fade" id="addModalOne" role="dialog">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <form autocomplete="off" data-toggle="validator" method="post" action="actionCurriculum.php" name="addCurriculum" id="addCurriculum" class="form-horizontal">
                          <div class="modal-header">
                              <h4 class="modal-title" id="myModalLabel"> ADD CURRICULUM </h4>
                          </div>

                          <div class="modal-body">

                            <div class="form-group" style="margin-top: 7%;">
                              <label class="col-sm-4 control-label">Curriculum Name</label>
                              <div class="col-sm-6 ">
                                <div class = "input-group selectContainer" style="width:100%;">
                                  <input type="text" class="form-control" name="txtAddCurr" id="txtAddCurr" style="text-transform:uppercase ;" />
                                </div>
                              </div>
                            </div>

                            <div class="modal-footer" style="margin-top: 7%">
                              <button type="submit" class="btn btn-info" name="btnAddCurr" id="btnAddCurr">Save</button>
                              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>

                  <!-- Update Modal -->
                  <div class="modal fade" id="updateModalOne">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <form autocomplete="off" data-toggle="validator" method="post" action="actionCurriculum.php" name="UpdCurriculum" id="UpdCurriculum" class="form-horizontal">
                          <div class="modal-header">
                              <h4 class="modal-title" id="myModalLabel"> UPDATE CURRICULUM </h4>
                          </div>

                          <div class="modal-body">

                            <div class="form-group" style="display: none;">
                              <label class="col-sm-4 control-label">Curriculum ID</label>
                              <div class="col-sm-6">
                                <div class = "input-group">
                                  <span class="input-group-addon"><i class="fa fa-list" aria-hidden="true"></i></span>
                                  <input type="text" id="txtUpdCurrId" name="txtUpdCurrId" class="form-control" readonly="" />
                                </div>
                              </div>
                            </div>

                            <div class="form-group" style="margin-top: 7%;">
                              <label class="col-sm-4 control-label">Curriculum Name</label>
                              <div class="col-sm-6 selectContainer">
                                <div class = "input-group" style="width:100%;">
                                  <input type="text" class="form-control" name="txtUpdCurr" id="txtUpdCurr" style="text-transform:uppercase ;">
                                </div>
                              </div>
                            </div>

                            <div class="modal-footer" style="margin-top: 7%">
                              <button type="submit" class="btn btn-info" name="btnUpdCurr" id="btnUpdCurr">Save</button>
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
                        <form method="POST" action="actionCurriculum.php" class="form-horizontal">
                          <div class="modal-header">
                            <h4 class="modal-title" id="deleteModalOne"> DELETE CURRICULUM </h4>
                          </div>

                          <div class="modal-body">
                            <div class="form-group" style="display: none;">
                              <label class="col-sm-4 control-label">Curriculum ID</label>
                              <div class="col-sm-5 input-group">
                                <span class="input-group-addon"><i class="fa fa-list" aria-hidden="true"></i></span>
                                <input type="text" name="txtDelCurrId" id="txtDelCurrId" readonly="" />
                              </div>
                            </div>

                            <div class="form-group">
                              <h4 align="center" style="margin-top: 5%">Are you sure you want to delete this record?</h4>
                            </div>
                          </div>

                          <div class="modal-footer" style="margin-top: 5%; float: center">
                            <button type="submit" class="btn btn-danger" name="btnDelCurr" id="btnDelCurr">Delete</button>
                            <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <!--modal delete end-->

                  <!--Curriculum Details-->
                  <div class="modal fade" id="detailModal" role="dialog">
                    <div class="modal-dialog">

                      <!-- Modal content-->
                      <div class="modal-content">
                        <form method="POST" action="actionCurriculum.php" class="form-horizontal">
                          <div class="modal-header">
                            <h4 class="modal-title"> UPDATE CURRICULUM DETAILS</h4>
                          </div>

                          <div class="modal-body">
                            <div class="form-group">

                                    <b><label class="col-sm-4 control-label"> Subject/s: </label></b>
                                    <div class="col-sm-6 selectContainer">
                                      <div class="input-group">
                                      <?php
                                        $query="select tblSubjectId, tblSubjectDesc from tblsubject where tblSubjectFlag=1";
                                        $result=mysqli_query($con, $query);
                                        while($row=mysqli_fetch_array($result)):
                                      ?>
                                        <input type="checkbox" name="chkDetSubjId[]" id="chkDetSubjId" value="<?php echo $row['tblSubjectId'] ?>"><?php echo $row['tblSubjectId'] ?><br />
                                      <?php endwhile; ?>
                                      </div>
                                    </div>
                                    <input type="hidden" name="txtDetCurrId" id="txtDetCurrId" />
                              </div>
                          </div>

                          <div class="modal-footer" style="margin-top: 5%; float: center">
                            <button type="submit" class="btn btn-success" name="btnUpdDet" id="btnUpdDet">Update</button>
                            <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <!--modal detail end-->

                  <table id="datatable" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th hidden></th>
                        <th>Curriculum Name</th>
                        <th>Action</th>
                      </tr>
                    </thead>

                    <tbody>
                      <?php
                      $query = "select * from tblcurriculum where tblCurriculumFlag=1";
                      $result = mysqli_query($con, $query);
                      while($row = mysqli_fetch_array($result))
                      {
                      ?>
                      <tr>
                        <td style="width:100px;" hidden><?php echo $row['tblCurriculumId'] ?></td>
                        <td style="width:100px;"><?php echo $row['tblCurriculumName'] ?></td>
                        <td style="width:100px;">
                          <button type="button" class="btn btn-success" data-toggle="modal" data-target="#detailModal">Update Details</button>
                          <button type="button" class="btn btn-success" data-toggle="modal" data-target="#updateModalOne"><i class="fa fa-edit"></i></button>
                          <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModalOne"><i class="fa fa-trash"></i></button>
                        </td>
                      </tr>
                        <?php } ?>
                    </tbody>
                  </table>

                  </div><!-- /.tab-pane tab_1 -->




                  <div class="tab-pane fade" id="tab_2" style="padding: 3%">
                      <div class="btn-group" style="margin-bottom: 3%">
                        <button type="button" class="btn btn-info" data-toggle="modal" onclick="myFunction()" value="Reset form" data-target="#addModalFour"><i class="fa fa-plus"></i>Add</button>
                      </div>

                  <!-- Modal starts here-->


                  <!-- Add Modal -->
                  <div class="modal fade" id="addModalFour" role="dialog">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <form autocomplete="off" id = "addLevel" name="addLevel" role="form" method="POST" action="actionCurriculum.php" class="form-horizontal">
                          <div class="modal-header">
                            <h4 class="modal-title" id="addModalFour"> ADD LEVEL </h4>
                          </div>

                          <div class="modal-body">

                            <div class="form-group" style="margin-top:7%">
                              <b><label class="col-sm-4 control-label"> Level Name </label></b>
                              <div class="col-sm-6 selectContainer">
                                <div class="input-group" style="width:100%;">
                                  <input type="text" class="form-control" name="txtAddLvl" id="txtAddLvl" style="text-transform:uppercase ;">
                                </div>
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="col-sm-4 control-label"> Division </label>
                              <div class="col-sm-6 selectContainer">
                                <div class="input-group">
                                  <div class="input-group-addon">
                                    <i class="fa fa-users" aria-hidden="true"></i>
                                  </div>
                                  <select class="form-control choose" style="width: 100%;" name="selAddLvlDiv" id="selAddLvlDiv">
                                    <option selected="selected" value="">--Select Division--</option>
                                    <?php
                                    $query = "select * from tbldivision where tblDivisionFlag = 1";
                                    $result = mysqli_query($con, $query);
                                    while($row = mysqli_fetch_array($result))
                                    {
                                    ?>
                                      <option value="<?php echo $row['tblDivisionId'] ?>"><?php echo $row['tblDivisionName'] ?></option>
                                    <?php } ?>
                                  </select>
                                </div>
                              </div>
                            </div>

                            <div class="modal-footer" style="margin-top: 7%">
                              <button type="submit" class="btn btn-info" name="btnAddLvl" id="btnAddLvl">Save</button>
                              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>

                  <!-- Update Modal -->
                  <div class="modal fade" id="updateModalFour">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <form autocomplete="off" data-toggle="validator" role="form" action="actionCurriculum.php" method="post" name="UpdLevel" id="UpdLevel" class="form-horizontal">
                          <div class="modal-header">
                              <h4 class="modal-title" id="myModalLabel"> UPDATE LEVEL </h4>
                          </div>

                          <div class="modal-body">

                            <div class="form-group" style="display: none;">
                              <label class="col-sm-4 control-label">Level ID</label>
                              <div class="col-sm-6">
                                <div class = "input-group">
                                  <span class="input-group-addon"><i class="fa fa-list" aria-hidden="true"></i></span>
                                  <input type="text" class="form-control" name="txtUpdLvlId" id="txtUpdLvlId" readonly="">
                                </div>
                              </div>
                            </div>

                            <div class="form-group" style="margin-top: 7%;">
                              <label class="col-sm-4 control-label">Level Name</label>
                              <div class="col-sm-6 selectContainer">
                                <div class = "input-group" style="width:100%;">
                                  <input type="text" class="form-control" name="txtUpdLvl" id="txtUpdLvl" style="text-transform:uppercase ;">
                                </div>
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="col-sm-4 control-label"> Division Name </label>
                              <div class="col-sm-6 selectContainer">
                                <div class="input-group">
                                  <div class="input-group-addon">
                                    <i class="fa fa-users" aria-hidden="true"></i>
                                  </div>

                                   <?php
                                $query = "select * from tbldivision where tblDivisionFlag = 1";
                                $result = mysqli_query($con, $query);
                                ?>
                                <select class="form-control choose" style="width: 100%;" name="selUpdLvlDiv" id="selUpdLvlDiv">
                               <option selected="selected">--Select Division--</option>
                                <?php
                                while($row = mysqli_fetch_array($result))
                                {
                                ?>
                                  <option><?php echo $row['tblDivisionName']; ?></option>
                                <?php } ?>
                                </select>
                                </div>
                              </div>
                            </div>

                            <div class="modal-footer" style="margin-top: 7%">
                              <button type="submit" class="btn btn-info" name="btnUpdLvl" id="btnUpdLvl">Save</button>
                              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>

                  <!-- Delete Modal -->
                  <div class="modal fade" id="deleteModalFour" role="dialog">
                    <div class="modal-dialog">

                      <!-- Modal content-->
                      <div class="modal-content">
                         <form method = "post" action = "actionCurriculum.php">
                          <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel"> DELETE LEVEL </h4>
                          </div>

                          <div class="modal-body">
                            <div class="form-group" style="display: none;">
                              <label class="col-sm-4 control-label">Subject ID</label>
                              <div class="col-sm-5 input-group">
                                <span class="input-group-addon"><i class="fa fa-list" aria-hidden="true"></i></span>
                                <input type="text" name="txtDelSubjId" id="txtDelSubjId" readonly="" />
                                <input type="text" name="txtDelLvlId" id="txtDelLvlId" readonly="" />
                              </div>
                            </div>

                            <div class="form-group">
                              <h4 align="center" style="margin-top: 5%">Are you sure you want to delete this record?</h4>
                            </div>
                          </div>

                          <div class="modal-footer" style="margin-top: 5%; float: center">
                            <button type="submit" class="btn btn-danger" name="btnDelLvl" id="btnDelLvl">Delete</button>
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
                        <th hidden></th>
                        <th>Level Name</th>
                        <th>Division</th>
                        <th>Action</th>
                      </tr>
                    </thead>

                    <tbody>
                      <?php
                      $query = "select l.tblLevel_tblDivisionId, l.tblLevelId, l.tblLevelName, d.tblDivisionName, l.tblLevelActive from tbllevel l, tbldivision d where tblLevelFlag = 1 and l.tblLevel_tblDivisionId = d.tblDivisionId order by d.tblDivisionId";
                      $result = mysqli_query($con, $query);
                      while($row = mysqli_fetch_assoc($result))
                      {
                      ?>
                      <tr>
                        <td hidden><?php echo $row['tblLevelId'] ?></td>
                        <td><?php echo $row['tblLevelName'] ?></td>
                        <td><?php echo $row['tblDivisionName'] ?></td>
                        <td><button type="button" class="btn btn-success" data-toggle="modal" data-target="#updateModalFour"><i class="fa fa-edit"></i></button>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModalFour"><i class="fa fa-trash"></i></button></td>
                      </tr>
                        <?php } ?>
                    </tbody>
                  </table>

                  </div> <!--tab-pane fade tab_3 -->



                  <div class="tab-pane fade" id="tab_3" style="padding: 3%">
                    <div class="btn-group" style="margin-bottom: 3%">
                      <button type="button" class="btn btn-info" data-toggle="modal"  onclick="myFunction()" value="Reset form" data-target="#addModalFive"><i class="fa fa-plus"></i>Add</button>
                    </div>


                    <div class="modal fade" id="addModalFive" role="dialog">
                      <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                          <form autocomplete="off" method="post" action="actionCurriculum.php" data-toggle="validator" role="form" name="addSubject" id="addSubject" class="form-horizontal">
                                <div class="modal-content col-sm-12">
                                  <div class="modal-header">
                                    <h4 class="modal-title"> ADD SUBJECT </h4>
                                  </div>

                                    <div class="form-group" style="margin-top:7%">
                                      <b><label class="col-sm-4 control-label"> Subject Code </label></b>
                                      <div class="col-sm-6 selectContainer">
                                        <div class="input-group" style="width:100%;">
                                          <input type="text" class="form-control" name="txtAddSubjId" id="txtAddSubjId" style="text-transform:uppercase ;">
                                        </div>
                                      </div>
                                    </div>

                                    <div class="form-group">
                                      <b><label class="col-sm-4 control-label"> Subject Name </label></b>
                                      <div class="col-sm-6 selectContainer">
                                        <div class="input-group" style="width:100%;">
                                          <input type="text" class="form-control" name="txtAddSubj" id="txtAddSubj" style="text-transform:uppercase ;">
                                        </div>
                                      </div>
                                    </div>

                                    <div class="form-group">
                                      <b><label class="col-sm-4 control-label"> Level/s: </label></b>
                                      <div class="col-sm-6 selectContainer">
                                        <div class="input-group" style="width:100%;">
                                        <?php
                                          $query="select tblLevelId, tblLevelName from tbllevel where tblLevelFlag=1";
                                          $result=mysqli_query($con, $query);
                                          while($row=mysqli_fetch_array($result)):
                                        ?>
                                          <input type="checkbox" name="chkAddLvlId[]" id="chkAddLvlId" value="<?php echo $row['tblLevelId'] ?>"><?php echo $row['tblLevelName'] ?><br />
                                        <?php endwhile; ?>
                                        </div>
                                      </div>
                                    </div>

                                    <div class="modal-footer" style="margin-top:7%;">
                                      <button type="submit" class="btn btn-info" name="btnAddSubj" id="btnAddSubj">Save</button>
                                      <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </form>
                          </div>
                        </div>
                      </div>

                      <!-- Update Modal -->
                      <div class="modal fade" id="updateModalFive">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <form autocomplete="off" method="post" action="actionCurriculum.php" name="UpdSubject" id="UpdSubject" class="form-horizontal">
                              <div class="modal-header">
                                  <h4 class="modal-title" id="myModalLabel"> UPDATE SUBJECT </h4>
                              </div>

                              <div class="modal-body">

                                <div class="form-group" style="display: none;">
                                  <label class="col-sm-4 control-label">Curriculum ID</label>
                                  <div class="col-sm-6">
                                    <div class = "input-group">
                                      <span class="input-group-addon"><i class="fa fa-list" aria-hidden="true"></i></span>
                                      <input type="text" class="form-control" name="txtUpdSubjId" id="txtUpdSubjId" readonly="">
                                    </div>
                                  </div>
                                </div>

                                <div class="form-group" style="margin-top: 7%;">
                                  <label class="col-sm-4 control-label">Subject Code</label>
                                  <div class="col-sm-6 selectContainer">
                                    <div class = "input-group" style="width:100%;">
                                      <input type="text" class="form-control" name="txtUpdSubjId2" id="txtUpdSubjId2" style="text-transform:uppercase ;">
                                    </div>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label class="col-sm-4 control-label">Subject Name</label>
                                  <div class="col-sm-6 selectContainer">
                                    <div class = "input-group" style="width:100%;">
                                       <input type="text" class="form-control" name="txtUpdSubj" id="txtUpdSubj" style="text-transform:uppercase;" maxlength="20">
                                    </div>
                                  </div>
                                </div>

                                <div class="form-group">
                                        <b><label class="col-sm-4 control-label"> Level/s: </label></b>
                                        <div class="col-sm-6 selectContainer">
                                          <div class="input-group" style="width:100%;">
                                          <?php
                                            $query="select tblLevelId, tblLevelName from tbllevel where tblLevelFlag=1";
                                            $result=mysqli_query($con, $query);
                                            while($row=mysqli_fetch_array($result)):

                                          ?>
                                            <input type="checkbox" name="chkUpdLvlId[]" id="chkUpdLvlId" value="<?php echo $row['tblLevelId'] ?>"><?php echo $row['tblLevelName'] ?><br />
                                          <?php endwhile; ?>
                                          </div>
                                        </div>
                                      </div>

                                <div class="modal-footer" style="margin-top: 7%">
                                  <button type="submit" class="btn btn-info" name="btnUpdSubj" id="btnUpdSubj">Save</button>
                                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>

                     <!-- Delete Modal -->
                      <div class="modal fade" id="deleteModalFive" role="dialog">
                        <div class="modal-dialog">

                          <!-- Modal content-->
                          <div class="modal-content">
                             <form method = "post" action = "actionCurriculum.php">
                              <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel"> DELETE SUBJECT </h4>
                              </div>

                              <div class="modal-body">
                                <div class="form-group" style="display: none;">
                                  <label class="col-sm-4 control-label">Subject ID</label>
                                  <div class="col-sm-5 input-group">
                                    <span class="input-group-addon"><i class="fa fa-list" aria-hidden="true"></i></span>
                                    <input type="text" name="txtDelSubjId" id="txtDelSubjId" readonly="" />
                                  </div>
                                </div>

                                <div class="form-group">
                                  <h4 align="center" style="margin-top: 5%">Are you sure you want to delete this record?</h4>
                                </div>
                              </div>

                              <div class="modal-footer" style="margin-top: 5%; float: center">
                                <button type="submit" class="btn btn-danger" name="btnDelSubj" id="btnDelSubj">Delete</button>
                              <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    <!--modal delete end-->


                      <table id="datatable4" class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <th>Subject Code</th>
                            <th>Subject Name</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $query = "select * from tblsubject where tblSubjectFlag = 1";
                          $result = mysqli_query($con, $query);

                          while($row = mysqli_fetch_array($result))
                          {
                          ?>
                          <tr>
                            <td style="width:100px;"><?php echo $row['tblSubjectId']; ?></td>
                            <td style="width:100px;"><?php echo $row['tblSubjectDesc']; ?></td>
                            <td style="width:100px;"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#updateModalFive"><i class="fa fa-edit"></i></button>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModalFive"><i class="fa fa-trash"></i></button></td>
                          </tr>
                          <?php } ?>
                        </tbody>
                      </table>

                    </div> <!-- /.tab-pane tab_4-->



                    <div class="tab-pane fade" id="tab_4" style="padding: 3%">

                    <div class="form-inline">
                      <div class="container">
                        <form method="get">
                          <label>View by Curriculum: </label>
                            <select class="form-control" style="width: 30%" name="selCurrName" id="selCurrName" onchange="showDetail(); ">
                              <option selected>--Select Here--</option>
                                <?php
                                $query = "select tblCurriculumId, tblCurriculumName from tblcurriculum where tblCurriculumFlag=1";
                                $result = mysqli_query($con, $query);
                                while($row = mysqli_fetch_array($result))
                                {
                                  ?>
                              <option value="<?php echo $row['tblCurriculumId'] ?>"><?php echo $row['tblCurriculumName'] ?></option>
                                <?php } ?>
                            </select>
                              <div id="detail"></div>
                        </form>
                      </div>
                    </div>

                    <div class="btn-group" style="margin-bottom: 3%; margin-top: 1%">
                      <button type="button" class="btn btn-info" id="btnAdd" data-toggle="modal" data-target="#addModalTwo" disabled><i class="fa fa-plus"></i>Add</button>
                    </div>

                    <!-- Modal starts here-->


                    <!-- Add Modal-->
                    <div class="modal fade" id="addModalTwo" role="dialog">
                      <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <h3 class="modal-title" style="font-style: bold">Add Details</h3>
                          </div>

                          <form method="post" action="saveCurriculumDetail.php" data-toggle="validator" role="form" name="addCurrDetails" id="addCurrDetails">
                            <div class="modal-body">
                              <div class="form-group" style="margin-top: 5%">
                                <div><input type="hidden" name="txtAddDetCurr" id="txtAddDetCurr"/></div>
                                <label class="col-sm-4" style="text-align: right">Division</label>
                                  <div class="col-sm-7 selectContainer">
                                    <select class="form-control choose" style="width: 100%;" name="selAddDetDiv" id="selAddDetDiv" onchange="changeDiv();">
                                      <option disabled="disabled" selected="selected">--SELECT DIVISION--</option>
                                        <?php
                                        $query = "select * from tbldivision where tblDivisionFlag = 1";
                                        $result = mysqli_query($con, $query);
                                        while($row = mysqli_fetch_array($result))
                                        {
                                          ?>
                                      <option value="<?php echo $row['tblDivisionId']; ?>"><?php echo $row['tblDivisionName']; ?></option>
                                        <?php } ?>
                                    </select>
                                  </div>
                              </div>

                              <div class="form-group" style="margin-top: 15%">
                                <label class="col-sm-4" style="text-align: right">Level</label>
                                <div class="col-sm-7 selectContainer">
                                  <select class="form-control choose" style="width: 100%;" name="selAddDetLvl" id="selAddDetLvl" disabled>
                                    <option disabled="disabled" selected="selected">--SELECT LEVEL--</option>
                                      <?php
                                      $query = "select * from tbllevel where tblLevelFlag = 1";
                                      $result = mysqli_query($con, $query);
                                      while($row = mysqli_fetch_array($result))
                                      {
                                      ?>
                                    <option value="<?php echo $row['tblLevelId']; ?>"><?php echo $row['tblLevelName']; ?></option>
                                      <?php } ?>
                                  </select>
                                </div>
                              </div>

                              <div class="form-group" style="margin-top: 25%">
                                <label class="col-sm-4" style="text-align: right">Subject Code</label>
                                <div class="col-sm-7 selectContainer">
                                  <select class="required form-control choose" style="width: 100%;" name="selAddDetSubj" id="selAddDetSubj" onchange="passSubjName();">
                                    <option disabled="disabled" selected="selected">--SELECT SUBJECT CODE--</option>
                                      <?php
                                      $query = "select * from tblsubject where tblSubjectFlag = 1";
                                      $result = mysqli_query($con, $query);
                                      while($row = mysqli_fetch_array($result))
                                      {
                                        ?>
                                    <option value="<?php echo $row['tblSubjectId']; ?>"><?php echo $row['tblSubjectId']; ?></option>
                                        <?php } ?>
                                  </select>
                                </div>
                              </div>

                              <div class="form-group" style="margin-top: 35%">
                                <label class="col-sm-4" style="text-align: right">Subject Name</label>
                                  <div class="col-sm-7 selectContainer">
                                    <input type="text" class="form-control" name="txtAddDetSubj" id="txtAddDetSubj" disabled/>
                                  </div>
                              </div>
                            </div> <!--modal body after form-->

                            <div class="modal-footer" style="margin-top: 10%">
                              <button type="submit" class="btn btn-info" name="btnAddDet" id="btnAddDet">Save</button>
                              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                          </form>
                        </div> <!--modal content-->
                      </div> <!--modal dialog-->
                    </div> <!--modal fade-->


                    <!-- Update Modal -->
                    <div class="modal fade" id="updateModalTwo" role="dialog">
                      <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <h3 class="modal-title" style="font-style: bold">Update Curriculum Details</h3>
                          </div>

                          <form autocomplete="off" data-toggle="validator" role="form" method="post" action="updateCurriculumDetail.php" name="UpdCurrDetails" id="UpdCurrDetails">
                            <div class="modal-body">
                              <div class="form-group" style="margin-top: 5%">
                                <div><input type="hidden" name="txtUpdDetCurrId" id="txtUpdDetCurrId"/>
                                  <input type="hidden" name="txtUpdDetId" id="txtUpdDetId"/>
                                  <input type="hidden" name="txtUpdDetDivId" id="txtUpdDetDivId"/>
                                  <input type="hidden" name="txtUpdDetLvlId" id="txtUpdDetLvlId"/>
                                </div>

                                <label class="col-sm-4" style="text-align: right">Division</label>
                                  <div class="col-sm-7" selectContainer>
                                    <select class="form-control choose" style="width: 100%;" name="selUpdDetDiv" id="selUpdDetDiv" onchange="changeUpdDiv();">
                                      <option selected="selected">--SELECT DIVISION--</option>
                                        <?php
                                        $query = "select * from tbldivision where tblDivisionFlag = 1";
                                        $result = mysqli_query($con, $query);
                                        while($row = mysqli_fetch_array($result))
                                        {
                                          ?>
                                      <option value="<?php echo $row['tblDivisionName']; ?>"><?php echo $row['tblDivisionName']; ?></option>
                                        <?php } ?>
                                    </select>
                                  </div>
                              </div>

                              <div class="form-group" style="margin-top: 15%">
                                <label class="col-sm-4" style="text-align: right">Level</label>
                                <div class="col-sm-7 selectContainer">
                                  <select class="form-control choose" style="width: 100%;" name="selUpdDetLvl" id="selUpdDetLvl" disabled>
                                    <option selected="selected">--Select Level--</option>
                                      <?php
                                      $query = "select * from tbllevel where tblLevelFlag = 1";
                                      $result = mysqli_query($con, $query);
                                      while($row = mysqli_fetch_array($result))
                                      {
                                      ?>
                                    <option value="<?php echo $row['tblLevelName']; ?>"><?php echo $row['tblLevelName']; ?></option>
                                      <?php } ?>
                                  </select>
                                </div>
                              </div>

                              <div class="form-group" style="margin-top: 25%">
                                <label class="col-sm-4" style="text-align: right">Subject Code</label>
                                <div class="col-sm-7">
                                  <select class="form-control choose" style="width: 100%;" name="selUpdDetSubj" id="selUpdDetSubj" onchange="passSubjNameUpd();">
                                    <option selected="selected">--SELECT SUBJECT CODE--</option>
                                      <?php
                                      $query = "select * from tblsubject where tblSubjectFlag = 1";
                                      $result = mysqli_query($con, $query);
                                      while($row = mysqli_fetch_array($result))
                                      {
                                      ?>
                                    <option value="<?php echo $row['tblSubjectId']; ?>"><?php echo $row['tblSubjectId']; ?></option>
                                      <?php } ?>
                                  </select>
                                </div>
                              </div>

                              <div class="form-group" style="margin-top: 35%">
                                <label class="col-sm-4" style="text-align: right">Subject Name</label>
                                <div class="col-sm-7">
                                  <input type="text" class="form-control" name="txtUpdDetSubj" id="txtUpdDetSubj" disabled/>
                                </div>
                              </div>
                            </div> <!--modal body-->

                            <div class="modal-footer" style="margin-top: 10%">
                              <button type="submit" class="btn btn-info" name="btnUpdDet" id="btnUpdDet">Save</button>
                              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                          </form>
                        </div> <!--modal content-->
                      </div> <!--modal dialog-->
                    </div> <!--class modal fade-->


                    <!-- Delete Modal -->
                    <div class="modal fade" id="deleteModalTwo" role="dialog">
                      <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h3 class="modal-title" style="font-style: bold">Delete Detail</h3>
                          </div>

                          <form method="post" action="deleteCurriculumDetail.php">
                              <div class="modal-body">
                                <div class="box-body table-responsive no-padding"   style="margin-top: 2%">
                                  <div><input type="hidden" name="txtDelDetId" id="txtDelDetId"/></div>
                                  <div>
                                    <h4 align="center" style="margin-top: 5%">Are you sure you want to delete this record?</h4>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer" style="margin-top: 5%; float: center">
                              <button type="submit" class="btn btn-danger" name="btnDelDet" id="btnDelDet">Delete</button>
                              <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                            </div>
                          </form>
                        </div> <!--modal content-->
                      </div> <!--modal dialog-->
                    </div><!--modal fade delete-->

                    <table id="datatable1" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th hidden>Curriculum Id</th>
                          <th hidden>Detail Id</th>
                          <th hidden>Division Id</th>
                          <th hidden>Level Id</th>
                          <th>Division</th>
                          <th>Level</th>
                          <th>Subject Code</th>
                          <th>Subject Name</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                    </table>


                    </div><!-- /.tab-pane tab_5 -->

                      </div>
                    </div>
                    <!-- /.tab-content -->
                  </div>
                  <!-- nav-tabs-custom -->
                </div>
                <!-- box body -->
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

    </div>
    <!-- ./wrapper -->
    <script>
    function showDetail()
      {
        document.getElementById("btnAdd").disabled=false;
        var xmlhttp =  new XMLHttpRequest();
        xmlhttp.open("GET","changeTblCurrDetail.php?selCurrName="+document.getElementById("selCurrName").value,false);
        xmlhttp.send(null);

        document.getElementById("datatable1").innerHTML=xmlhttp.responseText;
        var currId = document.getElementById("selCurrName").value;
        document.getElementById("txtAddDetCurr").value = currId
      }
    function changeDiv()
      {
        document.getElementById('selAddDetLvl').disabled = false;
        var xmlhttp =  new XMLHttpRequest();
        xmlhttp.open("GET","changeDivCurriculumDetail.php?selAddDetDiv="+document.getElementById("selAddDetDiv").value,false);
        xmlhttp.send(null);

        document.getElementById("selAddDetLvl").innerHTML=xmlhttp.responseText;

      }
      function changeUpdDiv()
      {
        document.getElementById('selUpdDetLvl').disabled = false;
        var xmlhttp =  new XMLHttpRequest();
        xmlhttp.open("GET","changeDivUpdDetail.php?selUpdDetDiv="+document.getElementById("selUpdDetDiv").value,false);
        xmlhttp.send(null);

        document.getElementById("selUpdDetLvl").innerHTML=xmlhttp.responseText;

      }
    function passSubjName()
      {
        var xmlhttp =  new XMLHttpRequest();
        xmlhttp.open("GET","passSubjName.php?selAddDetSubj="+document.getElementById("selAddDetSubj").value,false);
        xmlhttp.send(null);

        document.getElementById("txtAddDetSubj").value=xmlhttp.responseText;

      }
    function passSubjNameUpd()
      {
        var xmlhttp =  new XMLHttpRequest();
        xmlhttp.open("GET","passSubjNameUpdDetail.php?selUpdDetSubj="+document.getElementById("selUpdDetSubj").value,false);
        xmlhttp.send(null);

        document.getElementById("txtUpdDetSubj").value=xmlhttp.responseText;

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
  <script>
    $(function () {
      $("#datatable").DataTable();
      $("#datatable1").DataTable();
      $("#datatable2").DataTable();
      $("#datatable3").DataTable();
      $("#datatable4").DataTable();
      $("#datatable5").DataTable();
    });
  </script>

  <script src='http://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.4.5/js/bootstrapvalidator.min.js'></script>

  <script>
   // <!--   Curriculum Validaions   -->
   $(document).ready(function() {
    $('#addCurriculum').bootstrapValidator({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            txtAddCurr: {
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

    $('#addModalOne')
       .on('shown.bs.modal', function () {
           $('#addCurriculum').find().focus();
        })
        .on('hidden.bs.modal', function () {
            $('#addCurriculum').bootstrapValidator('resetForm', true);
        });

  $('#UpdCurriculum').bootstrapValidator({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            txtUpdCurr: {
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
           $('#UpdCurriculum').find().focus();
        })
        .on('hidden.bs.modal', function () {
            $('#UpdCurriculum').bootstrapValidator('resetForm', true);
        });
});

   //  <!--   Division Validaions   -->
   $(document).ready(function() {
    $('#UpdDivision').bootstrapValidator({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            txtUpdDiv: {
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
                        message: 'Division name is required'
                    }
                }
            }
            }
        })

     .on('success.form.bv', function (e) {
        // Prevent form submission
        //e.preventDefault();
    });

    $('#updateModalThree')
       .on('shown.bs.modal', function () {
           $('#UpdDivision').find().focus();
        })
        .on('hidden.bs.modal', function () {
            $('#UpdDivision').bootstrapValidator('resetForm', true);
        });
});

   //  <!--   Level Validaions   -->
    $(document).ready(function() {
    $('#addLevel').bootstrapValidator({

        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            txtAddLvl: {
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
                        message: 'Level name is required'
                    }
                }
            },
            selAddLvlDiv: {
                validators: {
                  notEmpty: {
                      message: 'Division is required.'
                  },
                }
            },
            }
        })
        .on('success.form.bv', function (e) {
        // Prevent form submission
        //e.preventDefault();
    });

    $('#addModalFour')
       .on('shown.bs.modal', function () {
           $('#addLevel').find().focus();
        })
        .on('hidden.bs.modal', function () {
            $('#addLevel').bootstrapValidator('resetForm', true);
        });

    $('#UpdLevel').bootstrapValidator({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
           txtUpdLvl: {
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
                        message: 'Level name is required'
                    }
                }
            },
            selUpdLvlDiv: {
                validators: {
                  notEmpty: {
                      message: 'Division is required.'
                  },
                }
            },
            }
        })
         .on('success.form.bv', function (e) {
        // Prevent form submission
        //e.preventDefault();
    });

    $('#updateModalFour')
       .on('shown.bs.modal', function () {
           $('#UpdLevel').find().focus();
        })
        .on('hidden.bs.modal', function () {
            $('#UpdLevel').bootstrapValidator('resetForm', true);
        });
});

    //  <!--   Subject Validaions   -->
    $(document).ready(function() {
    $('#addSubject').bootstrapValidator({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            txtAddSubjId: {
                validators: {
                    stringLength: {
                        min: 3,
                        max: 50,
                        message: 'Please enter at least 3 characters'
                    },

                     regexp: {
                        regexp: /^[a-zA-Z_\w-][0-9a-zA-Z_\w-\s][\w-'\s]+$/,
                        message: 'The first character must be an alphabet or does not allow special character'
                    },
                        notEmpty: {
                        message: 'Subject code is required'
                    }
                }
            },
            txtAddSubj: {
                validators: {
                    stringLength: {
                        min: 3,
                        max: 100,
                        message: 'Please enter at least 3 characters'
                    },

                     regexp: {
                        regexp: /^[a-zA-Z_\w-][0-9a-zA-Z_\w-\s][\w-,'\s]+$/,
                        message: 'The first character must be an alphabet or does not allow special character'
                    },
                        notEmpty: {
                        message: 'Subject name is required'
                    }
                }
            },
            'chkAddLvlId[]':{
              validators:{
                choice: {
                    min: 1,
                    message: 'Check atleast 1 Level'
                }
              }
            },
            }
        })
           .on('success.form.bv', function (e) {
        // Prevent form submission
        //e.preventDefault();
    });

    $('#addModalFive')
       .on('shown.bs.modal', function () {
           $('#addSubject').find().focus();
        })
        .on('hidden.bs.modal', function () {
            $('#addSubject').bootstrapValidator('resetForm', true);
        });

        $('#UpdSubject').bootstrapValidator({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            txtUpdSubj: {
                validators: {
                    stringLength: {
                        min: 3,
                        max: 100,
                        message: 'Please enter at least 3 characters'
                    },

                     regexp: {
                        regexp: /^[a-zA-Z_\w-][0-9a-zA-Z_\w-\s][\w-,'\s]+$/,
                        message: 'The first character must be an alphabet or does not allow special character'
                    },
                        notEmpty: {
                        message: 'Curriculum name is required'
                    }
                }
            },
            'chkUpdLvlId[]':{
              validators:{
                choice: {
                    min: 1,
                    message: 'Check atleast 1 Level'
                }
              }
            }
            }
        })

     .on('success.form.bv', function (e) {
        // Prevent form submission
        //e.preventDefault();
    });

    $('#updateModalFive')
       .on('shown.bs.modal', function () {
           $('#UpdSubject').find().focus();
        })
        .on('hidden.bs.modal', function () {
            $('#UpdSubject').bootstrapValidator('resetForm', true);
        });
});

    //  <!--   Curriculum Details Validaions   -->
    $(document).ready(function() {
        $('#addCurrDetails').bootstrapValidator({
            feedbackIcons: {
              valid: 'glyphicon glyphicon-ok',
              invalid: 'glyphicon glyphicon-remove',
              validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
              selAddDetDiv: {
                validators: {
                  notEmpty: {
                    message: 'Division Name is required.'
                  },
                }
              },
              selAddDetLvl: {
                validators: {
                  notEmpty: {
                    message: 'Level Name is required.'
                  },
                }
              },
              selAddDetSubj: {
                validators: {
                  notEmpty: {
                    message: 'Subject is required.'
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
               $('#addCurrDetails').find().focus();
            })
            .on('hidden.bs.modal', function () {
                $('#addCurrDetails').bootstrapValidator('resetForm', true);
            });
    });

      document.querySelector('ul.examples li.timer button').onclick = function(){
      swal({
        title: "Auto close alert!",
        text: "I will close in 2 seconds.",
        timer: 2000,
        showConfirmButton: false
      });
    };

</script>

</body>
</html>
