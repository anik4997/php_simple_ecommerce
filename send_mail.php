<?php
require 'vendor/autoload.php';
class mail{
   public $db;
   public function __construct(){
        $this->db = new database();
   }
   public function send_mail(){
    $mail_query = "SELECT * FROM selected_products";
    $mail_query_connection = $this->db->send_mail_connection($mail_query);
    return $mail_query_connection;
   }
   public function empty_cart(){
    $empty_cart_query = "DELETE FROM selected_products";
    $empty_cart_query_connection = $this->db->empty_cart_conncection($empty_cart_query);
   }
}
if(isset($_POST['order_btn'])){
    $mail = new mail();
    $send_mail = $mail->send_mail();
    if ($send_mail){
        // while looop for fetching data from database
        while($row = mysqli_fetch_assoc($send_mail)){
            $db_mail = $row['vendor_email'];
            $subject = "You have an order!";
            $body = "Dear vendor, you have an order from our website plese check it out from your admin panel and complete the order asap.";
            $header = "From: oliahammed54480000@gmail.com";
            if(mail($db_mail,$subject,$body,$header)){
                echo "<h3>A notification email send successfully to <b>$db_mail</b> about your order....<br></h3> ";
                // Cart will be empty after placing the order
               $empty_cart = $mail->empty_cart();
               
            }else{
                echo "Email sending failed!";
                
            }
        }
    }
}

?>
