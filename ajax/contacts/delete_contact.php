<?php 
    include("../mysqli.php");

    $id = $mysqli->real_escape_string(file_get_contents("php://input"));
    $check_query = $mysqli->query("DELETE FROM contacts WHERE id='$id'");
    echo "success";
?>