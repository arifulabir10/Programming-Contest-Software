<html>
	<head>
	<link rel="stylesheet" href="demo.css">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
		<title>Pending Post</title>
	</head>
		<body>
		<div class="resource_title">
  <h1 style="font-size:50px; background-color:rgb(66,103,178); color: white; margin-top:30px";>Pending Posts</h1>
  
 
 
			<?php


			
			
			echo"<div class='add_button'>";
							echo"<a href='create_pending_post.php'><button class='ui labled olive button'><h2>Create Admin Post</h2></button></a>";
						echo"</div>";

						?>
</div>

<style>
table {
  border-collapse: collapse;
  width: 95%;
  align-items:center;
  font-family: Arial, sans-serif;
  margin: 0 auto;
}

table th, table td {
  text-align: left;
  padding: 20px;
  border: 10px solid white;
  
}

table th {
  background-color: rgb(133,84,254);
  color: white;
  font-size:20px;
  
}

table tr:nth-child(even) {
  background-color: #F3F3F3;
}


.add_button {
	  display: inline-block;
	  margin-left: 20px;
	  margin-top: 10px;
  }

</style>

<?php

	if(isset($_GET['upload']))
	{
		$post_title = $_GET['post_title'];
		$post_description = $_GET['post_description'];

		$photo =$_FILES['photo']['post_title'];
		$tmp_name =$_FILES['photo']['tmp_name'];
		$folder ="pending_post_image/" .$photo;
		move_uploaded_file($tmp_name, $folder);

		$sql = "INSERT INTO pending_post VALUES ( NULL, '$post_title', '$post_description', '$photo', DATE_FORMAT(NOW(), '%D %M %Y %l:%m %p') )";
	}
?>

<?php





	require_once('db_connect2.php');
	$connect = mysqli_connect( HOST, USER, PASS, DB )
		or die("Can not connect");


	$results = mysqli_query( $connect, "SELECT * FROM pending_post
	
	order by post_id DESC;" )
		or die("Can not execute query");
		

	echo "<table class='ui celled striped unstackable collapsing table'> \n";
	echo "<table border=2> \n";
	echo "<thead><tr><th>SI</th> <th>Title</th> <th>Description</th> <th>Photo</th> <th>Time</th>
	<th>DELETE</th> <th>UPDATE</th></tr></thead><tbody> \n";

	while( $rows = mysqli_fetch_array( $results ) ) {
		extract( $rows );
		echo "<tr>";
		echo "<td> $post_id </td>";
		echo "<td> $post_title </td>";
		echo "<td> $post_description </td>";
		echo "<td> $photo </td>";
		echo "<td> $post_date </td>";
		echo "<td> <a href = 'decline.php?post_id=$post_id'><button class='ui labled red button'> <h3> Delete </h3></button> </a> </td>";
		echo "<td> <a href = 'approve.php?
		post_id=$post_id &post_title=$post_title &post_description=$post_description &photo=$photo'><button class='ui labled green button'><h3> Approve </h3></button></a> </td>";
		echo "</tr> \n";
	}

	echo "</tbody></table> \n";
?>
			
			
			


		</body>
</html>