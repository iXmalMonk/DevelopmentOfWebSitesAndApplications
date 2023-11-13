<?php
include "database.php";
if ($_SERVER["REQUEST_METHOD"] == "POST" &&
    isset($_POST["auth-login"]) &&
    isset($_POST["auth-password"]))
{
    $login = mysqli_real_escape_string($database, $_POST["auth-login"]);
    $password = mysqli_real_escape_string($database, $_POST["auth-password"]);
    $sql = "SELECT * FROM user WHERE login = '$login' and password = '$password'";
    $result = $database->query($sql);
    if($result->num_rows > 0)
    {
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