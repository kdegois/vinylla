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
          <li id="search" class="nav-item">
            <a class="nav-link" href="search.php">Recently posted</a>
          </li>
          <li id="create-ad" class="nav-item">
            <a class="nav-link" href="create-ad.php">List your vinyl</a>
          </li>
          <?php
          if (loggedIn()==true){
              echo "<li id=\"logout\" class=\"nav-item\"><a class=\"nav-link\" href=\"logout.php\">Logout</a></li>";
          }
          else {
            echo "<li id=\"login\" class=\"nav-item\"><a class=\"nav-link\" href=\"login.php\">Login</a></li>
                  <li id=\"signup\" class=\"nav-item\"><a class=\"nav-link\" href=\"signup.php\">Signup</a></li>"; 
          }
          ?>
        </ul>
        <a href = "Basket.php"><img src = "Basket.PNG" alt = "basket"></img></a>
        <form class="d-flex" action="search.php" method="get">
          <input class="form-control me-2" name ="term" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>
</header>