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
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
  <link rel="stylesheet" href="css/bootstrap3-wysihtml5.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="css/daterangepicker/daterangepicker.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="css/datepicker/datepicker3.css">
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="css/select2.min.css">
  <link rel="stylesheet" type="text/css" href="formwizard2.css">
  <link rel="stylesheet" type="text/css" href="css/sweetalert.css">
  <link rel="stylesheet" href="css/fullcalendar.min.css">
  <link rel="stylesheet" href="css/fullcalendar.print.css" media="print">
  <link rel="stylesheet" href="css/iCheck/all.css">
   <link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">
    <style>
      body {
        font-family: 'Noto Sans', sans-serif;
        font-weight: bold;
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
                   <!--<?php echo $namess ?> -->
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
          <!-- <p style="text-align: center; font-size: 14px; padding-top: 15px; color: white">Kiddo Academy Admission and Enrollment with Billing and Collection</p> -->
       
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
         <li class="header" style="color: black; font-size: 17px; margin-top: 3%">Welcome!</li>
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
   <div class="small-box bg-aqua">
         <div class="inner">
           <?php
             $query="select * from tblschoolyear where tblSchoolYrActive='ACTIVE' and tblSchoolYearFlag=1";
             $result=mysqli_query($con, $query);
             $row=mysqli_fetch_array($result);
             $sy=$row['tblSchoolYrYear'];
           ?>
           <h3><?php echo $sy ?></h3>
           <p style="font-size: 24px">Welcome!</p>
         </div>
         <div class="icon">
           <i class="fa fa-calendar-o"></i>
         </div>

       </div>

<!-- Calendar -->
<div class="row">
     <div class="col-md-3">
       <div class="box box-solid">
         <div class="box-header with-border">
           <h4 class="box-title">Draggable Events</h4>
         </div>
         <div class="box-body">
           <!-- the events -->
           <div id="external-events">
             <div class="external-event bg-green">Admission Starts</div>
             <div class="external-event bg-yellow">Admission Ends</div>
             <div class="external-event bg-aqua">Enrollment Starts</div>
             <div class="external-event bg-light-blue">Enrollment Ends</div>
             <div class="external-event bg-red">Start of class</div>
             <div class="checkbox">
               <label for="drop-remove">
                 <input type="checkbox" id="drop-remove">
                 remove after drop
               </label>
             </div>
           </div>
         </div>
         <!-- /.box-body -->
       </div>
       <!-- /. box -->
       <div class="box box-solid">
         <div class="box-header with-border">
           <h3 class="box-title">Create Event</h3>
         </div>
         <div class="box-body">
           <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
             <!--<button type="button" id="color-chooser-btn" class="btn btn-info btn-block dropdown-toggle" data-toggle="dropdown">Color <span class="caret"></span></button>-->
             <ul class="fc-color-picker" id="color-chooser">
               <li><a class="text-aqua" href="#"><i class="fa fa-square"></i></a></li>
               <li><a class="text-blue" href="#"><i class="fa fa-square"></i></a></li>
               <li><a class="text-light-blue" href="#"><i class="fa fa-square"></i></a></li>
               <li><a class="text-teal" href="#"><i class="fa fa-square"></i></a></li>
               <li><a class="text-yellow" href="#"><i class="fa fa-square"></i></a></li>
               <li><a class="text-orange" href="#"><i class="fa fa-square"></i></a></li>
               <li><a class="text-green" href="#"><i class="fa fa-square"></i></a></li>
               <li><a class="text-lime" href="#"><i class="fa fa-square"></i></a></li>
               <li><a class="text-red" href="#"><i class="fa fa-square"></i></a></li>
               <li><a class="text-purple" href="#"><i class="fa fa-square"></i></a></li>
               <li><a class="text-fuchsia" href="#"><i class="fa fa-square"></i></a></li>
               <li><a class="text-muted" href="#"><i class="fa fa-square"></i></a></li>
               <li><a class="text-navy" href="#"><i class="fa fa-square"></i></a></li>
             </ul>
           </div>
           <!-- /btn-group -->
           <div class="input-group">
             <input id="new-event" type="text" class="form-control" placeholder="Event Title">

             <div class="input-group-btn">
               <button id="add-new-event" type="button" class="btn btn-primary btn-flat">Add</button>
             </div>
             <!-- /btn-group -->
           </div>
           <!-- /input-group -->
         </div>
       </div>
     </div>
     <!-- /.col -->
     <div class="col-md-9">
       <div class="box box-primary">
         <div class="box-body no-padding">
           <!-- THE CALENDAR -->
           <div id="calendar"></div>
         </div>
         <!-- /.box-body -->
       </div>
       <!-- /. box -->
     </div>
     <!-- /.col -->
   </div>
   <!-- /.row -->
</div>
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

<script src="js/jQuery/jquery-2.2.3.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src=".plugins/fastclick/fastclick.js"></script>
<script src="dist/js/app.min.js"></script>
<script src="dist/js/demo.js"></script>
 <script type="text/javascript" src="js/formwizard.js"></script>
 <script src="js/selectjs/select2.full.min.js"></script>
<script src="js/datatables/jquery.dataTables.min.js"></script>
<script src="js/datatables/dataTables.bootstrap.min.js"></script>
<script src="js/input-mask/jquery.inputmask.js"></script>
<script src="js/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="js/input-mask/jquery.inputmask.extensions.js"></script>
<script src="js/icheck.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="js/fullcalendar.min.js"></script>

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

<script>
$(function () {

 /* initialize the external events
  -----------------------------------------------------------------*/
 function ini_events(ele) {
   ele.each(function () {

     // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
     // it doesn't need to have a start or end
     var eventObject = {
       title: $.trim($(this).text()) // use the element's text as the event title
     };

     // store the Event Object in the DOM element so we can get to it later
     $(this).data('eventObject', eventObject);

     // make the event draggable using jQuery UI
     $(this).draggable({
       zIndex: 1070,
       revert: true, // will cause the event to go back to its
       revertDuration: 0  //  original position after the drag
     });

   });
 }

 ini_events($('#external-events div.external-event'));

 /* initialize the calendar
  -----------------------------------------------------------------*/
 //Date for the calendar events (dummy data)
 var date = new Date();
 var d = date.getDate(),
     m = date.getMonth(),
     y = date.getFullYear();
 $('#calendar').fullCalendar({
   header: {
     left: 'prev,next today',
     center: 'title',
     right: 'month,agendaWeek,agendaDay'
   },
   buttonText: {
     today: 'today',
     month: 'month',
     week: 'week',
     day: 'day'
   },
   //Random default events
   events: [

   ],
   editable: true,
   droppable: true, // this allows things to be dropped onto the calendar !!!
   drop: function (date, allDay) { // this function is called when something is dropped

     // retrieve the dropped element's stored Event Object
     var originalEventObject = $(this).data('eventObject');

     // we need to copy it, so that multiple events don't have a reference to the same object
     var copiedEventObject = $.extend({}, originalEventObject);

     // assign it the date that was reported
     copiedEventObject.start = date;
     copiedEventObject.allDay = allDay;
     copiedEventObject.backgroundColor = $(this).css("background-color");
     copiedEventObject.borderColor = $(this).css("border-color");

     // render the event on the calendar
     // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
     $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

     // is the "remove after drop" checkbox checked?
     if ($('#drop-remove').is(':checked')) {
       // if so, remove the element from the "Draggable Events" list
       $(this).remove();
     }

   }
 });


 /* ADDING EVENTS */
 var currColor = "#3c8dbc"; //Red by default
 //Color chooser button
 var colorChooser = $("#color-chooser-btn");
 $("#color-chooser > li > a").click(function (e) {
   e.preventDefault();
   //Save color
   currColor = $(this).css("color");
   //Add color effect to button
   $('#add-new-event').css({"background-color": currColor, "border-color": currColor});
 });
 $("#add-new-event").click(function (e) {
   e.preventDefault();
   //Get value and make sure it is not null
   var val = $("#new-event").val();
   if (val.length == 0) {
     return;
   }

   //Create events
   var event = $("<div />");
   event.css({"background-color": currColor, "border-color": currColor, "color": "#fff"}).addClass("external-event");
   event.html(val);
   $('#external-events').prepend(event);

   //Add draggable funtionality
   ini_events(event);

   //Remove event from text input
   $("#new-event").val("");
 });
});
</script>
</body>
</html>
