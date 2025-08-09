<?php
require "././template/header.php";
require "././php/random.php";
?>
<?php

$sql = "SELECT * FROM restaurants WHERE restaurant_id = '{$_SESSION['restaurantid']}'";
$result = mysqli_query($con,$sql);
   if($result){
     $row = mysqli_fetch_assoc($result);
     $rname = $row['restaurantname'];
     $address = $row['addressrestaurant'];
     $services = $row['cuisines'];
     $region = $row['region'];
     $email = $row['email'];
     $image = $row['image'];
   }
?>
<?php
$error = false;
if(isset($_POST['save'])){
        $uploadedFile = '';
      if(!empty($_FILES["file"]["type"])){
        $fileName = time().'_'.$_FILES['file']['name'];
        
            $sourcePath = $_FILES['file']['tmp_name'];
            $targetPath = "../upload/".$fileName;
            if(move_uploaded_file($sourcePath,$targetPath)){
                $uploadedFile = $fileName;
            }
        
    } 
                $rname = htmlspecialchars($_POST['rname']);
                //$productimage = htmlspecialchars($_POST['productimage']);
                $address = htmlspecialchars($_POST['address']);
                $services = htmlspecialchars($_POST['services']);
                $email = htmlspecialchars($_POST['email']);
                $password = htmlspecialchars($_POST['password']);
       
        // Hash the password using password_hash (bcrypt)
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $regions = htmlspecialchars($_POST['regions']);
                $sql = "UPDATE `restaurants` SET `image`='$uploadedFile',`restaurantname`='$rname',`email`='$email',`password`='$hashedPassword',`region`='$regions',`cuisines`='$services',`addressrestaurant`='$address' WHERE restaurant_id = '{$_SESSION['restaurantid']}'";
        
        $result = mysqli_query($con,$sql);
                if($result){
                       $error = true;
                            $errorpost =  '<div class="alert alert-success alert-dismissible " role="alert">
                        Profile successfully updated!.
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
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Menu</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">

        <div class="row">
          <div class="col-lg-12">
            <div class="card card-warning card-outline">
              <div class="card-body">
                <h5 class="card-title"><i class="fa fa-edit"></i>&nbsp;EDIT FARMER'S PROFILE</h5>
        <hr>
                  <form   action="" method="POST" enctype="multipart/form-data">
              <div  style="padding:12px;"> 
                  <center><div class="form-group">
                        <label class="control-label col-lg-2">Upload Logo</label>
                        <div class="">
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-new thumbnail form-control" style="width: 200px; height: 150px;"><img src="img/demoUpload.jpg" alt=""  /></div>
                                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                <div>
                                    <span class="btn btn-file btn-warning"> <input type="file" name="file"  accept=".jpeg,.jpg,.png"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file" name="file" accept=".jpeg,.jpg,.png"/></span></input>
                                    <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload">Remove</a>
                                </div>
                            </div>
                        </div>
                    </div></center>
          <span> <?php if(isset($errorpost)) echo $errorpost;  ?>  </span>
          <span> <?php if(isset($errorposter)) echo $errorposter;  ?>  </span>
          <div class="form-row" style="padding:12px;">
              <div class="form-group col-md-6 mb-3">
                <label for="exampleInputPassword1">Name</label>
                <input type="text" class="form-control" id="rname" value="<?php echo  $rname  ?>" name="rname" placeholder="Name of Restaurant" required>
              </div>
         <div class="form-group col-md-6 mb-3">
                <label for="exampleInputPassword1">Address</label>
                <input type="text" class="form-control" id="address" value="<?php echo $address  ?>" name="address" placeholder="Enter Restaurant address" required>
              </div>
        <div class="form-group col-md-6 mb-3">
                <label for="exampleInputPassword1">Cuisines</label>
                <input type="text" class="form-control" id="services" value="<?php echo $services  ?>" name="services" required placeholder="Example Burgers, American, Sandwiches, Fast Food, BBQ">
              </div>
              <div class="form-group col-md-6 mb-3">
                <label for="exampleInputPassword1">Email</label>
                <input type="email" class="form-control" id="email" value="<?php echo $email  ?>" name="email" placeholder="Enter Email" required>
              </div>
              <div class="form-group col-md-6 mb-3">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" required>
              </div>
              <div class="form-group col-md-6 mb-3">
                <label for="">Country</label>
                <select class="crs-country form-control selectpicker" data-style="btn-dark" data-region-id="regions" data-default-value="Ghana" data-whitelist="GH"></select>
        
              </div>
              <div class="form-group col-md-6 mb-3">
                <label for="exampleInputPassword1">Region</label>
                <select  name="regions" id="regions" data-default-value="" class="form-control selectpicker" data-style="btn-dark" required></select>
              
           
              </div>
              <div class="form-group col-md-12 mb-3">
              <center><button type="submit" name="save" class="btn btn-dark btn-block">Save</button></center>
           
              </div>
        
        </div>
            </form>
              </div>
            </div>
            </div><!-- /.card -->
          </div>
          
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
             
<?php
require "././template/footer.php";
?>
           
        <script>
              $(document).ready(function(){
              //top bar active
               $(".profile").addClass('active');
                });
                </script> 