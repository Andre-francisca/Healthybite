<?php
require "././template/header.php";
require "././fusioncharts.php";

?>
<script src="././js/fusioncharts.js" type="text/javascript"></script>
<script src="././js/fusioncharts.charts.js" type="text/javascript"></script>
<?php
global $con;
  $s ="SELECT count(*) as tot FROM orders WHERE restaurant_id = '{$_SESSION['restaurantid']}'";
  $r = mysqli_query($con,$s);
 if($r){
  while($row = mysqli_fetch_assoc($r)){
    $num = $row['tot'];
      }
  }    

?>
<?php
global $con;
  $s ="SELECT count(*) as tot FROM item WHERE restaurant_id = '{$_SESSION['restaurantid']}'";
  $r = mysqli_query($con,$s);
 if($r){
  while($row = mysqli_fetch_assoc($r)){
    $numtotal = $row['tot'];
      }
  }    

?>
<?php
   
   $sql = "SELECT order_item_name,order_qty FROM orders  WHERE restaurant_id = '{$_SESSION['restaurantid']}'";
   $result = mysqli_query($con,$sql);
   if($result){
     // creating an associative array to store the chart attributes
  $arrData = array(
    "chart" => array(
      "caption" => "Restaurant's Order chart",
      "xAxisName" => "Order Column",
    "showlegend"=> "1", 
    "showpercentvalues"=> "1",
    "legendposition"=> "bottom",
    "usedataplotcolorforlabels"=> "1",
    "theme"=> "candy"
      // more chart configuration options
    )
  );
   $arrData["data"] = array();

  // iterating over each data and pushing it into $arrData array
  while ($row = mysqli_fetch_array($result)) {
    array_push($arrData["data"], array(
      "label" => $row["order_item_name"],
      "value" => $row["order_qty"],


    ));
  }
$jsonData = json_encode($arrData);
// creating FusionCharts instance
$columnChart = new FusionCharts("column2d", "expenseChart",
 "100%", "500", "column-chart", "json", $jsonData);
 // FusionCharts render() method
$columnChart->render();

// closing database connection      
$con->close(); 

}
else{
  echo "this is the error for not displaying the chart!".mysqli_error($con);
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
              <span class="info-box-icon bg-success elevation-1"><i class="fa fa-shopping-cart"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Orders</span>
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
                <span class="info-box-text">Items</span>
                <span class="info-box-number"><?php echo $numtotal ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
          <div class="col-lg-12">
            <div class="card card-warning card-outline">
              <div class="card-body">
                <h5 class="card-title">Chart</h5>

                <p class="card-text">
                 <div id="column-chart">Awesome Chart on its way!</div>
                </p>
               
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