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
              <li class="breadcrumb-item active">Orders</li>
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
                <h5 class="card-title"><i class="fa fa-eye"></i>&nbsp;Orders</h5>
				<hr>
        <table class="table table-striped table-bordered dt-responsive nowrap" id="order" cellspacing="0" width="100%" >
  <thead style="background:#000;color:#fff;">
  <tr>
  <th>Menu</th>
  <th>Price</th>
  <th>OrderID</th>
  <th>Email</th>
  <th>Qty</th>
  <th>Total (GHS) </th>
  <th>Order Date</th>
  <th>Payment Mode</th>
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
        $sql = "SELECT * FROM orders LEFT JOIN users ON users.users_id = orders.users_id WHERE restaurant_id ='{$_SESSION['restaurantid']}' order by order_date DESC" ;
        $result = mysqli_query($con,$sql);
    while ($row = mysqli_fetch_array($result)){
    
    echo "<tr>";
    echo "<td>".$row['order_item_name']."</td>";
    echo "<td>".$row['order_item_price']."</td>";
    echo "<td>".$row['ordercode']."</td>";
    echo "<td>".$row['user_email']."</td>";
    echo "<td>".$row['order_qty']."</td>";
    echo "<td>".$row['total_price']."</td>";
    echo "<td>".$row['order_date']."</td>";
    echo "<td>".$row['pmode']."</td>";
    
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
               $(".order").addClass('active');
                });
                </script> 
  <script>
  $(document).ready(function(){
 $("#order").DataTable();  
  
  });
  </script>