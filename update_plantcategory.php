<?php
include 'index.php';
$postdata = file_get_contents("php://input");
$request = json_decode($postdata, true);

$name = $request["name"];
$newcategory = $request["updated_category"];

$query = "select * from categories where category_name = ?";
$stmt0 = $connection -> prepare($query);
$stmt0 -> bind_param("s",$newcategory);
$result = $stmt0 -> execute();
$result = $stmt0 -> get_result();
if($result -> num_rows > 0){
        while ($row = $result -> fetch_assoc()){
                $id = $row["c_id"];
        }
        $stmt = $connection->prepare("UPDATE plants set category_id=? where p_name=?");
        $stmt->bind_param("ss",$id,$name);
        if($stmt->execute()){
                $response['status'] = 'success';
                $response['message'] = 'Plant updated successfully.';
        }
        else{
                $response['status'] = 'error';
                $response['message'] = 'Error updating plant.';
        }
}
$stmt->close();
echo json_encode($response["message"]);
?>