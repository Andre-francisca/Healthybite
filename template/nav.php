<nav class="navbar  fixed-top navbar-expand-lg navbar-light" >

  <a class="navbar-brand" href="index.php"><img src="img/healthybitegh.png" width="80px" > </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav w-100 justify-content-center" id="navb">
      <li class="nav-item" id="home">
        <a class="nav-link" href="./index.php" ><span>Home</span></a>
      </li>
      <li class="nav-item" id="farm">
        <a class="nav-link" href="./restaurants.php">Restaurants</a>
      </li> 
	   <li class="nav-item" id="shop">
        <a class="nav-link" href="search.php">Explore</a>
      </li> 
	   <li class="nav-item" id="cart">
    <a class="nav-link" href="cart.php"><i class="fa fa-shopping-cart"></i>&nbsp;Cart <span id="cart-item" class="badge badge-warning">
    </span></a>
      </li>
	  
      <?php
      if((isset($_SESSION['userid'])))
     {
      ?>
     <li class="nav-item">
   
     <a class="nav-link" href="profile.php"> 
      
      <span class="hidden-xs badge" style="background:#f39c12!important;"><?php  echo "hi ".$_SESSION['username']."" ?>&nbsp;<i class="fa fa-caret-down" style="color:#000"></i></span></a>
    </li>
     <li class="nav-item">
        <a class="nav-link" href="logout.php">
         Logout
        </a>
          
      </li>
    <?php
     }
     else{
      ?>
      <li class="nav-item">
        <a class="nav-link" href="signin.php">
         SIGNIN
        </a>
          
      </li>
      <?php
     }
	 
		
      ?>
    </ul>
   
  </div>
</nav>