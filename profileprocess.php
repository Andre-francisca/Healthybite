<?php
if(isset($_POST['fname'])){
	$fname =  strip_tags($_POST['fname']);
	$fname =  htmlspecialchars($_POST['fname']);
	$email =  strip_tags($_POST['email']);
	$email =  htmlspecialchars($_POST['email']);
	$phone =  strip_tags($_POST['phone']);
	$phone =  htmlspecialchars($_POST['phone']);
	$pid =  strip_tags($_POST['pid']);
	$pid =  htmlspecialchars($_POST['pid']);
	$password =  strip_tags($_POST['password']);
	$password =  htmlspecialchars($_POST['password']);
	$password = md5($password);
	$con = mysqli_connect('localhost','root','','resto');
	$sql = "INSERT INTO `users`( `user_name`, `user_email`, `user_password`, `user_phone`)
	VALUES ('$fname','$email','$password','$phone'))";
	
	$sql = "UPDATE `users` SET 
	`user_name`='$fname',`user_email`='$email',`user_password`='$password',`user_phone`='$phone' WHERE `users_id`= '$pid'";
	$result = mysqli_query($con,$sql);
	 if($result){ 	
	 	echo "success";
	 }
	 else{
		 echo 'fail';
		 echo  mysqli_error($con);	 
	 }
	

}
?>