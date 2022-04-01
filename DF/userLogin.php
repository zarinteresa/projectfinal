<?php
include 'connect.php';
doDB();

//Check for required fields from the form
if(($_POST['username']=="") || ($_POST['password']=="")){
    header("Location: userlogin.html");
    exit;
}

$display_block="";

//Clean the input
$safe_username = mysqli_real_escape_string($mysqli, $_POST['username']);
$safe_password = mysqli_real_escape_string($mysqli, $_POST['password']);

//Store the query
$sql = "SELECT Fname, Lname FROM authorize_users WHERE UserName = '".$safe_username."' AND Password = '".$safe_password."'";

//Store the result of the query
$result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));

//Get the number of rows in the result set
if(mysqli_num_rows($result) == 1){
    $_SESSION["user"] = $safe_username;
    $_SESSION["password"] = $safe_password;
    header("Location:discussionMenu.html"); //success
    exit;
}
else{
    session_destroy();
    $display_block = "<p style = 'text-align: center; color: red; font-size: 40px;'>Username and/or password are invalid.</p>
    <p id = 'return' style = 'text-align: center;'><a href = 'userLogin.html' style = 'color: #4286f4; text-decoration: underline;'>Return to login</a></p>";
}

//Close the connection
mysqli_close($mysqli);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <title>Login Page</title>
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <link rel="stylesheet" href="css/createaccount.css">
      <link rel="stylesheet" href="css/responsive.css">
      <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
</head>
<body>
<header>
      <div class="head_top">
         <div class="header">
            <div class="container-fluid">
               <div class="row">
                  <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col logo_section">
                     <div class="full">
                        <div class="center-desk">
                           <div class="logo">
                              <a href="discussionMenu.html"><img src="css/images/logo.png" alt="#" /></a>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <section class="banner_main">
            <div class="container">
               <div class="row d_flex">
                  <div class=" col-xl-8 col-lg-8 col-md-8 col-12-9">
                     <div class="text-bg">
                     <p style="font-size: 40px; font-family: 'Righteous', cursive; color: black;"> <?php echo $display_block ?> </p>
         
                     </div>
               </div>
            </div>
      </div>
      </section>
      </div>
   </header>
   <footer>
      <div class="footer">
         <div class="container">
            <div class="row">
               <div class="col-md-12 ">
                  <div class="cont">
                     <h3> <strong class="multi"> Institute of Information Technology</strong><br>
                        Jahangirnagar University
                     </h3>
                  </div>
               </div>
               <div class="col-md-12">
                  <ul class="social_icon">
                     <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                     <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></i></a></li>
                     <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></i></a></li>
                  </ul>
               </div>
            </div>
         </div>
         <div class="copyright">
            <div class="container">
               <div class="row">
                  <div class="col-md-12">
                     <p>Copyright 2022 All Right Reserved By <a href="https://html.design/"> A D Z </a></p>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </footer>

</body>
</html>