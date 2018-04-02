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
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="formwizard2.css"><!--
    <link href="css/multiple-select.css" rel="stylesheet"/> -->
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">
    <style>
      body {
        font-family: 'Noto Sans', sans-serif;
        font-weight: bold;
      }
    </style>
    <script>
    //   $(".minimal").click(function() {
    //     $("#txtHealthReason").attr("disabled", true);
    //     if ($("input[name=h2]:checked").val() == "Y") {
    //         $("#txtHealthReason").attr("disabled", false);
    //     }
    // });
    function disabledReason() {
    var txtHealthReason = document.getElementById('txtHealthReason');
    txtHealthReason.readOnly = true;
    }
    function disabledEmergency() {
    var txtHealthDoctor = document.getElementById('txtHealthDoctor');
    var txtHealthHospital = document.getElementById('txtHealthHospital');
    var txtHealthHosNum = document.getElementById('txtHealthHosNum');
    var txtHealthAddBldg = document.getElementById('txtHealthAddBldg');
    var txtHealthAddSt = document.getElementById('txtHealthAddSt');
    var txtHealthAddBrgy = document.getElementById('txtHealthAddBrgy');
    var txtHealthAddCity = document.getElementById('txtHealthAddCity');
    var txtHealthAddCountry = document.getElementById('txtHealthAddCountry');
    txtHealthDoctor.readOnly = true;
    txtHealthHospital.readOnly = true;
    txtHealthHosNum.readOnly = true;
    txtHealthAddBldg.readOnly = true;
    txtHealthAddSt.readOnly = true;
    txtHealthAddBrgy.readOnly = true;
    txtHealthAddCity.readOnly = true;
    txtHealthAddCountry.readOnly = true;
    }

    function addSibling()
    {
      var objTo = document.getElementById('sibling');
      var divingr = document.createElement("div");
      divingr.innerHTML = '<br /><label class="col-lg-4 control-label left">Name:</label><div class="col-lg-8"><input class="form-control" type="text" name="txtSiblName[]" id="txtSiblName"></div><label class="col-lg-4 control-label left">Age:</label><div class="col-lg-8"><input class="form-control" type="text" name="txtSiblAge[]" id="txtSiblAge"></div><label class="col-lg-4 control-label left">Grade/Level:</label><div class="col-lg-8"><input class="form-control" type="text" name="txtSiblGrd[]" id="txtSiblGrd"></div><label class="col-lg-4 control-label left">School:</label><div class="col-lg-8"><input class="form-control" type="text" name="txtSiblSchool[]" id="txtSiblSchool"></div>';
      objTo.appendChild(divingr);
    }

    function addRelative()
    {
      var objTo2 = document.getElementById('relative');
      var divingr2 = document.createElement("div");
      divingr2.innerHTML = '<br /><label class="col-lg-4 control-label left">Name:</label><div class="col-lg-8"><input class="form-control" type="text" name="txtRelName[]" id="txtRelName"></div><label class="col-lg-4 control-label left">Age:</label><div class="col-lg-8"><input class="form-control" type="number" name="txtRelAge[]" id="txtRelAge"></div><label class="col-lg-4 control-label left">Relation:</label><div class="col-lg-8"><input class="form-control" type="text" name="txtRelRelation[]" id="txtRelRelation"></div>';
      objTo2.appendChild(divingr2);
    }

    function addEmergencyContact()
    {
      var objTo2 = document.getElementById('relative');
      var divingr2 = document.createElement("div");
      divingr2.innerHTML = '<br /> <label class="col-lg-4 control-label">Name:</label><div class="col-lg-8"><input class="form-control" type="text" name="txtEmName[]" id="txtEmName"></div><label class="col-lg-4 control-label">Relation to Student:</label><div class="col-lg-8"><input class="form-control" type="text" name="txtReltoStud[]" id="txtReltoStud"><label class="col-lg-4 control-label">Tel/Mobile Number:</label><div class="col-lg-8"><input class="form-control" type="text" name="txtEmNum[]" id="txtEmNum"></div><label class="col-lg-4 control-label">Address:</label><div class="col-lg-8"><input class="form-control" type="text" name="txtEmAdress[]" id="txtEmAdress"></div>';
      objTo2.appendChild(divingr2);
    }

    function changeRequirement()
    {
      var xmlhttp =  new XMLHttpRequest();
      xmlhttp.open("GET","changeRequirement.php?r3="+document.querySelector('input[name="r3"]:checked').value,false);
      xmlhttp.send(null);
      document.getElementById("requirementfield").innerHTML=xmlhttp.responseText;
    }
    function firstname()
      {
        document.getElementById("fname").value=document.getElementById("txtStudFname").value;
      }

    function middlename()
      {
        var val=document.getElementById("txtStudMname").value;
        document.getElementById("mname").value=val;
      }
    function lastname()
      {
        var val=document.getElementById("txtStudLname").value;
        document.getElementById("lname").value=val;
      }
      function submitF()
      {
        window.location="admission.php";
      }
    </script>
  </head>

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
		                 <!-- <?php echo $namess ?>-->
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
            <div class="row">
                <div class="col-md-12">
                  <div class="box box-default">
                    <div class="box-header with-border"></div>

                    <div class="box-body">
                      <!-- <label style="padding: 3%">Parent: </label>
                      <select class="form-control choose" name="parentChoose" id="parentChoose" style="width: 40%">
                        <option selected="selected" disabled>--Select Parent--</option>
                            <?php
                            $query="select tblParentId, concat(tblParentLname, ', ', tblParentFname, ' ', tblParentMname) as names from tblparent where tblParentFlag=1";
                            $result = mysqli_query($con, $query);
                            while($row = mysqli_fetch_array($result))
                            {
                            ?>
                              <option value="<?php echo $row['tblParentId'] ?>"><?php echo $row['names'] ?></option>
                            <?php } ?>
                      </select> -->
                      <section>
                        <div class="wizard">
                          <div class="wizard-inner">
                            <div class="connecting-line"></div>
                            <ul class="nav nav-tabs" role="tablist">
                              <li role="presentation" class="active">
                                  <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Requirements">
                                    <span class="round-tab">
                                      1
                                    </span>
                                  </a>
                              </li>

                              <li role="presentation" class="disabled">
                                <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Personal Information">
                                  <span class="round-tab">
                                    2
                                  </span>
                                </a>
                              </l>

                              <li role="presentation" class="disabled">
                                <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Family Information">
                                  <span class="round-tab">
                                    3
                                  </span>
                                </a>
                              </li>

                              <li role="presentation" class="disabled">
                                <a href="#step4" data-toggle="tab" aria-controls="step4" role="tab" title="Health History">
                                  <span class="round-tab">
                                    4
                                  </span>
                                </a>
                              </li>
                            </ul>
                          </div>

                          <form method="post" action="saveadmission.php" id="form1">
                            <div class="tab-content">

                              <div class="tab-pane active" role="tabpanel" id="step1">
                                <center><h3 style="margin-bottom: 3%; margin-left: 3%">Check Requirements</h3></center>
                                <span style="color: rgba(255, 0, 0, 0.9); padding:5%;">* <span style="color: rgba(0, 0, 0, 0.9) ; font-size: 12px;">Indicates required fields</span></span>
                                <hr>
                                  <div class="col-md-12 col-sm-12 col-xs-12">

                                      <!-- radio -->
                                      <div class="form-group" style="margin-top: 3%; margin-left: 10%">
                                        <div class="radio">
                                          <label>
                                            <input type="radio" name="r3" id="r3" value="NEW STUDENT" onchange="changeRequirement()">New Student
                                          </label>
                                        </div>
                                        <div class="radio">
                                          <label>
                                            <input type="radio" name="r3" id="r3" value="TRANSFEREE" onchange="changeRequirement()">Transferee
                                          </label>
                                        </div>
                                        </div>
                                      <div class="form-group" style="margin-top: 3%; margin-left: 10%">
                                        <label style="width: 35%">Admission for:<span style="color:red; padding:5%;">*</span></label>
                                        <div>
                                          <select class="form-control" style="width: 35%;" name="selLevel" id="selLevel">
                                                  <option selected="selected" disabled>--Choose Level--</option>
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

                                      <div class="fieldset" style="border: 1px solid #d3d3d3; margin-top: 5%" id="requirementfield">
                                        <fieldset style="margin-top: 3%; padding: 3%">
                                        <h3>REQUIREMENTS<span style="color:red; padding:1%;">*</span></h3>
                                        <hr>
                                         </fieldset>
                                      </div> <!-- fieldser -->
                                    </div> <!-- col -->

                                      <ul class="list-inline pull-right" style="margin-top: 5%">
                                          <li><button type="button" class="btn btn-primary next-step" onclick="scrollWin()">Next</li>
                                      </ul>

                              </div> <!-- tab pane step1 -->

                                  <div class="tab-pane" role="tabpanel" id="step2">
                                    <center><h3 style="margin-bottom: 3%; margin-left: 3%">Student's Personal Information</h3></center>
                                    <div class="container">
                                      <span style="color: rgba(255, 0, 0, 0.9); padding:5%;">* <span style="color: rgba(0, 0, 0, 0.9) ; font-size: 12px;">Indicates required fields</span></span>
    <hr>
  <div class="row">
      <!-- left column -->
      <div class="col-md-3">
        <div class="text-center">
          <!-- <img id="studpictureview" src="//placehold.it/100" class="avatar img-rounded img-reponsive" alt="Student's Photo"  style="height:180px;max-width:100%;"> -->
          <img id="studpictureview" src="<?php echo $studimg ?>" class="avatar img-rounded img-reponsive img-thumbnail" alt="avatar">
           <h6>Upload photo...</h6>

          <!-- <input type="file" class="form-control" name="avatar" id="picture" accept="image/*" style="margin-top:3%;" required> -->
          <!-- <input type="file" accept="image/*" style="margin-top:3%;" onchange="document.getElementById('studpictureview').src = window.URL.createObjectURL(this.files[0])" required> -->
          <input type="file" class="text-center center-block well well-sm" name="file" id="file" accept="image/*" onchange="document.getElementById('studpictureview').src = window.URL.createObjectURL(this.files[0])">
        </div>
      </div>

      <!-- edit form column -->
      <div class="col-md-9 personal-info">


          <div class="form-group" style="margin-bottom:7%;">
            <label class="col-lg-2 control-label left">First name:<span style="color:red; padding:5%;">*</span></label>
            <div class="col-lg-8" style="width:30%;">
              <input class="form-control" type="text" name="txtStudFname" id="txtStudFname" required onkeyup="firstname()">
            </div>
          </div>
          <div class="form-group" style="margin-bottom:13%;">
            <label class="col-lg-2 control-label left">Middle name:</label>
            <div class="col-lg-8" style="width:30%">
              <input class="form-control" type="text" name="txtStudMname" id="txtStudMname" onkeyup="middlename()">
            </div>
          </div>
          <div class="form-group" style="margin-bottom:19%;">
            <label class="col-lg-2 control-label left">Last name:<span style="color:red; padding:5%;">*</span></label>
            <div class="col-lg-8" style="width:30%">
              <input class="form-control" type="text" name="txtStudLname" id="txtStudLname" required onkeyup="lastname()">
            </div>
          </div>
          <div class="form-group" style="margin-bottom:25%;">
            <form>
            <label class="col-lg-2 control-label left">Birthday:<span style="color:red; padding:5%;">*</span></label>
            <div class="col-lg-4" style="width:23%">
              <input class="form-control" type="date" id="date" name="dob" name="txtStudBday" id="txtStudBday" placeholder="mm/dd/yyyy" onblur="getAge();" required/>
            </div>
            <label class="col-lg-1 control-label left">Age:</label>
            <div class="col-lg-2" style="width:23%">
              <input type="text" id="age" name="age" value="" class="form-control" placeholder="Age" disabled>
            </div>
            </form>
          </div>
          <div class="form-group" style="margin-bottom:31%;">
            <label class="col-lg-2 control-label left">Birthplace:<span style="color:red; padding:5%;">*</span></label>
            <div class="col-lg-8" style="width:30%;">
              <input class="form-control" type="text" name="txtStudBplace" id="txtStudBplace" required>
            </div>
          </div>
          <div class="form-group" style="margin-bottom:37%;">
            <label class="col-lg-2 control-label left">Nationality:</label>
            <div class="col-lg-4" style="width:27%;">
              <input class="form-control" type="text" name="txtStudNat" id="txtStudNat">
            </div>
            <label class="col-lg-1 control-label left">Sex:<span style="color:red; padding:5%;">*</span></label>
            <div class="col-lg-3">
              <select class="form-control" type="text" name="txtStudGender" id="txtStudGender">
                <option selected disabled>--Select Sex--</option>
                <option value="Female">Female</option>
                <option value="Male">Male</option>
              </select>
            </div>
          </div>
          <div class="form-group" style="margin-bottom:43%;">
            <label class="col-lg-2 control-label left">Religion:</label>
            <div class="col-lg-8" style="width:27%;">
              <input class="form-control" type="text" name="txtStudReligion" id="txtStudReligion">
            </div>
          </div>
          <div class="form-group" style="margin-bottom:49%;">
            <label class="col-lg-2 control-label left">Home Address:</label>
            <div class="col-lg-2">
              <input class="form-control" type="text" placeholder="Unit/Bldg. No." name="txtStudAddBldg" id="txtStudAddBldg">
            </div>
            <div class="col-lg-3">
              <input class="form-control" type="text" placeholder="Street Name/No." name="txtStudAddSt" id="txtStudAddSt">
            </div>
            <div class="col-lg-3">
              <input class="form-control" type="text" placeholder="Brgy. Name/No." name="txtStudAddBrgy" id="txtStudAddBrgy">
            </div>
          </div>
          <div class="form-group" style="margin-bottom:55%;">
            <label class="col-lg-2 control-label left"><span style="color:red; padding:100%;">*</span></label>
            <div class="col-lg-6" style="width:27%;">
              <input class="form-control" type="text" placeholder="City/Municipality" name="txtStudAddCity" id="txtStudAddCity" required>
            </div>
            <div class="col-lg-2">
              <input class="form-control" type="text" value="Philippines" name="txtStudAddCountry" id="txtStudAddCountry">
            </div>
          </div>
          <div class="form-group" style="margin-bottom:61%;">
          <label class="col-lg-2 control-label">Spoken Language:</label>
          <div class="col-lg-8" style="width:27%;">
          <input class="form-control" type="text" name="txtStudLang1" id="txtStudLang1" placeholder="First Language">
          </div>
          </div>
          <div class="form-group">
          <label class="col-lg-2 control-label"></label>
          <div class="col-lg-8" style="width:27%;">
          <input class="form-control" type="text" name="txtStudLang2" id="txtStudLang2" placeholder="Second Language">
          </div>
          </div>

      </div>
  </div>
