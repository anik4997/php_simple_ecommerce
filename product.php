<?php
include 'database.php';
class product{
    public $db;

    public function __construct(){

        $this->db = new database();
    }
    public function addProduct($data, $img){
        $product_name = $data['product_name'];
        $product_details = $data['product_details'];
        $product_price = $data['product_price'];
        $vendor_email = $data['vendor_email'];
        $product_tax = $data['product_tax'];


        $permited_img_type = array('jpg','jpeg','png','gif');
        $product_image = $img['product_image']['name'];
        $permited_img_size = $img['product_image']['size'];
        $img_tmp = $img['product_image']['tmp_name'];

        $div = explode('.',$product_image);
        $img_ext = strtolower(end($div));
        $unique_img_name = substr(md5(time()),0,10).'.'.$img_ext;
        $upload_img = "upload/".$unique_img_name;


        // $rcv_id = $data['id'];


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

            $insert_query = "INSERT INTO oop_crud (product_name, product_details, product_price, vendor_email, product_image, tax) VALUES ('$product_name', '$product_details', '$product_price', '$vendor_email', '$upload_img', '$product_tax')";


            $insert_query_connection = $this->db->insert($insert_query);

            if($insert_query_connection){
                $insert_success_msg = "Product uploaded successfully!";
                return $insert_success_msg;
            }else{
                $insert_error_msg = "Product uploaded failed!";
                return $insert_error_msg;
            }
        } 
    }
    public function show_products(){
        $show_query = "SELECT * FROM oop_crud";
        $select_query_connection = $this->db->select($show_query);
        return $select_query_connection;
    }

    // public function show_cart(){
    //     $cart_insert =  "INSERT INTO selected_products (id, product_name, product_price, vendor_email, product_image, tax, product_quantity)
    //     SELECT id, product_name, product_price, vendor_email, product_image, tax, '$quantity'
    //     FROM 	oop_crud
    //     WHERE id = $rcv_id";


    //     $cart_insert_connection = $this->db->cart_select($cart_insert);
    //     return $cart_insert_connection;

    // }
}

?>