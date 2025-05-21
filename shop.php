<?php
include('server/connection.php');
$stmt= $conn->prepare("Select * from products");
$stmt->execute();
$products= $stmt->get_result();
?>
<?php
include('layouts/header.php');
?>

 <!--search-->
<!-- <section id="search" class="my-5 py-5 ms-2">
  <div class="container mt-5 py-2">
    <p>Search Products</p>
    <hr>
  </div>
  <form>
    <div class="row mx-auto container">
      <div class="col-lg-12 col-md-12 col-sm-12">
        <p>Category</p>
        <div class="form-check">
        <input class="form-check-input" type="radio" name="category" id="category_one">
        <label class="form-check-label"  for="flexRadioDefault1">
          Featured
        </label>
      </div>

      <div class="form-check">
        <input class="form-check-input" type="radio" name="category" id="category_two">
        <label class="form-check-label"  for="flexRadioDefault2">
          Men Bags
        </label></div>

        <div class="form-check">
          <input class="form-check-input" type="radio" name="Category" id="category_three">
          <label class="form-check-label"  for="flexRadioDefault3">
            Branded Bags
          </label>
        </div>

        <div class="form-check">
          <input class="form-check-input" type="radio" name="Category" id="category_four">
          <label class="form-check-label"  for="flexRadioDefault4">
            Ladies Bags
          </label>
        </div>
      </div>
    </div>

    <div class="row mx-auto container mt-5">
      <div class="col-lg-12 col-md-12 col-sm-12">
<p>Price</p>
<input type="range" class="form-range w-50" min="1" max="100000" id="customRange2">
<div class="w-50">
  <span style="float: left;">1</span>
  <span style="float: right;">100000</span></div></div>
</div>

<div class="form-group my-3 mx-3">
  <input type="submit" name="search" value="Search" class="btn btn-primary">
</div>
  </form>
 </section> -->
      
  <!--shop-->
  <section id="featured" class="my-5 py-5">
    <div class="container text-center mt-2 py-2">
        <h3> Our Products</h3>
        <hr><br>
        <p> Here you can check out featured products</p>  
    </div>
    <div class="row mx-auto container">
        <?php while($row = $products->fetch_assoc()) { ?>
            <div class="product text-center col-lg-3 col-md-4 col-sm-12" onclick="window.location.href='single_product.php';">
                <img class="img-fluid mb-3" src="assets/imgs/<?php echo $row['product_image']; ?>"/>
                <div class="star">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                </div>
                <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
                <h4 class="p-price">Rs <?php echo $row['product_price']; ?></h4>
                <a href="<?php echo "single_product.php?product_id=" . $row['product_id']; ?>" 
   class="btn buy-btn" 
   style="color: white; text-decoration: none;">
    Buy Now
</a>

            </div>
        <?php } ?>
    </div>



      















































<?php
include('layouts/footer.php');
?>