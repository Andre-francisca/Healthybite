<?php
session_start();
require "database/db.php";
require "php/random.php";


if(isset($_POST['add'])){
	
    if(isset($_SESSION['cart'])){

   $item_array_id = array_column($_SESSION['cart'], "productid");
           if(in_array($_POST['productid'],$item_array_id)){
               echo "<script>alert('Order already added in the cart..!')</script>";
               echo "<script>window.location='index.php'</script>";
           }
           else{
                $count = count($_SESSION['cart']);
                $item_array = array(
                'productid'=>$_POST['productid']
                 );

                $_SESSION['cart'][$count] = $item_array; 
                
           }
 
}else{ 
   
   $item_array = array(
   'productid'=>$_POST['productid']
   );
   
   //create new session variable
   $_SESSION['cart'][0] = $item_array;
   
   
}
}
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
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="./lib/fontawesome/css/fontawesome.css" >
    
   
    <title>Menu Item Info</title>
	
	<style>
.page-item.active .page-link {
z-index: 1;
color:#fff;
background-color:red!important;
border-color:#000!important;
}
.page-link{
  color:#000!important;
}
	</style>
  </head> 
  <body class="bg-light">
<section id="main" >
<?php require "template/nav.php"    ?>
<div class="container">
<h1>Menu Item Rating</h1>
</div>

