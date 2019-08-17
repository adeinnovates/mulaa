<?php 

header('Content-Type: application/json; charset=utf-8');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");


$response = array();
$upload_dir = 'uploads/';
$avatar_dir = 'uploads/products/';
$booms_dir = 'products/';
$server_url = 'http://dev.mulaa.co';

if($_FILES['product'])
{
    /*
    if (exif_imagetype('image.gif') != IMAGETYPE_GIF) {
        echo 'The picture is not a gif';
    }*/
    //$new_name = $_POST['username'];
    $avatar_name = $_FILES["product"]["name"];
    $avatar_tmp_name = $_FILES["product"]["tmp_name"];
    $error = $_FILES["product"]["error"];
    if($error > 0){
        $response = array(
            "status" => "error",
            "error" => true,
            "message" => "Error uploading the file!"
        );
    }else 
    {
        $temp = explode(".", $avatar_name); 
        $random_name = rand(1000,1000000)."-".$avatar_name;
        //$random_name = $new_name.'.'.end($temp);
        $upload_name = $avatar_dir.strtolower($random_name);
        $upload_name = preg_replace('/\s+/', '-', $upload_name);
    
        if(move_uploaded_file($avatar_tmp_name , $upload_name)) {
            $response = array(
                "status" => "success",
                "error" => false,
                "message" => "File uploaded successfully",
                "url" => $server_url."/imgapi//".$upload_name
              );
        }else
        {
            $response = array(
                "status" => "error",
                "error" => true,
                "message" =>  $response + "Error uploading the file!"
            );
        }
    }
    
}else{
    $response = array(
        "status" => "error",
        "error" => true,
        "message" => "No file was sent!"
    );
}
echo json_encode($response);
?>