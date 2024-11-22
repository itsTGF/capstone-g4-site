<?php
require '../include/database.php';

$conn = getDB();

// initialize filter variables
$tagFilter = isset($_GET['tagFilter']) ? $_GET['tagFilter'] : '';
$categoryFilter = isset($_GET['categoryFilter']) ? $_GET['categoryFilter'] : '';
$areaFilter = isset($_GET['areaFilter']) ? $_GET['areaFilter'] : '';

// sql queries (optional filters)
$sql = "SELECT * FROM mariano_meals WHERE 1=1";

if (!empty($tagFilter)) {
    $sql.= " AND tags LIKE ?";
}
if (!empty($categoryFilter)) {
    $sql.= " AND category LIKE ?";
}
if (!empty($areaFilter)) {
    $sql.= " AND area LIKE ?";
}

// execute queries
$params = [];
if (!empty($tagFilter)) {
    $params[] = '%'.$tagFilter.'%';
}
if (!empty($categoryFilter)) {
    $params[] = '%'.$categoryFilter.'%';
}
if (!empty($areaFilter)) {
    $params[] = '%'.$areaFilter.'%';
}

$stmt = sqlsrv_query($conn, $sql, $params);

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}
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

    <form method="get" action="">
      <div class="filter-container">
        <label for="tagFilter">Search by Tag:</label>
        <input
          type="text"
          id="tagFilter"
          name="tagFilter"
          value="<?php echo htmlspecialchars($tagFilter); ?>"
          placeholder="Enter tag"/>

        <label for="categoryFilter">Search by Category:</label>
        <input
          type="text"
          id="categoryFilter"
          name="categoryFilter"
          value="<?php echo htmlspecialchars($categoryFilter); ?>"
          placeholder="Enter category"/>

        <label for="areaFilter">Search by Area:</label>
        <input
          type="text"
          id="areaFilter"
          name="areaFilter"
          value="<?php echo htmlspecialchars($areaFilter); ?>"
          placeholder="Enter area"/>
        <button type="submit">Search</button>
      </div>
    </form>
    
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
      <tbody>
        <?php
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

        sqlsrv_free_stmt($stmt);
        ?>
      </tbody>
    </table>

    <div class="footer">&copy; 2024 TheMealDB</div>
  </body>
</html>