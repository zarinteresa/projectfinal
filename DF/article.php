<?php 
		include 'connect.php';
		doDB();
 ?>
	
	<h1>Article page</h1>
	

	<div class="article-container">
		<?php 
		$title = mysqli_real_escape_string($mysqli, $_GET['title']);
		$date = mysqli_real_escape_string($mysqli, $_GET['date']);

			$sql = "SELECT * FROM posts NATURAL JOIN topics WHERE PostText='$title' AND Created = '$date'";
			$result = mysqli_query($mysqli, $sql);
			$queryResults = mysqli_num_rows($result);

			if ($queryResults > 0) {
				while ($row = mysqli_fetch_assoc($result)) {
					echo "<div class='article-box'>
						<h2>".$row['Title']."</h2>
						<h3>".$row['PostText']."</h3>
						<p>".$row['Created']."</p>
						<p>".$row['Owner']."</p>
						<p>".$row['TopicId']."</p>
					</div>";
				}
			}
		 ?>
	</div>


</body>
</html>ssss