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

    <?php
       $sql = "SELECT * FROM mariano_meals";
       $stmt = sqlsrv_query($conn, $sql);
       
       if ($stmt === false) {
           die(print_r(sqlsrv_errors(), true));
       }

       echo "
       <div class=\"filter-container\">
         <label for=\"tagFilter\">Search by Tag:</label>
         <input type=\"text\" id=\"tagFilter\" placeholder=\"Enter tag\" />

         <label for=\"categoryFilter\">Search by Category:</label>
         <input type=\"text\" id=\"categoryFilter\" placeholder=\"Enter category\" />

         <label for=\"areaFilter\">Search by Area:</label>
         <input type=\"text\" id=\"areaFilter\" placeholder=\"Enter area\" />
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
         <tbody>";
       
       while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
           echo "
           <tr>
             <td>".htmlspecialchars($row['id'])."</td>
             <td>".htmlspecialchars($row['name'])."</td>
             <td>".htmlspecialchars($row['category'])."</td>
             <td>".htmlspecialchars($row['area'])."</td>
             <td>".htmlspecialchars($row['instructions'])."</td>
             <td><img src=\"".htmlspecialchars($row['thumbnail_url'])."\" alt=\"Meal Image\" style=\"max-width: 100px;\"></td>
             <td>".htmlspecialchars($row['tags'])."</td>
           </tr>";
       }

       echo "
         </tbody>
       </table>";

       sqlsrv_free_stmt($stmt);
    ?>

    <div class="footer">&copy; 2024 TheMealDB</div>
    <script src="/scripts/TheMealDB.js"></script>
  </body>
</html>