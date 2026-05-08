<?php
include "index.php";

$id = $_GET['id'];

$query = "select * from plants where category_id = ?";
$stmt = $connection -> prepare($query);
$stmt -> bind_param("s",$id);
$result = $stmt -> execute();
$result = $stmt -> get_result();

if($result -> num_rows > 0){
        $items = array();
        while ($row = $result -> fetch_assoc()){
                $items[] = $row;
        }
        for($i = 0; $i < count($items); $i++){
                $query2 = "select * from categories where c_id=?";
                $stmt0 = $connection -> prepare($query2);
                $stmt0 -> bind_param("s",$id);
                $result2 = $stmt0->execute();
                $result2 = $stmt0->get_result();
                while($row1 = $result2 -> fetch_assoc()){
                        $items[$i]["category_id"] = $row1["category_name"];
                }
        }
        echo json_encode($items);
}
else {
        echo json_encode(array());
}
?>