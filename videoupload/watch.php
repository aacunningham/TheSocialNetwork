<?php

mysql_connect("127.0.0.1","root","Aug3!");
mysql_select_db("videoupload");

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Video Upload</title>
</head>

<body>

<?php

if(isset($_GET['id']))
{
	$id = $_GET['id'];
	$query = mysql_query("SELECT * FROM `videos` WHERE id='$id'");
	while($row = mysql_fetch_assoc($query))
	{
		$name = $row['name'];
		$url = $row['url'];
	}
	
	echo "You are watching ".$name."<br />";
	echo "<embed src='$url' width='560' height='315'></embed>";
}
else
{
	echo "Error!";
}

?>

</body>
</html>