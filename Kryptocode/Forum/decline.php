<?php

	$post_id  = $_GET["post_id"];



	require_once('db_connect2.php');

	$connect = mysqli_connect( HOST, USER, PASS, DB )

		or die("Can not connect");



	mysqli_query( $connect, "DELETE FROM pending_post WHERE post_id=$post_id" )

		or die("Can not execute query");




	header("Location: view_pending_post.php");

?>