</div>
<hr>

                                    <ul class="list-inline pull-right" style="margin-top: 5%">
                                        <li><button type="button" class="btn btn-default prev-step" onclick="scrollWin()">Previous</button></li>
                                        <li><button type="button" class="btn btn-primary btn-info-full next-step" onclick="scrollWin()">Next</button></li>
                                    </ul>
                                  </div> <!-- tab pane step2-->

                                  <div class="tab-pane" role="tabpanel" id="step3">
                                    <center><h3 style="margin-bottom: 3%; margin-left: 3%">Family Information</h3></center>
<div class="container">
   <span style="color: rgba(255, 0, 0, 0.9); padding:5%;">* <span style="color: rgba(0, 0, 0, 0.9) ; font-size: 12px;">Indicates required fields</span></span>
    <hr>
  <div class="row">
      <!-- left column -->
      <div class="col-md-3">
        <div class="text-center">
          <img id="fpictureview" src="//placehold.it/100" class="avatar img-rounded img-reponsive" alt="Father's Photo"  style="height:180px;max-width:100%;">
           <h6>Upload photo...</h6>

          <!-- <input type="file" class="form-control" name="avatar" id="picture" accept="image/*" style="margin-top:3%;" required> -->
          <input type="file" accept="image/*" style="margin-top:3%;" onchange="document.getElementById('fpictureview').src = window.URL.createObjectURL(this.files[0])">
        </div>
      </div>

      <!-- edit form column -->
      <div class="col-md-9 personal-info">
        <h3>Father's Information</h3>


          <div class="form-group" style="margin-bottom:7%;">
            <label class="col-lg-2 control-label left">First name:<span style="color:red; padding:5%;">*</span></label>
            <div class="col-lg-8" style="width:30%">
              <input class="form-control" type="text" name="txtFatherFname" id="txtFatherFname" required>
            </div>
          </div>
          <div class="form-group" style="margin-bottom:13%;">
            <label class="col-lg-2 control-label left">Middle name:</label>
            <div class="col-lg-8" style="width:30%">
              <input class="form-control" type="text" name="txtFatherMname" id="txtFatherMname">
            </div>
          </div>
          <div class="form-group" style="margin-bottom:19%;">
            <label class="col-lg-2 control-label left">Last name:<span style="color:red; padding:5%;">*</span></label>
            <div class="col-lg-8" style="width:30%">
              <input class="form-control" type="text" name="txtFatherLname" id="txtFatherLname" required>
            </div>
          </div>
          <div class="form-group" style="margin-bottom:25%;">
            <label class="col-lg-2 control-label left">Mobile Number:<span style="color:red; padding:5%;">*</span></label>
            <div class="col-lg-8" style="width:20%">
              <input class="form-control" type="text" name="txtFatherNum" id="txtFatherNum" required>
            </div>
          </div>
          <div class="form-group" style="margin-bottom:31%;">
            <label class="col-lg-2 control-label left">E-mail Address:<span style="color:red; padding:5%;">*</span></label>
            <div class="col-lg-8" style="width:27%">
              <input class="form-control" type="email" name="txtFatherEmail" id="txtFatherEmail" required>
            </div>
          </div>
          <div class="form-group" style="margin-bottom:37%;">
            <label class="col-lg-2 control-label left">Home Address:</label>
            <div class="col-lg-2">
              <input class="form-control" type="text" placeholder="Unit/Bldg. No." name="txtFatherAddBldg" id="txtFatherAddBldg">
            </div>
            <div class="col-lg-3">
              <input class="form-control" type="text" placeholder="Street Name/No." name="txtFatherAddSt" id="txtFatherAddSt">
            </div>
            <div class="col-lg-3">
              <input class="form-control" type="text" placeholder="Brgy. Name/No." name="txtFatherAddBrgy" id="txtFatherAddBrgy">
            </div>
          </div>
          <div class="form-group" style="margin-bottom:43%;">
            <label class="col-lg-2 control-label left"><span style="color:red; padding:100%;">*</span></label>
            <div class="col-lg-6" style="width:27%;">
              <input class="form-control" type="text" placeholder="City/Municipality" name="txtFatherAddCity" id="txtFatherAddCity" required>
            </div>
            <div class="col-lg-2">
              <input class="form-control" type="text" value="Philippines" name="txtFatherAddCountry" id="txtFatherAddCountry">
            </div>
          </div>
          <div class="form-group" style="margin-bottom:49%;">
            <label class="col-lg-2 control-label left">Home Tel. Number:<span style="color:red; padding:5%;">*</span></label>
            <div class="col-lg-8" style="width:17%">
              <input class="form-control" type="text" name="txtFatherTelnum" id="txtFatherTelnum" required>
            </div>
          </div>
          <div class="form-group" style="margin-bottom:55%;">
            <label class="col-lg-2 control-label left">Occupation/Title:</label>
            <div class="col-lg-8" style="width:35%;">
              <input class="form-control" type="text" name="txtFatherJob" id="txtFatherJob">
            </div>
          </div>
          <div class="form-group" style="margin-bottom:61%;">
            <label class="col-lg-2 control-label left">Company Name:</label>
            <div class="col-lg-8" style="width:35%">
              <input class="form-control" type="text" name="txtFatherCompany" id="txtFatherCompany">
            </div>
          </div>
          <div class="form-group" style="margin-bottom:67%;">
            <label class="col-lg-2 control-label left">Company Address:</label>
            <div class="col-lg-2">
              <input class="form-control" type="text" placeholder="Unit/Bldg. No." name="txtFatherComAddBldg" id="txtFatherComAddBldg">
            </div>
            <div class="col-lg-3">
              <input class="form-control" type="text" placeholder="Street Name/No." name="txtFatherComAddSt" id="txtFatherComAddSt">
            </div>
            <div class="col-lg-3">
              <input class="form-control" type="text" placeholder="Brgy. Name/No." name="txtFatherComAddBrgy" id="txtFatherComAddBrgy">
            </div>
          </div>
          <div class="form-group" style="margin-bottom:73%;">
            <label class="col-lg-2 control-label left"></label>
            <div class="col-lg-6" style="width:27%">
              <input class="form-control" type="text" placeholder="City/Municipality" name="txtFatherComAddCity" id="txtFatherComAddCity">
            </div>
            <div class="col-lg-2">
              <input class="form-control" type="text" value="Philippines" name="txtFatherComAddCountry" id="txtFatherComAddCountry">
            </div>
          </div>
          <div class="form-group" style="margin-bottom:79%;">
            <label class="col-lg-2 control-label left">Work Phone Number:</label>
            <div class="col-lg-8" style="width:20%">
              <input class="form-control" type="text" name="txtFatherComNum" id="txtFatherComNum">
            </div>
          </div>

      </div>
  </div>
