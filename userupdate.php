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
  <link rel="icon" type="image/png" href="./assets/img/favicon.png">
  <title>CS 361</title>
  <!-- CSS Files -->
  <link id="pagestyle" href="assets/css/material-kit-pro.css?v=3.0.3" rel="stylesheet" />
  <!-- Client-Side Validation -->
  <script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js" defer></script>
  <script src="assets/js/update-profile_validation.js" defer></script>
  <!-- Modal -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
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
            <?php if (isset($user)): ?>
              <div class="col-2 container">
                <div class="collapse navbar-collapse" id="navbar-header-2">
                  <ul class="navbar-nav font-weight-bolder"> 
                    <li class="nav-item px-1">                
                      <a href="userprofile.php" class="nav-link text-dark" >
                        <span>Profile</span>
                      </a> 
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
          </nav>
        </div>
      </div>
    </div>
    <?php if (isset($user)): ?>
    <div class="col-8 card card-body blur shadow-blur mt-9 mb-4" style="margin-left: auto; margin-right: auto; max-width: 500px;" >
      <section>
        <div class="row mt-4">
          <div class="col-12">
            <div class="card-body">
              <h4 class="text-center">Update Profile Info</h4>
              <form action="process-update.php" method="post" id="update-info" role="form" autocomplete="off" novalidate>
                <label for="fname" class="form-label  ps-4">First Name</label> 
                <div class="input-group input-group-outline mb-3">  
                  <div class="container">
                    <input type="fname" id="fname" name="fname" class="form-control" value="<?= htmlspecialchars($user["first_name"]) ?>">
                  </div>
                </div>
                <label for="lname" class="form-label  ps-4">Last Name</label> 
                <div class="input-group input-group-outline mb-3">  
                  <div class="container">
                    <input type="lname" id="lname" name="lname" class="form-control" value="<?= htmlspecialchars($user["last_name"]) ?>">
                  </div>
                </div>
                <label for="phone" class="form-label  ps-4">Phone</label> 
                <div class="input-group input-group-outline mb-3">  
                  <div class="container">
                    <input type="phone" id="phone" name="phone" class="form-control" value="<?= htmlspecialchars($user["phone"]) ?>">
                  </div>
                </div>
                <label for="email" class="form-label  ps-4">Email</label> 
                <div class="input-group input-group-outline mb-3">  
                  <div class="container">
                    <input type="email" id="email" name="email" class="form-control" value="<?= htmlspecialchars($user["email"]) ?>">
                  </div>
                </div>
                <label for="confirm_email" class="form-label  ps-4">Confirm Email</label> 
                <div class="input-group input-group-outline mb-3">  
                  <div class="container">
                    <input type="confirm_email" id="confirm_email" name="confirm_email" class="form-control" value="<?= htmlspecialchars($user["email"]) ?>">
                  </div>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-lg bg-gradient-primary btn-lg mt-4 mb-0">Update</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </section>
    </div>
    <br/><br/><br/>

    </div>
    <?php else: ?>
      <div class="mt-9">
        <div class="pt-9">
          <p style="text-align:center;">You are currently not logged in.</p>
          <p style="text-align:center;">Please <a href="sign-in.php">Sign-In</a> or <a href="sign-up.php">Sign-Up</a>
        </div>
      </div>
    <?php endif;?>
    <footer class="footer py-10 pb-0">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 mb-4 mx-auto text-center">
          <a href="#home" id="" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
            Home
          </a>
          <a href="#classes" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
            Classes
          </a>
          <a href="" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
            About Us
          </a>
          <a href="" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
            Contact Us
          </a>

        </div>
      </div>
    </div>
  </footer>
</body>
</html>
