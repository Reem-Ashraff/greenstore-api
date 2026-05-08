<?php
include 'index.php';
$postdata = file_get_contents("php://input");
$request = json_decode($postdata, true);
$name = $request["p_name"];

$query = "delete from plants where p_name=?";
$stmt = $connection -> prepare($query);
$stmt -> bind_param("s",$name);
if($stmt -> execute()){
        $response['status'] = 'success';
        $response['message'] = 'Plant deleted successffully.';
}
else{
        $response['status'] = 'error';
        $response['message'] = 'Plant cannot be deleted.';
}
echo json_encode($response["message"]);
?>