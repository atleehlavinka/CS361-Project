<?php
session_start();
// print_r($_SESSION);

if (isset($_SESSION["user_id"])) {
    $mysqli = require __DIR__ . "/database.php";
    $sql = "SELECT * FROM User
            WHERE id = {$_SESSION["user_id"]}";
    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en" itemscope itemtype="http://schema.org/WebPage">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- <link rel="icon" type="image/png" href="./assets/img/favicon.png"> -->
  <title>CS 361</title>
  <link id="pagestyle" href="assets/css/material-kit-pro.css?v=3.0.3" rel="stylesheet" />
</head>

<body class="presentation-page bg-gray-200" id="home">
  <div class="container position-sticky z-index-sticky top-0">
    <div class="row">
      <div class="col-12">
        <nav class="navbar navbar-expand-lg navbar navbar-expand-lg blur border-radius-lg top-0 z-index-3 shadow position-absolute mt-4 py-2 start-0 end-0 mx-4 my-3 py-2 start-0 end-0 mx-4">
          <div class="col-10 container">
            <div class="collapse navbar-collapse" id="navbar-header-2">
              <ul class="navbar-nav font-weight-bolder">
                <li class="nav-item px-1">
                  <a class="nav-link text-dark" href="index.php#home">
                    Home
                  </a>
                </li>
                <li class="nav-item px-1">
                  <a class="nav-link text-dark" href="index.php#classes">
                    Classes
                  </a>
                </li>
                <li class="nav-item px-1">
                  <a class="nav-link text-dark" href="index.php#about-us">
                    About Us
                  </a>
                </li>
                <li class="nav-item px-1">
                  <a class="nav-link text-dark" href="index.php#about-us">
                    Contact Us
                  </a>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-2 container">
            <div class="collapse navbar-collapse" id="navbar-header-2">
              <ul class="navbar-nav font-weight-bolder"> 
                <?php if (isset($user)): ?>     
                  <li class="nav-item px-1">                
                      <a href="userprofile.php" class="nav-link text-dark" >
                        <span>Profile</span>
                      </a> 
                  </li>
                  <li class="nav-item px-1"> 
                    <a href="logout.php" class="nav-link text-dark" >
                      <span>Log Out</span>
                    </a>
                  </li>
                <?php else: ?>                    
                  <a href="sign-in.php" class="nav-link text-dark" >
                    <span>Sign-In </span>
                  </a>
                  &nbsp;&nbsp;&nbsp;
                  <a href="sign-up.html" class="nav-link text-dark" >
                    <span>Sign-Up</span>
                  </a>
                <?php endif;?>
              </ul>
            </div>
          </div>
        </nav>
      </div>
    </div>
  </div>
</body>
</html>