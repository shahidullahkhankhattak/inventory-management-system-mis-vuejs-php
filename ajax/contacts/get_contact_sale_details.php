<?php 
    include("../mysqli.php");

    $id = $mysqli->real_escape_string(file_get_contents("php://input"));
    $all_sales_query = $mysqli->query("SELECT s.id AS id, i.name AS item, s.sale_price AS price, s.quantity AS quantity, s.payment_method AS payment_method, c.name AS contact,
                                      s.date AS date
                                      FROM sales s
                                      INNER JOIN contacts c ON c.id=s.contact_id
                                      INNER JOIN items i ON i.id=s.item_id
                                      WHERE s.contact_id='$id'
                                      ");
    $all_sales = array();
    while($row = $all_sales_query->fetch_assoc()){
        array_push($all_sales, $row);
    }
    echo json_encode($all_sales);
?>