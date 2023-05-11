<?php

require_once "includes/functions.inc.php";
require_once("includes/dbconnect.inc.php");

?>

<!doctype html>
<html lang="en">
    <head>
        <script src="js/color-modes.js"></script>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <title>Vinylla - Search</title>
        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <!-- Main CSS -->
        <link href="css/main.css" rel="stylesheet">
        <!-- Sticky footer navbar -->
        <link href="css/sticky-footer-navbar.css" rel="stylesheet">
        <!-- Listing pages CSS -->
        <link href="css/listing.css" rel="stylesheet">
    </head>
    <body>

        <?php include "nav.php"?>

        <?php

        $term = "";
        $filters = "";

        // Get sorting method
        if(isset($_GET['sort'])){
            $sort = $_GET['sort'];
        }
        else{
            // Default
            $sort = "datetime_posted DESC";
        }

        // Search based on term (open user text)
        if(isset($_GET['term'])){
            $term = $_GET['term'];
            // Add search term to filters
            $filters = "WHERE title LIKE '%$term%' OR artist LIKE '%$term%'";
        }

        ?>

        <!-- Begin page content -->
        <main class="flex-shrink-0">
            <div class="container">
                <div class="row">
                    <h3>Listing Results</h3>
                    <div id="filter-form-container">
                        <form method="get">
                            <input type="hidden" name="term" value="<?php echo $term; ?>"/> <!-- Existing search terms -->
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

                    $sql = "SELECT * FROM listing $filters ORDER BY $sort";

                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) >= 1){
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<a class=\"listing\" href=\"view-ad.php?listing_id=" . $row['listing_id'] . "\">";
                            echo "<img width=\"100px\" style=\"float: left;\" src='" . $row['picture_1_uri'] . "' alt='" . $row['title'] . "'>";
                            echo "<div class=\"listing-text\">";
                            echo "<h4>" . $row['title'] . " - " . $row['artist'] . "</h4>";
                            echo "<ul>";
                            echo "<li>Price (Pcm): £" . $row['price'] . "</li>";
                            echo "<li>Posted: " . $row['datetime_posted'] . "</li>";
                            echo "</ul>";
                            echo "</div>";
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

        <?php include "footer.php"; ?>

        <!-- Bootstrap JS -->
        <script src="js/bootstrap.bundle.min.js"></script>
    </body>


</html>