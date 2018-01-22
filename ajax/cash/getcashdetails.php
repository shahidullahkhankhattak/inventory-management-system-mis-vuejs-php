<?php 
    include("../mysqli.php");

    $inventory_row = $mysqli->query("SELECT SUM((quantity - sold)*price) AS inventory_total from items")->fetch_assoc();
    $inventory = $inventory_row['inventory_total'];

    $recievables_row = $mysqli->query("SELECT SUM(quantity * sale_price) AS recievable_total FROM sales WHERE payment_method='credit'")->fetch_assoc();
    $recievables = $recievables_row['recievable_total'];

    $total_cash_row = $mysqli->query("SELECT SUM(sale_price * quantity) AS total_cash FROM sales WHERE payment_method='cash'")->fetch_assoc();
    $cash = $total_cash_row['total_cash'];

    echo json_encode(array("cash"=>$cash, "inventory"=>$inventory, "recievables"=>$recievables));
?>