</div>


 <div class="container">
    <hr>
  <div class="row">
      <!-- left column -->
      <div class="col-md-3">
        <div class="text-center">
          <img id="mpictureview" src="//placehold.it/100" class="avatar img-rounded img-reponsive" alt="Mother's Photo"  style="height:180px;max-width:100%;">
           <h6>Upload photo...</h6>

          <!-- <input type="file" class="form-control" name="avatar" id="picture" accept="image/*" style="margin-top:3%;" required> -->
          <input type="file" accept="image/*" style="margin-top:3%;" onchange="document.getElementById('mpictureview').src = window.URL.createObjectURL(this.files[0])">
        </div>
      </div>

      <!-- edit form column -->
      <div class="col-md-9 personal-info">
        <h3>Mother's Information</h3>


          <div class="form-group" style="margin-bottom:7%;">
            <label class="col-lg-2 control-label left">First name:<span style="color:red; padding:5%;">*</span></label>
            <div class="col-lg-8" style="width:30%">
              <input class="form-control" type="text" name="txtMotherFname" id="txtMotherFname" required>
            </div>
          </div>
          <div class="form-group" style="margin-bottom:13%;">
            <label class="col-lg-2 control-label left">Middle name:</label>
            <div class="col-lg-8" style="width:30%">
              <input class="form-control" type="text" name="txtMotherMname" id="txtMotherMname">
            </div>
          </div>
          <div class="form-group" style="margin-bottom:19%;">
            <label class="col-lg-2 control-label left">Last name:<span style="color:red; padding:5%;">*</span></label>
            <div class="col-lg-8" style="width:30%">
              <input class="form-control" type="text" name="txtMotherLname" id="txtMotherLname" required>
            </div>
          </div>
          <div class="form-group" style="margin-bottom:25%;">
            <label class="col-lg-2 control-label left">Mobile Number:<span style="color:red; padding:5%;">*</span></label>
            <div class="col-lg-8" style="width:20%">
              <input class="form-control" type="text" name="txtMotherNum" id="txtMotherNum" required>
            </div>
          </div>
          <div class="form-group" style="margin-bottom:31%;">
            <label class="col-lg-2 control-label left">E-mail Address:<span style="color:red; padding:5%;">*</span></label>
            <div class="col-lg-8" style="width:27%">
              <input class="form-control" type="email" name="txtMotherEmail" id="txtMotherEmail" required>
            </div>
          </div>
          <div class="form-group" style="margin-bottom:37%;">
            <label class="col-lg-2 control-label left">Home Address:</label>
            <div class="col-lg-2">
              <input class="form-control" type="text" placeholder="Unit/Bldg. No." name="txtMotherAddBldg" id="txtMotherAddBldg">
            </div>
            <div class="col-lg-3">
              <input class="form-control" type="text" placeholder="Street Name/No." name="txtMotherAddSt" id="txtMotherAddSt">
            </div>
            <div class="col-lg-3">
              <input class="form-control" type="text" placeholder="Brgy. Name/No." name="txtMotherAddBrgy" id="txtMotherAddBrgy">
            </div>
          </div>
          <div class="form-group" style="margin-bottom:43%;">
            <label class="col-lg-2 control-label left"><span style="color:red; padding:100%;">*</span></label>
            <div class="col-lg-6" style="width:27%">
              <input class="form-control" type="text" placeholder="City/Municipality" name="txtMotherAddCity" id="txtMotherAddCity">
            </div>
            <div class="col-lg-2">
              <input class="form-control" type="text" value="Philippines" name="txtMotherAddCountry" id="txtMotherAddCountry">
            </div>
          </div>
          <div class="form-group" style="margin-bottom:49%;">
            <label class="col-lg-2 control-label left">Home Tel. Number:<span style="color:red; padding:5%;">*</span></label>
            <div class="col-lg-8" style="width:17%">
              <input class="form-control" type="text" name="txtMotherTelnum" id="txtMotherTelnum" required>
            </div>
          </div>
          <div class="form-group" style="margin-bottom:55%;">
            <label class="col-lg-2 control-label left">Occupation/Title:</label>
            <div class="col-lg-8" style="width:35%">
              <input class="form-control" type="text" name="txtMotherJob" id="txtMotherJob">
            </div>
          </div>
          <div class="form-group" style="margin-bottom:61%;">
            <label class="col-lg-2 control-label left">Company Name:</label>
            <div class="col-lg-8" style="width:35%">
              <input class="form-control" type="text" name="txtMotherCompany" id="txtMotherCompany">
            </div>
          </div>
          <div class="form-group" style="margin-bottom:67%;">
            <label class="col-lg-2 control-label left">Company Address:</label>
            <div class="col-lg-2">
              <input class="form-control" type="text" placeholder="Unit/Bldg. No." name="txtMotherComAddBldg" id="txtMotherComAddBldg">
            </div>
            <div class="col-lg-3">
              <input class="form-control" type="text" placeholder="Street Name/No." name="txtMotherComAddSt" id="txtMotherComAddSt">
            </div>
            <div class="col-lg-3">
              <input class="form-control" type="text" placeholder="Brgy. Name/No." name="txtMotherComAddBrgy" id="txtMotherComAddBrgy">
            </div>
          </div>
          <div class="form-group" style="margin-bottom:73%;">
            <label class="col-lg-2 control-label left"></label>
            <div class="col-lg-6" style="width:27%">
              <input class="form-control" type="text" placeholder="City/Municipality" name="txtMotherComAddCity" id="txtMotherComAddCity">
            </div>
            <div class="col-lg-2">
              <input class="form-control" type="text" value="Philippines" name="txtMotherComAddCountry" id="txtMotherComAddCountry">
            </div>
          </div>
          <div class="form-group" style="margin-bottom:79%;">
            <label class="col-lg-2 control-label left">Work Phone Number:</label>
            <div class="col-lg-8" style="width:17%">
              <input class="form-control" type="text" name="txtMotherComNum" id="txtMotherComNum">
            </div>
          </div>

      </div>
  </div>
