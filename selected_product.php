<?php
namespace view;
require 'vendor/autoload.php';
// creating an object for product class
$product = new \model\Product();

if (isset($_POST['select_items'])){
  $select_product = $product->selectproduct($_POST, $_REQUEST);
}
?>

<!-- html with bootsrtap cdn -->
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
  </head>
    <body>
      <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">No of items</th>
            <th scope="col">Product name</th>
            <th scope="col">Product image</th>
            <th scope="col">Quantity</th>
            <th scope="col">Unit Price</th>
            <th scope="col">Tax</th>
            <th scope="col">Total Price</th>
            <th scope="col">Vendor's Email</th>
          </tr>
        </thead>
        <?php
        // Calling the method show_selectedproducts where sql select query by cart object
        $show_cart_products = $product->show_selectedproducts();
        if($show_cart_products){
          $serial_no = 0;
          // This is a while loop running for showing the product row by row in a html table
          while($row2 = mysqli_fetch_assoc($show_cart_products)){
            $serial_no++;
            // Calculation for total price including tax
            $tax_amount = $row2['tax']*$row2['product_price']/100;
            $unit_price = $row2['product_price']+$tax_amount;
            $total_price = $unit_price*$row2['product_quantity'];

            ?>
            <!-- This html table body inside a while loop for showing selected items -->
        <tbody>
          <tr>
            <th scope="row"><?php echo $serial_no;?></th>
            <td><?php echo $row2['product_name'];?></td>
            <td><img src="<?php echo $row2['product_image'];?>" height="50px" width="50px" alt=""></td>
            <td><?php echo $row2['product_quantity'];?></td>
            <td><?php echo $row2['product_price'];?></td>
            <td><?php echo $row2['tax'];?>%</td>
            <td><?php echo $total_price;?></td>
            <td><?php echo $row2['vendor_email'];?></td>
          </tr>
        </tbody>
        <?php
          }
        }
        ?>       
      </table>


      <form action="send_mail.php" method = "post">
        <button type="submit" name="order_btn" class="btn btn-primary">Place order</button>
      </form>
      <!-- javastript  -->
      <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"
      ></script>
      <script src="js/animated_progressbar.js"></script>
      <!-- jquery -->
      <script src="https://code.jquery.com/jquery-3.3.1.min.js" 
        integrity="sha384-tsQFqpEReu7ZLhBV2VZlAu7zcOV+rXbYlF2cqB8txI/8aZajjp4Bqd+V6D5IgvKT" 
        crossorigin="anonymous">
      </script> 

    </body>
</html>
              
