<?php
session_start();
require "database/db.php";
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
    <title>Check out</title>
	
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
<h1>Check Out</h1>
</div>

</section>

<div class="container">
 <div class="row justify-content-center">
  <?php
       if(isset($_POST['cartorder'])){
       $t = uniqid('HBGH');
       $date = date("y-m-d h:m:s");
       $itemname = $_POST['itemname'];
       $itemprice = $_POST['itemprice'];
       $qty = $_POST['qty']; 
       $restaurantid = $_POST['restaurantid'];
       $totalprice =$_POST['totalprice'];
         $grandtotal = $_POST['grandtotal'];
       $ship = $_POST['shipaddress'];
       $ship = strip_tags($ship);
      $paymode = $_POST['paymode'];
      $paymode = strip_tags($paymode);
       $user = $_POST['sessionuser'];
       $count = count($_POST['cartid']);
       ?>
       <div class="text-center">
       <h1 class="display-4 mt-2 text-danger">Thank You! </h1>
       <h2 class="text-success">Your order request has been sent successfully! </h2>
       <h5><span class="hidden-xs badge" style="background:#f39c12!important;">ORDERID </span>&nbsp;<?php echo $t; ?></h5>
     </div>
       <table class="table table-bordered table-striped text-center">
        <thead>
          
          <tr>
           <th>item</th>
           <th>Quantity</th>
           <th>Price (GHS)</th>
           </tr>
        </thead>
        <tbody>
           <?php

       for($i=0; $i<$count; $i++){
        $sql = "INSERT INTO orders(order_item_name,order_item_price,order_qty,restaurant_id,total_price,users_id,address,order_date,pmode,ordercode) VALUES 
       ('";$sql .=$itemname[$i]."','";$sql .=$itemprice[$i]."','";$sql .=$qty[$i]."','";$sql .=$restaurantid[$i]."','";$sql .=$totalprice[$i]."','";$sql .=$user[$i]."','";$sql .=$ship."','";$sql .=$date."','";$sql .=$paymode."','";$sql .=$t."')";
       $result = mysqli_query($con,$sql);
       if($result){
        $stmt = $con->prepare("DELETE FROM cart");
        $stmt->execute();
        ?>
         
         <tr>
            <td>
              <?php echo "".$itemname[$i].""; ?>
            </td>
            <td>
              <?php echo "".$qty[$i].""; ?>
            </td>
            <td>
              <?php echo "".$totalprice[$i].""; ?>
            </td>
          </tr>
          <?php

         }
       }
   ?>
       </tbody>
        </table>
        <div class="col-lg-6 px-4 pb-4" id="order">
    <div class="jumbotron p-3 mb-2 text-left ">
      <h4><b>Your Name:</b> <?php  echo "".$_SESSION['username']."" ?> </h4>
      <h4><b>Your Email:</b> <?php echo $_SESSION['email'] ?> </h4>
      <h4><b>Your Phone:</b>  <?php echo $_SESSION['userphone'] ?>  </h4>
    <h5><b>Total Amount Paid: </b><?= "GHS".$grandtotal."" ?></h5>
    <h5><b>Payment Mode: </b><?= "".$paymode."" ?></h5>
    </div>
    
       <button onclick="myFunction()" class="btn btn-secondary">print invoice</button> 
                <script>
                function myFunction(){
                   window.print();
                 }
                 </script>
      </div>
        <?php  
       }
?>

 	
    
 	</div>

 </div>
</div>

<?php

require "./template/footer.php";
?>

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
