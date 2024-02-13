<?php

if (empty($_POST["fname"])) {
    die("First name is required");
}
if (empty($_POST["lname"])) {
    die("Last name is required");
}
if (empty($_POST["phone"])) {
    die("Valid phone is required");
}
if (! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    die("Valid email is required");
}
if (strlen($_POST["password"]) < 8) {
    die("Password must be at least 8 characters");
}
if ( ! preg_match("/[a-z]/i", $_POST["password"])) {
    die("Password must contain at least one letter");
}
if ( ! preg_match("/[0-9]/", $_POST["password"])) {
    die("Password must contain at least one letter");
}
if ($_POST["password"] !== $_POST["confirm_password"]) {
    die("Passwords must match");
}

$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

$mysqli = require __DIR__ . "/database.php";

$sql = "INSERT INTO User (first_name, last_name, phone, email, password_hash)
        VALUES (?, ?, ?, ?, ?)";

$stmt = $mysqli->stmt_init();

if ( ! $stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}

$stmt->bind_param("sssss",
                $_POST["fname"],
                $_POST["lname"],
                $_POST["phone"],
                $_POST["email"],
                $password_hash);

function checkEmail($mysqli, $email) {
    $email = mysqli_real_escape_string($mysqli, $email);
    $checksql = mysqli_query($mysqli, "SELECT * FROM User WHERE email='$email'");
    if (mysqli_num_rows($checksql) == 0) {
        return true;
    }
    return false;
}

if (checkEmail($mysqli, $_POST['email'])) {
    if ($stmt->execute()) {
        header("Location: sign-up-success.html");
        exit;
    };
} else {
    die("Email already exists");
}
?>