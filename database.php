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
    // database connection
    public function db_connect(){
        $this->db_connection = mysqli_connect($this->db_host,$this->db_username,$this->db_password,$this->db_name);
        if(!$this->db_connection){
            die("Not connected".mysqli_error());
            return false;
        }
    }
    // INSERT
    public function insert($insert_query){
        $insert_query_connection = mysqli_query($this->db_connection,$insert_query) or die($this->db_connection->error.__LINE__);
        if($insert_query_connection){
            return $insert_query_connection;
        }else{
            return false;
        }
    }



    // SHOW
    public function select($insert_query){
        $insert_query_connection = mysqli_query($this->db_connection,$insert_query) or die($this->db_connection->error.__LINE__);
        if(mysqli_num_rows($insert_query_connection)>0){
            return $insert_query_connection;
        }else{
            return false;
        }
    }

}

?>