</section>

  <!-- Featured restaurants starts -->
        <section class="featured-restaurants" id="res">
            <div class="container">

        <?php 
         
          if(isset($_GET['item_id'])){ 
          $id = $_GET['item_id'];
           $sql = "SELECT * FROM item WHERE item_id = $id";
           $result = mysqli_query($con,$sql);
              while ($row = mysqli_fetch_assoc($result)) {
                    
                    $cuisines = $row['cuisines'];
        ?>
                <div class="row">
                    <div class="col-md-4">
                        <div class="title-block pull-left">
                            <h4>Menu Item: <?php  echo "<button class='btn btn-default btn-outline-warning'><i class='fa fa-tag' style='color:#000'></i>&nbsp".$row['item_name']."</button>";  ?></h4>  
              </div>
              <?php  }}?>  

                          
                    </div>
                    <div class="col-md-8">
                          <!-- farmers filter nav starts -->
                      <div class="farm-filter pull-right">
                          <button class="btn btn-dark btn-outline-warning"> <?php echo $cuisines ?></button>
                          
                        </div>
                        <!-- farmers filter nav ends -->
                    </div>
                </div>
                <!-- farmers listing starts -->
            <div class="col-md-12">
      
      <div class="container">
        <div class="row  py-5">
                <?php
           
            include 'class/Rating.php';
            $rating = new Rating();
            $itemDetails = $rating->getItem($_GET['item_id']);
            foreach($itemDetails as $item){
                $average = $rating->getRatingAverage($item["item_id"]);
            ?>	
            <div class="row mb-2">
                <div class="col-sm-2" style="width:150px">
                    <img class="product_image" src="restaurant/menupload/<?php echo $item["item_image"]; ?>" style="width:100%;height:100%;padding-top:10px;">
                </div>
                <div class="col-sm-4">
                <h4 style="margin-top:10px;"><?php echo $item["item_name"]; ?></h4>
                <div><span class="average"><?php printf('%.1f', $average); ?> <small>/ 5</small></span> <span class="rating-reviews"><a href="item_rating.php?item_id=<?php echo $item["item_id"]; ?>">Rating & Reviews</a></span></div>
                <?php echo $item["description"]; ?>				
                </div>	
                <div>
                
                </div>	
            </div>
        
            
            <?php } ?>	

            <div>
            <div class="price-btn-block"> <span class="price">GHS <?php echo $item["price"];?></span> </div>
            <form action="" class="form-submit">
  
            <input type="hidden" class="itemid" value="<?= $item['item_id']?>">
            <input type="hidden" class="itemname" value="<?= $item['item_name']?>">
            <input type="hidden" class="itemprice" value="<?= $item['price']?>">
            <input type="hidden" class="itemimage" value="<?= $item['item_image']?>">
            <input type="hidden" class="itemcode" value="<?= $item['item_code']?>">
            <input type="hidden" class="restaurantid" value="<?=  $restaurantid ?>">
            <b  class="btn theme-btn-dash pull-right"><button type="submit"  class="btn btn-success pull-right addItemBtn">ADD TO CART&nbsp;<i class="fa fa-shopping-cart" style="color:#fff"></i></button></b>
            </form>
            </div>
            
                
            <?php	
            $itemRating = $rating->getItemRating($_GET['item_id']);	
            $ratingNumber = 0;
            $count = 0;
            $fiveStarRating = 0;
            $fourStarRating = 0;
            $threeStarRating = 0;
            $twoStarRating = 0;
            $oneStarRating = 0;	
            foreach($itemRating as $rate){
                $ratingNumber+= $rate['ratingNumber'];
                $count += 1;
                if($rate['ratingNumber'] == 5) {
                    $fiveStarRating +=1;
                } else if($rate['ratingNumber'] == 4) {
                    $fourStarRating +=1;
                } else if($rate['ratingNumber'] == 3) {
                    $threeStarRating +=1;
                } else if($rate['ratingNumber'] == 2) {
                    $twoStarRating +=1;
                } else if($rate['ratingNumber'] == 1) {
                    $oneStarRating +=1;
                }
            }
            $average = 0;
            if($ratingNumber && $count) {
                $average = $ratingNumber/$count;
            }	
            ?>		
            <br>		
            <div id="ratingDetails"> 		
                <div class="row">			
                    <div class="col-sm-3">				
                        <h4>Rating and Reviews</h4>
                        <h2 class="bold padding-bottom-7"><?php printf('%.1f', $average); ?> <small>/ 5</small></h2>				
                        <?php
                        $averageRating = round($average, 0);
                        for ($i = 1; $i <= 5; $i++) {
                            $ratingClass = "btn-default btn-grey";
                            if($i <= $averageRating) {
                                $ratingClass = "btn-warning";
                            }
                        ?>
                        <button type="button" class="btn btn-sm <?php echo $ratingClass; ?>" aria-label="Left Align">
                        <span class="fa fa-star" aria-hidden="true"></span>
                        </button>	
                        <?php } ?>				
                    </div>
                    <div class="col-sm-3">
                        <?php
                        $fiveStarRatingPercent = round(($fiveStarRating/5)*100);
                        $fiveStarRatingPercent = !empty($fiveStarRatingPercent)?$fiveStarRatingPercent.'%':'0%';	
                        
                        $fourStarRatingPercent = round(($fourStarRating/5)*100);
                        $fourStarRatingPercent = !empty($fourStarRatingPercent)?$fourStarRatingPercent.'%':'0%';
                        
                        $threeStarRatingPercent = round(($threeStarRating/5)*100);
                        $threeStarRatingPercent = !empty($threeStarRatingPercent)?$threeStarRatingPercent.'%':'0%';
                        
                        $twoStarRatingPercent = round(($twoStarRating/5)*100);
                        $twoStarRatingPercent = !empty($twoStarRatingPercent)?$twoStarRatingPercent.'%':'0%';
                        
                        $oneStarRatingPercent = round(($oneStarRating/5)*100);
                        $oneStarRatingPercent = !empty($oneStarRatingPercent)?$oneStarRatingPercent.'%':'0%';
                        
                        ?>
                        <div class="pull-left">
                            <div class="pull-left" style="width:35px; line-height:1;">
                                <div style="height:9px; margin:5px 0;">5 <span class="fa fa-star"></span></div>
                            </div>
                            <div class="pull-left" style="width:180px;">
                                <div class="progress" style="height:9px; margin:8px 0;">
                                <div class="progress-bar bg-success" role="progressbar" aria-valuenow="5" aria-valuemin="0" aria-valuemax="5" style="width: <?php echo $fiveStarRatingPercent; ?>">
                                    <span class="sr-only"><?php echo $fiveStarRatingPercent; ?></span>
                                </div>
                                </div>
                            </div>
                            <div class="pull-right" style="margin-left:10px;"><?php echo $fiveStarRating; ?></div>
                        </div>
                        
                        <div class="pull-left">
                            <div class="pull-left" style="width:35px; line-height:1;">
                                <div style="height:9px; margin:5px 0;">4 <span class="fa fa-star"></span></div>
                            </div>
                            <div class="pull-left" style="width:180px;">
                                <div class="progress" style="height:9px; margin:8px 0;">
                                <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="4" aria-valuemin="0" aria-valuemax="5" style="width: <?php echo $fourStarRatingPercent; ?>">
                                    <span class="sr-only"><?php echo $fourStarRatingPercent; ?></span>
                                </div>
                                </div>
                            </div>
                            <div class="pull-right" style="margin-left:10px;"><?php echo $fourStarRating; ?></div>
                        </div>
                        <div class="pull-left">
                            <div class="pull-left" style="width:35px; line-height:1;">
                                <div style="height:9px; margin:5px 0;">3 <span class="fa fa-star"></span></div>
                            </div>
                            <div class="pull-left" style="width:180px;">
                                <div class="progress" style="height:9px; margin:8px 0;">
                                <div class="progress-bar bg-info" role="progressbar" aria-valuenow="3" aria-valuemin="0" aria-valuemax="5" style="width: <?php echo $threeStarRatingPercent; ?>">
                                    <span class="sr-only"><?php echo $threeStarRatingPercent; ?></span>
                                </div>
                                </div>
                            </div>
                            <div class="pull-right" style="margin-left:10px;"><?php echo $threeStarRating; ?></div>
                        </div>
                        <div class="pull-left">
                            <div class="pull-left" style="width:35px; line-height:1;">
                                <div style="height:9px; margin:5px 0;">2 <span class="fa fa-star"></span></div>
                            </div>
                            <div class="pull-left" style="width:180px;">
                                <div class="progress" style="height:9px; margin:8px 0;">
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="5" style="width: <?php echo $twoStarRatingPercent; ?>">
                                    <span class="sr-only"><?php echo $twoStarRatingPercent; ?></span>
                                </div>
                                </div>
                            </div>
                            <div class="pull-right" style="margin-left:10px;"><?php echo $twoStarRating; ?></div>
                        </div>
                        <div class="pull-left">
                            <div class="pull-left" style="width:35px; line-height:1;">
                                <div style="height:9px; margin:5px 0;">1 <span class="fa fa-star"></span></div>
                            </div>
                            <div class="pull-left" style="width:180px;">
                                <div class="progress" style="height:9px; margin:8px 0;">
                                <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="1" aria-valuemin="0" aria-valuemax="5" style="width: <?php echo $oneStarRatingPercent; ?>">
                                    <span class="sr-only"><?php echo $oneStarRatingPercent; ?></span>
                                </div>
                                </div>
                            </div>
                            <div class="pull-right" style="margin-left:10px;"><?php echo $oneStarRating; ?></div>
                        </div>
                    </div>		
                    <div class="col-sm-3">
                        <button type="button" id="rateProduct" class="btn btn-dark <?php if(!empty($_SESSION['userid']) && $_SESSION['userid']){ echo 'login';} ?>">Rate this menu item</button>
                    </div>		
                </div>
                <div class="row">
                    <div class="col-sm-7">
                        <hr/>
                        <div class="review-block">		
                        <?php
                        $itemRating = $rating->getItemRating($_GET['item_id']);
                        foreach($itemRating as $rating){				
                            $date=date_create($rating['created']);
                            $reviewDate = date_format($date,"M d, Y");						
                            // $profilePic = "profile.png";	
                            // if($rating['avatar']) {
                            //     $profilePic = $rating['avatar'];	
                            // }
                        ?>				
                            <div class="row">
                                <div class="col-sm-3">
                                    <img src="img/demoUpload.jpg" class="img-rounded user-pic">
                                    <div class="review-block-name">By <a href="#"><?php echo $rating['user_name']; ?></a></div>
                                    <div class="review-block-date"><?php echo $reviewDate; ?></div>
                                </div>
                                <div class="col-sm-9">
                                    <div class="review-block-rate">
                                        <?php
                                        for ($i = 1; $i <= 5; $i++) {
                                            $ratingClass = "btn-default btn-secondary";
                                            if($i <= $rating['ratingNumber']) {
                                                $ratingClass = "btn-warning";
                                            }
                                        ?>
                                        <button type="button" class="btn btn-xs <?php echo $ratingClass; ?>" aria-label="Left Align">
                                        <span class="fa fa-star" aria-hidden="true"></span>
                                        </button>								
                                        <?php } ?>
                                    </div>
                                    <div class="review-block-title"><?php echo $rating['title']; ?></div>
                                    <div class="review-block-description"><?php echo $rating['comments']; ?></div>
                                </div>
                            </div>
                            <hr/>					
                        <?php } ?>
                        </div>
                    </div>
                </div>	
            </div>
            <br>
            <div id="ratingSection" style="display:none;">
                <div class="row">
                    <div class="col-sm-12">
                        <form id="ratingForm" method="POST">					
                            <div class="form-group">
                                <h4>Rate this Menu Item</h4>
                                <button type="button" class="btn btn-warning btn-sm rateButton" aria-label="Left Align">
                                <span class="fa fa-star" aria-hidden="true"></span>
                                </button>
                                <button type="button" class="btn btn-default btn-grey btn-sm rateButton" aria-label="Left Align">
                                <span class="fa fa-star" aria-hidden="true"></span>
                                </button>
                                <button type="button" class="btn btn-default btn-grey btn-sm rateButton" aria-label="Left Align">
                                <span class="fa fa-star" aria-hidden="true"></span>
                                </button>
                                <button type="button" class="btn btn-default btn-grey btn-sm rateButton" aria-label="Left Align">
                                <span class="fa fa-star" aria-hidden="true"></span>
                                </button>
                                <button type="button" class="btn btn-default btn-grey btn-sm rateButton" aria-label="Left Align">
                                <span class="fa fa-star" aria-hidden="true"></span>
                                </button>
                                <input type="hidden" class="form-control" id="rating" name="rating" value="1">
                                <input type="hidden" class="form-control" id="itemId" name="itemId" value="<?php echo $_GET['item_id']; ?>">
                                <input type="hidden" name="action" value="saveRating">
                            </div>	
                            	
                            <div class="form-group">
                                <label for="usr">Title*</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>
                            <div class="form-group">
                                <label for="comment">Comment*</label>
                                <textarea class="form-control" rows="5" id="comment" name="comment" required></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success" id="saveReview">Save Review</button> <button type="button" class="btn btn-dark" id="cancelReview">Cancel</button>
                            </div>			
                        </form>
                    </div>
                </div>		
            </div>

            <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content" style="background-color: transparent;border:none">
                    <div class="loginmodal-container">
                            <h1>Login to rate this meal</h1><br>
                            <div style="display:none;" id="loginError" class="alert alert-danger">Invalid username/Password</div>
                            <form method="post" id="loginForm" name="loginForm">
                                <input type="text" name="user" placeholder="Username" required>
                                <input type="password" name="pass" placeholder="Password" required>
                                <input type="hidden" name="action" value="userLogin">
                                <input type="submit" name="login" class="login loginmodal-submit" value="SIGNIN">					 
                            </form>
                            
                        </div>
                 </div>
                   
                </div>
            </div>



        </div>
        </div>
          
        
      </div>

                <!---end of restaurant listing---->         
              
        
               
            </div>
        </section>

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
    
        
  <script src="./lib/js/jquery.js"></script>
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
    <script src="js/rating.js"></script>
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

   <script>
$(document).ready(function(){

$("#placeOrder").submit(function(e){
   e.preventDefault();
   $.ajax({
       url: 'action.php',
       method: 'post',
       data: $('form').serialize()+"&action=order",
       success: function(response){
       	$("#order").html(response);
       }
   });
});


 load_cart_item_number();

 function load_cart_item_number(){
 	$.ajax({
       url: 'action.php',
       method: 'get',
       data: {cartItem:"cart_item"},
       success: function(response){
       	$("#cart-item").html(response);
       }
 	});
 }
});
	
   </script>
 
  </body>
</html>
