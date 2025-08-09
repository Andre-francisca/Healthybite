<?php
session_start();
require "database/db.php";
require "php/random.php";
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
 
    <title>Restaurant Menu Items</title>
	
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
<h1>Restaurant's Menu Item</h1>
</div>

</section>

  <!-- Featured restaurants starts -->
        <section class="featured-restaurants" id="res">
            <div class="container">
        <?php 
         
          if(isset($_GET['far'])){
          $id = $_GET['far'];
           $sql = "SELECT * FROM restaurants WHERE restaurant_id = $id";
           $result = mysqli_query($con,$sql);
              while ( $row = mysqli_fetch_assoc($result)) {

        
        ?>
                <div class="row">
                    <div class="col-md-4">
                        <div class="title-block pull-left">
                            <h4>Restaurant: <?php  echo "<button class='btn btn-default btn-outline-warning'><i class='fa fa-tag' style='color:#000'></i>&nbsp".$row['restaurantname']."</button>";  ?></h4>  
              </div>
              <?php  }}?>  
                    </div>
                    <div class="col-md-8">
                          <!-- farmers filter nav starts -->
                      <div class="farm-filter pull-right">
                          <button class="btn btn-dark btn-outline-warning"> African</button>
                          <button class="btn btn-dark btn-outline-warning"> International </button>
                          <button class="btn btn-dark btn-outline-warning"> India</button>
                          <button class="btn btn-dark btn-outline-warning"> Chinese</button>
                          <button class="btn btn-dark btn-outline-warning"> Ethiopia</button>
                        </div>
                        <!-- farmers filter nav ends -->
                    </div>
                </div>
                <!-- farmers listing starts -->
            <div class="col-md-12">
        <?php
        if(isset($_GET['far'])){
          $id = $_GET['far'];
        /*How many records you want to show in a single page.*/
        $limit = 100;
        /*How may adjacent page links should be shown on each side of the current page link.*/
        $adjacents = 2;
        /*Get total number of records */
        $sql = "SELECT COUNT(*) 'total_rows' FROM item WHERE restaurant_id = '$id'";
        $res = mysqli_fetch_object(mysqli_query($con, $sql));
        $total_rows = $res->total_rows;
        /*Get the total number of pages.*/
        $total_pages = ceil($total_rows / $limit);
        
        
        if(isset($_GET['page']) && $_GET['page'] != "") {
          $page = $_GET['page'];
          $offset = $limit * ($page-1);
        } else {
          $page = 1;
          $offset = 0;
        }
                  
          }
          ?>
          <div class="container">
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
        <div class="row  py-5">
        
        <?php 
        if(isset($_GET['far'])){
         $id = $_GET['far'];
                                   $sql="SELECT * FROM item  WHERE restaurant_id = '$id' limit $offset, $limit  ";

                                   $result=mysqli_query($con,$sql);
                                   $rating = new Rating();
                                while ( $row = mysqli_fetch_assoc($result)) {
                                    $restaurantid = $row['restaurant_id'];
                                    $average = $rating->getRatingAverage($row["item_id"]);
                                   ?> 
        <div class="col-xs-12 col-sm-6 col-md-4 food-item">
                        <div class="food-item-wrap">
            
                            <div class="figure-wrap bg-image" data-image-src="restaurant/menupload/<?php echo $row['item_image'];?>" >
              <?php echo '<center><img class="figure-wrap bg-image"  src="restaurant/menupload/'.$row["item_image"].'" ; width="350px" height="453px"/></center>';?>
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
                                <div class="item-name"><?php echo $row["description"];?></div>
                                <div class="price-btn-block"> <span class="price">GHS <?php echo $row["price"];?></span> 

                            <form action="" class="form-submit">
                            <input type="hidden" class="itemid" value="<?= $row['item_id']?>">
                           <input type="hidden" class="itemname" value="<?= $row['item_name']?>">
                           <input type="hidden" class="itemprice" value="<?= $row['price']?>">
                           <input type="hidden" class="itemimage" value="<?= $row['item_image']?>">
                           <input type="hidden" class="itemcode" value="<?= $row['item_code']?>">
                           <input type="hidden" class="restaurantid" value="<?=  $restaurantid ?>">
                           <b  class="btn theme-btn-dash pull-right"><button type="submit"  class="btn btn-success pull-right addItemBtn">ADD TO CART&nbsp;<i class="fa fa-shopping-cart" style="color:#fff"></i></button></b>
                            </form>
                                     </div>
                            </div>
                
                          
                         
                        </div>
                    </div>
        <br><br><br>
        <?php
                }
              }
        ?>
        </div>
        </div>
          
          
          
          
          <?php

        //Checking if the adjacent plus current page number is less than the total page number.
        //If small then page link start showing from page 1 to upto last page.
        if($total_pages <= (1+($adjacents * 2))) {
          $start = 1;
          $end   = $total_pages;
        } else {
          if(($page - $adjacents) > 1) {           //Checking if the current page minus adjacent is greateer than one.
            if(($page + $adjacents) < $total_pages) {  //Checking if current page plus adjacents is less than total pages.
              $start = ($page - $adjacents);         //If true, then we will substract and add adjacent from and to the current page number  
              $end   = ($page + $adjacents);         //to get the range of the page numbers which will be display in the pagination.
            } else {                   //If current page plus adjacents is greater than total pages.
              $start = ($total_pages - (1+($adjacents*2)));  //then the page range will start from total pages minus 1+($adjacents*2)
              $end   = $total_pages;               //and the end will be the last page number that is total pages number.
            }
          } else {                     //If the current page minus adjacent is less than one.
            $start = 1;                                //then start will be start from page number 1
            $end   = (1+($adjacents * 2));             //and end will be the (1+($adjacents * 2)).
          }
        }
        //If you want to display all page links in the pagination then
        //uncomment the following two lines
        //and comment out the whole if condition just above it.
        /*$start = 1;
        $end = $total_pages;*/
        ?>
        
        <?php if($total_pages > 1) { ?>
          <ul class="pagination pagination-sm justify-content-center">
            <!-- Link of the first page -->
            <li class='page-item <?php ($page <= 1 ? print 'disabled' : '')?>'>
              <a class='page-link' href='?page=1'>&lt;&lt;</a>
            </li>
            <!-- Link of the previous page -->
            <li class='page-item <?php ($page <= 1 ? print 'disabled' : '')?>'>
              <a class='page-link' href='?page=<?php ($page>1 ? print($page-1) : print 1)?>'>&lt;</a>
            </li>
            <!-- Links of the pages with page number -->
            <?php for($i=$start; $i<=$end; $i++) { ?>
            <li class='page-item <?php ($i == $page ? print 'active' : '')?>'>
              <a class='page-link' href='?page=<?php echo $i;?>'><?php echo $i;?></a>
            </li>
            <?php } ?>
            <!-- Link of the next page -->
            <li class='page-item <?php ($page >= $total_pages ? print 'disabled' : '')?>'>
              <a class='page-link' href='?page=<?php ($page < $total_pages ? print($page+1) : print $total_pages)?>'>&gt;</a>
            </li>
            <!-- Link of the last page -->
            <li class='page-item <?php ($page >= $total_pages ? print 'disabled' : '')?>'>
              <a class='page-link' href='?page=<?php echo $total_pages;?>'>&gt;&gt;</a>
            </li>
          </ul>
        <?php } ?>
        <?php mysqli_close($con); ?>
      </div>

                <!---end of restaurant listing---->         
              
        
               
            </div>
        </section>


    

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
