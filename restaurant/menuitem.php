<?php
require "././template/header.php";
require "././php/random.php";
?>
<?php
$error = false;
if(isset($_POST['save'])){
       	$uploadedFile = '';
	    if(!empty($_FILES["file"]["type"])){
        $fileName = time().'_'.$_FILES['file']['name'];
        
            $sourcePath = $_FILES['file']['tmp_name'];
            $targetPath = "././menupload/".$fileName;
            if(move_uploaded_file($sourcePath,$targetPath)){
                $uploadedFile = $fileName;
            }
         
    }
                $itemname = htmlspecialchars($_POST['itemname']);
                //$productimage = htmlspecialchars($_POST['productimage']);
                $price = htmlspecialchars($_POST['price']);
                $desc = htmlspecialchars($_POST['desc']);
                $cuisines = htmlspecialchars($_POST['cuisines']);
                $calories = htmlspecialchars($_POST['calories']);
                $islowsugar = htmlspecialchars($_POST['islowsugar']);
                $islowsodium = htmlspecialchars($_POST['islowsodium']);
                $isnonspicy = htmlspecialchars($_POST['isnonspicy']);
				        $date = date("y-m-d h:m:s");
				
                $restaurantid = $_SESSION['restaurantid'];
                $sql = "INSERT INTO `item`(`item_id`, `restaurant_id`, `item_name`, `item_image`, `price`, `description`, `cuisines`, `date`, `item_code`,`region`, `address`,`calories`, `is_low_sugar`, `is_non_spicy`, `is_low_sodium`) 
				VALUES ('','$restaurantid','$itemname','$uploadedFile','$price','$desc','$cuisines','$date','$random','{$_SESSION['region']}','{$_SESSION['address']}','$calories', '$islowsugar', '$isnonspicy', '$islowsodium')";
				
				$result = mysqli_query($con,$sql);
                if($result){
                       $error = true;
                            $errorpost =  '<div class="alert alert-success alert-dismissible " role="alert">
                        Product successfully Added!.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>';
                            }
                else{
                    echo $con -> error;;
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
                <h5 class="card-title"><i class="fa fa-plus-circle"></i>ADD Menu Item</h5>
				<hr>
                <form   action="" method="POST" enctype="multipart/form-data">
						
                  <center><div class="form-group">
                        <label class="control-label col-lg-2">Upload Menu Item Image</label>
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
	          <div class="form-row" style="padding:12px;">
              <div class="form-group col-md-6 mb-3">
                <label for="exampleInputPassword1">Name of item</label>
                <input type="text" class="form-control" id="itemname" name="itemname" placeholder="Name of Item" required>
              </div>
              <div class="form-group col-md-6 mb-3">
                <label for="exampleInputPassword1">Cuisines</label>
                <input type="text" class="form-control" id="cuisines" name="cuisines" placeholder="African, International, Healthy, Chinese, Indian" required>
              </div>
			   <div class="form-group col-md-6 mb-3">
                <label for="">Price</label>
                <input type="text" onkeypress="return isNumberKey(this, event)" class="form-control" id="price" name="price" placeholder="Enter Price" required>
              </div>
			   <div class="form-group col-md-6 mb-3">
                <label for="">Calories (kcal)</label>
                <input type="text" onkeypress="return isNumberKey(this, event)" class="form-control" id="calories" name="calories" placeholder="3" required>
              </div>
			   <div class="form-group col-md-6 mb-3">
                <label for="">Is Low Sugar</label>
                <select class="form-control mb-4" name="islowsugar" id="islowsugar" required>
                    <option value="" disabled selected>****SELECT****</option>
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                    
                </select>
            </div>
			   <div class="form-group col-md-6 mb-3">
                <label for="">Is Non Spicy</label>
                <select class="form-control mb-4" name="isnonspicy" id="isnonspicy" required>
                    <option value="" disabled selected>****SELECT****</option>
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                    
                </select>
            </div>
			   <div class="form-group col-md-6 mb-3">
                <label for="">Is Low Sodium(salt)</label>
                <select class="form-control mb-4" name="islowsodium" id="islowsodium" required>
                    <option value="" disabled selected>****SELECT****</option>
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                    
                </select>
            </div>
			   
			    
              
			  <!-- <div class="form-group col-md-6 mb-3">
			  <label for="">Category</label>
            <select class="form-control selectpicker" data-style="btn-dark"  name="category"  id="category" required>
            <option value="" disabled selected>****SELECT****</option>
              <?php
              $sql = "SELECT * FROM category ";
              $result = mysqli_query($con,$sql);
              while($row = mysqli_fetch_array($result)){
                
                echo "<option id='$row[0]' value='$row[1]'>".$row[1]."</option>"; 
              }
              
              ?>
              </select>  
			   </div>
         <div class="form-group col-md-6 mb-3">
			  <label for="">Sub Category</label>
            <select class="form-control selectpicker" data-style="btn-dark"  name="subcategory" id="subcategory" required>
              </select>  
			   </div> -->

         <div class="form-group col-md-6 mb-3">
                <label for="">Description</label>
                <textarea type="text" class="form-control"  name="desc"  required>
				      </textarea>
              </div>
			  
			  </div>
			   <!-- <center><button type="submit" name="save" class="btn btn-dark">Save</button></center> -->
         <div class="form-group col-md-12 mb-3">
              <center><button type="submit" name="save" class="btn btn-dark btn-block">Save</button></center>
           
              </div>
            </form>
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
               $(".product").addClass('active');
                });

        </script> 
   
