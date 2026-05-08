<?php
include 'index.php';
$postdata = file_get_contents("php://input");
$request = json_decode($postdata, true);
//var_dump($request);
$total = $request[2];
$id = $request[0];
$items = $request[1];
for($i = 0; $i < count($items); $i++){
        $name = $items[$i]["item_name"];
        $price = $items[$i]["item_price"];
        $query = "insert into order_details (order_id,plant_name,plant_price) values (?,?,?)";
        $stmt = $connection -> prepare($query);
        $stmt -> bind_param("sss",$id,$name,$price);
        $stmt->execute();
}
$query1="update orders set total = ? where o_id=?";
$stmt0 = $connection -> prepare($query1);
$stmt0 -> bind_param("ss",$total,$id);
if($stmt0->execute()){
        $response['status'] = 'success';
        $response['message'] = 'You ordered successfully.';
}
echo json_encode($response["message"]);
?>