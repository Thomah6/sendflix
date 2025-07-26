<?php
require('conn.php');
session_start();
$userId = $_SESSION['id'] ?? 1; // Ensure that the user session is set

$results = [];
if (isset($_FILES['movie']) && !empty($_FILES['movie']['tmp_name'])) {

    $targetDir_video = 'brouillon/';
    if (!file_exists($targetDir_video)) {
        mkdir($targetDir_video, 0777, true);
    }
    $uploadFile_video = $targetDir_video . basename($_FILES['movie']['name']);
    $ji=$pdo->prepare("INSERT INTO brouillon (link,user) VALUES('$uploadFile_video','$userId')");
    if(move_uploaded_file($_FILES['movie']['tmp_name'], $uploadFile_video) && $ji->execute()){

        $results[] = ["path" => $uploadFile_video, "message" => "Upload confirmed"];
        

    }else{
        $results[] = ["message" => "An error occured"];
    }


    header('Content-Type: application/json');

echo json_encode($results);

}

?>