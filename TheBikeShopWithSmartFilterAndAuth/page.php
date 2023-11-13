<?php
if (isset($_COOKIE["auth_token"]))
{
    echo '
    <h1>PAGE</h1>
    ';
}
else
{
    header("Location: index.php");
    exit;
}