</div>

<div class="container">
    <hr>
  <div class="row">
      <!-- left column -->
      <div class="col-md-3">

      </div>

      <!-- edit form column -->
      <div class="col-md-9 personal-info">

 <div class="form-group" style="margin-bottom:7%;">
            <label class="col-lg-2 control-label left">Parent Status:<span style="color:red; padding:5%;">*</span></label>
            <div class="col-lg-8">
              <select class="form-control choose" multiple="multiple" data-placeholder="Select a status" name="chkParentStat" id="chkParentStat" style="width: 100%">
                    <option value="Parents Married">Parents Married</option>
                    <option value="Father Deceased">Father Deceased</option>
                    <option value="Father Remarried">Father Remarried</option>
                    <option value="Mother Deceased">Mother Deceased</option>
                    <option value="Mother Remarried">Mother Remarried</option>
                    <option value="Applicant Adopted">Applicant Adopted</option>
                    <option value="Single Parent">Single Parent</option>
                    <option value="Parents Separated/Divorced">Parents Separated/Divorced</option>
              </select>
            </div>
          </div>
  <div class="form-group" style="margin-bottom:13%;">
            <label class="col-lg-2 control-label left">Applicant Lives With:<span style="color:red; padding:5%;">*</span></label>
            <div class="col-lg-8">
              <select class="form-control choose" multiple="multiple" data-placeholder="Select a status" name="chkLivesWith" id="chkLivesWith" style="width: 100%">
                <option value="Father and Mother">Father and Mother</option>
                <option value="Stepfather and Mother">Stepfather and Mother</option>
                <option value="Father">Father</option>
                <option value="Stepmother and Father">Stepmother and Father</option>
                <option value="Mother">Mother</option>
                <option value="Relative/s">Relative/s</option>
              </select>
            </div>
          </div>

          </div>
          </div>
          </div>

