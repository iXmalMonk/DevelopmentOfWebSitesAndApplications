<?php
include "php/database.php";
session_start();
if ($_SERVER["REQUEST_METHOD"] == "GET" &&
    isset($_GET["email"]) &&
    isset($_GET["token"]))
{
    $email = urldecode($_GET["email"]);
    $token = urldecode($_GET["token"]);
    $_SESSION["email"] = $email;
    $_SESSION["token"] = $token;
    $sql = "SELECT * FROM token WHERE email = '$email' AND token = '$token'";
    $result = $database->query($sql);
    if ($result->num_rows > 0)
    {
        echo '
        <form class="form" id="page-fyp-form" method="POST">
            <label>PASSWORD:</label>
            <input type="password" id="page-fyp-password" name="page-fyp-password" required>
            <button type="submit">SEND</button>
        </form>
        <script src="script.js"></script>
        ';
    }
    else
    {
        echo '
        <script>window.location.href = "index.php"</script>
        ';
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" &&
    isset($_POST["page-fyp-password"]))
{
    $email = $_SESSION["email"];
    $token = $_SESSION["token"];
    $password = md5(mysqli_real_escape_string($database, $_POST["page-fyp-password"]));
    $sql = "UPDATE user SET password = '$password' WHERE email = '$email'";    
    if ($database->query($sql) == true)
    {
        $sql = "DELETE FROM token WHERE email = '$email' AND token = '$token'";
        $database->query($sql);
        $fypResponse = array("status" => "success", "message" => "FYP +");
        echo json_encode($fypResponse);
    }
    else
    {
        $pageFypResponse = array("status" => "error", "message" => "FYP -");
        echo json_encode($fypResponse);
    }
}
?>