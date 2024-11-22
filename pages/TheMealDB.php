<?php
require '../include/database.php';

$conn = getDB();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>TheMealDB</title>
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter">
  </head>

  <body>
    <div class="header">
        <div class="header-left">
            <a href="../index.php">Homepage</a>
        </div>
    </div>

    <h1>Meal Search</h1>

    <div class="filter-container">
        <label for="tagFilter">Search by Tag:</label>
        <input type="text" id="tagFilter" placeholder="Enter tag" />

        <label for="categoryFilter">Search by Category:</label>
        <input type="text" id="categoryFilter" placeholder="Enter category" />

        <label for="areaFilter">Search by Area:</label>
        <input type="text" id="areaFilter" placeholder="Enter area" />
    </div>

    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Category</th>
            <th>Area</th>
            <th>Instructions</th>
            <th>Thumbnail</th>
            <th>Tags</th>
        </tr>
        </thead>
        <tbody id="mealsTable"></tbody>
    </table>

    <div class="footer">&copy; 2024 TheMealDB</div>

    <script>
        const mealsData = <?php
            // fetch meal data
            $recipeSql = "SELECT * FROM mariano_meals";
            $recipeStmt = sqlsrv_query($conn, $recipeSql);

            if ($recipeStmt === false) {
                die(json([]));
            }

            $meals = [];
            while ($row = sqlsrv_fetch_array($recipeStmt, SQLSRV_FETCH_ASSOC)) {
                $meals[] = [
                    'id' => htmlspecialchars($row['id']),
                    'name' => htmlspecialchars($row['name']),
                    'category' => htmlspecialchars($row['category']),
                    'area' => htmlspecialchars($row['area']),
                    'instructions' => htmlspecialchars($row['instructions']),
                    'thumbnail_url' => htmlspecialchars($row['thumbnail_url']),
                    'tags' => htmlspecialchars($row['tags']),
                ];
            }

            sqlsrv_free_stmt($recipeStmt);
            echo json($meals); // json output
        ?>;
    </script>

    <script src="/scripts/TheMealDB.js"></script>
</body>
</html>