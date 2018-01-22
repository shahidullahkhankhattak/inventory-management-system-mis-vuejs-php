<?php 
    include("../mysqli.php");

    $check_query = $mysqli->query("SELECT * FROM contacts");
    $all_items = array();
    while($row = $check_query->fetch_assoc()){
        array_push($all_items, $row);
    }
    echo json_encode($all_items);
?>