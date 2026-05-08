<?php
include 'index.php';
$postdata = file_get_contents("php://input");
$request = json_decode($postdata, true);

$name = $request["name"];
$newname = $request["updated_name"];

$stmt = $connection->prepare("UPDATE plants set p_name=? where p_name=?");
$stmt->bind_param("ss",$newname,$name);
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