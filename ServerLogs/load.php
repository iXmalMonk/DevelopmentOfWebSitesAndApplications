<?php
ini_set("memory_limit", "256M");
$data = array();
$logFile = "../server_logs.log";
$logIterator = new SplFileObject($logFile);
$logRecordsPerBatch = 100;
$regexPattern = '/^(\S+) \S+ \S+ \[(\d{2}\/\w{3}\/\d{4}:\d{2}:\d{2}:\d{2} \+\d{4})\] "(\S+) (\S+) (\S+)" (\d+) (\S+) "(\S+)" "([^"]+)"$/';
$positionStart = isset($_GET["position"]) ? intval($_GET["position"]) : 0;
$positionEnd = min($positionStart + $logRecordsPerBatch, 200000);
$logIterator->seek($positionStart);
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
    $data[] = array($method, $path, $version, $code, $size, $url, $browser, $ipAddress, $date);
    $logIterator->next();
}
$database = new mysqli("localhost", "root", "root", "database");
$statement = $database->prepare("CALL insert_data (?, ?, ?, ?, ?, ?, ?, ?, ?)");
foreach ($data as $row)
{
    $statement->bind_param("sssssssss", ...$row);
    $statement->execute();
}
$database->close();
$response = array("position" => $i);
echo json_encode($response);
?>