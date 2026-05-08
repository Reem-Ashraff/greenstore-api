<?php
include 'index.php';
$postdata = file_get_contents("php://input");
$request = json_decode($postdata, true);

$name = $request["category_name"];
$newname = $request["updated_name"];

$stmt = $connection->prepare("UPDATE categories set category_name=? where category_name=?");
$stmt->bind_param("ss",$newname,$name);
if($stmt->execute()){
        $response['status'] = 'success';
        $response['message'] = 'Category updated successfully.';
}
else{
        $response['status'] = 'error';
        $response['message'] = 'Error updating category.';
}
$stmt->close();
echo json_encode($response["message"]);
?>