<?php
require '../include/database.php';

$conn = getDB();
?>

<!DOCTYPE html>
<html>
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Open Food Facts</title>
	
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter">
    <link rel="stylesheet" href="../styles.css">
    
</head>
<body>
    <header id="topPage">
        <h1>Open Food Facts</h1>
    </header>
    
    <h3>Items:</h3>
    
    <!-- database access -->
    
    <?php
    $sql = "SELECT * FROM goglia_items";
    
    $stmt = sqlsrv_query($conn, $sql);
    
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    
    echo "<table class='recipe-table'>
        <thead>
            <tr>
                <th>ID</th>
                <th>Product</th>
                <th>Generic Name</th>
                <th>Food Groups</th>
                <th>Brand</th>
                <th>Serving Size</th>
                <th>Quantity</th>
                <th>Ingredients</th>
                <th>Origin</th>
                <th>Nutri-Score</th>
                <th>Allergens</th>
                <th>Stores Sold In</th>
            </tr>
        </thead>
        <tbody>";
   
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        echo "<tr>
            <td>" . $row['id'] . "</td>
            <td>" . $row['prodname'] . "</td>
            <td>" . $row['genname'] . "</td>
            <td>" . $row['brand'] . "</td>
            <td>" . $row['foodgroups'] . "</td>
            <td>" . $row['quantity'] . "</td>
            <td>" . $row['serving'] . "</td>
            <td>" . $row['origin'] . "</td>
            <td>" . $row['ingredients'] . "</td>
            <td>" . $row['allergens'] . "</td>
            <td>" . $row['nutriscore'] . "</td>
            <td>" . $row['stores'] . "</td>
        </tr>";
    }
    
    echo "</tbody>
          </table>";
    sqlsrv_free_stmt($stmt);
    ?>
    
    <!-- end database access -->
    
    <h3>API:</h3>
    
    <nav>
        <a href="https://world.openfoodfacts.org/">Open Food Facts Homepage</a>
    </nav>

    <footer>
        <p>Return to the <a href="../index.php">homepage</a></p>
    </footer>
</body>
</html>
