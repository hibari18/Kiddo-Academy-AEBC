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
   <!-- daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">

    <!-- sweetalert -->
    <script src="sweetalert-master/dist/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="sweetalert-master/dist/sweetalert.css">

  <!-- iCheck for checkboxes and radio inputs -->
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <script>
/*  $(document).ready(function(){
    $("#btnUpdF").click(function(e){
      e.preventDefault();
      $.ajax({type: "POST",
        url: "try.php",
        data: {
        btn: $(this).val(), // < note use of 'this' here
        pId: $("#pId").val()},
        success: function(result)
        {
          alert('ok');
        }
        error: function(result)
        {
          alert('error');
        }
    })
    })*/
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
  ?>

<body class="hold-transition skin-green-light sidebar-mini">
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
          <p style="text-align: center; font-size: 14px; padding-top: 15px; color: white">Kiddo Academy Admission and Enrollment with Billing and Collection</p>
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

        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab">Personal Information</a></li>
              <li><a href="#tab_2" data-toggle="tab">Family Information</a></li>
              <li><a href="#tab_3" data-toggle="tab">Health History</a></li>
            </ul>
            <div class="tab-content">
              
  <div class="tab-pane active" id="tab_1">
    <div class="box">
      <div class="box-body">  
  <!-- left column -->
  <form class="form-horizontal" role="form" method="post" action="updatePersonalInfo.php" enctype="multipart/form-data">
      <?php
      if(isset($_POST['btnStud']))
      {
        $id = $_POST['txtStudId'];
        $query="select si.tblStudInfoFname, si.tblStudInfoLname, si.tblStudInfoMname, si.tblStudInfoBday, si.tblStudInfoBplace, si.tblStudInfoAddSt, si.tblStudInfoAddBrgy, si.tblStudInfoAddCity, si.tblStudInfoAddCountry, si.tblStudInfoGender, si.tblStudInfoReligion, si.tblStudInfoNationality, si.tblStudInfoLang1, si.tblStudInfoLang2, si.tblStudInfoImage from tblstudent s, tblstudentinfo si where s.tblStudentId = '$id' and s.tblStudentId = si.tblStudInfo_tblStudentId and s.tblStudentFlag = 1";
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_array($result);
        $fname = $row['tblStudInfoFname'];
        $lname = $row['tblStudInfoLname'];
        $mname = $row['tblStudInfoMname'];
        $bday = $row['tblStudInfoBday'];
        $bplace = $row['tblStudInfoBplace'];
        $addst = $row['tblStudInfoAddSt'];
        $addbrgy = $row['tblStudInfoAddBrgy'];
        $addcity = $row['tblStudInfoAddCity'];
        $addcountry = $row['tblStudInfoAddCountry'];
        $gender = $row['tblStudInfoGender'];
        $religion = $row['tblStudInfoReligion'];
        $nationality = $row['tblStudInfoNationality'];
        $lang1 = $row['tblStudInfoLang1'];
        $lang2 = $row['tblStudInfoLang2'];
        $studimg = $row['tblStudInfoImage'];
        $arrStud = array($fname, $lname, $mname, $bday, $bplace, $gender, $addst, $addbrgy, $addcity, $addcountry, $religion, $nationality, $lang1, $lang2);
        ?>
    <div class="col-md-4 col-sm-6 col-xs-12" style="margin-top: 5%">
      <div class="text-center">
        <img id="studpictureview" src="<?php echo $studimg ?>" class="avatar img-rounded img-reponsive img-thumbnail" alt="avatar">
       <!--  <img id="studpictureview" src="<?php echo $studimg ?>" class="avatar img-rounded img-reponsive" alt="Student's Photo"  style="height:180px;max-width:100%;"> -->
        <h6>Upload new photo</h6>
        <input type="file" class="text-center center-block well well-sm" name="file" id="file" accept="image/*" onchange="document.getElementById('studpictureview').src = window.URL.createObjectURL(this.files[0])">
        <!-- <input type="file" accept="image/*" style="margin-top:3%;" onchange="document.getElementById('studpictureview').src = window.URL.createObjectURL(this.files[0])" required> -->
      </div>
    </div>
    <!-- edit form column -->
    <div class="col-md-8 col-sm-6 col-xs-12 personal-info" style="margin-top: 4%">
        <input type="hidden" name="txtPerId" id="txtPerId" value="<?php echo $id ?>"/>
        <div class="form-group">
          <label class="col-lg-3 control-label">First name:</label>
          <div class="col-lg-7">
            <input class="form-control" type="text" name="txtPerFname" id="txtPerFname" value = "<?php echo $fname ?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-lg-3 control-label">Last name:</label>
          <div class="col-lg-7">
            <input class="form-control" type="text" name="txtPerLname" id="txtPerLname" value = "<?php echo $lname ?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-lg-3 control-label">Middle name:</label>
          <div class="col-lg-7">
            <input class="form-control" type="text" name="txtPerMname" id="txtPerMname" value = "<?php echo $mname ?>">
          </div>
        </div>
        <div class="form-group">
                <label class="col-lg-3 control-label">Birthday:</label>
                <div class="col-lg-7">
                  <input type="text" class="form-control" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask name="txtPerBday" id="txtPerBday" value = "<?php echo $bday ?>">
                </div>
       </div>
        <div class="form-group">
          <label class="col-lg-3 control-label">Birthplace:</label>
          <div class="col-lg-7">
            <input class="form-control" type="text" name="txtPerBplace" id="txtPerBplace" value = "<?php echo $bplace ?>">
          </div>
        </div>
        <div class="form-group">
        <label class="col-lg-3 control-label">Sex:</label>
          <div class="col-lg-7">
            <label class="radio-inline">
              <input type="radio" name="optradio" value="M" <?php echo($gender=='M')?'checked':'' ?>>Male
            </label>
            <label class="radio-inline">
              <input type="radio" name="optradio" value="F" <?php echo($gender=='F')?'checked':'' ?>>Female
            </label>
          </div>
        </div>
        <div class="form-group">
            <label class="col-lg-3 control-label left">Home Address:</label>
            <div class="col-lg-4">
              <input class="form-control" type="text" placeholder="Street Name/No." name="txtAddSt" id="txtAddSt" value = "<?php echo $addst ?>">
            </div>
            <div class="col-lg-3">
              <input class="form-control" type="text" placeholder="Brgy. Name/No." name="txtAddBrgy" id="txtAddBrgy" value = "<?php echo $addbrgy ?>">
            </div>
        </div>
          <div class="form-group">
            <label class="col-lg-3 control-label left"></label>
            <div class="col-lg-5">
              <input class="form-control" type="text" placeholder="City/Municipality" name="txtAddCity" id="txtAddCity" value = "<?php echo $addcity ?>">
            </div>
            <div class="col-lg-2">
              <input class="form-control" type="text" value="Philippines" name="txtAddCountry" id="txtAddCountry" value = "<?php echo $addcountry ?>">
            </div>
          </div>
        <div class="form-group">
                <label class="col-lg-3 control-label">Religion:</label>
                <div class="col-sm-7">
                <input class="form-control" type="text" name="txtReligion" id="txtReligion" value = "<?php echo $religion ?>">
                </div>
        </div>
        <div class="form-group">
                <label class="col-lg-3 control-label">Nationality:</label>
                <div class="col-sm-7">
                <input class="form-control" type="text" name="txtNationality" id="txtNationality" value = "<?php echo $nationality ?>">
                </div>
        </div>
        <div class="form-group">
        <label class="col-lg-3 control-label">First Language:</label>
              <div class="col-sm-7">
                <input class="form-control" type="text" name="txtlang1" id="txtlang1" value = "<?php echo $lang1 ?>">
              </div>
        </div>
        <div class="form-group">
        <label class="col-lg-3 control-label">Second Language:</label>
              <div class="col-sm-7">
                <input class="form-control" type="text" name="txtlang2" id="txtlang2" value = "<?php echo $lang2 ?>">
              </div>
        </div>
        <?php } ?>
      
      </div>
       <div class="btn-group" style="margin-top: 5%; float: right">
                      <button type="submit" class="btn btn-info" name="btnpersonal" id="btnpersonal">Save</button>

                    </div>
      
      </div>
      </div>
      <!-- /.box-body -->
      </form>
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="tab_2">
          <div class="box">
              <div class="box-body">
    <section>
        <div class="wizard">
            <div class="wizard-inner">
                <div class="connecting-line"></div>
                <ul class="nav nav-tabs" role="tablist">

                    <li role="presentation" class="active">
                        <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Step 1">
                            <span class="round-tab">
                                1
                            </span>
                        </a>
                    </li>

                    <li role="presentation" class="disabled">
                        <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Step 2">
                            <span class="round-tab">
                                2
                            </span>
                        </a>
                    </li>
                    <li role="presentation" class="disabled">
                        <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Step 3">
                            <span class="round-tab">
                                3
                            </span>
                        </a>
                    </li>

                    <li role="presentation" class="disabled">
                        <a href="#complete" data-toggle="tab" aria-controls="complete" role="tab" title="Complete">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-ok"></i>
                            </span>
                        </a>
                    </li>
                </ul>
            </div>

            <form class="form-horizontal" role="form" method="post" action="updateFamilyInfo.php">
            <?php $arr = array("hi","hello"); ?>
                <div class="tab-content" style="height: 110%">
                   
                    <div class="tab-pane active" role="tabpanel" id="step1">
                         <center><h3>Father</h3></center>
                        
                            <div class="row mar_ned">
                                
                            </div>
                      <!-- left column -->
                      <div class="col-md-4 col-sm-6 col-xs-12">
                      <div class="text-center">
                          <img src="<?php echo $fimg ?>" class="avatar img-circle img-thumbnail" alt="avatar">
                          <h6>Upload new photo</h6>
                          <input type="file" class="text-center center-block well well-sm" name="fatherfile" id="fatherfile">
                        </div>

                      </div>
                        <div class="col-md-8 col-sm-6 col-xs-12">
                        <div>
                        <?php
                      if(isset($_POST['btnStud']))
                      {

                        $id = $_POST['txtStudId'];
                        $query = "select p.tblParentId, p.tblParentLname, p.tblParentFname, p.tblParentMname, p.tblParentAddSt, p.tblParentAddBrgy, p.tblParentAddCity, p.tblParentAddCountry, p.tblParentTelNo, p.tblParentCpNo, p.tblParentOccupation, p.tblParentCompany, p.tblParentComAddSt, p.tblParentComAddBrgy, p.tblParentComAddCity, p.tblParentComAddCountry, p.tblParentWorkNo, p.tblParentEmail, p.tblParentImage from tblparent p, tblparentstudent ps where ps.tblParStud_tblStudentId = '$id' and p.tblParentId=ps.tblParStud_tblParentId and p.tblParentFlag = 1 and p.tblParentRelation = 'Father'";
                        $result = mysqli_query($con, $query);
                        $row = mysqli_fetch_array($result);
                        $pId = $row['tblParentId'];
                        $pfname = $row['tblParentFname'];
                        $plname = $row['tblParentLname'];
                        $pmname = $row['tblParentMname'];
                        $paddst = $row['tblParentAddSt'];
                        $paddbrgy = $row['tblParentAddBrgy'];
                        $paddcity = $row['tblParentAddCity'];
                        $paddcountry = $row['tblParentAddCountry'];
                        $ptelno = $row['tblParentTelNo'];
                        $pcpno = $row['tblParentCpNo'];
                        $pjob = $row['tblParentOccupation'];
                        $pcompany = $row['tblParentCompany'];
                        $pcaddst = $row['tblParentComAddSt'];
                        $pcaddbrgy = $row['tblParentComAddBrgy'];
                        $pcaddcity = $row['tblParentComAddCity'];
                        $pcaddcountry = $row['tblParentComAddCountry'];                        
                        $pcompanyno = $row['tblParentWorkNo'];
                        $pemail = $row['tblParentEmail'];
                        $fimg = $row['tblParentImage'];
                        $arrFather = array($pfname, $plname, $pmname, $ptelno, $pcpno, $pjob, $pcompany, $pcompanyno, $pemail);
                        ?>
                        <input type="hidden" name="txtFStudId" id="txtFStudId" value="<?php echo $id ?>"/>
                        <input type="hidden" id="txtId" name="txtId" value="<?php echo $pId; ?>"/>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">First name:</label>
                            <div class="col-lg-7">
                              <input class="form-control" type="text" name="txtParentFname" id="txtParentFname" value = "<?php echo $pfname ?>">
                            </div>
                          </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Last name:</label>
                            <div class="col-lg-7">
                              <input class="form-control" type="text" name="txtParentLname" id="txtParentLname" value = "<?php echo $plname ?>">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-lg-3 control-label">Middle name:</label>
                            <div class="col-lg-7">
                              <input class="form-control" type="text" name="txtParentMname" id="txtParentMname" value = "<?php echo $pmname ?>">
                            </div>
                          </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label left">Home Address:</label>
                            <div class="col-lg-4">
                              <input class="form-control" type="text" placeholder="Street Name/No." name="txtParentAddSt" id="txtParentAddSt" value = "<?php echo $paddst ?>">
                            </div>
                            <div class="col-lg-3">
                              <input class="form-control" type="text" placeholder="Brgy. Name/No." name="txtParentAddBrgy" id="txtParentAddBrgy" value = "<?php echo $paddbrgy ?>">
                            </div>
                        </div>
                          <div class="form-group">
                            <label class="col-lg-3 control-label left"></label>
                            <div class="col-lg-5">
                              <input class="form-control" type="text" placeholder="City/Municipality" name="txtParentAddCity" id="txtParentAddCity" value = "<?php echo $paddcity ?>">
                            </div>
                            <div class="col-lg-2">
                              <input class="form-control" type="text" value="Philippines" name="txtParentAddCountry" id="txtParentAddCountry" value = "<?php echo $paddcountry ?>">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-lg-3 control-label">Home Tel. Number:</label>
                            <div class="col-lg-7">
                              <input class="form-control" type="text" name="txtParentTelNo" id="txtParentTelNo" value = "<?php echo $ptelno ?>">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-lg-3 control-label">Mobile Number:</label>
                            <div class="col-lg-7">
                              <input class="form-control" type="text" name="txtParentCpNo" id="txtParentCpNo  " value = "<?php echo $pcpno ?>">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-lg-3 control-label">Occupation/Title:</label>
                            <div class="col-lg-7">
                              <input class="form-control" type="text" name="txtParentOccupation" id="txtParentOccupation" value = "<?php echo $pjob ?>">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-lg-3 control-label">Company Name:</label>
                            <div class="col-lg-7">
                              <input class="form-control" type="text" name="txtParentCompany" id="txtParentCompany" value = "<?php echo $pcompany ?>">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-lg-3 control-label left">Company Address:</label>
                            <div class="col-lg-4">
                              <input class="form-control" type="text" placeholder="Street Name/No." name="txtParentCompanyAddSt" id="txtParentCompanyAddSt" value = "<?php echo $pcaddst ?>">
                            </div>
                            <div class="col-lg-3">
                              <input class="form-control" type="text" placeholder="Brgy. Name/No." name="txtParentCompanyAddBrgy" id="txtParentCompanyAddBrgy" value = "<?php echo $pcaddbrgy ?>">
                            </div>
                        </div>
                          <div class="form-group">
                            <label class="col-lg-3 control-label left"></label>
                            <div class="col-lg-5">
                              <input class="form-control" type="text" placeholder="City/Municipality" name="txtParentCompanyAddCity" id="txtParentCompanyAddCity" value = "<?php echo $pcaddcity ?>">
                            </div>
                            <div class="col-lg-2">
                              <input class="form-control" type="text" value="Philippines" name="txtParentCompanyAddCountry" id="txtParentCompanyAddCountry" value = "<?php echo $pcaddcountry ?>">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-lg-3 control-label">Work Phone Number:</label>
                            <div class="col-lg-7">
                              <input class="form-control" type="text" name="txtParentWorkNo" id="txtParentWorkNo" value = "<?php echo $pcompanyno ?>">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-lg-3 control-label">Email Address:</label>
                            <div class="col-lg-7">
                              <input class="form-control" type="text" name="txtParentEmail" id="txtParentEmail" value = "<?php echo $pemail ?>">
                            </div>
                          </div>
                          <?php } ?>
                        
                        </div>
                        <div class="row mar_ned">
                               
                            </div>
                        <ul class="list-inline pull-right" style="margin-top: 8%">
                            <li><button type="button" class="btn btn-primary next-step" name="btnUpdF" id="btnUpdF">Next</button></li>
                        </ul>
                        </div>
                    </div>
                  
                    <div class="tab-pane form-horizontal" role="tabpanel" id="step2">
                        <center> <h3>Mother</h3></center>

                      <!-- left column -->
                      <div class="col-md-4 col-sm-6 col-xs-12">
                      <!--<div class="text-center">
                          <img src="admin.jpg" class="avatar img-circle img-thumbnail" alt="avatar">
                          <h6>Upload new photo</h6>
                          
                        </div>-->
                            <div class="text-center">
                          <img src="<?php echo $studimg ?>" class="avatar img-circle img-thumbnail" alt="avatar">
                          <h6>Upload new photo</h6>
                          <input type="file" class="text-center center-block well well-sm">
                        </div>

                      </div>
                        <div class="col-md-8 col-sm-6 col-xs-12">
                        <div>
                        <?php
                      if(isset($_POST['btnStud']))
                      {
                        $id = $_POST['txtStudId'];
                        $query = "select p.tblParentId, p.tblParentLname, p.tblParentFname, p.tblParentMname, p.tblParentAddSt, p.tblParentAddBrgy, p.tblParentAddCity, p.tblParentAddCountry, p.tblParentTelNo, p.tblParentCpNo, p.tblParentOccupation, p.tblParentCompany, p.tblParentComAddSt, p.tblParentComAddBrgy, p.tblParentComAddCity, p.tblParentComAddCountry, p.tblParentWorkNo, p.tblParentEmail from tblparent p, tblparentstudent ps where ps.tblParStud_tblStudentId = '$id' and p.tblParentId=ps.tblParStud_tblParentId and p.tblParentFlag = 1 and p.tblParentRelation = 'Mother'";
                        $result = mysqli_query($con, $query);
                        $row = mysqli_fetch_array($result);
                        $pmfname = $row['tblParentFname'];
                        $pmlname = $row['tblParentLname'];
                        $pmmname = $row['tblParentMname'];
                        $pmaddst = $row['tblParentAddSt'];
                        $pmaddbrgy = $row['tblParentAddBrgy'];
                        $pmaddcity = $row['tblParentAddCity'];
                        $pmaddcountry = $row['tblParentAddCountry'];                        
                        $pmtelno = $row['tblParentTelNo'];
                        $pmcpno = $row['tblParentCpNo'];
                        $pmjob = $row['tblParentOccupation'];
                        $pmcompany = $row['tblParentCompany'];
                        $pmcaddst = $row['tblParentComAddSt'];
                        $pmcaddbrgy = $row['tblParentComAddBrgy'];
                        $pmcaddcity = $row['tblParentComAddCity'];
                        $pmcaddcountry = $row['tblParentComAddCountry']; 
                        $pmcompanyno = $row['tblParentWorkNo'];
                        $pmemail = $row['tblParentEmail'];
                        $arrMother = array($pmfname, $pmlname, $pmmname, $pmtelno, $pmcpno, $pmjob, $pmcompany, $pmcompanyno, $pmemail);

                   ?>
                        <input type="hidden" name="txtPmId" id="txtPmId" value="<?php echo $row['tblParentId'] ?>"
                        
               
                         <div class="form-group">
                            <label class="col-lg-3 control-label">First name:</label>
                            <div class="col-lg-7">
                              <input class="form-control" type="text" name="txtParentMFname" id="txtParentMFname" value = "<?php echo $pmfname ?>">
                            </div>
                          </div>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">Last name:</label>
                            <div class="col-lg-7">
                              <input class="form-control" type="text" name="txtParentMLname" id="txtParentMLname" value = "<?php echo $pmlname ?>">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-lg-3 control-label">Middle name:</label>
                            <div class="col-lg-7">
                              <input class="form-control" type="text" name="txtParentMMname" id="txtParentMMname" value = "<?php echo $pmmname ?>">
                            </div>
                          </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label left">Home Address:</label>
                            <div class="col-lg-4">
                              <input class="form-control" type="text" placeholder="Street Name/No." name="txtParentMAddSt" id="txtParentMAddSt" value = "<?php echo $pmaddst ?>">
                            </div>
                            <div class="col-lg-3">
                              <input class="form-control" type="text" placeholder="Brgy. Name/No." name="txtParentMAddBrgy" id="txtParentMAddBrgy" value = "<?php echo $pmaddbrgy ?>">
                            </div>
                        </div>
                          <div class="form-group">
                            <label class="col-lg-3 control-label left"></label>
                            <div class="col-lg-5">
                              <input class="form-control" type="text" placeholder="City/Municipality" name="txtParentMAddCity" id="txtParentMAddCity" value = "<?php echo $pmaddcity ?>">
                            </div>
                            <div class="col-lg-2">
                              <input class="form-control" type="text" value="Philippines" name="txtParentMAddCountry" id="txtParentMAddCountry" value = "<?php echo $pmaddcountry ?>">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-lg-3 control-label">Home Tel. Number:</label>
                            <div class="col-lg-7">
                              <input class="form-control" type="text" name="txtParentMTelNo" id="txtParentMTelNo" value = "<?php echo $pmtelno ?>">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-lg-3 control-label">Mobile Number:</label>
                            <div class="col-lg-7">
                              <input class="form-control" type="text" name="txtParentMCpNo" id="txtParentMCpNo" value = "<?php echo $pmcpno ?>">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-lg-3 control-label">Occupation/Title:</label>
                            <div class="col-lg-7">
                              <input class="form-control" type="text" name="txtParentMJob" id="txtParentMJob" value = "<?php echo $pmjob ?>">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-lg-3 control-label">Company Name:</label>
                            <div class="col-lg-7">
                              <input class="form-control" type="text" name="txtParentMCompany" id="txtParentMCompany" value = "<?php echo $pmcompany ?>">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-lg-3 control-label left">Company Address:</label>
                            <div class="col-lg-4">
                              <input class="form-control" type="text" placeholder="Street Name/No." name="txtParentMComAddSt" id="txtParentMComAddSt" value = "<?php echo $pmcaddst ?>">
                            </div>
                            <div class="col-lg-3">
                              <input class="form-control" type="text" placeholder="Brgy. Name/No." name="txtParentMComAddBrgy" id="txtParentMComAddBrgy" value = "<?php echo $pmcaddbrgy ?>">
                            </div>
                        </div>
                          <div class="form-group">
                            <label class="col-lg-3 control-label left"></label>
                            <div class="col-lg-5">
                              <input class="form-control" type="text" placeholder="City/Municipality" name="txtParentMComAddCity" id="txtParentMComAddCity" value = "<?php echo $pmcaddcity ?>">
                            </div>
                            <div class="col-lg-2">
                              <input class="form-control" type="text" value="Philippines" name="txtParentMComAddCountry" id="txtParentMComAddCountry" value = "<?php echo $pmcaddcountry ?>">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-lg-3 control-label">Work Phone Number:</label>
                            <div class="col-lg-7">
                              <input class="form-control" type="text" name="txtParentMWorkNo" id="txtParentMWorkNo" value = "<?php echo $pmcompanyno ?>">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-lg-3 control-label">Email Address:</label>
                            <div class="col-lg-7">
                              <input class="form-control" type="text" name="txtParentMEmail" id="txtParentMEmail" value = "<?php echo $pmemail ?>">
                            </div>
                          </div>
                          <?php } ?>
                        
                        </div>
                        <ul class="list-inline pull-right">
                            <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
                            <li><button type="button" class="btn btn-primary next-step">Next</button></li>
                        </ul>
                        </div>
                    
                    <div class="tab-pane" role="tabpanel" id="step3">
                        <h3>Siblings</h3>
                        <div class="col-md-8 col-sm-6 col-xs-12">                        
                        <div>
                        <?php
                        $query = "select * from tblstudsiblings where tblStudSib_tblStudId='$id'";
                        $result = mysqli_query($con, $query);
                        while($row=mysqli_fetch_array($result))
                        {
                        ?>
                        <div style="margin-top:10%"></div>
                        <div class="form-group">
                        <input type="hidden" value="<?php echo $row['tblStudSibId'] ?>">
                            <label class="col-lg-3 control-label">First name:</label>
                            <div class="col-lg-7">
                              <input class="form-control" type="text" value="<?php echo $row['tblStudSibName'] ?>">
                            </div>
                          </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Age:</label>
                            <div class="col-lg-7">
                              <input class="form-control" type="text" value="<?php echo $row['tblStudSibAge'] ?>">
                            </div>
                          </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Grade/Level:</label>
                            <div class="col-lg-7">
                              <input class="form-control" type="text" value="<?php echo $row['tblStudSibGrade'] ?>">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-lg-3 control-label">School:</label>
                            <div class="col-lg-7">
                              <input class="form-control" type="text" value="<?php echo $row['tblStudSibSchool'] ?>">
                            </div>
                          </div>
                        <div><p></p></div>
                        <?php } ?>
                        </div>
                        <ul class="list-inline pull-right">
                            <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
                            <li><button type="button" class="btn btn-default next-step">Skip</button></li>
                            <button type="submit" class="btn btn-primary btn-info-full" id="btnSubmit" name="btnSubmit">Submit</button>
                        </ul>
                        
                      </div>
                        
                    </div>
                    <div class="tab-pane" role="tabpanel" id="complete">
                        <h3>Complete</h3>
                        <p>Changes are saved.</p>

                    </div>
                    <div class="clearfix"></div>
                </div>
            </form>
        </div>
    </section>
            </div>
            </div>
            <!-- /.box-body -->
              </div>
              <!-- /.tab-pane -->
       
