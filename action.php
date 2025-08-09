<?php
session_start();
require "database/db.php";
require "php/randomses.php";




if(isset($_GET['itemcode']) && isset($_GET['itemcode']) !== ''){

	$itemcode = $_GET['itemcode'];
	
    

	
	//$_SESSION['username'] = $username;
	//$userIP = $_SERVER['REMOTE_ADDR'];
	$qty = 1;

	$q = "SELECT * FROM cart WHERE cart_item_code='$itemcode' ";
	$result = mysqli_query($con,$q);
	$row = mysqli_num_rows($result);

	if($row>0){

						
			 $output =  "<div class='alert alert-warning hide alert-dismissible fade show' role='alert'><strong><center>Item already added to Cart</center></strong>
			 </div>";
			 echo json_encode($output);
	

	}else{

		$q = "SELECT * FROM item WHERE item_code='$itemcode'";
		$result = mysqli_query($con,$q);

		if($result){

			$row = mysqli_fetch_assoc($result);

			$itemcode = $row['item_code'];
			$itemname = $row['item_name'];
			$price = $row['price'];
			$qty = 1;
			$itemimage = $row['item_image'];
			$restaurantid = $row['farm_id'];


		$query = $con->prepare("INSERT INTO cart (cart_item_name,cart_price,cart_item_image,qty,total_price,cart_item_code,farm_id) values(?,?,?,?,?,?,?)");
		$query->bind_param("sssissi",$itemname,$price,$itemimage,$qty,$price,$itemcode,$restaurantid);
		$query->execute();

		$output = "<div class='alert alert-success hide alert-dismissible fade show' role='alert'><center><strong>Item added to Cart!</strong><br>
				 <button type='button' class='btn btn-dark'>
					<a href='./index.php' >Continue Shopping</a>
				  </button>
				  <a href='./cart.php' ><button type='button' class='btn btn-warning'>
					View Cart and Checkout
				  </button></a>
				  
				</div>";

				 
		echo json_encode($output);

		}



		
	}

	
}
if(isset($_POST['itemname'])){
	$itemid = mysqli_real_escape_string($con,$_POST['itemid']);
	$itemname = mysqli_real_escape_string($con,$_POST['itemname']);
	$price = mysqli_real_escape_string($con,$_POST['price']);
	$itemcode = mysqli_real_escape_string($con,$_POST['itemcode']);
	$itemimage = mysqli_real_escape_string($con,$_POST['itemimage']);
	$restaurantid = $_POST['restaurantid'];
    

	
	//$_SESSION['username'] = $username;
	//$userIP = $_SERVER['REMOTE_ADDR'];
	$qty = 1;

	$q = "SELECT * FROM cart WHERE cart_item_code='$itemcode' ";
	$result = mysqli_query($con,$q);
	$row = mysqli_num_rows($result);

	if($row>0){

						
			 echo "<div class='alert alert-warning hide alert-dismissible fade show' role='alert'><strong><center>Item already added to Cart</center></strong>
			 </div>";
	

	}else{
		$query = $con->prepare("INSERT INTO cart (cart_item_name,cart_price,cart_item_image,qty,total_price,cart_item_code,restaurant_id) values(?,?,?,?,?,?,?)");
		$query->bind_param("sssissi",$itemname,$price,$itemimage,$qty,$price,$itemcode,$restaurantid);
		$query->execute();

				 echo "<div class='alert alert-success hide alert-dismissible fade show' role='alert'><center><strong>Item added to Cart!</strong><br>
				 <button type='button' class='btn btn-dark'>
					<a href='./index.php' >Continue Shopping</a>
				  </button>
				  <a href='./cart.php' ><button type='button' class='btn btn-warning'>
					View Cart and Checkout
				  </button></a>
				  
				</div>";
	}

}


 if(isset($_GET['cartItem']) && isset($_GET['cartItem']) == 'cart_item'){
 	$stmt = $con->prepare("SELECT * FROM cart");
 	$stmt->execute();
 	$stmt->store_result();
 	$rows = $stmt->num_rows;

 	echo $rows;
	
 }

 if(isset($_GET['remove'])){
 	$id = $_GET['remove'];

 	$stmt = $con->prepare("DELETE FROM cart WHERE cart_id = ?");
 	$stmt->bind_param("i",$id);
 	$stmt->execute();

 	$_SESSION['showAlert'] = 'block';
 	$_SESSION['message'] = 'item removed from cart!';
 	header('location:cart.php');

 }

 if(isset($_GET['clear'])){

 	$stmt = $con->prepare("DELETE FROM cart");
 	$stmt->execute();
 	$_SESSION['showAlert'] = 'block';
 	$_SESSION['message'] = 'All item removed from cart!';
 	header('location:cart.php');
 }

 if(isset($_POST['qty'])){

    $qty = $_POST['qty'];
    $itemid = $_POST['itemid'];
    $itemprice = $_POST['itemprice'];

    $tprice = $qty*$itemprice;

    $stmt = $con->prepare("UPDATE cart SET qty=?, total_price=? WHERE cart_id=?");
    $stmt->bind_param("isi",$qty,$tprice,$itemid);
    $stmt->execute();

	

 }

if(isset($_POST['action']) && isset($_POST['action']) == 'order'){
	$name = $_POST['name'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$items = $_POST['items'];
	$grand_total = $_POST['grand_total'];
	$address = $_POST['address'];
	$pmode = $_POST['pmode'];

	$ordercode = $_POST['ordercode'];

	$data = '';
	$stmt = $con->prepare("INSERT INTO orders(name,email,phone,address,pmode,items,amount_paid,ordercode)
		values(?,?,?,?,?,?,?,?)");
	$stmt->bind_param('ssssssss',$name,$email,$phone,$address,$pmode,$items,$grand_total,$ordercode);
	$stmt->execute();
	 $data .='<div class="text-center">
      <h1 class="display-4 mt-2 text-danger">Thank You!</h1>
      <h2 class="text-success">Your Order placed successfully!</h2>
      <h5> OrderID : '.$ordercode.' </h5>
      <h4 class="bg-danger text-light rounded">Items Purchased : '.$items.'</h4>
      <h4>Your Name : '.$name.' </h4>
      <h4>Your E-mail : '.$email.' </h4>
      <h4>Your Phone : '.$phone.' </h4>
      <h4>Total Amount Paid: '.$grand_total.' </h4>
      <h4>Payment Mode : '.$pmode.' </h4>
   </div>';

   echo $data;
}


?>