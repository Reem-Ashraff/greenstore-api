<?php
include "index.php";
$query = "select * from categories";
$stmt = $connection -> prepare($query);
$result = $stmt -> execute();
$result = $stmt -> get_result();

if($result -> num_rows > 0){
        $categories = array();
        while ($row = $result -> fetch_assoc()){
                $categories[] = $row;
        }
        echo json_encode($categories);
}
else {
        echo json_encode(array());
}
?>