<?php 
	include 'connect.php';
	doDB();
 ?>



<html>
<head>
<meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <title>Home</title>
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <link rel="stylesheet" href="css/topics.css">
	  <link rel="stylesheet" href="css/menu.css">
      <link rel="stylesheet" href="css/responsive.css">
      <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
                               <a href="homepage.php"><img src="css/images/logo.png" alt="#" /></a>
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
                   <div class="col">
                      
                      <div class="article-container">
                      <?php 
		if (isset($_POST['submit-search'])) {
			$search = mysqli_real_escape_string($mysqli, $_POST['search']);
			$sql = "SELECT * FROM posts NATURAL JOIN topics WHERE PostText LIKE '%$search%' OR TopicId LIKE '%$search%' OR Owner LIKE '%$search%'  OR Created LIKE '%$search%' OR Title Like'%$search%' OR Owner Like'%$search%'";
			$result = mysqli_query($mysqli, $sql);
			$queryResult = mysqli_num_rows($result);

			echo "There are ".$queryResult." results on ".$search."!";

			if ($queryResult > 0) {
				while ($row = mysqli_fetch_assoc($result)) {
					echo "<a href='article.php?title=".$row['PostText']."&date=".$row['Owner']."'><div class='article-box'>
						<h2>".$row['Title']."</h2>
						<h3>".$row['PostText']."</h3>
						<p>".$row['Created']."</p>
						<p>".$row['Owner']."</p>
						<p>".$row['TopicId']."</p>
						</div></a>";
				}
			} else {
				echo "There are no results matching your search!";
			}
		}
	 ?>
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

<script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.0.0.min.js"></script>
</body>
</html>


