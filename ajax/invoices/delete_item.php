<?php 
    include("../mysqli.php");

    $id = $mysqli->real_escape_string(file_get_contents("php://input"));
    $check_query = $mysqli->query("DELETE FROM items WHERE id='$id'");
    $mysqli->query("DELETE FROM sales WHERE item_id='$id'");
    echo "success";
?>