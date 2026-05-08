<?php
include "index.php";

$query = "select * from users";
$stmt =  $connection -> prepare($query);
$result = $stmt -> execute();
$result = $stmt -> get_result();

$num = $result -> num_rows;

echo json_encode($num);

?>