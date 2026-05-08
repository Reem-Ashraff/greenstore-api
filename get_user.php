<?php
include "index.php";
$postdata = file_get_contents("php://input");
$request = json_decode($postdata, true);

$id = $request;

$query = "select * from users where u_id=?";
$stmt = $connection -> prepare($query);
$stmt -> bind_param("s",$id);
$result = $stmt -> execute();
$result = $stmt -> get_result();

if($result -> num_rows > 0){
        $user = array();
        while ($row = $result -> fetch_assoc()){
                $user[] = $row;
        }
        echo json_encode($user);
}
else {
        echo json_encode(array());
}
$stmt->close();
?>