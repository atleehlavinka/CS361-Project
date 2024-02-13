<?php
$is_invalid = false;
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $mysqli = require __DIR__ . "/database.php";
    $sql = sprintf("SELECT * FROM User WHERE email = '%s'", $mysqli->real_escape_string($_POST["email"]));
    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();
    if ($user) {
        if (password_verify($_POST["password"], $user["password_hash"])) {
            session_start();
            session_regenerate_id();
            $_SESSION["user_id"] = $user["id"];
            header("Location: index.php");
            exit;
        }
    }
    $is_invalid = true;
}
?>

<!DOCTYPE html>
<html lang="en" itemscope itemtype="http://schema.org/WebPage">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" type="image/png" href="./assets/img/favicon.png">
  <title>CS 361</title>
  <link id="pagestyle" href="assets/css/material-kit-pro.css?v=3.0.3" rel="stylesheet" />
</head>

<body class="presentation-page bg-gray-200">
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
                  <a href="sign-in.php" class="nav-link text-dark" >
                    <span>Sign-In </span>
                  </a>
                    &nbsp;&nbsp;&nbsp;
                  <a href="sign-up.html" class="nav-link text-dark" >
                    <span>Sign-Up</span>
                  </a>
                </ul>
              </div>
            </div>
          </nav>
        </div>
      </div>
    </div>
  <section>
    <div class="page-header min-vh-100">
      <div class="container">
        <div class="row">
          <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 start-0 text-center justify-content-center flex-column">
          </div>
          <div class="col-xl-4 col-lg-5 col-md-7 ms-auto me-auto">
            <div class="card card-plain">
              <div class="card-header text-center">
                <h4 class="font-weight-bolder">Sign In</h4>
                <p class="mb-0">Enter your email and password to sign in</p>
              </div>
              <div class="card-body mt-2">
                <form role="form" method="post">
                  <div class="input-group input-group-outline mb-3">
                    <input type="email" id="email" name="email" class="form-control" placeholder="email"
                      value="<?= htmlspecialchars($_POST["email"] ?? "") ?>">
                  </div>
                  <div class="input-group input-group-outline mb-3">
                    <input type="password" id="password" name="password" class="form-control" placeholder="password">
                  </div>
                  <?php if ($is_invalid): ?>
                    <em class="text-sm text-danger">Invalid login</em>
                  <?php endif; ?>
                  <div class="text-center">
                    <button type="submit" class="btn btn-lg bg-gradient-primary btn-lg w-100 mt-4 mb-0">Sign in</button>
                  </div>
                </form>
              </div>
              <div class="card-footer text-center pt-0 px-lg-2 px-1">
                <p class="mb-4 text-sm mx-auto">
                  Don't have an account?
                  <a href="sign-up.html" class="text-primary text-gradient font-weight-bold">Sign up</a>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
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
