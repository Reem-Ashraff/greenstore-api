<?php
include "index.php";

$query = "select * from plants limit 6";
$stmt = $connection -> prepare($query);
$result = $stmt -> execute();
$result = $stmt -> get_result();

if($result -> num_rows > 0){
        $items = array();
        while ($row = $result -> fetch_assoc()){
                $items[] = $row;
        }
        for($i = 0; $i < count($items); $i++){
                $id = $items[$i]["category_id"];
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