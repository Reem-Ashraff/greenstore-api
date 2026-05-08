<?php
include 'index.php';
$postdata = file_get_contents("php://input");
$request = json_decode($postdata, true);

$email = $request['email'];
$password = $request['password'];
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$stmt = $connection->prepare("SELECT u_id,u_password FROM users WHERE email=?");
$stmt->bind_param("s",$email);
$stmt->execute();
$stmt->store_result();
// while($row= $result -> fetch_assoc()){
//         $items = array();
//         $items[] = $row; 
//         $id0 = json_encode($items[0]["u_id"]);
//         echo $id0;
//         //$id0 = $items["u_id"];
$result=[];
if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashed_password);
        $stmt->fetch();
        if (password_verify($password, $hashed_password)) {
                $response['status'] = 'success';
                $response['message'] = 'you loged in successfully.';
                //echo json_encode(array("message" => "Login successful","user_id"=>$id));
                $response["user_id"] = $id;
                $result[0]= $response['message'];
                $result[1]= $response["user_id"];
        }
        else {
                $response['status'] = 'error';
                $response['message'] = 'Invalid password.';
                $result[0]= $response['message'];
        }
}
else{
        $response['status'] = 'error';
        $response['message'] = 'Email not found.';
        $result[0]= $response['message'];
}
//echo json_encode($response['message']);
//echo json_encode($response["user_id"]);
echo json_encode($response);
?>