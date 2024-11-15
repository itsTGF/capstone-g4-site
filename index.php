<!DOCTYPE html>
<html>
<head>
    
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Capstone</title>
	
	<style>
	* {
  		box-sizing: border-box;
	}

	/* Create two columns/boxes that floats next to each other */
	nav {
 		 float: left;
 		 width: 30%;
 		 background: #ccc;
 		 padding: 20px;
 		 height: 300px;
	}

	/* Style the list inside the menu */
	nav ul {
 		 list-style-type: none;
 		 padding: 0;
	}

	li { 
		  margin-bottom: 2em; 
	}

	section::after {
 		 content: "";
 		 display: table;
 		 clear: both;
	}

	/* Responsive layout - makes the two columns/boxes stack on top of each other instead of next to each other, on small screens */
	@media (max-width: 600px) {
 	 	nav, article {
   			width: 100%;
    			height: auto;
 		}
	}
	</style>
	</head>

	<body>
    
	<header>
 		<h1>Recipe Rundown</h1>
  		<h4><i>- Be Your Own Chef -</i></h4>
	</header>

	<section>
		<nav>
    			<ul>
        			<li><a href="OpenFood.php">Open Food Facts Data</a></li>
        			<li><a href="#">_</a></li> <!--Your page reference here-->
        			<li><a href="#">_</a></li> <!--Your page reference here-->
        			<li><a href="#">_</a></li> <!--Your page reference here-->
    			</ul>
		</nav>

		<article>
    			<h3>About Us</h3>
    			<p>This site holds data from four food-related APIs. This platform allows users to explore recipes, what food items they involve, and the nutrients in each item.</p>
    			<hr>
    			<!--<p>The APIs used are: Open Food Facts, ___, ___, and ___.</p>-->
		</article>
	</section>

	<footer>
  		<p>Computing & Informatics Capstone Project - 2024</p>
  		<hr>
  		<p>Contributors:</p>
  		<ul>
     			<li>Benny Pena</li>
      			<li>Jon Stewart
      			<li>Justin Goglia
      			<li>Mariano DiGiacomo
    		</ul>
	</footer>

	</body>
</html>

<!-- - -->

<?php

/**
 * Home page of the website
 * Capstone Group 4
 */

require 'include/database.php';

echo("Hello World!" . PHP_EOL);

$conn = getDB();

$sql = "SELECT * FROM edamam.ingredient_info";
$stmt = sqlsrv_query($conn, $sql);

if ($stmt === false) {
	die(print_r(sqlsrv_errors(), true));
}

echo "<table border = '1'>
		<tr>
			<th>ID</th>
			<th>Name</th>
			<th>Calories</th>
		</tr>";

while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
	echo "<tr>
			<td>" . $row['id'] . "</td>
			<td>" . $row['name'] . "</td>
			<td>" . $row['calories'] . "</td>
		</tr>";
}

echo "</table>";
sqlsrv_free_stmt($stmt);
?>
