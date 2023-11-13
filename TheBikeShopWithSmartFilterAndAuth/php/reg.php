<?php
include "database.php";
if ($_SERVER["REQUEST_METHOD"] == "POST" &&
    isset($_POST["reg-login"]) &&
    isset($_POST["reg-password"]) &&
    isset($_POST["reg-full-name"]) &&
    isset($_POST["reg-email"]))
{
    $login = mysqli_real_escape_string($database, $_POST["reg-login"]);
    $password = mysqli_real_escape_string($database, $_POST["reg-password"]);
    $fullName = mysqli_real_escape_string($database, $_POST["reg-full-name"]);
    $email = mysqli_real_escape_string($database, $_POST["reg-email"]);
    if (isset($_FILES["reg-avatar"]))
    {
        $dir = "../avatars/";
        $file = $dir.basename($_FILES["reg-avatar"]["name"]);
        if (move_uploaded_file($_FILES["reg-avatar"]["tmp_name"], $file))
        {
            $avatar = mysqli_real_escape_string($database, $_FILES["reg-avatar"]["name"]);
        }
    }
    $sql = "INSERT INTO user (login, password, full_name, email, avatar) VALUES ('$login', '$password', '$fullName', '$email', '$avatar')";
    if ($database->query($sql) == TRUE)
    {
        $regResponse = array("status" => "success", "message" => "REG +");
        echo json_encode($regResponse);
    }
    else
    {
        $regResponse = array("status" => "error", "message" => "REG -");
        echo json_encode($regResponse);
    }
}
?>