<?php
include "database.php";
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST" &&
    isset($_POST["auth-login"]) &&
    isset($_POST["auth-password"]))
{
    $login = mysqli_real_escape_string($database, $_POST["auth-login"]);
    $password = md5(mysqli_real_escape_string($database, $_POST["auth-password"]));
    $sql = "SELECT * FROM user WHERE login = '$login' AND password = '$password'";
    $result = $database->query($sql);
    if($result->num_rows > 0)
    {
        $row = $result->fetch_assoc();
        $_SESSION["login"] = $login;
        $_SESSION["fullName"] = $row["full_name"];
        $_SESSION["email"] = $row["email"];
        $_SESSION["avatar"] = $row["avatar"];
        $authResponse = array("status" => "success", "message" => "AUTH +");
        setcookie("auth_token", "auth", time() + 3600, "/");
        echo json_encode($authResponse);
    }
    else
    {
        $authResponse = array("status" => "error", "message" => "AUTH -");
        echo json_encode($authResponse);
    }
}
?>