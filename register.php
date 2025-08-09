<?php
require "database/db.php";
?>
<?php
$error = false;
if(isset($_POST['reg'])){
  $rname = htmlspecialchars($_POST['rname']);
  //$productimage = htmlspecialchars($_POST['productimage']);
  $address = htmlspecialchars($_POST['address']);
  $services = htmlspecialchars($_POST['services']);
  $email = htmlspecialchars($_POST['email']);
  $password = htmlspecialchars($_POST['password']);
  // Hash the password using password_hash (bcrypt)
 $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
  $regions = htmlspecialchars($_POST['regions']);



    $q = "Select * From restaurants Where email = '$email'";
    $result = mysqli_query($con,$q);
    $num = mysqli_num_rows($result);

    if($num > 0){
                // Email already exists
          $error = true;
                $errorposter =  '<div class="alert alert-warning alert-dismissible " role="alert">
            Email already taken, try another
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';



    }else{


      $uploadedFile = '';
	    if(!empty($_FILES["file"]["type"])){
        $fileName = time().'_'.$_FILES['file']['name'];
        
            $sourcePath = $_FILES['file']['tmp_name'];
            $targetPath = "upload/".$fileName;
            if(move_uploaded_file($sourcePath,$targetPath)){
                $uploadedFile = $fileName;
            }
        
    }
              
                $sql = "INSERT INTO `restaurants`(`restaurant_id`, `image`, `restaurantname`, `email`, `password`, `region`, `cuisines`, `addressrestaurant`) 
				VALUES ('','$uploadedFile','$rname','$email','$hashedPassword','$regions','$services','$address')";
				
				$result = mysqli_query($con,$sql);
                if($result){
                       $error = true;
                            $errorpost =  '<div class="alert alert-success alert-dismissible " role="alert">
                        Restaurant Successfully Registered!.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>';
                            }
                else{
                   $error = true;
                            $errorposter =  '<div class="alert alert-warning alert-dismissible " role="alert">
                        Something went wrong! try again, avoiding using apostrophy
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>';
                }


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
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<link rel="stylesheet" href="css/bootstrap-fileupload.min.css">
	<link rel="stylesheet" href="./lib/fontawesome/css/fontawesome.css" >
    <title>Register Restaurant</title>
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

<section id="register">
<?php require "template/nav.php"  ?>

<div class="container">

<h1>Register your Restaurant</h1>
<p>Reach out to alot of clients across Ghana</p>
<p>Already have an account <a href="./restaurant/"><button class="btn btn-success">SignIn</button></a></p>

                    
        <div class="fm">
				<form   action="" method="POST" enctype="multipart/form-data">
						<div  style="padding:12px;"> 
                  <center><div class="form-group">
                        <label class="control-label col-lg-2">Upload Logo</label>
                        <div class="">
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-new thumbnail form-control" style="width: 200px; height: 150px;"><img src="img/demoUpload.jpg" alt=""  /></div>
                                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                <div>
                                    <span class="btn btn-file btn-warning"> <input type="file" name="file"  accept=".jpeg,.jpg,.png"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file" name="file" accept=".jpeg,.jpg,.png" required/></span></input>
                                    <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload">Remove</a>
                                </div>
                            </div>
                        </div>
                    </div></center>
					<span> <?php if(isset($errorpost)) echo $errorpost;  ?>  </span>
	        <span> <?php if(isset($errorposter)) echo $errorposter;  ?>  </span>
              <div class="form-group">
                <label for="exampleInputPassword1">Name</label>
                <input type="text" class="form-control" id="rname" name="rname" placeholder="Name of restaurant" required>
              </div>
			   <div class="form-group">
                <label for="exampleInputPassword1">Address</label>
                <input type="text" class="form-control" id="address" name="address" placeholder="Enter restaurant address" required>
              </div>
			  <div class="form-group">
                <label for="exampleInputPassword1">Cuisines</label>
                <input type="text" class="form-control" id="services" name="services" required placeholder="African, International, Healthy, Chinese, Indian">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" required>
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" required>
              </div>
              <div class="form-group">
                <label for="">Country</label>
                <select readonly class="crs-country form-control selectpicker" data-style="btn-dark" data-region-id="regions" data-default-value="Ghana" data-whitelist="GH"></select>
        
              </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Region</label>
              <select  name="regions" id="regions" data-default-value="" class="form-control selectpicker" data-style="btn-dark" required></select>
              
        
      
              </div>
			  <center><button type="submit" name="reg" class="btn btn-success btn-block">Register</button></center>
			  </div>
            </form>
                      </div>
                    
                
                <!-- add restaurant ends -->
	 
</div>

</section>

          



    <script src="./lib/js/jquery.js" ></script>
    <script src="js/popper.js" ></script>
	<script src="./lib/js/gridjs.js" ></script>
	<script src="js/bootstrap-select.js" ></script>
	<script src="./js/main.js" ></script>
	<script src="./js/crs.min.js" ></script>
	 <script src="js/choices.js"></script>
	 <script src="js/wow.min.js"></script>
	 <script src="js/bootstrap-fileupload.js"></script>
	 
	 
    <script>
      const choices = new Choices('[data-trigger]',
      {
        searchEnabled: false,
        itemSelectText: '',
      });

    </script>
	
	
	
	<script>
	  new WOW().init();
	  </script>
	   <script type="text/javascript">
    //menu toggle button
    
	 
	 //scrolling effect
	 $(window).on("scroll",function(){
		 if($(window).scrollTop() >=50 ){
			 $('.navbar').css('background','#000').css('border-bottom','solid 1px #f1db88');
			 
		 }
		 else {
			 $('.navbar').css('background','transparent').css('border-bottom','transparent');
			 
		 }
		 
	 })
	 
   </script>
   <script>
    $(document).ready(function(){

        $(".custom-select").each(function(){

            $(this).wrap( "<span class='select-wrapper'></span>" );

            $(this).after("<span class='holder'></span>");

        });

        $(".custom-select").change(function(){

            var selectedOption = $(this).find(":selected").text();

            $(this).next(".holder").text(selectedOption);

        }).trigger('change');
		

    })
   </script>
  </body>
</html>
