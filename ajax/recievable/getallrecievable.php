<?php 
    include("../mysqli.php");
    $date = date('Y-m-d');
    $customers = $mysqli->query("SELECT DISTINCT s.contact_id AS id, c.name AS name FROM sales s INNER JOIN contacts c ON c.id=s.contact_id WHERE payment_method='credit'");
    $total_recievables = array();
    while($customer_row = $customers->fetch_assoc()){
        $customer_id = $customer_row['id'];
        $customer_name = $customer_row['name'];

        $recievables_row = $mysqli->query("SELECT SUM(quantity * sale_price) AS recievable_total FROM sales WHERE payment_method='credit' AND contact_id='$customer_id'")->fetch_assoc();
        $recievables = $recievables_row['recievable_total'];

        $days_outstanding_row = $mysqli->query("SELECT s.date AS days FROM sales s WHERE payment_method='credit' AND contact_id='$customer_id'")->fetch_assoc();
        $days_database = new DateTime($days_outstanding_row['days']);
        $days_our = new DateTime($date);
        $days_outstanding = $days_our->diff($days_database)->format("%a");

        array_push($total_recievables, array("contact_id"=>$customer_id, "contact_name"=>$customer_name, "recievables"=>$recievables, "days"=>$days_outstanding));
    }
    echo json_encode($total_recievables);
?>  