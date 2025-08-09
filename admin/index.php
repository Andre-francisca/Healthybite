<?php
require "../database/db.php";
session_start();
if(isset($_SESSION['resid'])){
	header('location:dashboard.php');
}
?>

<?php
$error = false;
if (isset($_POST['go'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    // Check if admin with the given email exists
    $sql = "SELECT * FROM admin WHERE email = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $row['password'])) {
            $_SESSION['admin'] = $row['admin_id'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['email'] = $row['email'];

            $error = true;
            $errorgif = "<center><p style='color:red;'>Please wait!!!</p><img src='./img/hour.gif' style='width:30px;'></center>";
            header('refresh:5; url=dashboard.php');
            
        } else {
            // Password does not match
            $error = true;
            $errorinvalid = '<div class="alert alert-danger alert-dismissible" role="alert">
                Invalid Credential!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';
        }
    } else {
        // No admin found with that email
        $error = true;
        $errorinvalid = '<div class="alert alert-danger alert-dismissible" role="alert">
            Email not found!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>';
    }

    $stmt->close();
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
    <title>Admin Login restaurant</title>
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

<section id="register" >
<div class="container" >

                                     
                        <div class="fm">
						
				<form  action="" method="POST">
						<div  style="padding:12px;"> 
                  <center>
				  <img src="../img/healthybitegh.png" width="100px">
				  <h1>Admin Login</h1>  
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
			  <button type="submit" name="go" class="btn btn-danger btn-block">Signin</button>
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
