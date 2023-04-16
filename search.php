<?php
require_once "includes/functions.inc.php";
require_once("includes/dbconnect.inc.php");



?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <title>Vinylla - Search</title>
        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <!-- Sticky footer navbar -->
        <link href="css/sticky-footer-navbar.css" rel="stylesheet">
        <!-- Custom style for search page -->
        <style>
            a.listing {
                display: block;
                color: var(--bs-body-color);
                text-decoration: none;
                padding: 20px;
                margin: 20px 0;
                border-radius: 5px;
                background-color: #ccc;
            }
            a.listing:hover {
                background-color: #ddd;
            }
            h3 {
                padding-top: 20px;
            }
        </style>
    </head>
    <body>

        <?php include "nav.php"?>

        <!-- Begin page content -->
        <main class="flex-shrink-0">
            <div class="container">
                <div class="row">
                    <h3>Listing Results</h3>
                    <!-- <form method="get">
                        <h3>Filter</h3>
                        <div class="mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" class="form-control" id="price" name="price">
                        </div>
                        <div class="mb-3">
                            <label for="date" class="form-label">Posted Date</label>
                            <input type="date" class="form-control" id="date" name="date">
                        </div>
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </form> -->
                    <div id="filter-form-container">
<form method="get">
  <div class="mb-3">
    <label for="sort" class="form-label">Sort by</label>
    <select class="form-select" id="sort" name="sort">
<option value="datetime_posted DESC" <?php if($sort == "datetime_posted DESC") echo "selected"; ?>>Most Recent</option>
      <option value="price ASC"<?php if($sort == "price ASC") echo " selected"; ?>>Price: Low to High</option>
      <option value="price DESC"<?php if($sort == "price DESC") echo " selected"; ?>>Price: High to Low</option>
      <option value="title ASC"<?php if($sort == "title ASC") echo " selected"; ?>>Name: A to Z</option>
      <option value="title DESC"<?php if($sort == "title DESC") echo " selected"; ?>>Name: Z to A</option>
    </select>
  </div>
  <button type="submit" class="btn btn-primary">Filter</button>
</form>
        </div>

                </div>
<?php
    $filters = "";

    // Sort based on option selected
    if(isset($_GET['sort'])){
        $sort = $_GET['sort'];
    }
    else{
        $sort = "datetime_posted DESC";
    }

    // Search based on term
    if(isset($_GET['term'])){
        $term = $_GET['term'];
        $filters .= " AND title LIKE '%$term%'";
    }

    $sql = "SELECT * FROM listing WHERE 1 $filters ORDER BY $sort";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) >= 1){
        while($row = mysqli_fetch_assoc($result)) {
            echo "<a class=\"listing\" href=\"view-ad.php?listing_id=" . $row['listing_id'] . "\">";
            echo "<h4>" . $row['title'] . " - " . $row['artist'] . "</h4>";
            echo "<ul>";
            echo "<li>Price (Pcm): £" . $row['price'] . "</li>";
            echo "<li>Posted: " . $row['datetime_posted'] . "</li>";
            echo "</ul>";
            echo "</a>";
        }
    }
    else{
        echo "<h3>No results found</h3>";
        echo "<p>Your search has returned no results, please try again.</p>";
    }
?>
            </div>
        </main>

        <!-- Bootstrap JS -->
        <script src="js/bootstrap.bundle.min.js"></script>
    </body>


</html>