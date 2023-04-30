<?php
require 'vendor/autoload.php';

class Database {
    public $db_host = HOST;
    public $db_username = USERNAME;
    public $db_password = PASSWORD;
    public $db_name = DATABASE;
    private static $instance = NULL;
    private $db_conn;

    // Convert default constructor private
    private function __construct() {}

    // Creating a single instance for db connection
    public static function getInstance() {
        if(self::$instance == NULL){
            self::$instance = new static();
        }
        return self::$instance;
    }

    // Database connection
    public static function db_connect() {
        $db = self::getInstance();
        $db->db_conn = mysqli_connect($db->db_host,$db->db_username,$db->db_password,$db->db_name);
        if(!$db->db_conn){
            die("Not connected".mysqli_error());
            return false;
        }
        return $db->db_conn;
    }

    // Insert products to database
    public function insert($insert_query){
        $insert_query_connection = mysqli_query($this->db_conn, $insert_query) or die($this->db_conn->error.__LINE__);
        if($insert_query_connection){
            return $insert_query_connection;
        } else {
            return false;
        }
    }

    // Show products in available products section
    public function select($show_query) {
        $select_query_connection = mysqli_query($this->db_conn, $show_query) or die($this->db_conn->error.__LINE__);
        if(mysqli_num_rows($select_query_connection)>0) {
            return $select_query_connection;
        } else {
            return false;
        }
    }

    // Cart insert
    public function insert_cart_table($cart_insert) {
        $cart_insert_connection = mysqli_query($this->db_conn, $cart_insert) or die($this->db_conn->error.__LINE__);
        if($cart_insert_connection) {
            return $cart_insert_connection;
        } else {
            return false;
        }
    }

    // Cart show
    public function show_cart($show_cart_query) {
        $show_cart_query_connection = mysqli_query($this->db_conn, $show_cart_query) or die($this->db_conn->error.__LINE__);
        if(mysqli_num_rows($show_cart_query_connection)>0) {
            return $show_cart_query_connection;
        } else {
            return false;
        }
    }

    // Send notification mail to the vendor
    public function send_mail_connection($mail_query) {
        $mail_query_connection = mysqli_query($this->db_conn, $mail_query) or die($this->db_conn->error.__LINE__);
    }

    // Empty cart
    public function empty_cart_connection($empty_cart_query) {
        $empty_cart_query_connection = mysqli_query($this->db_conn, $empty_cart_query) or die($this->db_conn->error.__LINE__);
    }
}

// Get a single instance of the database object
$db = Database::getInstance();

// Establish database connection
$db_conn = $db->db_connect();
?>
