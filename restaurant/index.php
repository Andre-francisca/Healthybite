<?php
require "../database/db.php";
session_start();
if(isset($_SESSION['farmid'])){
	header('location:dashboard.php');
}
?>

<?php
$error = false;
if (isset($_POST['go'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    // Use prepared statement for security
    $stmt = $con->prepare("SELECT * FROM restaurants WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $rows = $result->fetch_assoc();

        // Verify the entered password with the hashed one in the database
        if (password_verify($password, $rows['password'])) {
            // Set session variables
            $_SESSION['restaurantid'] = $rows['restaurant_id'];
            $_SESSION['restaurantname'] = $rows['restaurantname'];
            $_SESSION['email'] = $rows['email'];
            $_SESSION['region'] = $rows['region'];
            $_SESSION['address'] = $rows['addressrestaurant'];

            $error = true;
            $errorgif = "<center><p style='color:red;'>Please wait!!!</p><img src='././img/hour.gif' style='width:30px;'></center>";
            header('refresh:5; url=dashboard.php');
        } else {
            // Wrong password
            $error = true;
            $errorinvalid = '<div class="alert alert-danger alert-dismissible" role="alert">
                Invalid Credential!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';
        }
    } else {
        // Email not found
        echo "<script> alert('Invalid credentials / account does not exist!') </script>";
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
    <link rel="stylesheet" href="../lib/css/grid.css" >
	<link rel="stylesheet" href="../css/custom.css" >
	<link rel="stylesheet" href="../css/main.css">
	<link rel="stylesheet" href="../css/animate.css">
	<link rel="stylesheet" href="../css/bootstrap-select.css">
	<link rel="stylesheet" href="../css/bootstrap-fileupload.min.css">
	<link rel="stylesheet" href="././fontawesome/css/fontawesome.css" >
    <title>Restaurant's Login</title>
	<style>
	.form-control{
		background:transparent;
		color:#fff;
		border:1px solid #d97f3e;
	}
	.form-control:focus{
		box-shadow: none !important;
		background:transparent!important;
		border:1px solid #d97f3e;
		color:#fff;
	}

	</style>
  </head>
  <body>

<section id="register1" >
<div class="container" >

                                     
                        <div class="fm">
						
				<form  action="" method="POST">
						<div  style="padding:12px;"> 
                  <center>
				  <img src="../img/healthybitegh.png" width="100px">
				  <h1>Restaurant Sign In</h1>  
				  <span> <?php if(isset($errorinvalid)) echo $errorinvalid;  ?>   </span>
				  </center>
					<span> <?php if(isset($errorpost)) echo $errorpost;  ?>  </span>
	
              <div class="form-group">
                <label for="exampleInputPassword1">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" required>
              </div>
			  <span> <?php if(isset($errorgif)) echo $errorgif;  ?>   </span>
              <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" required>
              </div>
             
			  <center>
			  <button type="submit" name="go" class="btn btn-success btn-block"> Signin</button>
			  <br>
			  <button  class="btn btn-success btn-block">
			  Don't Have an Account? <a href="http://localhost/healthybite/register.php">SignUp</a></button>
			  </center>
			  </div>
            </form>
                      </div>
                    
                
                <!-- add restaurant ends -->
	 
</div>

</section>




    <script src="../lib/js/jquery.js" ></script>
    <script src="../js/popper.js" ></script>
	<script src="../lib/js/gridjs.js" ></script>
	<script src="../js/bootstrap-select.js" ></script>
	<script src="../js/main.js" ></script>
	 <script src="../js/wow.min.js"></script>
	 
	
	<script>
	  new WOW().init();
	  </script>
	 
  
  </body>
</html>
