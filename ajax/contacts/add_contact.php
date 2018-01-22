<?php 
    include("../mysqli.php");
    $data = json_decode(file_get_contents("php://input"));

    $name = $mysqli->real_escape_string($data->name);
    $phone = $mysqli->real_escape_string($data->phone);
    $address = $mysqli->real_escape_string($data->address);
    $check_query = $mysqli->query("SELECT * FROM contacts WHERE name='$name' AND phone='$phone'");
    if($check_query->num_rows > 0){
        echo "exist";
    }else{
        $mysqli->query("INSERT INTO contacts VALUES('','$name','$phone', '$address')");
        echo "success";
    }

?>