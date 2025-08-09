<?php
session_start();
require "database/db.php";
require "database/createdb.php";
require "php/random.php";
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
  <link rel="stylesheet/less" type="text/less" href="css/restaurants.less">
    <!--<link rel="stylesheet" type="text/css" href="css/restaurants.css" />-->
    <script src="js/less.js"></script>
    <title>Restaurants</title>
	
	<style>
.page-item.active .page-link {
z-index: 1;
color:#fff;
background-color:#f1db87!important;
border-color:#000!important;
}
.page-link{
  color:#000!important;
}

.navbar-light .navbar-nav .show > .nav-link, .navbar-light .navbar-nav .active > .nav-link, .navbar-light .navbar-nav .nav-link.show, .navbar-light .navbar-nav .nav-link.active {
  color: #ffc107;
}
	</style>
  </head>
  <body class="bg-light">
<section id="main" >
<?php require "template/nav.php"    ?>
<div class="container">
<h1>Restaurants</h1>
</div>

</section>

  <!-- Featured farmers starts -->
        <section class="featured-restaurants" id="res">
            <div class="container">
      
                <div class="row">
                    <div class="col-md-4">
                        <div class="title-block pull-left">
                            <h4>Featured Restaurants</h4> 
              </div>
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
                <!-- Farmers listing starts -->
            <div class="col-md-12">
        <?php
        /*How many records you want to show in a single page.*/
        $limit = 4;
        /*How may adjacent page links should be shown on each side of the current page link.*/
        $adjacents = 2;
        /*Get total number of records */
        $sql = "SELECT COUNT(*) 'total_rows' FROM restaurants";
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
                  
          
          ?>
          <div class="container">
        <div class="row text-center py-5">
        
        <?php 
             $sql="SELECT * FROM restaurants limit $offset, $limit";
             $result1 = mysqli_query($con,$sql);
            while ($row = mysqli_fetch_assoc($result1)) {
              $res = $row['restaurant_id'];
             ?> 
        <div class="col-md-3 col-sm-6 my-3 " >
        <div class="card shadow" style = "color:#000;background:#eeeeee; border-radius:7px; margin-top:18px;height:100%;">
        <div>
        <?php echo '<img onerror="this.src=`img/demoUpload.jpg`" class="figure-wrap bg-image" src ="upload/'.$row["image"].'" class="card-img-top" width="100px" height="100px";/>';?>
         
        </div>
        <div class="card-body">
        <span class="badge badge-success" ><?php echo "<i style='font-size:16px'>".$row['restaurantname']."</i>" ?></span>
        
        <hr>
        <h5 class="card-title"><?php echo "".$row['cuisines']."" ?></h5>
        <h6>
          <i class="fa fa-star"></i>
           <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
           <i class="fa fa-star"></i>
        </h6>
        <a href='meals.php?far=<?php echo  $res   ?>'><button class="btn btn-default btn-outline-warning">
        <svg fill="#000000" width="20px" height="20px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M20.276,2.553,22,6H2L3.724,2.553A1,1,0,0,1,4.618,2H19.382A1,1,0,0,1,20.276,2.553ZM2,8H22V21a1,1,0,0,1-1,1H3a1,1,0,0,1-1-1ZM5,18a1,1,0,0,0,1,1h4a1,1,0,0,0,0-2H6A1,1,0,0,0,5,18Z"/></svg>
            &nbsp;View Meal(s)</button></a><br><br>
		<a href='restaurantdetails.php?far=<?php echo  $res   ?>'><button class="btn btn-warning book_data" id="<?php echo $res; ?>">Learn More </button></a>

        </div>
        </div>
        </div>
        

       
        <!-- /.modal -->
        <?php
                }
        ?>
        </div>

        </div>
		          			  <!-- /.modal -->
<div class="modal fade" id="resModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
			 <i class="badge badge-danger" id="rname"></i>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>   
            </div>
			
            <div class="modal-body" style="background:#ececec">
				<center><img src="" id="image" width="100px"></img></center>
				<form id="insert_form"  method="POST">
				<div id="loader"></div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Name</label>
      <input type="text" class="form-control" id="name" name="name" required>
	  <input type="hidden" class="form-control" id="resid" name="resid">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Phone Number</label>
      <input type="text" class="form-control" id="phone" name="phone" required>
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Date</label>
      <input type="date" class="form-control" id="date" name="date" required>
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Email</label>
      <input type="email" class="form-control" id="email" name="email" required>
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Number of Guests</label>
      <input type="number" class="form-control" id="nog" name="nog" required>
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Time</label>
      <input type="text" class="form-control" id="time" name="time" required>
    </div>
  </div>
  <div class="form-group">
    <label for="inputAddress2">Note</label>
	<textarea class="form-control" id="note" name="note" required></textarea>
  </div>
  <button type="submit" class="btn btn-dark">Book Table</button>
</form>
            </div>
        </div>
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
              <a class='page-link' href='?page=<?php ($page>1 ? print($page-1) : print 1)?>'>PREVIOUS</a>
            </li>
            <!-- Links of the pages with page number -->
            <?php for($i=$start; $i<=$end; $i++) { ?>
            <li class='page-item <?php ($i == $page ? print 'active' : '')?>'>
              <a class='page-link' href='?page=<?php echo $i;?>'><?php echo $i;?></a>
            </li>
            <?php } ?>
            <!-- Link of the next page -->
            <li class='page-item <?php ($page >= $total_pages ? print 'disabled' : '')?>'>
              <a class='page-link' href='?page=<?php ($page < $total_pages ? print($page+1) : print $total_pages)?>'>NEXT</a>
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

        <?php

        require "./template/footer.php";
        ?>
    

	<script src="./lib/js/jquery.js"></script>
	<script src="./lib/js/popper.js" ></script>
	<script src="./js/main.js" ></script>
	<script src="js/choices.js"></script>
	<script src="js/wow.min.js"></script>
	<script src="js/resbooking.js"></script>
	 
    <script>
   $("#farm").addClass('active');
    </script>
	<script src="./lib/js/gridjs.js" ></script>
	<script>
	  new WOW().init();
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
