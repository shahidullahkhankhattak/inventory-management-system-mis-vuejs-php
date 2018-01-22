<?php 
    include("../mysqli.php");

    $id = $mysqli->real_escape_string(file_get_contents("php://input"));
    $check_query = $mysqli->query("SELECT s.id AS id, 
                                          c.name AS contact_name,
                                          (s.sale_price * s.quantity) AS recievable,
                                          i.name AS item_name,
                                          s.quantity AS quantity,
                                            s.sale_price AS price
                                            FROM sales s
                                            INNER JOIN contacts c ON c.id=s.contact_id
                                            INNER JOIN items i ON i.id=s.item_id
                                            WHERE s.contact_id='$id' AND s.payment_method='credit'");
    $sales = array();
    while($row = $check_query->fetch_assoc()){
            array_push($sales, $row);
    }
    echo json_encode($sales);
?>