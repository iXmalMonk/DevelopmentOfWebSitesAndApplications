<?php
include "database.php";
if ($_SERVER["REQUEST_METHOD"] == "POST" &&
    isset($_POST["fyp-email"]))
{
    $email = mysqli_real_escape_string($database, $_POST["fyp-email"]);
    $sql = "SELECT * FROM user WHERE email = '$email'";
    $result = $database->query($sql);
    if($result->num_rows > 0)
    {
        $token = bin2hex(random_bytes(16));
        $link = "http://localhost/TheBikeShopWithSmartFilterAndAuth/page-fyp.php?email=".urlencode($email)."&token=".urlencode($token);
        $file = fopen("../fyp.txt", "a");
        fwrite($file, $link.PHP_EOL);
        fclose($file);
        $sql = "INSERT INTO token (email, token) VALUES ('$email', '$token')";
        $database->query($sql);
        $fypResponse = array("status" => "success", "message" => "FYP +");
        echo json_encode($fypResponse);
    }
    else
    {
        $fypResponse = array("status" => "error", "message" => "FYP -");
        echo json_encode($fypResponse);
    }
}
?>