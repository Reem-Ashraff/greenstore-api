<?php
include 'index.php';
$postdata = file_get_contents("php://input");
$request = json_decode($postdata, true);

$name = $request["category_name"];

$stmt = $connection->prepare("INSERT INTO categories (category_name) value (?)");
$stmt->bind_param("s", $name);
if($stmt->execute()){
        $response['status'] = 'success';
        $response['message'] = 'Category added successfully.';
}
else{
        $response['status'] = 'error';
        $response['message'] = 'Error adding category.';
}
$stmt->close();
echo json_encode($response["message"]);
?>