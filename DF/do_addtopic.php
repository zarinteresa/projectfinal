<?php
include 'connect.php';
doDB();

if($_SESSION["user"] == null){
	header("Location: userLogin.html");
	exit;
}

//check for required fields from the form
if ((!$_POST['topic_title']) || (!$_POST['post_text'])) {
	header("Location: addtopic.html");
	exit;
}

//create safe values for input into the database
$clean_topic_owner = mysqli_real_escape_string($mysqli, $_SESSION["user"]);
$clean_topic_title = mysqli_real_escape_string($mysqli, $_POST['topic_title']);
$clean_post_text = mysqli_real_escape_string($mysqli, $_POST['post_text']);

//create and issue the first query
$add_topic_sql = "INSERT INTO topics (Title, Created, Owner) VALUES ('".$clean_topic_title ."', now(), '".$clean_topic_owner."')";

$add_topic_res = mysqli_query($mysqli, $add_topic_sql) or die(mysqli_error($mysqli));

//get the id of the last query
$topic_id = mysqli_insert_id($mysqli);

//create and issue the second query
$add_post_sql = "INSERT INTO posts (TopicId, PostText, Created, Owner) VALUES ('".$topic_id."', '".$clean_post_text."',  now(), '".$clean_topic_owner."')";

$add_post_res = mysqli_query($mysqli, $add_post_sql) or die(mysqli_error($mysqli));

//close connection to MySQL
mysqli_close($mysqli);

//create nice message for user
$display_block = "<p>The <strong>".$_POST["topic_title"]."</strong> topic has been created.</p>";
?>
<!DOCTYPE html>
<html>
<head>
<title>New Topic Added</title>
	<meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <title>Home Page</title>
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <link rel="stylesheet" href="css/topics.css">
	  <link rel="stylesheet" href="css/menu.css">
      <link rel="stylesheet" href="css/responsive.css">
      <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
	body{
		text-align: center;
	}
	#logOut{
		background-color: #4286f4;
    color: white;
    position: fixed;
    top: 50px;
    right: 50px;
    padding: 15px 35px;
    border: 1px solid white;
    border-radius: 20px;
    font-size: 20px;
	}
	#logOut:hover{
		background-color: skyblue;
    color: black;
	}
</style>
</head>
<body>
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
                               <a href="homepage.php"><img src="css/images/logo.png" alt="#" /></a>
                            </div>
                         </div>
                      </div>
                   </div>
                     <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                        <a href = "topiclist.php"><button id = "logOut">Forum</button></a>
                    </div>
                   </div>
               </div>
         </div>
			 <section class="banner_main">
             <div class="container">
                <div class="row d_flex">
                   <div class="col">
				   <section id = "filler"> </section>
						<section id = "topics">
						<?php echo $display_block; ?>
						</section>
					<section id = "filler"> </section>
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

<script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.0.0.min.js"></script>
</body>
</html>
