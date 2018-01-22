<?php 
    include("../mysqli.php");
    $data = json_decode(file_get_contents("php://input"));

    $name = $mysqli->real_escape_string($data->name);
    $price = $mysqli->real_escape_string($data->price);
    $quantity = $mysqli->real_escape_string($data->quantity);
    $date = $date = date('Y-m-d');
    $check_query = $mysqli->query("SELECT * FROM items WHERE name='$name' AND price='$price'");
    if($check_query->num_rows > 0){
        $row = $check_query->fetch_assoc();
        $quantity = $row['quantity'] + $quantity;
        $mysqli->query("UPDATE items SET quantity='$quantity', date='$date' WHERE name='$name' AND price='$price'");
        echo "success";
    }else{
        $mysqli->query("INSERT INTO items VALUES('','$name','$quantity', '$price','0','$date')");
        echo "success";
    }

?>