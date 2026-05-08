<?php
include 'index.php';
$folderPath = "./Images/";
$postdata = $_POST;

//$postdata = file_get_contents("php://input");
//$request = json_decode($postdata, true);

$name = $_POST["p_name"];
$cname = $_POST["category_name"];
$price = $_POST["p_price"];

if($_POST['p_image'] !=""){
        $file_tmp = $_FILES['fileSource']['tmp_name'];
        $file_ext = explode('.',$_FILES['fileSource']['name']);
        $file_extension = end($file_ext);
        $img = $folderPath . uniqid() . '.'.$file_extension;
        move_uploaded_file($file_tmp, $img);
}
else{
        $img='';
}

$stmt = $connection->prepare("SELECT c_id  FROM categories WHERE category_name=?");
$stmt->bind_param("s", $cname);
$result = $stmt -> execute();
$result = $stmt -> get_result();
if($result -> num_rows > 0){
        $category = array();
        while ($row = $result -> fetch_assoc()){
                $category[] = $row;
                $id = $category[0]["c_id"];
        }
        $query2 = "insert into plants (p_name,p_price,category_id,p_image) values (?,?,?,?)";
        $stmt0 = $connection -> prepare($query2);
        $stmt0 -> bind_param("ssss",$name,$price,$id,$img);
        if($stmt0->execute()){
                $response['status'] = 'success';
                $response['message'] = 'Plant added successfully.';
        }
        else{
                $response['status'] = 'error';
                $response['message'] = 'Error adding plant.';
        }
        $stmt0->close();
}
else {
        echo json_encode(array());
}

echo json_encode($response["message"]);
?>