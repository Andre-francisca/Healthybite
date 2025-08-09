<?php
//remove all session variables
session_start();
session_unset();

session_destroy();

	header('location:http://localhost/healthybite/admin/index.php');
?>