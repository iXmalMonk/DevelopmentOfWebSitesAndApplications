<?php
ini_set("memory_limit", "1024M");
$database = new mysqli("localhost", "root", "root", "database");
$statement = $database->prepare("CALL select_data()");
$statement->execute();
$result = $statement->get_result();
$data = $result->fetch_all(MYSQLI_ASSOC);
$database->close();
echo json_encode($data);
?>