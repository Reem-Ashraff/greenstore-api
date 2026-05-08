<?php
include 'index.php';
$postdata = file_get_contents("php://input");
$request = json_decode($postdata, true);

$username = $request['username'];
$email = $request['email'];
$password = $request['password'];

$stmt = $connection->prepare("SELECT u_id FROM users WHERE username=? OR email=?");
$stmt->bind_param("ss", $username, $email);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows > 0){
        $response['status'] = 'error';
        $response['message'] = 'Username or email already exists.';
}
else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $connection->prepare("INSERT INTO users (username, email, u_password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $hashed_password);

        if ($stmt->execute()) {
                $response['status'] = 'success';
                $response['message'] = 'User registered successfully.';

                $stmt = $connection->prepare("SELECT u_id FROM users WHERE email=?");
                $stmt->bind_param("s",$email);
                $result0 = $stmt->execute();
                $result0 = $stmt->get_result();
                if ($result0->num_rows > 0) {
                        //$user = array();
                        while ($row = $result0->fetch_assoc()) {
                                $user = $row["u_id"];
                                $response["user_id"]=$user;
                                //$result[1]=$response["user_id"];
                        }
                        //echo json_encode($user["u_id"]);
                }

                $result[0]= $response['message'];
        } else {
                $response['status'] = 'error';
                $response['message'] = 'Error registering user.';
                $result[0]= $response['message'];
        }
        $stmt->close();
}
//$res = json_encode($response["message"]);
//echo $res;
echo json_encode($response);
?>