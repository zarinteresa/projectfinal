<?php
    include 'connect.php';
    doDB();

    $topics = "SELECT * FROM topics";
    $result = mysqli_query($mysqli, $topics) or die(mysqli_error($mysqli));

    //Go through each result row, which is stored as an array, and add the data to xml tags
    $xml = "<topicList>";
    while($r = mysqli_fetch_array($result)){
        $xml .= "<topic>";
        $xml .= "<id>".$r['TopicId']."</id>";
        $xml .= "<title>".$r['Title']."</title>";
        $xml .= "<created>".$r['Created']."</created>";
        $xml .= "<owner>".$r['Owner']."</owner>";
        $xml .= "<likes>".$r['Likes']."</likes>";
        $xml .= "</topic>";
    }
    $xml .= "</topicList>";

    //Parse our data
    $sxe = new SimpleXMLElement($xml);
    $sxe->asXML("topics.xml");
    $display_block = "<p style = 'font-size: 30px; color: red; text-align:center;'>The Discussion Topics were successfully saved.</p>";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <title>Home Page</title>
      <link rel="stylesheet" href="css/bootstrap.min.css">
	  <link rel="stylesheet" href="css/menu.css">
      <link rel="stylesheet" href="css/responsive.css">
      <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        #logOut{
            background-color: #4286f4;
            color: white;
            position: fixed;
            top: 15px;
            right: 15px;
            padding: 5px 20px;
            border: 1px solid white;
            border-radius: 20px;
        }
        #logOut:hover{
            background-color: white;
            color: #4286f4;
        }
    </style>
</head>
<body>
<header>
       <div  class="head_top">
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
			 <section class="banner_main">
             <div class="container">
                <div class="row d_flex">
                   <div class="col">
                       <p> <?php echo $display_block; ?></p>
                  
                   </div>
                </div>
             </div>
          </section>
</div>

<a href = "logOut.php"><button id = "logOut">Log Out</button></a>

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

<script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.0.0.min.js"></script>


</body>
</html>
