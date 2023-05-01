<?php
namespace model;
require 'vendor/autoload.php';

class product{
    public $obj;
    // This constractor is for creating an object for the class database where have all the connections(db connection, insert, show query connections)
    public function __construct(){

       $this->obj = \controller\Database::getInstance();
    }
    public function addProduct($data, $img){
        // Taking values of input field by post and files(super global variable)
        $product_name = $data['product_name'];
        $product_details = $data['product_details'];
        $product_price = $data['product_price'];
        $vendor_email = $data['vendor_email'];
        $product_tax = $data['product_tax'];

        // This variable is declared for specific types of files permission('jpg','jpeg','png','gif')
        $permited_img_type = array('jpg','jpeg','png','gif');
        $product_image = $img['product_image']['name'];
        // This variable is declared for specific size of files permission less than 1mb
        $permited_img_size = $img['product_image']['size'];
        $img_tmp = $img['product_image']['tmp_name'];

        $div = explode('.',$product_image);
        // This variable is declared for converting lowercase of the permitted files extendions ('jpg','jpeg','png','gif')
        $img_ext = strtolower(end($div));
        $unique_img_name = substr(md5(time()),0,10).'.'.$img_ext;
        $upload_img = "upload/".$unique_img_name;


        // These are the conditions of not empty fields, permitted file size and permitted file types

        if(empty($product_name) || empty($product_details) || empty($product_price) || empty($vendor_email) || empty($product_image) ){
            $empty_msg = "Field must not be empty!";
            return $empty_msg;
        }elseif($permited_img_size>1048567){
            $size_error_msg = "Image size must be less than 1mb";
            return $size_error_msg;
        }elseif(in_array($img_ext , $permited_img_type ) == false){
            $extension_error_msg = "Only jpg, jpeg, png, gif this type of files are permitted to upload!".impload(', ',$permited_img_type);
            return $extension_error_msg;
        }else{
            move_uploaded_file($img_tmp,$upload_img);
            // Insert query

            $insert_query = "INSERT INTO oop_crud (product_name, product_details, product_price, vendor_email, product_image, tax) VALUES ('$product_name', '$product_details', '$product_price', '$vendor_email', '$upload_img', '$product_tax')";


            $insert_query_connection = $this->obj->insert($insert_query);
            header("location: index.php");
            exit;

            if($insert_query_connection){
                $insert_success_msg = "Product uploaded successfully!";
                return $insert_success_msg;
            }else{
                $insert_error_msg = "Product uploaded failed!";
                return $insert_error_msg;
            }
        } 
    }
    //  This method is for select query for showing products
    public function show_products(){
        $show_query = "SELECT * FROM oop_crud";
        $select_query_connection = $this->obj->select($show_query);
        return $select_query_connection;
    }


//  This method is for selecting products and copy to the new cart table(selected_products in mysql) from oop_crud table
public function selectproduct($quantity_input, $id_input){
    $quantity = $quantity_input['quantity'];
    $rcv_id = $id_input['id'];
     if(empty($quantity)){
         $quantity_error = "Quantity must not be empty!";
         return $quantity_error;
     }else{
         $cart_insert =  "INSERT INTO selected_products (id, product_name, product_price, vendor_email, product_image, tax, product_quantity)
         SELECT id, product_name, product_price, vendor_email, product_image, tax, '$quantity'
         FROM oop_crud
         WHERE id = $rcv_id";
         $cart_insert_connection = $this->obj->insert_cart_table($cart_insert);
     }
 }
    
//  This method is for showing selected products from selected_products mysql table to UI
 public function show_selectedproducts(){
        $show_cart_query = "SELECT * FROM selected_products";
        $show_cart_query_connection = $this->obj->show_cart($show_cart_query);
        return $show_cart_query_connection;
 }
}
?>
