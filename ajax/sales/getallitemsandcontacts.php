<?php 
    include("../mysqli.php");

    $items_query = $mysqli->query("SELECT * FROM items");
    $all_items = array();
    while($row = $items_query->fetch_assoc()){
        array_push($all_items, $row);
    }
    $contacts_query = $mysqli->query("SELECT * FROM contacts");
    $all_contacts = array();
    while($row = $contacts_query->fetch_assoc()){
        array_push($all_contacts, $row);
    }
    echo json_encode(array("items"=>$all_items, "contacts"=>$all_contacts));
?>