<div class="tab-pane" id="tab_3">
            <div class="box">

              <div class="box-body">  
    <div style="margin-top: 3%">
      <form class="form-horizontal" role="form" method="post" action="updateHealth.php">
      <?php
      if(isset($_POST['btnStud']))
      {
      $id = $_POST['txtStudId'];
      $query = "select * from tblstudhealth where tblStudHealthFlag=1 and tblStudHealth_tblStudentId = '$id'";
      $result = mysqli_query($con, $query);
      $row = mysqli_fetch_array($result);
      $allergy = $row['tblStudHealthAllergies'];
      $illness = $row['tblStudHealthIllness'];
      $medication = $row['tblStudHealthMedication'];
      $bloodtype = $row['tblStudHealthBloodType'];
      $hospitalized = $row['tblStudHealthHospitalized'];
      $reason = $row['tblStudHealthReason'];
      $doctor = $row['tblStudHealthDoctor'];
      $hospital = $row['tblStudHealthHospital'];
      $hospitalno = $row['tblStudHealthHospitalNo'];
      $hospaddst = $row['tblStudHealthHospAddSt'];
      $hospaddbrgy = $row['tblStudHealthHospAddBrgy'];
      $hospaddcity = $row['tblStudHealthHospAddCity'];
      $hospaddcountry = $row['tblStudHealthHospAddCountry'];
      $emergency = $row['tblStudHealthEmergency'];
      ?>
      <input type="hidden" name="txtHStudId" id="txtHStudId" value="<?php echo $id ?>"/>
      <div class="form-group">
          <label class="col-lg-2 control-label">Allergies:</label>
          <div class="col-lg-7">
            <input class="form-control" type="text" name="txtHealthAllergy" id="txtHealthAllergy" value = "<?php echo $allergy ?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-lg-2 control-label">Illness or Disability:</label>
          <div class="col-lg-7">
            <input class="form-control" type="text" name="txtHealthIllness" id="txtHealthIllness" value = "<?php echo $illness ?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-lg-2 control-label">Medication:</label>
          <div class="col-lg-7">
            <input class="form-control" type="text" name="txtHealthMedic" id="txtHealthMedic" value = "<?php echo $medication ?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-lg-2 control-label">Blood Type:</label>
                <div class="col-lg-7">
                <select class="form-control choose" style="width: 100%;" name="txtHealthBlood" id="txtHealthBlood" >
                  <option <?php echo ($bloodtype == 'A')?"selected":"" ?>>A</option>
                  <option <?php echo ($bloodtype == 'B')?"selected":"" ?>>B</option>
                  <option <?php echo ($bloodtype == 'O')?"selected":"" ?>>O</option>
                  <option <?php echo ($bloodtype == 'AB')?"selected":"" ?>>AB</option>
                </select>
        </div>
        <div class="form-group" style="margin-top: 5%">
          <label class="col-lg-3 control-label">Hospitalized?
          <label style="margin-left: 3%">Yes
            <input type="radio" name="h2" class="minimal" value="Y" <?php echo($hospitalized=='Y')?'checked':'' ?>>
          </label>
          <label>No
            <input type="radio" name="h2" class="minimal" value="N" <?php echo($hospitalized=='N')?'checked':'' ?>>
          </label>
          </label>
        </div>
        <div class="form-group" style="margin-bottom: 5%">
          <label class="col-lg-2 control-label">Reason:</label>
          <div class="col-lg-7">
            <input class="form-control" type="text" name="txtHealthReason" id="txtHealthReason" value = "<?php echo $reason ?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-lg-7 control-label">In case of emergency, can we call your family doctor/pediatrician?
          <label style="margin-left: 3%">Yes
            <input type="radio" name="r1" class="minimal" value="Y" <?php echo($emergency=='Y')?'checked':'' ?>>
          </label>
          <label>No
            <input type="radio" name="r1" class="minimal" value="N" <?php echo($emergency=='N')?'checked':'' ?>>
          </label>
          </label>
        </div>
        <div class="form-group">
          <label class="col-lg-2 control-label">Doctor's Name:</label>
          <div class="col-lg-7">
            <input class="form-control" type="text" name="txtHealthDoctor" id="txtHealthDoctor" value = "<?php echo $doctor ?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-lg-2 control-label">Hospital:</label>
          <div class="col-lg-7">
            <input class="form-control" type="text" name="txtHealthHospital" id="txtHealthHospital" value = "<?php echo $hospital ?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-lg-2 control-label">Tel/Mobile #:</label>
          <div class="col-lg-7">
            <input class="form-control" type="text" name="txtHealthNo" id="txtHealthNo" value = "<?php echo $hospitalno ?>">
          </div>
        </div>
        <div class="form-group">
        <label class="col-lg-3 control-label">Hospital Address:</label>
        <div class="col-lg-4">
          <input class="form-control" type="text" placeholder="Street Name/No." name="txtHealthAddSt" id="txtHealthAddSt" value = "<?php echo $hospaddst ?>">
        </div>
        <div class="col-lg-3">
          <input class="form-control" type="text" placeholder="Brgy. Name/No." name="txtHealthAddBrgy" id="txtHealthAddBrgy" value = "<?php echo $hospaddbrgy ?>">
        </div>
      </div>
      <div class="form-group">
        <label class="col-lg-3 control-label left"></label>
        <div class="col-lg-5">
          <input class="form-control" type="text" placeholder="City/Municipality" name="txtHealthAddCity" id="txtHealthAddCity" value = "<?php echo $hospaddcity ?>">
        </div>
        <div class="col-lg-2">
          <input class="form-control" type="text" value="Philippines" name="txtHealthAddCountry" id="txtHealthAddCountry" value = "<?php echo $hospaddcountry ?>">
        </div>
      </div>
      
      <div class="btn-group" style="margin-top: 5%; float: right">
                      <button type="submit" class="btn btn-info" name="btnHealth" id="btnHealth">Save</button>
       </div>
       <?php } ?>
      </form>
      </div>
    </div>
          </div>
          </div>
          </div>

          </div>
       </div>
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
<!-- Sweetalert -->
<script src="js/sweetalert.min.js"></script>
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="js/select2.full.min.js"></script>
<!-- InputMask -->
<script src="plugins/input-mask/jquery.inputmask.js"></script>
<script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- bootstrap color picker -->
<script type="text/javascript" src="formwizard.js"></script>

<script>
  $(function () {
    //Initialize Select2 Elements
    $(".choose").select2();
    $("#datatable").DataTable();
    $("#datatable1").DataTable();
    //Datemask dd/mm/yyyy
    $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
    //Datemask2 mm/dd/yyyy
    $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
     $("#datemask3").inputmask("yyyy-mm-dd", {"placeholder": "yyyy-mm-dd"});
    //Money Euro
    $("[data-mask]").inputmask();

    //Date range picker
    $('#reservation').daterangepicker();
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
    //Date range as a button
    $('#daterange-btn').daterangepicker(
        {
          ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          startDate: moment().subtract(29, 'days'),
          endDate: moment()
        },
        function (start, end) {
          $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
    );

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
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

    //Colorpicker
    $(".my-colorpicker1").colorpicker();
    //color picker with addon
    $(".my-colorpicker2").colorpicker();

    //Timepicker
    $(".timepicker").timepicker({
      showInputs: false
    });
  });
</script>
</body>
</html>