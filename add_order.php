<?php
include 'index.php';
$postdata = file_get_contents("php://input");
$request = json_decode($postdata, true);

$first = $request["firstname"];
$last = $request["lastname"];
$country = $request["country"];
$address = $request["address"];
$city = $request["city"];
$phone = $request["phone"];
$email = $request["email"];
$notes = $request["notes"];

$query = "select u_id from users where email=?";
$stmt = $connection -> prepare($query);
$stmt->bind_param("s", $email);
$result = $stmt -> execute();
$result = $stmt -> get_result();
if($result -> num_rows > 0){
        $user = array();
        while ($row = $result -> fetch_assoc()){
                $user[] = $row;
                $id = $user[0]["u_id"];
        }
        $query2 = "insert into orders (id_user,u_firstname,u_lastname,country,address,city,u_phone,notes) values (?,?,?,?,?,?,?,?)";
        $stmt0 = $connection -> prepare($query2);
        $stmt0 -> bind_param("ssssssss",$id,$first,$last,$country,$address,$city,$phone,$notes);
        if($stmt0 -> execute()){
                $query3 = "SELECT o_id from orders order by time_date desc";
                $stmt1 = $connection -> prepare($query3);
                $result0 = $stmt1 -> execute();
                $result0 = $stmt1 -> get_result();
                if($result0 -> num_rows > 0){
                        $order = array();
                        while ($row = $result0 -> fetch_assoc()){
                                $order[] = $row;
                                $order_id = $order[0]["o_id"];
                        }
                }
        }
        echo json_encode($order_id);

}
?>