<div class="container">
    <hr>
  <div class="row">
      <!-- edit form column -->
      <div class="col-md-9 personal-info">
        <h3>Siblings</h3>
        <div class= "right" style="margin-bottom:7%">
               <a href="#"><span class="btn btn-info" id="siblingbutton" style="float: right;" onclick="addSibling();" >ADD</span></a>
        </div>
        <div class="form-group" id="sibling">

            <label class="col-lg-4 control-label left">Name:</label>
            <div class="col-lg-8" style="margin-bottom:2%; width:45%;">
              <input class="form-control" type="text" name="txtSiblName[]" id="txtSiblName">
            </div>
            <label class="col-lg-4 control-label left">Age:</label>
            <div class="col-lg-8" style="margin-bottom:2%; width:45%;">
              <input class="form-control" type="text" name="txtSiblAge[]" id="txtSiblAge">
            </div>
            <label class="col-lg-4 control-label left">Grade/Level:</label>
            <div class="col-lg-8" style="margin-bottom:2%;width:45%;">
              <input class="form-control" type="text" name="txtSiblGrd[]" id="txtSiblGrd">
            </div>
            <label class="col-lg-4 control-label left">School:</label>
            <div class="col-lg-8" style="margin-bottom:2%;width:45%;">
              <input class="form-control" type="text" name="txtSiblSchool[]" id="txtSiblSchool">
          </div>
       </div>
      </div>
  </div>
