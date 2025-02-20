<?php
header('content-type: application/json;charset=utf-8');
$data = json_decode(file_get_contents('php://input'), true);
//die(print_r($data));
$count = $data['count'];
$sql = "SELECT * FROM `RU` LIMIT '$count'";
require_once "connect.php";
$result = $pdo->query($sql);
$rowList = [];
while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    $rowList[] = $row;
}
http_response_code(200);
echo json_encode($rowList, JSON_UNESCAPED_UNICODE);
//$pdo->close();
?>