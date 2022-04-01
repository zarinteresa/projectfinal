<?php
include 'connect.php';
doDB();

if($_SESSION["user"] == null){
	header("Location: userLogin.html");
	exit;
}

if($_GET){
    $safe_topic_id = mysqli_real_escape_string($mysqli, $_GET['topic_id']);
    $_SESSION["topic_id"] = $safe_topic_id;
}

if(!$_POST){
    
    //get record from topics table
    $get_topic_sql = "SELECT * FROM topics WHERE TopicId = $safe_topic_id;";
    $get_topic_res = mysqli_query($mysqli, $get_topic_sql) or die(mysqli_error($mysqli));
    
    // get record from topic posting table
    //$get_post_sql = "SELECT * FROM rj_posts WHERE TopicId = $safe_topic_id;";
    //$get_post_res = mysqli_query($mysqli, $get_post_sql) or die(mysqli_error($mysqli));

    $display_block = "";
    
    if (mysqli_num_rows($get_topic_res) < 1) {
        //no records
        $display_block .= "<p><em>There was an error retrieving your topic!</em></p>";
    } else {
        //topic record exists, so display topic and post information for editing
        $rec = mysqli_fetch_array($get_topic_res);
        $display_id = stripslashes($rec['TopicId']);
        $display_title = stripslashes($rec['Title']);
        $display_block .= "<form method='post' id = 'addForm' action='".$_SERVER['PHP_SELF']."'>";
        $display_block .="<p><label>Topic Title:</label> <br> <input type='text' id='topic_title' name='topic_title' value='".$display_title."'></p>";
        //$postRec = mysqli_fetch_array($get_post_res);
        //$display_post = stripslashes($postRec['PostText']);
        //$display_block .="<p><label>Post Text:</label> <br> <textarea rows='8' cols='40' style='vertical-align:text-top;' id='post_text' name='post_text'>".$display_post."</textarea></p>";
        $display_block .= "<button type='submit' class = 'styledButton' id='change' name='change' value='change'>Change Topic</button></p>";
        $display_block .="</form>";
    }
    //free result
    //mysqli_free_result($get_post_res);
    mysqli_free_result($get_topic_res);
}
else{
    $clean_topic_title = mysqli_real_escape_string($mysqli, $_POST['topic_title']);
	//$clean_post_text = mysqli_real_escape_string($mysqli, $_POST['post_text']);

	//create and issue the forum_topic update
	$update_topic_sql = "UPDATE topics SET Title = '".$clean_topic_title ."' WHERE TopicId =".$_SESSION["topic_id"];
	$update_topic_res = mysqli_query($mysqli, $update_topic_sql) or die(mysqli_error($mysqli));

	//create and issue the forum_post update
	//$update_post_sql = "UPDATE rj_posts SET PostText='" .$clean_post_text."' WHERE TopicId= ".$_SESSION["topic_id"];
	//$update_post_res = mysqli_query($mysqli, $update_post_sql) or die(mysqli_error($mysqli));

	//close connection to MySQL
	mysqli_close($mysqli);

	//create nice message for user
    $display_block ="<p style = 'font-size: 20px; margin-top: 15px;'> Your Topic has been modified. </p>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <title>Topics</title>
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <link rel="stylesheet" href="css/menu.css">
      <link rel="stylesheet" href="css/forms.css">
      <link rel="stylesheet" href="css/responsive.css">
      <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">

    <title>Edit Topic</title>
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
				   <section style = "text-align: center;">
    <?php echo $display_block ?>
</section>
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