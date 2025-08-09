<?php
 $con = mysqli_connect('localhost','root','','resto');
 if(isset($_POST["resbook_id"]))  
 { 
 $sql = "SELECT * FROM restaurants WHERE res_id = '".$_POST["resbook_id"]."'";
  $result = mysqli_query($con, $sql);  
      $row = mysqli_fetch_array($result);  
      echo json_encode($row);
  }
?>