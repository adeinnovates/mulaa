<?php 

header('Content-Type: application/json; charset=utf-8');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");


$response = array();
$upload_dir = 'uploads/';
$feed_dir = 'uploads/feed/';
$server_url = 'https://shop.mulaa.co';

if($_FILES['shopfeed'])
{
    // code will be added here.

    $feed_name = $_FILES["shopfeed"]["name"];
    $feed_tmp_name = $_FILES["shopfeed"]["tmp_name"];
    $error = $_FILES["shopfeed"]["error"];

    if($error > 0){
        $response = array(
            "status" => "error",
            "error" => true,
            "message" => "Error uploading the file!"
        );
    }else 
    {
        // The rest of your code will be added here.
        $random_name = rand(1000,1000000)."-".$feed_name;
        $upload_name = $feed_dir.strtolower($random_name);
        $upload_name = preg_replace('/\s+/', '-', $upload_name);

        //

        if(move_uploaded_file($feed_tmp_name , $upload_name)) {
            $response = array(
                "status" => "success",
                "error" => false,
                "message" => "File uploaded successfully",
                "url" => $server_url."/".$upload_name
              );
        }else
        {
            $response = array(
                "status" => "error",
                "error" => true,
                "message" => "Error uploading the file!"
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