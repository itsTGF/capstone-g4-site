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

<!DOCTYPE html>
<html>
	<body>
	
	<nav>
		<a href="OpenFood.php">Open Food Facts Data</a>
	</nav>

</body>
</html>
