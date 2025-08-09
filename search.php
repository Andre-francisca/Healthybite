<?php
session_start();
require "database/db.php";
require "php/random.php";
require "database/createdb.php";
include 'class/Rating.php';
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="">
	<meta name="description" content="">
    <link rel="stylesheet" href="./lib/css/grid.css" >
	<link rel="stylesheet" href="./css/custom.css" >
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/animate.css">
	<link rel="stylesheet" href="./lib/fontawesome/css/fontawesome.css" >
    <title>HealthyBiteGH</title>
	
	<style>
.page-item.active .page-link {
z-index: 1;
color:#fff;
background-color:red!important;
border-color:#000!important;
}
	</style>
  </head>
  <body class="bg-light">
<section id="main" >
<?php require "template/nav.php"    ?>
<div class="container">
<h1>Search</h1>
<div class="s132" >
      <form action="search.php" method="post">
        <div class="inner-form">
         
          <div class="input-field second-wrap">
            <input id="search" type="text" name="q"placeholder="Search meals and restaurants" />
          </div>
          <div class="input-field third-wrap">
            <button class="btn-search" type="submit" name="submit"><i class="fa fa-search"></i>&nbsp;Search</button>
          </div>
        </div>
      </form>
    </div>

  </div>
</section>


<!----menu--->
  <div class="container">
       
  </div>
  <!--response modal--->
                                <div class="modal fade" id="delete_Modal">
                                  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-info"></i>&nbsp;Alert</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                          <div id="message"></div>
                                      </div>
                                     
                                    </div>
                                  </div>
                                </div>
   <section class="popular">
            <div class="container">
               
                <div class="row">
                    <?php 
                    if(isset($_POST['submit'])){
                   
                    $q = $con->real_escape_string($_POST['q']);
                    
                     $query = $con->query("SELECT * FROM item LEFT JOIN restaurants ON restaurants.restaurant_id = item.restaurant_id WHERE item_name LIKE '%$q%' OR  restaurantname like '%$q%' ") or die(mysqli_error($con));
                     ?>
                     <div class="container text-xs-center m-b-30">
                      <?php
                       echo "Search Query: <b style='color:orange'>".$q."</b><br>";
                        echo "Total: <span class='badge badge-info' style='background:orange'>".$query->num_rows." </span> results found<br><br>";?>
                      </div>
                      <?php
                     if($query->num_rows > 0){ 
                      $rating = new Rating();
                     

                                      while ($row = $query->fetch_assoc()) {
                                          $average = $rating->getRatingAverage($row["item_id"]);
                                          $restaurantid = $row['restaurant_id'];
                      //$productid = $row["res_id"];
                                         ?>  
                    <!-- Each popular food item starts -->
                    <div class="col-xs-12 col-sm-6 col-md-4 food-item">
                        <div class="food-item-wrap">
            
                            <div class="figure-wrap bg-image" data-image-src="restaurant/menupload/<?php echo $row['item_image'];?>" >
              <?php echo '<center><img class="figure-wrap bg-image"  src="restaurant/menupload/'.$row["item_image"].'" ;/></center>';?>
                                <div class="distance"><i class="fa fa-pin"></i><?php echo $row['cuisines'];?></div>
                                <!-- <div class="rating pull-left"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> </div>
                                 -->
                                 <div class="review pull-right"><a href="item_rating.php?item_id=<?php echo $row["item_id"]; ?>">
                                  <button type="button" class="btn btn-warning">
                                      Rating and Review <span class="badge badge-light"><?php printf('%.1f', $average); ?> <small>/ 5</small></span>
                                      </button>
                                  </a> </div>
                            </div>
                            <div class="content">
                                <h5><a href="#"><?php echo $row["item_name"];?></a></h5>
                                <div class="product-name"><?php echo $row["description"];?></div>
                                <div class="price-btn-block"> <span class="price">GH&cent <?php echo $row["price"];?></span> 

                            <form action="" class="form-submit">

                           <input type="hidden" class="itemid" value="<?= $row['item_id']?>">
                           <input type="hidden" class="itemname" value="<?= $row['item_name']?>">
                           <input type="hidden" class="itemprice" value="<?= $row['price']?>">
                           <input type="hidden" class="itemimage" value="<?= $row['item_image']?>">
                           <input type="hidden" class="itemcode" value="<?= $row['item_code']?>">
                           <input type="hidden" class="restaurantid" value="<?=  $row['restaurant_id'] ?>">
                           <b  class="btn theme-btn-dash pull-right"><button type="submit"  class="btn btn-success pull-right addItemBtn">Add to Cart&nbsp;<i class="fa fa-shopping-cart" style="color:#000"></i></button></b>
                            </form>
                                     </div>
                            </div>
                
                            <div class="restaurant-block">
                                <div class="left">
                                    <a class="pull-left" href="#"> <img src="upload/<?php echo $row["image"];?>" alt="Restaurant logo" onerror="this.src='img/demoUpload.jpg'" width="50px;"/> </a>
                                    <div class="pull-left right-text"> <a href="#"><?php echo $row["restaurantname"];?></a> <span><?php echo $row["address"];?></span> </div>
                                </div>
                
                                
                            </div>
                         
                        </div>
                    </div>
          <?php
}
}
} else{
	
	$sql = "SELECT * FROM item LEFT JOIN restaurants ON restaurants.restaurant_id = item.restaurant_id";
	$result = mysqli_query($con,$sql);
  $rating = new Rating();
	while($row = mysqli_fetch_assoc($result)){
    $average = $rating->getRatingAverage($row["item_id"]);

?>
             <!-- Each popular food item starts -->
                    <div class="col-xs-12 col-sm-6 col-md-4 food-item">
                        <div class="food-item-wrap">
            
                            <div class="figure-wrap bg-image" data-image-src="restaurant/menupload/<?php echo $row['item_image'];?>" >
              <?php echo '<center><img class="figure-wrap bg-image"  src="restaurant/menupload/'.$row["item_image"].'" ;/></center>';?>
                                <div class="distance"><i class="fa fa-pin"></i><?php echo $row['cuisines'];?></div>
                                <!-- <div class="rating pull-left"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> </div>
                                 -->
                                 <div class="review pull-right"><a href="item_rating.php?item_id=<?php echo $row["item_id"]; ?>">
                                  <button type="button" class="btn btn-warning">
                                      Rating and Review <span class="badge badge-light"><?php printf('%.1f', $average); ?> <small>/ 5</small></span>
                                      </button>
                                  </a> </div>
                            </div>
                            <div class="content">
                                <h5><a href="#"><?php echo $row["item_name"];?></a></h5>
                                <div class="product-name"><?php echo $row["description"];?></div>
                                <div class="price-btn-block"> <span class="price">GH&cent <?php echo $row["price"];?></span> 

                            <form action="" class="form-submit">

                           <input type="hidden" class="itemid" value="<?= $row['item_id']?>">
                           <input type="hidden" class="itemname" value="<?= $row['item_name']?>">
                           <input type="hidden" class="itemprice" value="<?= $row['price']?>">
                           <input type="hidden" class="itemimage" value="<?= $row['item_image']?>">
                           <input type="hidden" class="itemcode" value="<?= $row['item_code']?>">
                           <input type="hidden" class="restaurantid" value="<?=  $row['restaurant_id'] ?>">
                           <b  class="btn theme-btn-dash pull-right"><button type="submit"  class="btn btn-success pull-right addItemBtn">Add to Cart&nbsp;<i class="fa fa-shopping-cart" style="color:#000"></i></button></b>
                            </form>
                                     </div>
                            </div>
                
                            <div class="restaurant-block">
                                <div class="left">
                                    <a class="pull-left" href="#"> <img src="upload/<?php echo $row["image"];?>" alt="Restaurant logo" onerror="this.src='img/demoUpload.jpg'" width="50px;"/> </a>
                                    <div class="pull-left right-text"> <a href="#"><?php echo $row["restaurantname"];?></a> <span><?php echo $row["address"];?></span> </div>
                                </div>
                
                                
                            </div>
                         
                        </div>
                    </div>
          <?php
}
}
?>
<?php
         
          ?>
                    <!-- Each popular food item starts -->
                  
                </div>
            </div>
        </section>


  	  <script src="./lib/js/jquery.js" ></script>
    <script src="./lib/js/popper.js" ></script>
	<script src="./js/main.js" ></script>
	 <script src="js/choices.js"></script>
	 <script src="js/wow.min.js"></script>
	 
    <script>
      const choices = new Choices('[data-trigger]',
      {
        searchEnabled: false,
        itemSelectText: '',
      });

    </script>
	<script src="./lib/js/gridjs.js" ></script>
	<script>
	  new WOW().init();
	  </script>
	   <script type="text/javascript"> 
    //menu toggle button
    
	 
	 //scrolling effect
	 $(window).on("scroll",function(){
		 if($(window).scrollTop() >=50 ){
			 $('.navbar').css('background','#000').css('border-bottom','solid 1px #ff3807');
			 
		 }
		 else {
			 $('.navbar').css('background','transparent').css('border-bottom','transparent');
			 
		 }
		 
	 })
	 
   </script>
  </body>
</html>
