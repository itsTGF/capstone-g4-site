<?php

require 'include/database.php';

//$conn = getDB();

?>

<!DOCTYPE html>
<html>
	<head>
	<meta charset="UTF-8">
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

<?php

$sql = "SELECT *
		FROM goglia_items";
				
$stmt = sqlsrv_query($conn, $sql);

if ($stmt === false){
	die(print_r(sqlsrv_errors(), true));
}

echo "<table border = '1'>
	<tr>
		<th>ID</th>
		<th>Product</th>
		<th>Generic Name</th>
		<th>Brand</th>
		<th>Food Groups</th>
		<th>Quantity</th>
		<th>Serving Size</th>
		<th>Origin</th>
		<th>Ingredients</th>
		<th>Allergens</th>
		<th>Nutri-Score</th>
		<th>Stores Sold In</th>
	</tr>";
	
while ($row = slqsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
	echo "<tr>
		<td>" . $row['ID'] . "</td>
		<td>" . $row['productName'] . "</td>
		<td>" . $row['genName'] . "</td>
		<td>" . $row['brands'] . "</td>
		<td>" . $row['foodGroups'] . "</td>
		<td>" . $row['quantity'] . "</td>
		<td>" . $row['serving'] . "</td>
		<td>" . $row['origin'] . "</td>
		<td>" . $row['ingredients'] . "</td>
		<td>" . $row['allergens'] . "</td>
		<td>" . $row['nutriscore'] . "</td>
		<td>" . $row['stores'] . "</td>
		</tr>";
}

echo "</table>";
sqlsrv_free_stmt($stmt);

?>
	
	<header id = "bottompage">
	<h3>API:</h3>
	</header>
	
	<nav>
		<a href="https://world.openfoodfacts.org/">Open Food Facts Homepage</a>
	</nav>
	
	<footer>
	<p>Return to the top of the <a href="#topPage">page</a>.</p>
	</footer>

</body>
</html>
