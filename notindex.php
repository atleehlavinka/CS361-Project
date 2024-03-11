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

  <header>
    <?php if (isset($user)): ?>
      <div class="page-header min-vh-75"loading="lazy">
        <div class="container">
          <div class="row">
            <div
              class="col-lg-6 col-md-7 d-flex justify-content-center text-md-start text-center flex-column mt-sm-0 mt-7">
              <h1 class="text-dark pt-6">Welcome!</h1>
              <p class="lead pe-md-5 me-md-5 text-dark opacity-8">We are a learning management website, here to help you find new content to learn.</p>

            </div>
          </div>
        </div>
      </div>
    <?php else: ?> 
      <div class="page-header min-vh-75"loading="lazy">
        <div class="container">
          <div class="row">
            <div
              class="col-lg-6 col-md-7 d-flex justify-content-center text-md-start text-center flex-column mt-sm-0 mt-7">
              <h1 class="text-dark pt-6">Welcome!</h1>
              <p class="lead pe-md-5 me-md-5 text-dark opacity-8">We are a learning management website, here to help you find new content to learn.</p>
              <div class="buttons">
                <a href="sign-up.html">
                  <button href="sign-up.html" type="button" class="btn btn-primary mt-4">Get Started</button>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php endif;?>
  </header>
  <section class="header-rounded-images">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 col-md-6">
          <div class="card card-body blur shadow-blur mx-3 mx-md-4 mt-n6 mb-4">
            <div class="card-body">
              <h5 class="card-title">Our Mission</h5>
              <p class="card-text">To provider high quality content for continued education.</p>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-md-6">
          <div class="card card-body blur shadow-blur mx-3 mx-md-4 mt-n6 mb-4">
            <div class="card-body">
              <h5 class="card-title">Our Vision</h5>
              <p class="card-text">To lower the threshold for continued learning.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section id = "classes">
    <div class="row mt-4">
      <div class="col-12">
        <div class="card card-body blur shadow-blur mx-3">
            <div class="card-header text-center">
              <h5 class="mb-0">Search Classes Here</h5>
              <p class="text-sm mb-0">
                Search by Course Name or Instructor
              </p>
            </div>
            <div class="card-body text-center">
              <div class="row">
                <form role="form" class="search-filter">
                  <div class="col-md-4 col-12 input-group input-group-outline" id="search">
                    <label class="form-label">Search</label>
                    <input type="search" class="form-control">
                  </div>
                </form>
              </div> 
              <div class="table-responsive">
                <table class="table table-flush" id="datatable-search">
                  <thead class="thead-light">
                    <tr>
                      <th>Course Name</th>
                      <th>Description</th>
                      <th>Instructor</th>
                      <th>Date</th>
                      <th>Price</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="text-sm font-weight-normal">Fundamentals of C# I</td>
                      <td class="text-sm font-weight-normal">Description</td>
                      <td class="text-sm font-weight-normal">Person 1</td>
                      <td class="text-sm font-weight-normal">2011/04/25</td>
                      <td class="text-sm font-weight-normal">$1,800</td>
                    </tr>
                    <tr>
                      <td class="text-sm font-weight-normal">Fundamentals of C# II</td>
                      <td class="text-sm font-weight-normal">Description</td>
                      <td class="text-sm font-weight-normal">Person 2</td>
                      <td class="text-sm font-weight-normal">2011/07/25</td>
                      <td class="text-sm font-weight-normal">$1,750</td>
                    </tr>
                    <tr>
                      <td class="text-sm font-weight-normal">Fundamentals of C# III</td>
                      <td class="text-sm font-weight-normal">Description</td>
                      <td class="text-sm font-weight-normal">Person 3</td>
                      <td class="text-sm font-weight-normal">2009/01/12</td>
                      <td class="text-sm font-weight-normal">$1,000</td>
                    </tr>
                    <tr>
                      <td class="text-sm font-weight-normal">Fundamentals of Python I</td>
                      <td class="text-sm font-weight-normal">Description</td>
                      <td class="text-sm font-weight-normal">Person 4</td>
                      <td class="text-sm font-weight-normal">2012/03/29</td>
                      <td class="text-sm font-weight-normal">$1,060</td>
                    </tr>
                    <tr>
                      <td class="text-sm font-weight-normal">Fundamentals of Python II</td>
                      <td class="text-sm font-weight-normal">Description</td>
                      <td class="text-sm font-weight-normal">Person 5</td>
                      <td class="text-sm font-weight-normal">2008/11/28</td>
                      <td class="text-sm font-weight-normal">$1,700</td>
                    </tr>
                    <tr>
                      <td class="text-sm font-weight-normal">Fundamentals of Python III</td>
                      <td class="text-sm font-weight-normal">Description</td>
                      <td class="text-sm font-weight-normal">Person 6</td>
                      <td class="text-sm font-weight-normal">2012/12/02</td>
                      <td class="text-sm font-weight-normal">$1,000</td>
                    </tr>
                    <tr>
                      <td class="text-sm font-weight-normal">Fundamentals of JavaScript I</td>
                      <td class="text-sm font-weight-normal">Description</td>
                      <td class="text-sm font-weight-normal">Person 7</td>
                      <td class="text-sm font-weight-normal">2012/08/06</td>
                      <td class="text-sm font-weight-normal">$1,500</td>
                    </tr>
                    <tr>
                      <td class="text-sm font-weight-normal">Fundamentals of JavaScript II</td>
                      <td class="text-sm font-weight-normal">Description</td>
                      <td class="text-sm font-weight-normal">Person 8</td>
                      <td class="text-sm font-weight-normal">2010/10/14</td>
                      <td class="text-sm font-weight-normal">$1,900</td>
                    </tr>
                    <tr>
                      <td class="text-sm font-weight-normal">Fundamentals of JavaScript III</td>
                      <td class="text-sm font-weight-normal">Description</td>
                      <td class="text-sm font-weight-normal">Person 9</td>
                      <td class="text-sm font-weight-normal">2009/09/15</td>
                      <td class="text-sm font-weight-normal">$1,500</td>
                    </tr>
                  </tbody>
                </table>
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