</div>

<div class="container">
    <hr>
  <div class="row">
      <!-- edit form column -->
      <div class="col-md-9 personal-info">
        <h3>Other members of the Household</h3>
        <div class= "right" style="margin-bottom: 7%">
               <a href="#"><span class="btn btn-info" id="relativebutton" style="float: right" onclick="addRelative();" >ADD</span></a>
        </div>

          <div class="form-group" id="relative">
            <label class="col-lg-4 control-label left">Name:</label>
            <div class="col-lg-8" style="margin-bottom:2%;width:45%;">
              <input class="form-control" type="text" name="txtRelName[]" id="txtRelName">
            </div>

            <label class="col-lg-4 control-label left">Age:</label>
            <div class="col-lg-8" style="margin-bottom:2%;width:45%;">
              <input class="form-control" type="text" name="txtRelAge[]" id="txtRelAge">
            </div>

            <label class="col-lg-4 control-label left">Relation:</label>
            <div class="col-lg-8" style="margin-bottom:2%;width:45%;">
              <input class="form-control" type="text" name="txtRelRelation[]" id="txtRelRelation">
            </div>
          </div>

      </div>
  </div>
</div>
                                    <div>
                                    <hr>
                                    <ul class="list-inline pull-right" style="margin-top: 5%">
                                        <li><button type="button" class="btn btn-default prev-step" onclick="scrollWin()">Previous</button></li>
                                        <li><button type="button" class="btn btn-primary next-step" onclick="scrollWin()">Next</button></li>
                                    </ul>
                                    </div>

                                  </div> <!-- tab pane step3-->

                                  <div class="tab-pane" role="tabpanel" id="step4">

                                    <!-- <div class="col-md-12 col-sm-12 col-xs-12"> -->
                                    <center><h3 style="margin-left: 3%">Health History</h3></center>
                                    <span style="color: rgba(255, 0, 0, 0.9); padding:5%;">* <span style="color: rgba(0, 0, 0, 0.9) ; font-size: 12px;">Indicates required fields</span></span>
                                    <hr>
                                      <!-- <h3>Health History</h3> -->

                                          <div class="form-group">
                                            <label class="col-lg-2 control-label">Allergies:</label>
                                            <div class="col-lg-7" style="width:45%;">
                                              <input class="form-control" type="text" name="txtHealthAllergies" id="txtHealthAllergies">
                                            </div>
                                          </div>

                                          <div class="form-group" style="margin-top: 6%">
                                            <label class="col-lg-2">Illness or Disability:</label>
                                            <div class="col-lg-7" style="width:45%;">
                                              <input class="form-control" type="text" name="txtHealthIllness" id="txtHealthIllness">
                                            </div>
                                          </div>

                                          <div class="form-group" style="margin-top: 10%">
                                            <label class="col-lg-2 control-label">Medication:</label>
                                            <div class="col-lg-7" style="width:45%;">
                                              <input class="form-control" type="text" name="txtHealthMeds" id="txtHealthMeds">
                                            </div>
                                          </div>

                                          <div class="form-group" style="margin-top: 14%">
                                            <label class="col-lg-2 control-label">Blood Type:</label>
                                              <div class="col-lg-7" style="width:11%;">
                                                <select class="form-control choose" style="width: 100%;" name="selHealthBtype" id="selHealthBtype">
                                                  <option value="A">A</option>
                                                  <option value="B">B</option>
                                                  <option value="O">O</option>
                                                  <option value="AB">AB</option>
                                                </select>
                                              </div>
                                              </div>


                                              <div class="form-group" style="margin-top: 18%">
                                                <label class="col-lg-3 control-label">Hospitalized?
                                                  <label style="margin-left: 3%">Yes
                                                    <input type="radio" name="h2" class="minimal" checked value="Y">
                                                  </label>
                                                  <label>No
                                                    <input type="radio" name="h2" class="minimal" onchange="disabledReason()" value="N">
                                                  </label>
                                                </label>
                                              </div>

                                              <div class="form-group" style="margin-top: 21%">
                                                <label class="col-lg-2 control-label">Reason:</label>
                                                <div class="col-lg-7" style="width:45%;">
                                                  <input class="form-control" type="text" name="txtHealthReason" id="txtHealthReason">
                                                  <!--<textarea rows="2" cols="20" class="form-control" type="text" name="txtHealthReason" id="txtHealthReason" style="width: 60%"></textarea>-->
                                                </div>
                                              </div>

                                              <div class="form-group" style="margin-top: 25%">
                                                <label class="col-lg-7 control-label">In case of emergency, can we call your family doctor/pediatrician?
                                                  <label style="margin-left: 3%">Yes
                                                    <input type="radio" name="r1" class="minimal" checked value="Y">
                                                  </label>
                                                  <label>No
                                                    <input type="radio" name="r1" class="minimal" onchange="disabledEmergency()" value="N">
                                                  </label>
                                                </label>
                                              </div>

                                              <div class="form-group" style="margin-top: 29%">
                                                <label class="col-lg-2 control-label">Doctor's Name:</label>
                                                <div class="col-lg-7" style="width: 30%;">
                                                  <input class="form-control" type="text" name="txtHealthDoctor" id="txtHealthDoctor">
                                                </div>
                                              </div>

                                              <div class="form-group" style="margin-top: 33%">
                                                <label class="col-lg-2 control-label">Hospital:</label>
                                                <div class="col-lg-7" style="width: 35%;">
                                                  <input class="form-control" type="text" name="txtHealthHospital" id="txtHealthHospital">
                                                </div>
                                              </div>

                                              <div class="form-group" style="margin-top: 37%">
                                                <label class="col-lg-2 control-label">Tel/Mobile #:</label>
                                                <div class="col-lg-7" style="width: 17%;">
                                                  <input class="form-control" type="text" name="txtHealthHosNum" id="txtHealthHosNum">
                                                </div>
                                              </div>

                                              <div class="form-group" style="margin-top: 41%">
                                                <label class="col-lg-2 control-label left">Hospital Address:</label>
                                                <div class="col-lg-2">
                                                  <input class="form-control" type="text" placeholder="Unit/Bldg. No." name="txtHealthAddBldg" id="txtHealthAddBldg">
                                                </div>
                                                <div class="col-lg-3">
                                                  <input class="form-control" type="text" placeholder="Street Name/No." name="txtHealthAddSt" id="txtHealthAddSt">
                                                </div>
                                                <div class="col-lg-2">
                                                  <input class="form-control" type="text" placeholder="Brgy. Name/No." name="txtHealthAddBrgy" id="txtHealthAddBrgy">
                                                </div>
                                              </div>
          <div class="form-group" style="margin-top: 46%;">
            <label class="col-lg-2 control-label left"></label>
            <div class="col-lg-5" style="width: 27%;">
              <input class="form-control" type="text" placeholder="City/Municipality" name="txtHealthAddCity" id="txtHealthAddCity">
            </div>
            <div class="col-lg-2">
              <input class="form-control" type="text" value="Philippines" name="txtHealthAddCountry" id="txtHealthAddCountry">
            </div>
          </div>


  <div class="container" style="margin-top: 50%">
    <hr>
  <div class="row">
      <!-- edit form column -->
      <div class="col-md-9 personal-info">
      	<h4 style="font-weight: bold">Emergency Contact</h4>
        <h5>Other person(s) to contact in case of emergency</h5>
        <div class= "right" style="margin-bottom:7%">
               <a href="#"><span class="btn btn-info" id="emcontactbutton" style="float: right" onclick="addEmergencyContact();" >ADD</span></a>
        </div>
        <div class="form-group" id="sibling">

            <label class="col-lg-4 control-label">Name:</label>
            <div class="col-lg-8" style="width: 45%; margin-bottom:1%;">
              <input class="form-control" type="text" name="txtEmName[]" id="txtEmName">
            </div>
            <label class="col-lg-4 control-label">Relation to Student:</label>
            <div class="col-lg-8" style="width: 45%; margin-bottom:1%;">
              <input class="form-control" type="text" name="txtReltoStud[]" id="txtReltoStud">
            </div>
            <label class="col-lg-4 control-label">Tel/Mobile Number:</label>
            <div class="col-lg-8" style="width: 45%; margin-bottom:1%;">
              <input class="form-control" type="text" name="txtEmNum[]" id="txtEmNum">
            </div>
            <label class="col-lg-4 control-label">Address:</label>
            <div class="col-lg-8" style="width: 45%;">
              <input class="form-control" type="text" name="txtEmAdress[]" id="txtEmAdress">
          </div>
       </div>
      </div>
  </div>
