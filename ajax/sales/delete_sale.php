<?php 
    include("../mysqli.php");

    $data = json_decode(file_get_contents("php://input"));
    $id = $mysqli->real_escape_string($data->id);
    $quantity = $mysqli->real_escape_string($data->quantity);
    $mysqli->query("DELETE FROM sales WHERE id='$id'");

    $mysqli->query("UPDATE items SET sold=sold-$quantity");
    echo "success";
?>