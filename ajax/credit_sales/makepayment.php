<?php 
    include("../mysqli.php");

    $id = $mysqli->real_escape_string(file_get_contents("php://input"));
    $check_query = $mysqli->query("UPDATE sales SET payment_method='cash' WHERE id='$id'");
    echo "success";
?>