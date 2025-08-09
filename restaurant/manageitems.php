<?php
require "././template/header.php";
require "././php/random.php";
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
              <li class="breadcrumb-item active">Manage Items</li>
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
              <div class="card-body table-responsive-sm">
                <h5 class="card-title"><i class="fa fa-eye"></i>&nbsp;Items</h5>
				<hr>
        <table class="table table-striped table-bordered dt-responsive " id="items" cellspacing="0" width="100%" >
  <thead style="background:#000;color:#fff;">
  <tr>
  <th>Image</th>
  <th>Name</th>
  <th>Price</th>
  <th>Description</th>
  <th>cuisines</th>
  <th>Date</th>
  <th>Calories</th>
  <th>Item Code</th>
  <th>Is Low Sugar</th>
  <th>Is Non Spicy</th>
  <th>Is Low Sodium</th>
  </thead>
 <tbody>
<?php
//deleting order
  if(isset($_GET["delete"])){
    $sql = "delete  from orders where product_id='".$_GET["delete"]."'";
    $result = mysqli_query($conn,$sql);
    if($result){
      unlink("images/".$_GET["picture"]);
    
     echo "<script>document.location = 'orders.php';</script>";
    }
    
  }

?> 
<?php
        $sql = "SELECT * FROM item  WHERE restaurant_id ='{$_SESSION['restaurantid']}' order by date DESC" ;
        $result = mysqli_query($con,$sql);
    while ($row = mysqli_fetch_array($result)){ 
    
    echo "<tr>";
    echo "<td><img src='menupload/" . $row['item_image'] . "' alt='Item Image' width='80'></td>";
    echo "<td>".$row['item_name']."</td>";
    echo "<td>".$row['price']."</td>";
    echo "<td>".$row['description']."</td>";
    echo "<td>".$row['cuisines']."</td>";
    echo "<td>".$row['date']."</td>";
    echo "<td>".$row['calories']."</td>";
    echo "<td>".$row['item_code']."</td>";
    echo "<td>".$row['is_low_sugar']."</td>";
    echo "<td>".$row['is_non_spicy']."</td>";
    echo "<td>".$row['is_low_sodium']."</td>";
    
      echo "</tr>";
     } 
       
  ?>
  </tr>
  </tbody>
  </table>
            
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
$(".manageitems").addClass('active');
});
</script> 
  <script>
  $(document).ready(function(){
 $("#items").DataTable();  
  
  });
  </script>