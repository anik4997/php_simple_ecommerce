<?php
include 'database_connection.php';
if(isset($_POST['order_btn'])){
    $mail_query = "SELECT * FROM selected_items";
    $mail_query_connection = mysqli_query($connect,$mail_query);
    
    $count = mysqli_num_rows($mail_query_connection);
if($count>0){
    while($row = mysqli_fetch_assoc($mail_query_connection)){
        $db_mail = $row['vendor_email'];
        $subject = "You have an order!";
        $body = "Dear vendor, you have an order from our website plese check it out from your admin panel and complete the order asap.";
        $header = "From: oliahammed54480000@gmail.com";
        if(mail($db_mail,$subject,$body,$header)){
            echo "<h3>A notification email send successfully to <b>$db_mail</b> about your order....<br></h3> ";
            // Cart will be empty after placing the order
            $empty_cart_query = "DELETE FROM selected_items";
            $empty_cart_query_connection = mysqli_query($connect,$empty_cart_query);
           
        }else{
            echo "Email sending failed!";
            
        }
    }
}
}

?>