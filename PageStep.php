<?php

require 'includes/database.php';

$conn = getDB();

$sql = "SELECT *
		FROM goglia_items
		ORDER BY ID;";
		
$results = mysqli_query($conn, $sql);

if ($results === false){
	echo mysqli_error($conn);
}else{
	$articles = mysqli_fetch_all($results, MYSQLI_ASSOC);
}

?>

<!DOCTYPE html>
<html>
	<head>
	<meta charset="UTF-8">'
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Open Food Facts</title>
	</head>
	<body>
	
	<header id="topPage">
	<h1>Open Food Facts</h1>
	</header>
	
	<header id = "midpage">
	<h3>Items:</h3>
	</header>
	
	<!-- <nav>
		<a href="PageStep.html">Open Food Facts Data</a> - goes on index.php
	</nav> -->
	
	<footer>
	<p>Link to website</p>
	<p>return to the top of the <a href="#topePage">page</a>.</p>
	</footer>

</body>
</html>