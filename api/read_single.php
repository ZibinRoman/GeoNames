<?php
header('content-type: application/json;charset=utf-8');
$data = json_decode(file_get_contents('php://input'), true);
//die(print_r($data));
$id = $data['id'];
$sql = "SELECT * FROM `RU` WHERE `geonameid` = '$id'";
require_once "connect.php";
$result = $pdo->query($sql);
$row = $result->fetchArray(SQLITE3_ASSOC);
http_response_code(200);
echo json_encode($row, JSON_UNESCAPED_UNICODE);
//$pdo->close();
?>