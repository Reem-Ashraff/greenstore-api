<?php
include 'index.php';
$postdata = file_get_contents("php://input");
$request = json_decode($postdata, true);

$u_id = $request["id"];
$item_name = $request["item_name"];
$item_price = $request["item_price"];
$item_image = $request["item_image"];

if (!isset($request["id"]) || !isset($request["name"])|| !isset($request["price"]) || !isset($request["img"])) {
        $response['status'] = 'error';
        $response['message'] = "Item can't be added.";
}
if (empty($u_id) || empty($item_name) || empty($item_image) || empty($item_price)) {
        $response['status'] = 'error';
        $response['message'] = "Item can't be added.";
}
else{
        $stmt = $connection->prepare("INSERT INTO cart (user_id, item_name, item_price, item_image) VALUES (?,?,?,?)");
        $stmt->bind_param("ssss", $u_id, $item_name, $item_price, $item_image);
        if ($stmt->execute()) {
                $response['status'] = 'success';
                $response['message'] = 'Item added successfully.';
        }
        else {
                $response['status'] = 'error';
                $response['message'] = "Item can't be added.";
        }
$stmt->close();
}
$res = json_encode($response["message"]);
echo $res;
?>