<?php
session_start();
// print_r($_SESSION);
$email_changes = false;
if (isset($_SESSION["user_id"])) {
    $mysqli = require __DIR__ . "/database.php";
    $sql = "SELECT * FROM User
            WHERE id = {$_SESSION["user_id"]}";
    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();

    $mysqli = require __DIR__ . "/database.php";

    if (!empty($_POST["fname"])) {
        $updatefname = "UPDATE User SET first_name = ? WHERE id = {$user["id"]}";

        $stmt = $mysqli->stmt_init();

        if ( ! $stmt->prepare($updatefname)) {
            die("SQL error: " . $mysqli->error);
        }

        $stmt->bind_param("s",
            $_POST["fname"]);
            $stmt->execute();
    }

    if (!empty($_POST["lname"])) {
        $updatelname = "UPDATE User SET last_name = ? WHERE id = {$user["id"]}";

        $stmt = $mysqli->stmt_init();

        if ( ! $stmt->prepare($updatelname)) {
            die("SQL error: " . $mysqli->error);
        }

        $stmt->bind_param("s",
            $_POST["lname"]);
            $stmt->execute();
    }

    if (!empty($_POST["phone"])) {
        $updatelname = "UPDATE User SET phone = ? WHERE id = {$user["id"]}";

        $stmt = $mysqli->stmt_init();

        if ( ! $stmt->prepare($updatelname)) {
            die("SQL error: " . $mysqli->error);
        }

        $stmt->bind_param("s",
            $_POST["phone"]);
            $stmt->execute();
    }

    if (!empty($_POST["email"])) {
        
        function checkEmail($mysqli, $email) {
            $email = mysqli_real_escape_string($mysqli, $email);
            $checksql = mysqli_query($mysqli, "SELECT * FROM User WHERE email='$email'");
            if (mysqli_num_rows($checksql) == 0) {
                return true;
            }
            return false;
        }
        
        $updateemail = "UPDATE User SET email = ? WHERE id = {$user["id"]}";

        $stmt = $mysqli->stmt_init();

        if ( ! $stmt->prepare($updateemail)) {
            die("SQL error: " . $mysqli->error);
        }

        $stmt->bind_param("s",
            $_POST["email"]);

        if (checkEmail($mysqli, $_POST['email'])) {
            $email_changes = true;
            $stmt->execute();
        }
    }

    if ($email_changes) {
        header("Location: info-update-success.html");
        exit;
    } else {
        header("Location: userprofile.php");
        exit;
    }
}
?>