<?php
header('content-type: application/json;charset=utf-8');
require_once "connect.php";
$data = json_decode(file_get_contents('php://input'), true);
//die(print_r($data));
$city1 = $data['city1'];
$city2 = $data['city2'];
$request = [];
$sql1 = "SELECT * FROM `RU` WHERE `name` = '$city1' ORDER BY `population` ASC NULLS LAST;";
$result1 = $pdo->query($sql1);
$rowList1 = $result1->fetchArray(SQLITE3_ASSOC);
//echo json_encode($rowList1, JSON_UNESCAPED_UNICODE);
$request['city1'] = $rowList1;
$sql2 = "SELECT * FROM `RU` WHERE `name` = '$city2' ORDER BY `population` ASC NULLS LAST;";
$result2 = $pdo->query($sql2);
$rowList2 = $result2->fetchArray(SQLITE3_ASSOC);
//echo json_encode($rowList2, JSON_UNESCAPED_UNICODE);
$request['city2'] = $rowList2;
if($rowList1["longitude"]>$rowList2["longitude"]){
    $response = "Севернее ".$rowList1['name']." города ".$rowList2['name'];
    $request['response1'] = $response;
    //echo json_encode($response, JSON_UNESCAPED_UNICODE);
}else{
    $response = "Севернее ".$rowList1['name']." города ".$rowList2['name'];
    $request['response1'] = $response;
    //echo json_encode($response, JSON_UNESCAPED_UNICODE);
}
if($rowList1["timezone"]===$rowList2["timezone"]){
    $response = "У городов ".$rowList1['name'].", ".$rowList2['name']." одинаковая временная зона";
    $request['response2'] = $response;
    //echo json_encode($response, JSON_UNESCAPED_UNICODE);
}else{
    $response = "У городов ".$rowList1['name'].", ".$rowList2['name']." разная временная зона";
    $request['response2'] = $response;
   // echo json_encode($response, JSON_UNESCAPED_UNICODE);
}
http_response_code(200);
echo json_encode($request, JSON_UNESCAPED_UNICODE);
//$pdo->close();
?>