<?php
include "config.php";
// class for database connection
class database{
    public $db_host = HOST;
    public $db_username = USERNAME;
    public $db_password = PASSWORD;
    public $db_name = DATABASE;
    public $db_connection;
    public $db_error;


    public function __construct(){
        $this->db_connect();
    }


    // Database connection
    public function db_connect(){
        $this->db_connection = mysqli_connect($this->db_host,$this->db_username,$this->db_password,$this->db_name);
        if(!$this->db_connection){
            die("Not connected".mysqli_error());
            return false;
        }
    }


    // Insert products to database
    public function insert($insert_query){
        $insert_query_connection = mysqli_query($this->db_connection,$insert_query) or die($this->db_connection->error.__LINE__);
        if($insert_query_connection){
            return $insert_query_connection;
        }else{
            return false;
        }
    }



    // Show products in available products section
    public function select($insert_query){
        $insert_query_connection = mysqli_query($this->db_connection,$insert_query) or die($this->db_connection->error.__LINE__);
        if(mysqli_num_rows($insert_query_connection)>0){
            return $insert_query_connection;
        }else{
            return false;
        }
    }


    //Cart insert
    public function insert_cart_table($cart_insert){
        $cart_insert_connection = mysqli_query($this->db_connection,$cart_insert) or die($this->db_connection->error.__LINE__);
        if($cart_insert_connection){
            return $cart_insert_connection;
        }else{
            return false;
        }
    }

    
    // Cart show
    public function show_cart($show_cart_query){
        $show_cart_query_connection = mysqli_query($this->db_connection,$show_cart_query) or die($this->db_connection->error.__LINE__);
        if(mysqli_num_rows($show_cart_query_connection)>0){
            return $show_cart_query_connection;
        }else{
            return false;
        }
    }
}

?>
