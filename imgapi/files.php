<?php 

header('Content-Type: application/json; charset=utf-8');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");


$response = array();
$upload_dir = 'uploads/';
$avatar_dir = 'uploads/files/';
$booms_dir = 'files/';
$server_url = 'http://dev.mulaa.co';
$user = $_POST['username'];

if($_FILES['product'])
{
   
    $avatar_name = $_FILES["product"]["name"];
    $extension = pathinfo($avatar_name, PATHINFO_EXTENSION);
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
        if (!in_array($extension, ['pdf','docx', 'xls', 'doc'])) {
            $response = array(
                "status" => "error",
                "error" => true,
                "message" => "Wrong file format",
                "extension" => $extension
              );
            }else{
           
        $temp = explode(".", $avatar_name); 
        $random_name = $user."-".rand(1000,1000000)."-".$avatar_name;
        
        $upload_name = $avatar_dir.strtolower($random_name);
        $upload_name = preg_replace('/\s+/', '-', $upload_name);
    
        if(move_uploaded_file($avatar_tmp_name , $upload_name)) {
            $response = array(
                "status" => "success",
                "error" => false,
                "message" => "File uploaded successfully",
                "extension" => $extension,
                "url" => $random_name //http://dev.mulaa.co/imgapi//uploads/files/filename.ext
                //"url" => $server_url."/imgapi//".$upload_name
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
       // 
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