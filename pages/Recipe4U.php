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
    <title>Recipes</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter">
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <header id="topPage">
        <h1>Recipes</h1>
    </header>
    
    <h3>Select a Recipe:</h3>

    <?php
    $recipeSql = "SELECT * FROM dbo.Recipes4U";
    $recipeStmt = sqlsrv_query($conn, $recipeSql);

    if ($recipeStmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    echo "<form method='get' action=''>
            <label for='recipeSelect'>Choose a recipe:</label>
            <select name='recipeId' id='recipeSelect'>";
    
    while ($recipe = sqlsrv_fetch_array($recipeStmt, SQLSRV_FETCH_ASSOC)) {
        echo "<option value='" . $recipe['id'] . "'>" . htmlspecialchars($recipe['name']) . "</option>";
    }

    echo "    </select>
            <button type='submit'>Show Recipe</button>
          </form>";

    if (isset($_GET['recipeId'])) {
        $recipeId = $_GET['recipeId'];
        $detailSql = "SELECT * FROM dbo.Recipes4U WHERE id = ?";
        $detailParams = array($recipeId);
        $detailStmt = sqlsrv_query($conn, $detailSql, $detailParams);

        if ($detailStmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        if ($row = sqlsrv_fetch_array($detailStmt, SQLSRV_FETCH_ASSOC)) {
            echo "<h3>Recipe Details:</h3>
                  <table class='recipe-table'>
                      <tr><th>Name</th><td>" . htmlspecialchars($row['name']) . "</td></tr>
                      <tr><th>Description</th><td>" . htmlspecialchars($row['description']) . "</td></tr>
                      <tr><th>Cook Time (minutes)</th><td>" . htmlspecialchars($row['cook_time_minutes']) . "</td></tr>
                      <tr><th>Serving Size</th><td>" . htmlspecialchars($row['num_servings']) . "</td></tr>
                  </table>";

            echo "<h3>Nutrition Facts:</h3>
                  <table class='recipe-table'>
                      <tr><th>Calories</th><td>" . htmlspecialchars($row['calories']) . "</td></tr>
                      <tr><th>Carbohydrates</th><td>" . htmlspecialchars($row['carbohydrates']) . "g</td></tr>
                      <tr><th>Fat</th><td>" . htmlspecialchars($row['fat']) . "g</td></tr>
                      <tr><th>Fiber</th><td>" . htmlspecialchars($row['fiber']) . "g</td></tr>
                      <tr><th>Protein</th><td>" . htmlspecialchars($row['protein']) . "g</td></tr>
                      <tr><th>Sugar</th><td>" . htmlspecialchars($row['sugar']) . "g</td></tr>
                  </table>";

            // New Section for Instructions
            echo "<h3>Instructions:</h3>
                  <p>" . nl2br(htmlspecialchars($row['instructions'])) . "</p>";

            // New Section for Tags
            echo "<h3>Tags:</h3>
                  <p>" . htmlspecialchars($row['tags']) . "</p>";
        } else {
            echo "<p>No recipe found with the selected ID.</p>";
        }

        sqlsrv_free_stmt($detailStmt);
    }

    sqlsrv_free_stmt($recipeStmt);
    ?>

    <footer>
        <p>Return to the <a href="../index.php">homepage</a></p>
    </footer>
</body>
</html>
