<?php
session_start();
require "database/db.php";
require "php/random.php";
?>
<?php

$error = false;
//query for user login
if (isset($_POST['login'])) {
    $email = strip_tags($_POST['email']);
    $password = strip_tags($_POST['password']);

    // Use prepared statements to prevent SQL injection
    $stmt = $con->prepare("SELECT * FROM users WHERE user_email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $rows = $result->fetch_assoc();
        
        // Verify the password against the hashed one in the database
        if (password_verify($password, $rows['user_password'])) {
            // Set session variables
            $_SESSION['userid'] = $rows['users_id'];
            $_SESSION['username'] = $rows['user_name'];
            $_SESSION['email'] = $rows['user_email'];
            $_SESSION['userphone'] = $rows['user_phone'];

            $error = true;
            $errorlogin = "<center><p style='color:red;'>Please wait!!!</p><img src='img/hour.gif' style='width:70px;background:#fff;'></center>";
            header('refresh:5; url=checkout.php');
        } else {
            $error = true;
            $errorlogin = "<center><p style='color:red;'>Invalid credentials!!!</p></center>";
        }
    } else {
        $error = true;
        $errorlogin = "<center><p style='color:red;'>Invalid credentials!!!</p></center>";
    }
}
?>
<?php 
//query for user registration
$error = false;


if (isset($_POST['create'])) {
            // Collect form data
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $healthcondition = $_POST['healthcondition'];
            $password = $_POST['password'];

            // Hash the password using password_hash (bcrypt)
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Check if email already exists
            $checkStmt = $con->prepare("SELECT * FROM users WHERE user_email = ?");
            $checkStmt->bind_param("s", $email);
            $checkStmt->execute();
            $checkStmt->store_result();

            if ($checkStmt->num_rows > 0) {
                $error = true;
                $errorcustomer = "<center><p style='color:red;'>Email already exists. Please use another email.</p></center>";
            } else {
                // Email does not exist, proceed to insert
                $stmt = $con->prepare("INSERT INTO users(user_name, user_email, user_password, user_phone, healthcondition) VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param("sssss", $name, $email, $hashedPassword, $phone, $healthcondition);

                if ($stmt->execute()) {
                    $error = true;
                    $errorcustomer = "<center><p style='color:green;'>User registered successfully. Please login!</p></center>";
                    // Optionally redirect
                    // header('refresh:5; url=checkout2.php');
                } else {
                    $error = true;
                    $errorcustomer = "<center><p style='color:red;'>Error while registering user. Please try again.</p></center>";
                }

                $stmt->close();
            }

            $checkStmt->close();
        }


?>
<?php
if((isset($_SESSION['userid']))){

  header("location:checkout.php");

}
else{

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
    <title>HealthyBiteGH - Check out</title>
	
	<style>
.page-item.active .page-link {
z-index: 1;
color:#fff;
background-color:red!important;
border-color:#000!important;
}
.btn-outline-secondary{
    color: #6c757d !important;
border-color:#ced4da !important;
background:#343a40 !important;
}
	</style>
  </head>
  <body class="bg-light">
<section id="main" >
<?php require "template/nav.php"    ?>
<div class="container">
<h1>Check Out</h1>
</div>\

</section>
<div class="container">
  <div class="row mt-5">
  	  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title text-danger">Already Registered please Login to process your order</h5>
        <form action="" method="POST">
		
    <span class="text-danger"> <?php if(isset($errorlogin)) echo $errorlogin;  ?> </span>
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control" name="email" id="" aria-describedby="emailHelp" placeholder="Enter email" required>
    
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" name="password" id="password"  placeholder="Password">
  </div>
  <button type="submit" class="btn btn-dark btn-block" name="login">Login</button>
</form>
        
      </div>
    </div>
  </div>
  <!--end here-->
    <div class="col-lg-6 ">
        	<div class="card mb-5">
      <div class="card-body">
   <h4 class="text-center text-danger p-2">Create Account </h4>
   <span class="text-danger"> <?php if(isset($errorcustomer)) echo $errorcustomer;  ?> </span>
    <form action="" method="post" >
     <input type="hidden" name="menus" value="<?= $allItems; ?>">
     <input type="hidden" name="grand_total" value="<?= $grand_total; ?>">
     <div class="form-group">
      <input type="text" name="name" class="form-control" placeholder="Enter Name" required>
     </div>
      <div class="form-group">
      <input type="email" name="email" class="form-control" placeholder="Enter E-Mail" required>
     </div>
      <div class="form-group">
      <input type="tel" name="phone" class="form-control" placeholder="Enter Phone" required>
     </div>
      <div class="form-group">
        <label>Health Condition</label>
        <select class="form-control mb-4" name="healthcondition" id="healthcondition" required>
            <option value="" disabled selected>****SELECT****</option>
            <option value="ulcer">Ulcer</option>
            <option value="diabetes">Diabetes</option>
            <option value="hypertension">Hypertension</option>
        </select>
     </div>
       <div class="form-group">
      <input type="password" name="password" class="form-control" placeholder="Enter Password" required>
     </div>
     <div class="form-group">
      <input type="hidden" name="ordercode" class="form-control" placeholder="Enter Phone" value="<?= $random  ?>" >
     </div>
     <!--
      <div class="form-group">
      <textarea name="address" class="form-control"  rows="3" cols="10" placeholder="Enter Delivery Address Here..."></textarea>
     </div>-->
      <div class="form-group">
        <input type="submit" name="create" value="Create Account" class="btn btn-dark btn-block">
      </div>
    </form>
 	
    </div>
  </div>
</div>
</div>
</div>

<?php

require "./template/footer.php";
?>
    

  	  <script src="./lib/js/jquery.js" ></script>
    <script src="./lib/js/popper.js" ></script>
	
	 <script src="js/choices.js"></script>
	 <script src="js/wow.min.js"></script>
    <script src="js/bootstrap-show-password.js"></script>
   
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
<script type="text/javascript">

  $("#password").password('toggle');

</script>
  </body>
</html>
<?php
}
?>