<?php
include 'index.php';
$postdata = file_get_contents("php://input");
$request = json_decode($postdata, true);
$name = $request["category_name"];

$query = "delete from categories where category_name=?";
$stmt = $connection -> prepare($query);
$stmt -> bind_param("s",$name);
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