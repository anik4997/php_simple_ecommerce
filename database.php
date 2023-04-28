<?php
require 'vendor/autoload.php';
// class for database connection
class database{
    public $db_host = HOST;
    public $db_username = USERNAME;
    public $db_password = PASSWORD;
    public $db_name = DATABASE;
    private static $instance = NULL;
    private $db_conn;


    // Convert default constructor private
    private function __construct(){}


    // Creating a single instance for db connection
    public static function getInstance(){
        if(self::$instance == NULL){
            self::$instance = new Static();
        }
        return self::$instance;
    }


    // Database connection
    public static function db_connect(){
            $db = self::getInstance();
            $db->db_conn = mysqli_connect($db->db_host,$db->db_username,$db->db_password,$db->db_name);
            return $db->db_conn;
            if(!$db->db_conn){
                die("Not connected".mysqli_error());
                return false;
            }
        
    }

    // Insert products to database
    public function insert($insert_query){
        $db = self::getInstance();
        $insert_query_connection = mysqli_query($db->db_conn,$insert_query) or die($db->db_conn->error.__LINE__);
        if($insert_query_connection){
            return $insert_query_connection;
        }else{
            return false;
        }
    }



    // Show products in available products section
    public function select($insert_query){
        $db = self::getInstance();
        $insert_query_connection = mysqli_query($db->db_conn,$insert_query) or die($db->db_conn->error.__LINE__);
        if(mysqli_num_rows($insert_query_connection)>0){
            return $insert_query_connection;
        }else{
            return false;
        }
    }


    //Cart insert
    public function insert_cart_table($cart_insert){
        $db = self::getInstance();
        $cart_insert_connection = mysqli_query($db->db_conn,$cart_insert) or die($db->db_conn->error.__LINE__);
        if($cart_insert_connection){
            return $cart_insert_connection;
        }else{
            return false;
        }
    }


    // Cart show
    public function show_cart($show_cart_query){
        $db = self::getInstance();
        $show_cart_query_connection = mysqli_query($db->db_conn,$show_cart_query) or die($db->db_conn->error.__LINE__);
        if(mysqli_num_rows($show_cart_query_connection)>0){
            return $show_cart_query_connection;
        }else{
            return false;
        }
    }

    // Send notification mail to the vendor
    public function send_mail_connection($mail_query){
        $db = self::getInstance();
        $mail_query_connection = mysqli_query($db->db_conn,$mail_query) or die($db->db_conn->error.__LINE__);
        
    }

    // Empty cart
    public function empty_cart_connection($empty_cart_query){
        $db = self::getInstance();
        $empty_cart_query_connection = mysqli_query($db->db_conn,$empty_cart_query) or die($db->db_conn->error.__LINE__);
        
    }

}
$db_connect = database::db_connect();
?>
