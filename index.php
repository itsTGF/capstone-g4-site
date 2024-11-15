<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>Capstone Group 4</title>

		<link rel="stylesheet" href="styles.css">
	
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
			text-align: center;
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