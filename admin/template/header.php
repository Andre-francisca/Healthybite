<?php
require "../admin/php/core.php";
?>
<?php
require "../database/db.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>HealthyBiteGH || Dashboard</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="././fontawesome/css/fontawesome.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="././css/grid.css">
  <link rel="stylesheet" href="././css/style.css">
  <link rel="stylesheet" href="././css/jquery.dataTables.css">
  <link rel="stylesheet" href="././css/adminlte.min.css">
	<link rel="stylesheet" href="../css/bootstrap-fileupload.min.css">
  <style>
.page-item.active .page-link {
    z-index: 1;
    color: 
#fff;
background-color:
#ff3503!important;
border-color:
    #000!important;
}

  </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>
     
    </ul>

  

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
   
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
         <span class="hidden-xs badge " style="background:#f39c12!important;"><?php echo "".$_SESSION['name']."" ?></span>&nbsp;&nbsp;&nbsp;
              
      </li>
	   <li class="nav-item dropdown">
        	<li><a href="logout.php"><i class="fa fa-power-off " style="font-size:18px;color:red"></i>&nbsp;Logout&nbsp;&nbsp;</a></li>
            
      </li>
      
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="dashboard.php" class="brand-link">
      <img src="././img/resto.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Resto</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="././img/icon2.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
		  <?php echo "<b style='color:orange'>Hi</b>&nbsp;<b style='color:#fff;'>".$_SESSION['name']."</b>"  ?>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fa fa-dashboard"></i>
              <p>
                Dashboard
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
			 <li class="nav-item">
                <a href="dashboard.php" class="nav-link home">
                  <i class="fa fa-home nav-icon"></i>
                  <p>Home</p>
                </a>
              </li>
            
              <!-- <li class="nav-item">
                <a href="profile.php" class="nav-link profile">
                  <i class="fa fa-tags nav-icon"></i>
                  <p>Profile</p>
                </a>
              </li> -->
           
			  <li class="nav-item">
                <a href="logout.php" class="nav-link">
                  <i class="fa fa-sign-out nav-icon"></i>
				  <p>Logout</p>
                </a>
              </li>
			  
			  
            </ul>
          </li>
       
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
