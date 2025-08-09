<?php
require "../admin/template/header.php";
require "././fusioncharts.php";

?>
<script src="././js/fusioncharts.js" type="text/javascript"></script>
<script src="././js/fusioncharts.charts.js" type="text/javascript"></script>
<?php
global $con;
  $s ="SELECT count(*) as tot FROM restaurants";
  $r = mysqli_query($con,$s);
 if($r){
  while($row = mysqli_fetch_assoc($r)){
    $num = $row['tot'];
      }
  }    

?>
<?php
global $con;
  $s ="SELECT count(*) as tot FROM users";
  $r = mysqli_query($con,$s);
 if($r){
  while($row = mysqli_fetch_assoc($r)){
    $num2 = $row['tot'];
      }
  }    

?>
<?php
global $con;
  $s ="SELECT count(*) as tot FROM orders";
  $r = mysqli_query($con,$s);
 if($r){
  while($row = mysqli_fetch_assoc($r)){
    $num3 = $row['tot'];
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
              <li class="breadcrumb-item active"><i class="fa fa-dashboard"></i></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
	    <!-- Info boxes -->
        <div class="row">
          
          <!-- /.col -->
      
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fa fa-home"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">RESTAURANTS</span>
                <span class="info-box-number"><?php echo $num;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fa fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Customers</span>
                <span class="info-box-number"><?php echo $num2;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fa fa-tag"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Orders</span>
                <span class="info-box-number"><?php echo $num3;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
        </div>
        <!-- /.row --> 

        <div class="row">
          <div class="col-lg-12">
            <div class="card card-warning card-outline">
              <div class="card-body table-responsive-sm">
                <h5 class="card-title"><i class="fa fa-eye"></i>&nbsp;Restaurants</h5>
				<hr>
        <table class="table table-striped table-bordered dt-responsive " id="order" cellspacing="0" width="100%" >
  <thead style="background:#000;color:#fff;">
  <tr>
  <!-- <th>Image</th> -->
  <th>Restaurant Name</th>
  <th>Cuisines</th>
  <th>Address</th>
  <th>Email</th>
  
  </thead>
 <tbody>

<?php
        $sql = "SELECT * FROM restaurants" ;
        $result = mysqli_query($con,$sql);
    while ($row = mysqli_fetch_array($result)){
    
    echo "<tr>";
    // echo "<td><img  src='http:localhost/muhresto/upload/".$row['image']."'/></td>";
    echo "<td>".$row['restaurantname']."</td>";
    echo "<td>".$row['cuisines']."</td>";
    echo "<td>".$row['addressrestaurant']."</td>";
    echo "<td>".$row['email']."</td>";
   
    
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
  $(".home").addClass('active');
  });
  </script> 
	  <script>
              $(document).ready(function(){
              //top bar active
               $(".order").addClass('active');
                });
                </script> 
  <script>
  $(document).ready(function(){
 $("#order").DataTable();  
  
  });
  </script>