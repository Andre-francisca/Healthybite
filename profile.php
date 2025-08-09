<?php
session_start();
require "database/db.php";
require "php/core.php";
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
    <title>User Profile</title>
	
	<style>
.page-item.active .page-link {
z-index: 1;
color:#fff;
background-color:red!important;
border-color:#000!important;
}
	</style>
  </head>
  <body >
<section id="main" >
<?php require "template/nav.php"    ?>
<div class="container">
<h1>Client Profile</h1>
</div>

</section>

<div class="prof"></div>
<div class="container profinner">
 <div class="row justify-content-center mt-2">
 	<div class="col-lg-6 px-4 pb-4" id="order">
    <div class="jumbotron p-3 mb-2 text-left" style="background:#f1db88">
     <img class="mx-auto d-block" src="img/icon2.png">  
    <h5></h5>
    <input type="hidden" name="grandtotal" value=''>
    </div>
    <h4><b>Name:</b> <?php  echo "".$_SESSION['username']."" ?> </h4>
      <h4><b>Email:</b> <?php echo $_SESSION['email'] ?> </h4>
      <h4><b>Phone:</b>  <?php echo $_SESSION['userphone'] ?>  </h4>
     
    
      <div class="form-group">
        <input type="button" name="cartorder" value="Edit" class="btn btn-dark btn-block" data-toggle="modal" data-target="#userprofile">
      </div>
    </form>
 	</div>

 </div>
</div>

                      <!-- Modal -->
                    <div class="modal fade" id="userprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-edit"></i>&nbsp;Edit Profile</h5>

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
						      <h4 style="color:orange;text-transform:uppercase;border:#000 solid;background:#000" align="center"> <?php  echo "".$_SESSION['username']."" ?> </h4>
                           <form class="form-horizontal" id="profilet"  action="" method="POST">
                            <div class="loader"></div>
                          <div class="modal-body">
                            <div id="messages"></div>
                          <div class="form-row">
                            <div class="form-group col-md-6">
                            <label for="inputEmail4"> Full Name</label>
                            <input type="text" class="form-control" id="fname" name="fname" value="<?php  echo "".$_SESSION['username']."" ?> " >
                          </div>
                          <div class="form-group col-md-6">
                            <label for="inputEmail4">Email</label>
                            <input type="text" class="form-control" id="email" name="email" value="<?php echo $_SESSION['email'] ?>">
                          </div>
                          <div class="form-group col-md-6">
                            <label for="inputPassword4">Phone Number</label>
                            <input type="text" class="form-control" name="phone" id="phone" value="<?php echo $_SESSION['userphone'] ?>">
                          </div>
                          <div class="form-group col-md-6">
                            <label for="inputPassword4">Password</label>
                            <input type="text" class="form-control" name="password" id="password" placeholder="" required>
							<input type="hidden" class="form-control" name="pid" id="pid" value="<?php echo $_SESSION['userid'] ?>" required>
                          </div>
                        </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" id="loading" class="btn btn-dark">Save</button>
                          </div>
                        </form>
                        </div>
                      </div>
                    </div>
    

  <script src="./lib/js/jquery.js"></script>
  <script src="./lib/js/popper.js" ></script>
	<script src="./js/main.js" ></script>
	<script src="js/choices.js"></script>
	<script src="js/profile.js"></script>
	<script src="js/jvalidate.js"></script>
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