</div>

              <ul class="list-inline pull-right" style="margin-top: 5%">
                 <li><button type="button" class="btn btn-default prev-step" onclick="scrollWin()">Previous</button></li>
              </ul>
              <div class="btn-group" style="margin-top: 5%; float: right">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalAdmission" style="margin-right: 15px; ">Save Student</button>
              </div>
             


              <!-- Modal Admission -->
                <div class="modal fade" id="modalAdmission" role="dialog">
                  <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title" id="deleteModalOne"> PROCEED </h4>
                        </div>
                        <div>
                        <button type="submit" class="btn btn-info" name="btnSave" id="btnSave" href="saveadmission.php" style="margin-top: 3%; margin-left: 40%">Save Student</button>
                        </div>

                        <div>
                        <button type="button" class="btn btn-primary" name="btnfees" id="btnfees" style="margin-top: 3%; margin-left: 37%;"><a target="_blank" href="outputListofFees.php" style="color: white">Print List of Fees</a></button>
                        </div>

                        <div style="margin-left: 33%">
                        <form method="post" action="outputAdmissionNotice.php" target="_blank">
                                <input type="hidden" id="fname" name="fname" />
                                <input type="hidden" id="mname" name="mname" />
                                <input type="hidden" id="lname" name="lname" />
                          <button type="submit" class="btn btn-success" name="btnbtn" id="btnbtn" style="margin-top: 3%;" target="_blank">Print Notice of Admission</button>
                        </form>
                        </div>
                        <div class="modal-footer" style="margin-top: 5%; float: center">
                            <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                  </div>
                </div>
                <!--modal end-->
        

        </form> <!-- main form -->
             </div> <!-- tab pane step4 -->

                                <div class="clearfix"></div>
                              </div> <!-- tab pane step4 -->
                            </div> <!-- tab content -->


                        </div> <!-- wizard -->
                      </section>
                    </div> <!-- /.box-body -->
                </div><!-- /.box-default -->
              </div><!-- /.col-md-12 -->
            </div><!-- /.row -->
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
  <!-- InputMask -->
  <script src="jquery.inputmask.js"></script>
  <script src="jquery.inputmask.date.extensions.js"></script>
  <script src="jquery.inputmask.extensions.js"></script>
  <!-- DataTables -->
  <script src="plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
  <script src="js/select2.full.min.js"></script>
  <script type="text/javascript" src="formwizard.js"></script>
  <script type='text/javascript' src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script><!--
  <script src="js/multiple-select.js"></script> -->
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

  function getAge(){
    var dob = document.getElementById('date').value;
    dob = new Date(dob);
    var today = new Date();
    var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));
    document.getElementById('age').value=age;
}
  </script>

    <script>
  function scrollWin() {
      window.scrollTo(0, -300);
  }
  </script>

  <script>

function readURL(input) {
  if (input.files && input.files[0]){
    var reader = new FileReader();

    reader.onload = function(e){
      $('#pictureview').attr('src',e.target.result);
    }
    reader.readAsDataURL(input.file[0]);
  } else{
    $('#pictureview'.attr('src','//placehold.it/100'))
  }
}
$("#picture").change(function() {
  readURL(this);
});
</script>

  </body>

</html>
