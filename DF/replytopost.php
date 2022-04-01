<?php
include 'connect.php';
doDB();

if($_SESSION["user"] == null){
	header("Location: userLogin.html");
	exit;
}

//check to see if we're showing the form or adding the post
if (!$_POST) {
   // showing the form; check for required item in query string
   if (!isset($_GET['post_id'])) {
      header("Location: topiclist.php");
      exit;
   }

   //create safe values for use
   $safe_post_id = mysqli_real_escape_string($mysqli, $_GET['post_id']);

   //still have to verify topic and post
   $verify_sql = "SELECT t.TopicId, t.Title FROM posts
                  AS p LEFT JOIN topics AS t ON p.TopicId =
                  t.TopicId WHERE p.PostId = '".$safe_post_id."'";

   $verify_res = mysqli_query($mysqli, $verify_sql)
                 or die(mysqli_error($mysqli));

   if (mysqli_num_rows($verify_res) < 1) {
      //this post or topic does not exist
      header("Location: topiclist.php");
      exit;
   } else {
      //get the topic id and title
      while($topic_info = mysqli_fetch_array($verify_res)) {
         $topic_id = $topic_info['TopicId'];
         $topic_title = stripslashes($topic_info['Title']);
      }
?>
      <!DOCTYPE html>
      <html>
      <head>
      <title>Post Your Reply in <?php echo $topic_title; ?></title>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <title>Topics</title>
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <link rel="stylesheet" href="css/menu.css">
      <link rel="stylesheet" href="css/responsive.css">
      <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
      <link href="css/forms.css" rel="stylesheet" type="text/css" />
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
      <!-- <header id = "top">
        <h1> Reply to <?php echo $topic_title; ?> </h1>
      </header>
      <nav>
            <a href = "discussionMenu.html"><button>Main Menu</button></a>
            <a href="showtopic.php"><button>Show Topics</button></a>
            <a href = "addtopic.html"><button>Add Topic</button></a>
      </nav>
      <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" id = "replyForm">

      <p><label for="post_text">Post Text:</label><br/>
      <textarea id="post_text" name="post_text" rows="8" cols="40"
         required="required" autofocus></textarea></p>
      <input type="hidden" name="topic_id" value="<?php echo $topic_id; ?>">
      <button id = "addPost" class = "styledButton" type="submit" name="submit" value="submit">Add Post</button>
      </form>

      <a href = "logOut.php"><button id = "logOut">Log Out</button></a> -->
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
                   
                   <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" id = "replyForm" style="width:500px;">
                      <h1> Reply to <?php echo $topic_title; ?> </h1>
                     <p><label for="post_text">Post Text:</label><br/>
                     <textarea id="post_text" name="post_text" rows="8" cols="40"
                        required="required" autofocus></textarea></p>
                     <input type="hidden" name="topic_id" value="<?php echo $topic_id; ?>">
                     <button id = "addPost" class = "styledButton" type="submit" name="submit" value="submit">Add Reply</button>
                     </form>
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
<?php
      //free result
      mysqli_free_result($verify_res);

      //close connection to MySQL
      mysqli_close($mysqli);
   }

} else if ($_POST) {
      //check for required items from form
      if ((!$_POST['topic_id']) || (!$_POST['post_text'])/* || (!$_POST['post_owner'])*/) {
          header("Location: topiclist.php");
          exit;
      }

      //create safe values for use
      $safe_topic_id = mysqli_real_escape_string($mysqli, $_POST['topic_id']);
      $safe_post_text = mysqli_real_escape_string($mysqli, $_POST['post_text']);
      $safe_post_owner = mysqli_real_escape_string($mysqli, $_SESSION["user"]);

      //add the post
      $add_post_sql = "INSERT INTO posts (TopicId, PostText,
                       Created , Owner) VALUES
                       ('".$safe_topic_id."', '".$safe_post_text."',
                       now(),'".$safe_post_owner."')";
      $add_post_res = mysqli_query($mysqli, $add_post_sql)
                      or die(mysqli_error($mysqli));

      //close connection to MySQL
      mysqli_close($mysqli);

      //redirect user to topic
      header("Location: showtopic.php?topic_id=".$_POST['topic_id']);
      exit;
}
?>

