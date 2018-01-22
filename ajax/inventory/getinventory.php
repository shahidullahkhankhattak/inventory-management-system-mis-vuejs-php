<?php 
    include("../mysqli.php");

    $query = $mysqli->query("SELECT name, ((quantity - sold) * price) AS cash_value FROM items");
    $total_items = array();
    while($row = $query->fetch_assoc())
        array_push($total_items, $row);

    echo json_encode($total_items);
?>