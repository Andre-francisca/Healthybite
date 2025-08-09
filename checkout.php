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

  <div class="row ">
    <div class="col-lg-12">
                <div style="display:<?php  if(isset($_SESSION['showAlert2'])) {echo $_SESSION['showAlert2']; } else{ echo "none"; } unset($_SESSION['showAlert2']); ?>" class='alert alert-success hide alert-dismissible fade show mt-3' role='alert'><strong>

                  <?php if(isset($_SESSION['message2'])) {echo $_SESSION['message2']; } unset($_SESSION['showAlert2']); ?>
                    
                  </strong>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
            </button>
          </div>
       <div class="table-responsive mt-5 mb-5">
        <table class="table table-bordered table-striped text-center">
        <thead>
            <tr>
           <td colspan="7">
              <h4 class="text-center text-dark m-0">
              <h4 class="text-center text-dark p-2">Complete your Order! </h4>
              </h4>
           </td>
          </tr>
          <tr>
            <th>s/n</th>
           <th>Image</th>
           <th>Menu</th>
           <th>Price</th>
           <th>Quantity</th>
           <th>Total Price</th>
           <th> 
              <a href="action.php?clear=all" class="badge-dark text-white badge p-1" onclick="return confirm('Are you sure you want to clear your cart?');"><i class="fa fa-trash" style="color:#fff"></i>&nbsp;Clear cart </a>
           </th>
          </tr>
        </thead>
        <tbody>
          <?php
           $c = 0;
             require "database/db.php";
            
             $stmt = $con->prepare("SELECT * FROM cart ");
             $stmt->execute();
             $result = $stmt->get_result();
             $grand_total = 0;
             while($row = $result->fetch_assoc()): 
              $c++;
          ?>
          <tr>
            <td>
              <?php echo "".$c.""; ?>
            </td>
            <form action="checkoutprocess.php" method="post" >
              <input type="hidden" name="sessionuser[]" value="<?= $_SESSION['userid']  ?>"   >
              <input type="hidden" name="cartid[]" class="itemid" value="<?= $row['cart_id']  ?>"   >
            <input type="hidden" name="itemname[]" value="<?= $row['cart_item_name']  ?>"   >
            <input type="hidden" name="restaurantid[]" value="<?= $row['restaurant_id']  ?>"   >

            <td>
            <?php echo '<img src="restaurant/menupload/'.$row["cart_item_image"].'" width="50px" '?>
            </td>
            <td>
              <?= $row['cart_item_name'] ?>
            </td>
            <td>GHS&nbsp;<?= $row['cart_price'] ?></td>
             <input type="hidden" name="itemprice[]" class="itemprice" value="<?= $row['cart_price']  ?>"   >
              <input type="hidden" name="totalprice[]" value="<?= $row['total_price']  ?>"   >

            <td><input type="number" name="qty[]" class="form-control itemQty" value="<?php echo $row['qty'] ?>" style="width:75px"></td>
            <td>GHS&nbsp;<?= $row['total_price'] ?> </td>
            <td>
            <a href="action.php?remove=<?=  $row['cart_id'] ?>" class="text-danger lead" onclick="return confirm('Are you sure you want to remove this item?');"><i class="fa fa-trash" style="color:#dc3545"></i></a>
            </td>
          </tr>
          <?php  $grand_total += $row['total_price']; ?>
          
        <?php endwhile; ?>
        <tr>  
            <td colspan="3"><a href="index.php" class="btn btn-success"><i class="fa fa-shopping-cart" style="color:#fff"></i>&nbsp;Continue Shopping</a>  </td>
            <td colspan="2">
             <b>Grand Total</b>
            </td>
            <td>
             <b>GHS&nbsp;<?= $grand_total ?></b>
            </td>
            
        </tr>
        </tbody>
        </table>
       </div>
    </div>
  </div>

</div>

<div class="container">
 <div class="row justify-content-center">
 	<div class="col-lg-6 px-4 pb-4" id="order">
    <div class="jumbotron p-3 mb-2 text-left">
    
    <h5><b>Total Amount Payable: </b><?= "GHS". number_format($grand_total,2) ?></h5>
    <input type="hidden" name="grandtotal" value='<?=number_format($grand_total,2) ?>'>
    </div>
    
      <div class="form-group">
      <textarea name="shipaddress" class="form-control"  rows="3" cols="10" placeholder="Enter Delivery Address Here..." required></textarea>
     </div>
     <h6 class="text-center lead">Select Payment Mode </h6>
     <div class="form-group">
       <select name="paymode" class="form-control" required>
       	<option value="" selected disabled>-Select Payment Mode-</option>
       	<option value="cod">Cash On Delivery </option>
       	<option value="cards">Debit/Credit Cards</option>
       </select>
      </div>
      <div class="form-group">
        <input type="submit" name="cartorder" value="Place Order" class="btn btn-success btn-block">
      </div>
    </form>
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
