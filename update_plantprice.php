<?php
include 'index.php';
$postdata = file_get_contents("php://input");
$request = json_decode($postdata, true);

$name = $request["name"];
$newprice = $request["updated_price"];

$stmt = $connection->prepare("UPDATE plants set p_price=? where p_name=?");
$stmt->bind_param("ss",$newprice,$name);
if($stmt->execute()){
        $response['status'] = 'success';
        $response['message'] = 'Plant updated successfully.';
}
else{
        $response['status'] = 'error';
        $response['message'] = 'Error updating plant.';
}
$stmt->close();
echo json_encode($response["message"]);
?>