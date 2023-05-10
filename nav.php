<?php include "light-dark.php"?>

<header>
  <!-- Fixed navbar -->
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php">Vinylla</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
          <li id="search" class="nav-item"><a class="nav-link" href="search.php">Recent</a></li> 
          <?php
          if (loggedIn()==true){
              echo "<li id=\"create-ad\" class=\"nav-item\"><a class=\"nav-link\" href=\"create-ad.php\">Post Ad</a></li>";
              echo "<li id=\"logout\" class=\"nav-item\"><a class=\"nav-link\" href=\"logout.php\">Logout</a></li>";
              echo "<li id=\"cart\" class=\"nav-item\"><a class=\"nav-link\" href=\"basket.php\"><i class=\"bi bi-cart\"></i> Cart</a></li>";
              echo "<li id=\"cart\" class=\"nav-item\"><a class=\"nav-link\" href=\"wishlist.php\"</i> Wishlist</a></li>";
          }
          else {
            echo "<li id=\"login\" class=\"nav-item\"><a class=\"nav-link\" href=\"login.php\">Login</a></li>";
            echo "<li id=\"signup\" class=\"nav-item\"><a class=\"nav-link\" href=\"signup.php\">Signup</a></li>";
          }
          ?>
        </ul>
        <form class="d-flex" action="search.php" method="get">
          <input class="form-control me-2" name ="term" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>
</header>