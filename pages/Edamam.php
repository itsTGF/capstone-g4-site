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
        <title>Edamam</title>

        <link rel="stylesheet" href="../styles.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter">
    </head>

<body>
    <header>
        <h1>Edamam</h1>
    </header>
    <h3>Items:</h3>
    <?php
    $sql = "SELECT * FROM edamam.ingredient_info";
    
    $stmt = sqlsrv_query($conn, $sql);
    
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    
    echo "<table class='ingredient-table'>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Calories</th>
                </tr>
            </thead>
            <tbody>";
   
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        echo "<tr>
                <td>" . $row['id'] . "</td>
                <td>" . $row['name'] . "</td>
                <td>" . $row['calories'] . "</td>
              </tr>";
    }
    
    echo "</tbody>
          </table>";
    sqlsrv_free_stmt($stmt);
    ?>
    
    <h3>API:</h3>
    <a href="https://developer.edamam.com/edamam-docs-nutrition-api">Edamam API Documentation</a>
    
    <footer>
        <p>Return to the <a href="../index.php">homepage</a></p>
    </footer>
</body>
</html>
