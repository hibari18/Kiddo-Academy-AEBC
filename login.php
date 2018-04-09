<?php
   include("config.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
      
      $sql = "SELECT * FROM tbluser WHERE tblUserName = '$myusername' and tblUserPassword = '$mypassword'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      // $active = $row['active'];
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
    
      if($count == 1) {
         // session_register("myusername");
         $_SESSION['login_user'] = $myusername;
         
         header("location: dashboard.php");
      }else {
         $error = "Your Login Name or Password is invalid";
      }
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>AEBC</title>
<link rel="icon" type="image/gif" href=""/>
<link href="css/bootstrap.css" rel="stylesheet">
<link rel="stylesheet" href="css/font-awesome.css">
 <link rel="stylesheet" type="text/css" href="css/style.css"/>
 <link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
      html,body {
        font-family: 'Noto Sans', sans-serif;
        font-weight: bold;
      }
    </style>

</head>

<body>
<div class="container-fluid containerz">
 <!--  <center><div class="photo">
    <img id="logo" src="images/symbol.png">
    <img id="name" src="images/logo1.png">
  </div></center> -->
  <center><div class="container" style="margin-top: 10%">
   <div class="tagAuthentication">
        <b><p id="tagAdmin">User Authentication</p></b>
    </div>
    <center><form id="form1" name="form1" method="post">
    <div class="main">
     <div class="form-input">
		  <input type="text" name="username" id="username" class="userName" placeholder="Username">
	   </div>

	  <div class="form-input1">
	  <input type="password" name="password" id="password" class="pwd" placeholder="Password">
      </div>

        <input name="submit" type="submit" class="btn" id="submit" value="Log-In">
       <input name="reset" type="reset" class="btn" id="reset" value="Clear">
        &nbsp;

        </div><!-- end of main class-->
	  </form></center>

</div></center>
  <div class="row footer">
    <div class="text-center col-md-6 col-md-offset-3">
      <b><p>Copyright &copy; 2017 &middot; All Rights Reserved</p></b>
    </div>
  </div>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery-1.11.3.min.js"></script>

<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.js"></script>
</body>
</html>
