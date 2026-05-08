<?php
include 'index.php';
$folderPath = "./Images/";
$postdata = $_POST;
//$postdata = file_get_contents("php://input");
//$request = json_decode($postdata, true);

$name = $_POST["name"];
//$newimg = $request["updated_image"];

if($_POST['updated_image'] !=""){
        $file_tmp = $_FILES['fileSource']['tmp_name'];
        $file_ext = explode('.',$_FILES['fileSource']['name']);
        $file_extension = end($file_ext);
        $newimg = $folderPath . uniqid() . '.'.$file_extension;
        move_uploaded_file($file_tmp, $newimg);
}
else{
        $newimg='';
}

$stmt = $connection->prepare("UPDATE plants set p_image=? where p_name=?");
$stmt->bind_param("ss",$newimg,$name);
if($stmt->execute()){
        $response['status'] = 'success';
        $response['message'] = 'Plant updated successfully.';
}
else{
        $response['status'] = 'error';
        $response['message'] = 'Error updating plant.';
}
$stmt->close();
echo json_encode($response["message"]);
?>