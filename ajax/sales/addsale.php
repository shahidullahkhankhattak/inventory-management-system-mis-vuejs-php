<?php 
    include("../mysqli.php");
    $data = json_decode(file_get_contents("php://input"));

    $itemid = $mysqli->real_escape_string($data->itemid);
    $quantity = $mysqli->real_escape_string($data->quantity);
    $price = $mysqli->real_escape_string($data->price);
    $contactid = $mysqli->real_escape_string($data->contactid);
    $payment_method = $mysqli->real_escape_string($data->payment_method);
    $date = $date = date('Y-m-d');
    $mysqli->query("INSERT INTO sales VALUES('', '$itemid', '$contactid', '$quantity', '$price', '$payment_method', '$date')");
    
    $get_item_query = $mysqli->query("SELECT * FROM items WHERE id='$itemid'");
    $current_item = $get_item_query->fetch_assoc();
    $sold_items = ((int)$quantity) + ((int)$current_item['sold']);
    $mysqli->query("UPDATE items SET sold='$sold_items' WHERE id='$itemid'");

    echo "success";
?>