<?php
include "database.php";
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $login = $_SESSION["login"];
    $fullName = mysqli_real_escape_string($database, $_POST["acc-full-name"]);
    $email = mysqli_real_escape_string($database, $_POST["acc-email"]);
    $avatar = mysqli_real_escape_string($database, $_FILES["acc-avatar"]["name"]);
    $sql = "UPDATE user SET full_name = '$fullName', email = '$email'";
    if (strlen($_POST["acc-password"]) > 0)
    {
        $password = md5(mysqli_real_escape_string($database, $_POST["acc-password"]));
        $sql .= ", password = '$password'";
    }
    if (!empty($avatar))
    {
        $avatar = $login.$avatar;
        $sql .= ", avatar = '$avatar'";
        unlink("../avatars/".$_SESSION["avatar"]);
        $_SESSION["avatar"] = $avatar;
        $file = "../avatars/".$avatar;
        move_uploaded_file($_FILES["acc-avatar"]["tmp_name"], $file);
    }
    $sql .= " WHERE login = '$login'";
    if ($database->query($sql) == TRUE)
    {
        $_SESSION["fullName"] = $fullName;
        $_SESSION["email"] = $email;
        $accResponse = array("status" => "success", "message" => "ACC + ");
        echo json_encode($accResponse);
    }
    else
    {
        $accResponse = array("status" => "error", "message" => "ACC -");
        echo json_encode($accResponse);
    }
}
?>