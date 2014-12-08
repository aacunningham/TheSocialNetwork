<?php
 	// please validate the input
	$uploaddir = "uploads/";  // the directory where files are to be uploaded - include the trailing slash
	$file_name = $_GET['imageName'];
	echo "<img src='$uploaddir.$file_name' />";

?>