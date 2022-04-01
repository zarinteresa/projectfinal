<?php 
    include 'connect.php';
    doDB();
    
    $xmlList = simplexml_load_file("topics.xml") or die(header("Location: topiclist.php"));

    $display_block = "<table>";
    $display_block.="<tr><th>Id</th><th>Topic Title</th><th>Date Created</th><th>Owner</th><th>Likes</th></tr>";

    foreach($xmlList->topic as $t){
        $id = $t->id;
        $title = $t->title;
        $created = $t->created;
        $owner = $t->owner;
        $likes = $t->likes;

        $safe_id = mysqli_escape_string($mysqli, $id);
        $safe_title = mysqli_escape_string($mysqli, $title);
        $safe_created = mysqli_escape_string($mysqli, $created);
        $safe_owner = mysqli_escape_string($mysqli, $owner);
        $safe_likes = mysqli_escape_string($mysqli, $likes);

        $display_block .= "<tr><td>".$safe_id."</td><td>".$safe_title."</td><td>".$safe_created."</td><td>".$safe_owner."</td><td>".$safe_likes."</td></tr>";
    } 
    $display_block .= "</table>";

    //close connection to MySQL
    mysqli_close($mysqli);

    
?>
<!DOCTYPE html>
<html>
<head>
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
	table {
        width:100%;
		border: 1px solid black;
		border-collapse: collapse;
	}
	th {
		border: 1px solid black;
		padding: 6px;
		font-weight: bold;
        background: #2770e5;
        color: white;
	}
	td {
		border: 1px solid black;
		padding: 6px;
	}
    .num_posts_col { text-align: center; }
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
                   <section id = "filler"> </section>
        <section id = "saved">
            <p style="font-size:30px; margin-bottom:10px;">Saved Topics:</p>

            <?php echo $display_block; ?>
        </section>
        <section id = "filler"> </section>
                  
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
</body>
</html>