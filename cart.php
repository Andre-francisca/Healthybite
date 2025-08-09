<?php
session_start();
require "database/createdb.php";
//require "php/function.php";


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
.navbar-light .navbar-nav .show > .nav-link, .navbar-light .navbar-nav .active > .nav-link, .navbar-light .navbar-nav .nav-link.show, .navbar-light .navbar-nav .nav-link.active {
  color: #ffc107;
    }  
	</style>
  </head>
  <body class="bg-light">
<section id="main" >
<?php require "template/nav.php"    ?>
<div class="container">
<h1>Shopping Cart</h1>
</div>

</section>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-lg-10">
                <div style="display:<?php  if(isset($_SESSION['showAlert'])) {echo $_SESSION['showAlert']; } else{ echo "none"; } unset($_SESSION['showAlert']); ?>" class='alert alert-success hide alert-dismissible fade show mt-3' role='alert'><strong>

                  <?php if(isset($_SESSION['message'])) {echo $_SESSION['message']; } unset($_SESSION['showAlert']); ?>
                    
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
              item(s) in your cart!
              </h4>
           </td>
          </tr>
          <tr>
            <th>s/n</th>
           <th>Image</th>
           <th>Menu Item</th>
           <th>Price</th>
           <th>Quantity</th>
           <th>Total Price</th>
           <th> 
              <a href="action.php?clear=all" class="badge-danger badge p-1" onclick="return confirm('Are you sure you want to your cart?');"><i class="fa fa-trash" style="color:#fff"></i>&nbsp;Clear cart </a>
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
            <input type="hidden" class="itemid" value="<?= $row['cart_id']  ?>"   >
            <input type="hidden" class="restaurantid" value="<?= $row['restaurant_id']  ?>"   >
            <td>
            <?php echo '<img src="restaurant/menupload/'.$row["cart_item_image"].'" width="50px" '?>
            </td>
            <td>
              <?= $row['cart_item_name'] ?>
            </td>
            <td>GHS&nbsp;<?= $row['cart_price'] ?></td>
             <input type="hidden" class="itemprice" value="<?= $row['cart_price']  ?>"   >

            <td><input type="number" class="form-control itemQty" value="<?php echo $row['qty'] ?>" style="width:75px"></td>
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
            <td>
              <a href="account.php" class="btn btn-warning <?= ($grand_total>1)?"":"disabled";  ?>" style="color:#fff"><i class="fa fa-credit-card" style="color:#000"></i>&nbsp;Checkout</a>
            </td>
        </tr>
        </tbody>
        </table>
       </div>
    </div>
  </div>

</div>

<?php

require "./template/footer.php";
?>
    

  	  <script src="./lib/js/jquery.js" ></script>
      <script src="./lib/js/gridjs.js" ></script>
    <script src="./lib/js/popper.js" ></script>
	<script src="./js/main.js" ></script>
	   <script type="text/javascript">
    //menu toggle button
    
    $("#cart").addClass('active');
	 

   </script>
  </body>
</html>
