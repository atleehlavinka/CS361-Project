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

    if (! empty($_POST["new_password"])) {
        $hashedPassword = $user["password_hash"];
        $password = PASSWORD_HASH($_POST["new_password"], PASSWORD_DEFAULT);
        if (password_verify($_POST["current_password"], $hashedPassword)) {
            $updatesql = "UPDATE User SET password_hash = ? WHERE id = {$_SESSION["user_id"]}";
            $statement = $mysqli->prepare($updatesql);
            $statement->bind_param('s', $password);
            $statement->execute();
            header("Location: index.php");
            exit;
        } else
            header("Location: userevents.php");
            exit;
    }
}
?>