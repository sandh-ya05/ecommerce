<?php
include('server/connection.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $product = $stmt->get_result();

    if ($product->num_rows == 0) {
        echo "<h3>No product found for the given ID.</h3>";
        exit();
    }
} else {
    echo "<h3>Product ID is not set in the URL!</h3>";
    header('location: index.php');
    exit();
}
?>

<?php
include('layouts/header.php');
?>

    <section class="container single-product my-5 pt-5">
    <div class="row mt-5">
        <?php while ($row = $product->fetch_assoc()) { ?>
         
            <div class="col-lg-5 col-md-6 col-sm-12">
                <img src="assets/imgs/<?php echo $row['product_image']; ?>" class="img-fluid w-60 d-block mx-auto pb-1" id="mainImg"/>
                <div class="small-img-group">
                    <div class="small-img-col">
                        <img src="assets/imgs/<?php echo $row['product_image']; ?>" width="100%" class="small-img"/>
                    </div>
                    <div class="small-img-col">
                        <img src="assets/imgs/<?php echo $row['product_image2']; ?>" width="100%" class="small-img"/>
                    </div>
                    <div class="small-img-col">
                        <img src="assets/imgs/<?php echo $row['product_image3']; ?>" width="100%" class="small-img"/>
                    </div>
                    <div class="small-img-col">
                        <img src="assets/imgs/<?php echo $row['product_image4']; ?>" width="100%" class="small-img"/>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-12 col-12">
                
                <h3 class="py-4"><?php echo $row['product_name']; ?></h3>
                <h2><?php echo $row['product_price']; ?></h2>
                <form method="POST" action="cart.php">
                  <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>" />
            <input type="hidden" name="product_image" value="<?php echo $row['product_image']; ?>"/>
            <input type="hidden" name="product_name" value="/<?php echo $row['product_name']; ?>"/>
            <input type="hidden" name="product_price" value="/<?php echo $row['product_price']; ?>"/>
                
                <input type="number" name="product_quantity" value="1"/>
                <button class="buy-btn" type="submit" name="add_to_cart">Add To Cart</button>  
              </form>
                
                <h4 class="mt-5 mb-5">Product Details</h4>
                <span><?php echo $row['product_description']; ?></span>
            </div>
        <?php } ?>
    </div>
</section>

<!--Related Products-->
<section id="related products" class="my-2">
    <div class="container text-center mt-2 py-2">
      <h3> Related Products</h3>
  <hr><br>
  </div>
  <div class="row mx-auto container-fluid">
    <div class="product text-center col-lg-3 col-md-4 col-sm-12">
      <img class="img-fluid mb-3" src="assets/imgs/backpack.jpg"/>
      <div class="star">
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
      </div>
      <h5 class="p-name">Back Pack</h5>
      <h4 class="p-price">Rs.2700</h4>
      <button class="buy-btn">Buy Now</button>
    </div>
    <div class="product text-center col-lg-3 col-md-4 col-sm-12">
      <img class="img-fluid mb-3" src="assets/imgs/briefcase.jpeg"/>
      <div class="star">
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
      </div>
      <h5 class="p-name">Brief Case</h5>
      <h4 class="p-price">Rs.12000</h4>
      <button class="buy-btn">Buy Now</button>
    </div>
    <div class="product text-center col-lg-3 col-md-4 col-sm-12">
      <img class="img-fluid mb-3" src="assets/imgs/duffle.jpg"/>
      <div class="star">
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
      </div>
      <h5 class="p-name">Duffle Bag</h5>
      <h4 class="p-price">Rs.5000</h4>
      <button class="buy-btn">Buy Now</button>
    </div>
    <div class="product text-center col-lg-3 col-md-4 col-sm-12">
      <img class="img-fluid mb-3" src="assets/imgs/sling.jpg"/>
      <div class="star">
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
      </div>
      <h5 class="p-name">Sling Bag</h5>
      <h4 class="p-price">Rs. 2500</h4>
      <button class="buy-btn">Buy Now</button>
    </div>
  </div>
  </section>
  



















  <?php
include('layouts/footer.php');
?>