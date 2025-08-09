<?php
session_start();

if(!$_SESSION['restaurantid']){
	
	header('location:index.php');
}

?>
