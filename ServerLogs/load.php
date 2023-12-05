<?php
ini_set("memory_limit", "512M");
$database = new mysqli("localhost", "root", "root", "database");
$logFile = "server_logs.log";
$logIterator = new SplFileObject($logFile);
$logRecordsPerBatch = 2000;
$regexPattern = '/^(.*) \S+ \S+ \[(.*)\] "(.*) (.*) (.*)" (.*) (.*) "(.*)" "(.*)"$/';
$positionStart = isset($_GET["position"]) ? intval($_GET["position"]) : 0;
$positionEnd = min($positionStart + $logRecordsPerBatch, 200000);
$logIterator->seek($positionStart);
$statement = $database->prepare("CALL insert_data (?, ?, ?, ?, ?, ?, ?, ?, ?)");
$database->begin_transaction();
for ($i = $positionStart; $i < $positionEnd; $i++)
{
preg_match($regexPattern, $logIterator->current(), $logRecord);
$ipAddress = $logRecord[1];
$date = DateTime::createFromFormat('d/M/Y:H:i:s O', $logRecord[2])->format('Y-m-d H:i:s');
$method = $logRecord[3];
$path = $logRecord[4];
$version = $logRecord[5];
$code = $logRecord[6];
$size = $logRecord[7] == '-' ? '0' : $logRecord[7];
$url = $logRecord[8];
$browser = $logRecord[9];
$logIterator->next();
$statement->bind_param("sssssssss", $method, $path, $version, $code, $size, $url, $browser, $ipAddress, $date);
$statement->execute();
}
$database->commit();
$database->close();
$response = array("position" => $i);
echo json_encode($response);
?>