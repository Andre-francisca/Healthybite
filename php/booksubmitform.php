<?php
//update researchers
$con = mysqli_connect('localhost','root','','resto'); 
 if(!empty($_POST))  
 {  

      $output = '';  
      $message = '';   
      $resid = $_POST["resid"];
      $name = mysqli_real_escape_string($con, $_POST["name"]); 
      $email = mysqli_real_escape_string($con, $_POST["email"]); 
      $nog = mysqli_real_escape_string($con, $_POST["nog"]); 
      $time = mysqli_real_escape_string($con, $_POST["time"]);
       $date = mysqli_real_escape_string($con, $_POST["date"]); 
       $note = mysqli_real_escape_string($con, $_POST["note"]);
       $phone = mysqli_real_escape_string($con, $_POST["phone"]);	   
       //$client_id = mysqli_real_escape_string($con, $_POST["client_id"]);
           if($_POST["resid"] != '')  
      {  
           
          $query = "INSERT INTO `res_booking`( `res_id`, `name`, `phone`, `email`, `nog`, `note`, `time`, `date`)
		  VALUES ('$resid','$name','$phone','$email','$nog','$note','$time','$date')";
          $message = 'Data Updated';  
      }
      if(mysqli_query($con, $query))  
      {  
           $output .= '<label class="text-success">' . $message . '</label>'; 
           
      }
 echo $output; 
 }


?>