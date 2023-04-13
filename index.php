<?php
require 'vendor/autoload.php';
// Creating objects for product class and passing the super global variable $_POST, $_FILES as parameter to the method addProduct()
$product = new Product();
// Passing superglobal variable POST and REQUEST to addProduct method(product.php) for getting the specific values
if (isset($_POST['submit'])){
  $add_product = $product->addProduct($_POST, $_FILES);
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
    <link rel="stylesheet" href="css/fontawesome.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
<!-- navbar start -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark p-4">
    <a class="navbar-brand" href="#">coderex</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Dropdown
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Something else here</a>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
        </li>
        </ul>
    </div>
    </nav>
<!-- navbar end -->
<!-- product upload section start -->
<p>
  <a class="btn btn-primary mt-3" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
    Click to upload your product
  </a>
</p>
<div class="collapse" id="collapseExample">
  <div class="card card-body">
  <form action="index.php" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="Product Name">Product Name</label>
    <input type="text" class="form-control" name="product_name" placeholder="Product Name" required>
  </div>
  <div class="form-group">
    <label for="Product Details">Product Details</label>
    <input type="text" class="form-control" name="product_details" placeholder="Product Details" required>
  </div>
  <div class="form-group">
    <label for="Product price">Product price</label>
    <input type="number" class="form-control" name="product_price" placeholder="Product price" min="1" step="1" required>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control" name="vendor_email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" required>
  </div>
  <div class="form-group">
    <label for="exampleFormControlFile1">Product Image</label>
    <input type="file" class="form-control-file" name="product_image" id="exampleFormControlFile1" required>
  </div>
  <div class="col-md-12">
    <div role="button" data-bs-toggle="collapse" data-bs-target="#ship_to_diff_form" class="mb-4" aria-expanded="true">
      <input type="checkbox" id="ship_to_diff" name="another" value="1" />
      <label for="ship_to_diff"><h3>Click for taxable items.</h3></label>
    </div>

    <div class="collapse" id="ship_to_diff_form">
      <div class="row">
        <div class="col-md-12 mb-5">
          <input class="form-control checkout_form" type="number" name="product_tax" id="log_user" placeholder="Tax amount %*" value="" min="1" step="1" />
        </div>
      </div>
  </div>
  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
</form>
  </div>
</div>
</div>
<!-- product upload section end -->

<!-- products showing section start -->



<div class="container mt-4">
              <div class="row">
                <div class="col text-center">
                  <h2>Available Products</h2>
                  <p class="text-theme">Choose your own</p>
                </div>
              </div>
            <div class="row mt-3">  
              <?php
                $show_products = $product->show_products();
                if ($show_products){
                  // while looop for fetching data from database
                  while($row = mysqli_fetch_assoc($show_products)){
                    ?>
                    <!-- This is product showing section inside a while loop -->
                      <div class="col-md-3">
                  <div class="card mb-4">
                      <img src="<?php echo $row['product_image'];?>" width="309px" height="309px" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title d-inline"><?php $row['product_name'];?></h5>
                      <h5 class="float-right">$<?php echo $row['product_price'];?>+ tax <?php echo $row['tax'];?>%</h5>
                      <p class="card-text"><?php echo $row['product_details'];?></p>
                      <form action="selected_product.php?id=<?php echo $row['id'];?>" method="post">
                        <input type="number" class="mb-2" min="1" step="1" name="quantity" placeholder="quantity" required>
                        <a href="selected_product.php?id=<?php echo $row['id'];?>"><button type="submit" name="select_items" class="btn btn-primary">Select Item</button></a>
                   </div>
                  </div>
                </div>
              </form>
                    <?php
                  }
                }
              ?>          
              
                <!-- Php tag for closing while loop bracket and closing if else condition for counting database row -->
            </div>             
</div>
<!-- products showing section end -->

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
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
