<?php
include 'index.php';
$postdata = file_get_contents("php://input");
$request = json_decode($postdata, true);
$id = $request;

$query = "delete from categories where c_id=?";
$stmt = $connection -> prepare($query);
$stmt -> bind_param("s",$id);
if($stmt -> execute()){
        $response['status'] = 'success';
        $response['message'] = 'Category deleted successffully.';
}
else{
        $response['status'] = 'error';
        $response['message'] = 'Category cannot be deleted.';
}
echo json_encode($response["message"]);
?>