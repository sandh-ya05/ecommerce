<?php
include('layouts/header.php'); 
?>

<!--Home-->
<section id="home" >
  <div class="container">
    <h5>NEW ARRIVALS</h5>
    <h1><span>Best Prices </span> This Season</h1>
    <p>Best Products for the most affordable price</p>
    <a href="shop.php"> <button >Shop Now</button></a>
  </div>
</section>

<br>
    <br>
    <br>


<!--Brands-->
<section id="brand" class="container">
  <div class="row">
    <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/imgs/chanel.png"/>
    <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/imgs/coach.png"/>
    <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/imgs/prada.png"/>
    <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/imgs/her.png"/>

  </div>

<br>
<br>

</section>

<!--New-->
<section id ="new" class="w-100">
  <div class="row p-0 m-0">
    <!--one-->
    <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
      <img class="img-fluid" src="assets/imgs/1.jpg"/>
      <div class="details">
        <h2>Stylish Bags</h2>
       <a href="shop.php"> <button class="text-uppercase">Shop Now</button></a>
      </div>
    </div>

    <!--two-->
    <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
      <img class="img-fluid" src="assets/imgs/2.jpg"/>
      <div class="details">
        <h2> Get One Now</h2>
        <a href="shop.php"> <button class="text-uppercase">Shop Now</button></a>
      </div>
    </div>

    <!--three-->
    <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
      <img class="img-fluid" src="assets/imgs/3.jpg"/>
      <div class="details">
        <h2>50% OFF</h2>
        <a href="shop.php"> <button class="text-uppercase">Shop Now</button></a>
      </div>
    </div>
  </div>
</section>
</section>
 
<!--feature-->
<section id="featured" class="my-2 pb-2">
  <div class="container text-center mt-2 py-2">
    <h3> Our Featured</h3>
<hr><br>
<p> Here you can check out featured produtcs</p>  
</div>
<div class="row mx-auto container-fluid">
<?php include('server/get_featured_products.php'); ?>

  <?php while($row=$featured_products->fetch_assoc()){?>
  <div class="product text-center col-lg-3 col-md-4 col-sm-12">
  <img class="img-fluid mb-3" src="assets/imgs/<?php echo $row['product_image']; ?>" />

    <div class="star">
      <i class="fa fa-star"></i>
      <i class="fa fa-star"></i>
      <i class="fa fa-star"></i>
      <i class="fa fa-star"></i>
      <i class="fa fa-star"></i>
    </div>
    <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
    <h4 class="p-price"><span>Rs </span><?php echo $row['product_price']; ?></h4>
    <a href="<?php echo "single_product.php?product_id=" . $row['product_id']; ?>">
    <button class="buy-btn">Buy Now</button>
</a>

  </div>
 <?php } ?>
</div>
</section>

<!-- branded feature-->
<section id="branded" class="my-2 pb-2">
  <div class="container text-center mt-2 py-2">
    <h3> Branded Bags</h3>
<hr><br>
<p> Here you can check out the branded produtcs</p>  
</div>
<div class="row mx-auto container-fluid">
<?php include('server/get_branded.php'); ?>

  <?php while($row=$branded->fetch_assoc()){?>
  <div class="product text-center col-lg-3 col-md-4 col-sm-12">
  <img class="img-fluid mb-3" src="assets/imgs/<?php echo $row['product_image']; ?>" />

    <div class="star">
      <i class="fa fa-star"></i>
      <i class="fa fa-star"></i>
      <i class="fa fa-star"></i>
      <i class="fa fa-star"></i>
      <i class="fa fa-star"></i>
    </div>
    <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
    <h4 class="p-price"><span>Rs </span><?php echo $row['product_price']; ?></h4>
    <a href="<?php echo "single_product.php?product_id=" . $row['product_id']; ?>">
    <button class="buy-btn">Buy Now</button>
</a>

  </div>
 <?php } ?>
</div>
</section>

<!--banner-->
<section id="banner" class="my-2 py-2">
  <div class="container">
    <h4>MID SEASON SALE</h4>
    <h1>Trending Collection<br> Upto 30% OFF</h1>
   <a href="shop.php"> <button class="text-uppercase">shop now</button></a>
  </div>
</section>

<!-- ladies items-->
<section id="ladies" class="my-2">
  <div class="container text-center mt-2 py-2">
    <h3> Ladies' Bags</h3>
<hr><br><p> Here you can check out ladies trendy bags</p>
</div>
<div class="row mx-auto container-fluid">
<?php include('server/get_ladies.php'); ?>

  <?php while($row=$ladies->fetch_assoc()){?>
  <div class="product text-center col-lg-3 col-md-4 col-sm-12">
  <img class="img-fluid mb-3" src="assets/imgs/<?php echo $row['product_image']; ?>" />

    <div class="star">
      <i class="fa fa-star"></i>
      <i class="fa fa-star"></i>
      <i class="fa fa-star"></i>
      <i class="fa fa-star"></i>
      <i class="fa fa-star"></i>
    </div>
    <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
    <h4 class="p-price"><span>Rs </span><?php echo $row['product_price']; ?></h4>
    <a href="<?php echo "single_product.php?product_id=" . $row['product_id']; ?>">
    <button class="buy-btn">Buy Now</button>
</a>

  </div>
 <?php } ?>
</div>
</section>



<!--Men bags-->
<section id="mens" class="my-2">
  <div class="container text-center mt-2 py-2">
    <h3> Men's Bags</h3>
<hr><br><p> Here you can check out men's trendy bags</p>
</div>
<div class="row mx-auto container-fluid">
<?php include('server/get_men.php'); ?>

  <?php while($row=$men->fetch_assoc()){?>
  <div class="product text-center col-lg-3 col-md-4 col-sm-12">
  <img class="img-fluid mb-3" src="assets/imgs/<?php echo $row['product_image']; ?>" />

    <div class="star">
      <i class="fa fa-star"></i>
      <i class="fa fa-star"></i>
      <i class="fa fa-star"></i>
      <i class="fa fa-star"></i>
      <i class="fa fa-star"></i>
    </div>
    <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
    <h4 class="p-price"><span>Rs </span><?php echo $row['product_price']; ?></h4>
    <a href="<?php echo "single_product.php?product_id=" . $row['product_id']; ?>">
    <button class="buy-btn">Buy Now</button>
</a>

  </div>
 <?php } ?>
</div>
</section>



<!--footer-->
<?php include('layouts/footer.php'); ?>