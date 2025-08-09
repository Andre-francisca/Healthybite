<?php
//start session
session_start();
require "database/db.php"; 
require "database/createdb.php";
include 'class/Rating.php';
//create instance of create db class

if(isset($_POST['add'])){
	
	 	if(isset($_SESSION['cart'])){
    
		$item_array_id = array_column($_SESSION['cart'], "productid");
                if(in_array($_POST['productid'],$item_array_id)){
                    echo "<script>alert('Order already added in the cart..!')</script>";
                    echo "<script>window.location='index.php'</script>";
                }
                else{
                     $count = count($_SESSION['cart']);
                     $item_array = array(
                     'productid'=>$_POST['productid']
                      );

                     $_SESSION['cart'][$count] = $item_array; 
                     
                }
  	
	}else{ 
		
		$item_array = array(
		'productid'=>$_POST['productid']
		);
		
		//create new session variable
		$_SESSION['cart'][0] = $item_array;
		
		
	}
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="">
	<meta name="description" content="">
    <link rel="stylesheet" href="./lib/css/grid.css" >
	<link rel="stylesheet" href="./css/custom.css" >
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/animate.css">
	<link rel="stylesheet" href="./lib/fontawesome/css/fontawesome.css" >
    <title>HealthyBite</title>
	
	<style>
    .navbar-light .navbar-nav .show > .nav-link, .navbar-light .navbar-nav .active > .nav-link, .navbar-light .navbar-nav .nav-link.show, .navbar-light .navbar-nav .nav-link.active {
  color: #ffc107;
    }   
	</style>
  </head>
  <body>

<section id="main">
<?php require "template/nav.php"    ?>
<div class="container mb-5 ">

<h1>Order Healthy Meals</h1>
<p>Easily Find restaurants,Specials in Accra</p>
 <div class="s132" >
      <form action="search.php" method="post">
        <div class="inner-form">
         
          <div class="input-field second-wrap">
            <input id="search" type="text" name="q"placeholder="search restaurants, healthy meals" />
          </div>
          <div class="input-field third-wrap">
            <button class="btn-search" type="submit" name="submit"><i class="fa fa-search"></i>&nbsp;Search</button>
          </div>
        </div>
      </form>
    </div>
	            <div class="steps">
                        <div class="step-item step1">
                            <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 483 483" width="512" height="512">
                                <g fill="#FFF">
                                    <path d="M467.006 177.92c-.055-1.573-.469-3.321-1.233-4.755L407.006 62.877V10.5c0-5.799-4.701-10.5-10.5-10.5h-310c-5.799 0-10.5 4.701-10.5 10.5v52.375L17.228 173.164a10.476 10.476 0 0 0-1.22 4.938h-.014V472.5c0 5.799 4.701 10.5 10.5 10.5h430.012c5.799 0 10.5-4.701 10.5-10.5V177.92zM282.379 76l18.007 91.602H182.583L200.445 76h81.934zm19.391 112.602c-4.964 29.003-30.096 51.143-60.281 51.143-30.173 0-55.295-22.139-60.258-51.143H301.77zm143.331 0c-4.96 29.003-30.075 51.143-60.237 51.143-30.185 0-55.317-22.139-60.281-51.143h120.518zm-123.314-21L303.78 76h86.423l48.81 91.602H321.787zM97.006 55V21h289v34h-289zm-4.198 21h86.243l-17.863 91.602h-117.2L92.808 76zm65.582 112.602c-5.028 28.475-30.113 50.19-60.229 50.19s-55.201-21.715-60.23-50.19H158.39zM300 462H183V306h117v156zm21 0V295.5c0-5.799-4.701-10.5-10.5-10.5h-138c-5.799 0-10.5 4.701-10.5 10.5V462H36.994V232.743a82.558 82.558 0 0 0 3.101 3.255c15.485 15.344 36.106 23.794 58.065 23.794s42.58-8.45 58.065-23.794a81.625 81.625 0 0 0 13.525-17.672c14.067 25.281 40.944 42.418 71.737 42.418 30.752 0 57.597-17.081 71.688-42.294 14.091 25.213 40.936 42.294 71.688 42.294 24.262 0 46.092-10.645 61.143-27.528V462H321z"></path>
                                     <path d="M202.494 386h22c5.799 0 10.5-4.701 10.5-10.5s-4.701-10.5-10.5-10.5h-22c-5.799 0-10.5 4.701-10.5 10.5s4.701 10.5 10.5 10.5z"></path>
                                </g>
                            </svg>
                            <h4><span>1. </span>Filter Meals</h4> </div>
                        <!-- end:Step -->
                        <div class="step-item step2"> 
                            <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewbox="0 0 380.721 380.721">
                                <g fill="#FFF">
                                    <path d="M58.727 281.236c.32-5.217.657-10.457 1.319-15.709 1.261-12.525 3.974-25.05 6.733-37.296a543.51 543.51 0 0 1 5.449-17.997c2.463-5.729 4.868-11.433 7.25-17.01 5.438-10.898 11.491-21.07 18.724-29.593 1.737-2.19 3.427-4.328 5.095-6.46 1.912-1.894 3.805-3.747 5.676-5.588 3.863-3.509 7.221-7.273 11.107-10.091 7.686-5.711 14.529-11.137 21.477-14.506 6.698-3.724 12.455-6.982 17.631-8.812 10.125-4.084 15.883-6.141 15.883-6.141s-4.915 3.893-13.502 10.207c-4.449 2.917-9.114 7.488-14.721 12.147-5.803 4.461-11.107 10.84-17.358 16.992-3.149 3.114-5.588 7.064-8.551 10.684-1.452 1.83-2.928 3.712-4.427 5.6a1225.858 1225.858 0 0 1-3.84 6.286c-5.537 8.208-9.673 17.858-13.995 27.664-1.748 5.1-3.566 10.283-5.391 15.534a371.593 371.593 0 0 1-4.16 16.476c-2.266 11.271-4.502 22.761-5.438 34.612-.68 4.287-1.022 8.633-1.383 12.979 94 .023 166.775.069 268.589.069.337-4.462.534-8.97.534-13.536 0-85.746-62.509-156.352-142.875-165.705 5.17-4.869 8.436-11.758 8.436-19.433-.023-14.692-11.921-26.612-26.631-26.612-14.715 0-26.652 11.92-26.652 26.642 0 7.668 3.265 14.558 8.464 19.426-80.396 9.353-142.869 79.96-142.869 165.706 0 4.543.168 9.027.5 13.467 9.935-.002 19.526-.002 28.926-.002zM0 291.135h380.721v33.59H0z" /> </g>
                            </svg>
                            <h4><span>2. </span>Order Food</h4> </div>
                        <!-- end:Step -->
                        <div class="step-item">
                            &nbsp;
                            <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewbox="0 0 612.001 612">
                                <path d="M604.131 440.17h-19.12V333.237c0-12.512-3.776-24.787-10.78-35.173l-47.92-70.975a62.99 62.99 0 0 0-52.169-27.698h-74.28c-8.734 0-15.737 7.082-15.737 15.738v225.043h-121.65c11.567 9.992 19.514 23.92 21.796 39.658H412.53c4.563-31.238 31.475-55.396 63.972-55.396 32.498 0 59.33 24.158 63.895 55.396h63.735c4.328 0 7.869-3.541 7.869-7.869V448.04c-.001-4.327-3.541-7.87-7.87-7.87zM525.76 312.227h-98.044a7.842 7.842 0 0 1-7.868-7.869v-54.372c0-4.328 3.541-7.869 7.868-7.869h59.724c2.597 0 4.957 1.259 6.452 3.305l38.32 54.451c3.619 5.194-.079 12.354-6.452 12.354zM476.502 440.17c-27.068 0-48.943 21.953-48.943 49.021 0 26.99 21.875 48.943 48.943 48.943 26.989 0 48.943-21.953 48.943-48.943 0-27.066-21.954-49.021-48.943-49.021zm0 73.495c-13.535 0-24.472-11.016-24.472-24.471 0-13.535 10.937-24.473 24.472-24.473 13.533 0 24.472 10.938 24.472 24.473 0 13.455-10.938 24.471-24.472 24.471zM68.434 440.17c-4.328 0-7.869 3.543-7.869 7.869v23.922c0 4.328 3.541 7.869 7.869 7.869h87.971c2.282-15.738 10.229-29.666 21.718-39.658H68.434v-.002zm151.864 0c-26.989 0-48.943 21.953-48.943 49.021 0 26.99 21.954 48.943 48.943 48.943 27.068 0 48.943-21.953 48.943-48.943.001-27.066-21.874-49.021-48.943-49.021zm0 73.495c-13.534 0-24.471-11.016-24.471-24.471 0-13.535 10.937-24.473 24.471-24.473s24.472 10.938 24.472 24.473c0 13.455-10.938 24.471-24.472 24.471zm117.716-363.06h-91.198c4.485 13.298 6.846 27.54 6.846 42.255 0 74.28-60.431 134.711-134.711 134.711-13.535 0-26.675-2.045-39.029-5.744v86.949c0 4.328 3.541 7.869 7.869 7.869h265.96c4.329 0 7.869-3.541 7.869-7.869V174.211c-.001-13.062-10.545-23.606-23.606-23.606zM118.969 73.866C53.264 73.866 0 127.129 0 192.834s53.264 118.969 118.969 118.969 118.97-53.264 118.97-118.969-53.265-118.968-118.97-118.968zm0 210.864c-50.752 0-91.896-41.143-91.896-91.896s41.144-91.896 91.896-91.896c50.753 0 91.896 41.144 91.896 91.896 0 50.753-41.143 91.896-91.896 91.896zm35.097-72.488c-1.014 0-2.052-.131-3.082-.407L112.641 201.5a11.808 11.808 0 0 1-8.729-11.396v-59.015c0-6.516 5.287-11.803 11.803-11.803 6.516 0 11.803 5.287 11.803 11.803v49.971l29.614 7.983c6.294 1.698 10.02 8.177 8.322 14.469-1.421 5.264-6.185 8.73-11.388 8.73z" fill="#FFF" /> </svg>
                            <h4><span>3. </span>Take-Outs / Delivery</h4> </div>
                        <!-- end:Step -->
        </div>
		   <!-- add Farmer starts -->
                <section class="add-restaurants">
                    
                        <div class="row">
                            <div class="col-xs-12 col-sm-3 add-title">
                                <h4>Own a Restaurant?</h4> </div>
                            <div class="col-xs-12 col-sm-5 join-text">
                                <p>Join the thousands of other restaurants who benefit from having their Meals on <a href="#"><strong>HealthyBite</strong></a> </p>
                            </div>
                            <div class="col-xs-12 col-sm-4 join-btn text-xs-right"><a href="register.php" class="btn btn-warning btn-lg wow shake infinite" data-wow-duration='9s'">Sign Up</a> </div>
                        </div>
                    
                </section>

                <!-- add Farm ends -->
	 
</div>

</section>
          <!--response modal--->
            <div class="modal fade" id="delete_Modal">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-info"></i>&nbsp;Alert</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <div id="message"></div>
                    </div>
                    
                </div>
                </div>
            </div>

    <section class="popular" id="farm">
        <?php

            if((isset($_SESSION['userid']))){

                ?>
                    <div class="container">
                            <div class="title text-xs-center m-b-30">
                                        <h2>Recommended Menus </h2>
                                        <center>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewbox="0 0 380.721 380.721">
                                                <g fill="#000">
                                                    <path d="M58.727 281.236c.32-5.217.657-10.457 1.319-15.709 1.261-12.525 3.974-25.05 6.733-37.296a543.51 543.51 0 0 1 5.449-17.997c2.463-5.729 4.868-11.433 7.25-17.01 5.438-10.898 11.491-21.07 18.724-29.593 1.737-2.19 3.427-4.328 5.095-6.46 1.912-1.894 3.805-3.747 5.676-5.588 3.863-3.509 7.221-7.273 11.107-10.091 7.686-5.711 14.529-11.137 21.477-14.506 6.698-3.724 12.455-6.982 17.631-8.812 10.125-4.084 15.883-6.141 15.883-6.141s-4.915 3.893-13.502 10.207c-4.449 2.917-9.114 7.488-14.721 12.147-5.803 4.461-11.107 10.84-17.358 16.992-3.149 3.114-5.588 7.064-8.551 10.684-1.452 1.83-2.928 3.712-4.427 5.6a1225.858 1225.858 0 0 1-3.84 6.286c-5.537 8.208-9.673 17.858-13.995 27.664-1.748 5.1-3.566 10.283-5.391 15.534a371.593 371.593 0 0 1-4.16 16.476c-2.266 11.271-4.502 22.761-5.438 34.612-.68 4.287-1.022 8.633-1.383 12.979 94 .023 166.775.069 268.589.069.337-4.462.534-8.97.534-13.536 0-85.746-62.509-156.352-142.875-165.705 5.17-4.869 8.436-11.758 8.436-19.433-.023-14.692-11.921-26.612-26.631-26.612-14.715 0-26.652 11.92-26.652 26.642 0 7.668 3.265 14.558 8.464 19.426-80.396 9.353-142.869 79.96-142.869 165.706 0 4.543.168 9.027.5 13.467 9.935-.002 19.526-.002 28.926-.002zM0 291.135h380.721v33.59H0z" /> </g>
                                            </svg>
                                        </center>
                                        <div class="row">
                                        <?php
                                    

                                        $user_id = $_SESSION['userid'];

                                        $sql = "SELECT * FROM users WHERE users_id = $user_id";
                                        $result = $con->query($sql);
                                        $rating = new Rating();

                                        if ($result->num_rows > 0) {
                                            $user = $result->fetch_assoc();

                                            $healthcondition = $user['healthcondition'];
                                          

                                            $recommendations = [];

                                            $sql = "SELECT * FROM item m JOIN restaurants r where m.restaurant_id = r.restaurant_id";

                                            if($healthcondition === 'diabetes') {
                                                $sql .= " AND is_low_sugar = 'yes'";
                                            }

                                            if($healthcondition === 'ulcer') {
                                                $sql .= " AND is_non_spicy = 'yes'";
                                            }

                                            if($healthcondition === 'hypertension') {
                                                $sql .= " AND is_low_sodium = 'yes'";
                                            }

                                           

                                            $result = $con->query($sql);

                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    $recommendations[] = $row;
                                                    $average = $rating->getRatingAverage($row["item_id"]);
                                                }
                                            }

                                            if (empty($recommendations)) {
                                                echo "No recommendations found.";
                                            } else {
                                               
                                                foreach ($recommendations as $item) {
                                                   

                                                    ?>  
                   
                                                       
                                                        <div class="col-xs-12 col-sm-6 col-md-4 food-item" >
                                                        <div class="food-item-wrap">
                                                        
                                                            <div class="figure-wrap bg-image" data-image-src="img/menupload/<?php echo $item['item_image'];?>"  >
                                                            <?php echo '<center><img class="figure-wrap bg-image"  src="restaurant/menupload/'.$item["item_image"].'" ; width="350px" height="453px" /></center> '; ?>
                                                            
                                                                <div class="distance"><i class="fa fa-pin"></i><?php echo $item['cuisines'];?></div>
                                                                <!-- <div class="rating pull-left"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> </div>
                                                                 -->
                                                                <div class="review pull-right"><a href="item_rating.php?item_id=<?php echo $item["item_id"]; ?>">
                                                                <button type="button" class="btn btn-warning">
                                                                    Rating and Review <span class="badge badge-light"><?php printf('%.1f', $average); ?> <small>/ 5</small></span>
                                                                    </button>
                                                                </a> </div>
                                                            </div>
                                                            <div class="content">
                                                                <h5><a href="#"><?php echo $item["item_name"];?></a></h5>
                                                                <div class="product-name"><?php echo $item["description"];?></div>
                                                                <div class="price-btn-block"> <span class="price">GHS <?php echo $item["price"];?></span> 
                                
                                                            <form action="" class="form-submit">
                                  
                                                           <input type="hidden" class="itemid" value="<?= $item['item_id']?>">
                                                           <input type="hidden" class="itemname" value="<?= $item['item_name']?>">
                                                           <input type="hidden" class="itemprice" value="<?= $item['price']?>">
                                                           <input type="hidden" class="itemimage" value="<?= $item['item_image']?>">
                                                           <input type="hidden" class="itemcode" value="<?= $item['item_code']?>">
                                                           <input type="hidden" class="restaurantid" value="<?=  $item['restaurant_id'] ?>">
                                                           <b  class="btn theme-btn-dash pull-right"><button type="submit"  class="btn btn-success pull-right addItemBtn">ADD TO CART&nbsp;<i class="fa fa-shopping-cart" style="color:#fff"></i></button></b>
                                                            </form>
                                                                     </div>
                                                            </div>
                                                                
                                                            <div class="restaurant-block">
                                                                <div class="left">
                                                                    <a class="pull-left" href="restaurantdetails.php?far=<?php echo  "".$item['restaurant_id'].""   ?>"> <img src="upload/<?php echo $item["image"];?>" alt="restaurant logo" onerror="this.src='img/demoUpload.jpg'"  width="50px;"/> </a>
                                                                    <div class="pull-left right-text"> <a href="restaurantdetails.php?far=<?php echo  "".$item['restaurant_id'].""   ?>"><?php echo $item["restaurantname"];?></a></div>
                                                                </div>
                                                                
                                                                
                                                            </div>
                                                         
                                                        </div>
                                                    </div>
                                                      
                                                    <?php
                                                }
                                            }
                                        } else {
                                            echo "User not found.";
                                        }

                                        // $con->close();
                                        ?>

                                        </div>
                                    
                                    </div>
                            </div>

                <?php
            }else{

                ?>


                      <section class="popular" id="farm">
            <div class="container">
                <div class="title text-xs-center m-b-30">
                    <h2>Explore Menus </h2>
                    <img src="img/fork.png" width="50px" class="mx-auto d-block">
                    <p class="lead">The easiest way to your favourite healthy food</p>
                    <div id="message"></div>
                </div>
                <?php
        
                    $limit1 = 6;
                    $adjacents = 2;
                    $sq = "SELECT COUNT(*) 'total_rows' FROM item";
                    $res1 = mysqli_fetch_object(mysqli_query($con, $sq));
                    $total_rows1 = $res1->total_rows;
                    $total_pages1= ceil($total_rows1 / $limit1);

                    if(isset($_GET['page1']) && $_GET['page1'] != "") {
                    $page1 = $_GET['page1'];
                    $offset1 = $limit1 * ($page1-1);
                    } else {
                    $page1 = 1;
                    $offset1 = 0;
                    }
                            
          
          ?>
                <div class="row">
                        <?php 

                        // function excerpt($content,$numberOfWords = 10){     
                        //     $contentWords = substr_count($content," ") + 1;
                        //     $words = explode(" ",$content,($numberOfWords+1));
                        //     if( $contentWords > $numberOfWords ){
                        //         $words[count($words) - 1] = '...';
                        //     }
                        //     $excerpt = join(" ",$words);
                        //     return $excerpt;
                        // }

                        function trim_text($input, $length, $ellipses = true)
                                    {
                                        if (strlen($input) <= $length) {
                                            return $input;
                                        }

                                        // find last space within length
                                        $last_space = strrpos(substr($input, 0, $length), ' ');
                                        if ($last_space === FALSE) {
                                            $last_space = $length;
                                        }

                                        $trimmed_text = substr($input, 0, $last_space);

                                        // add ellipses
                                        if ($ellipses) {
                                            $trimmed_text .= '...';
                                        }

                                        return $trimmed_text;
                                    }
                        
                        $sql = "SELECT * FROM item m JOIN restaurants r where m.restaurant_id = r.restaurant_id ORDER BY date DESC limit $offset1, $limit1  ";
                        $result = mysqli_query($con,$sql);
                        $rating = new Rating();
                        // $result = $database->getData();
                        if($result){
                                      while($row = mysqli_fetch_assoc($result)) {
										  $restaurantid = $row["restaurant_id"];
                                          $average = $rating->getRatingAverage($row["item_id"]);



                                         ?>  
                   
                    <div class="col-xs-12 col-sm-6 col-md-4 food-item" >
                        <div class="food-item-wrap">
						
                            <div class="figure-wrap bg-image" data-image-src="img/menupload/<?php echo $row['item_image'];?>"  >
							<?php echo '<center><img class="figure-wrap bg-image"  src="restaurant/menupload/'.$row["item_image"].'" ; width="350px" height="453px" /></center> '; ?>
                            
                                <div class="distance"><i class="fa fa-pin"></i><?php echo $row['cuisines'];?></div>
                                <!-- <div class="rating pull-left"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> </div>
                                 -->
                                <div class="review pull-right"><a href="item_rating.php?item_id=<?php echo $row["item_id"]; ?>">
                                <button type="button" class="btn btn-warning">
                                    Rating and Review <span class="badge badge-light"><?php printf('%.1f', $average); ?> <small>/ 5</small></span>
                                    </button>
                                </a> </div>
                            </div>

                            <div class="content">
                                <h5><a href="#"><?php echo $row["item_name"];?></a></h5>
                                <div class="product-name"><?php echo trim_text($row['description'],30) ?></div>
                                <div class="price-btn-block"> <span class="price">GHS <?php echo $row["price"];?></span> 

                            <form action="" class="form-submit">
  
                           <input type="hidden" class="itemid" value="<?= $row['item_id']?>">
                           <input type="hidden" class="itemname" value="<?= $row['item_name']?>">
                           <input type="hidden" class="itemprice" value="<?= $row['price']?>">
                           <input type="hidden" class="itemimage" value="<?= $row['item_image']?>">
                           <input type="hidden" class="itemcode" value="<?= $row['item_code']?>">
                           <input type="hidden" class="restaurantid" value="<?=  $restaurantid ?>">
                           <b  class="btn theme-btn-dash pull-right"><button type="submit"  class="btn btn-success pull-right addItemBtn">ADD TO CART&nbsp;<i class="fa fa-shopping-cart" style="color:#fff"></i></button></b>
                            </form>
                                     </div>
                            </div>
								
                            <div class="restaurant-block">
                                <div class="left">
                                    <a class="pull-left" href="restaurantdetails.php?far=<?php echo  "".$row['restaurant_id'].""   ?>"> <img src="upload/<?php echo $row["image"];?>" alt="restaurant logo" onerror="this.src='img/demoUpload.jpg'"  width="50px;"/> </a>
                                    <div class="pull-left right-text"> <a href="restaurantdetails.php?far=<?php echo  "".$row['restaurant_id'].""   ?>"><?php echo $row["restaurantname"];?></a></div>
                                </div>
								
                                
                            </div>
                         
                        </div>
                    </div>
					<?php
                            }
                        }
					?>
                    	  <?php
				if($total_pages1 <= (1+($adjacents * 2))) {
					$start1 = 1;
					$end1   = $total_pages1;
				} else {
					if(($page1 - $adjacents) > 1) {				   
						if(($page1 + $adjacents) < $total_pages1) { 
							$start1 = ($page - $adjacents);         
							$end1   = ($page + $adjacents);        
						} else {								   
							$start1 = ($total_pages1 - (1+($adjacents*2)));  
							$end1   = $total_pages1;						  
						}
					} else {									   
						$start1 = 1;                       
						$end1   = (1+($adjacents * 2));  
					}
				}
				//If you want to display all page links in the pagination then
				//uncomment the following two lines
				//and comment out the whole if condition just above it.
				/*$start = 1;
				$end = $total_pages;*/
				?>
                    <!-- Each popular Product item starts -->
                   
                </div>

                <?php if($total_pages1 > 1) { ?>
					<ul class="pagination pagination-sm justify-content-center">
						<!-- Link of the first page -->
						<li class='page-item <?php ($page1 <= 1 ? print 'disabled' : '')?>'>
							<a class='page-link' href='?page1=1'>&lt;&lt;</a>
						</li>
						<!-- Link of the previous page -->
						<li class='page-item <?php ($page1 <= 1 ? print 'disabled' : '')?>'>
							<a class='page-link' href='?page1=<?php ($page1>1 ? print($page1-1) : print 1)?>#farm'>PREVIOUS</a>
						</li>
						<!-- Links of the pages with page number -->
						<?php for($i=$start1; $i<=$end1; $i++) { ?>
						<li class='page-item <?php ($i == $page1 ? print 'active' : '')?>'>
							<a class='page-link' href='?page1=<?php echo $i;?>#farm'><?php echo $i;?></a>
						</li>
						<?php } ?>
						<!-- Link of the next page -->
						<li class='page-item <?php ($page1 >= $total_pages1 ? print 'disabled' : '')?>'>
							<a class='page-link' href='?page1=<?php ($page1 < $total_pages1 ? print($page1+1) : print $total_pages1)?>#farm'>NEXT</a>
						
                        </li>
						<!-- Link of the last page -->
						<li class='page-item <?php ($page1 >= $total_pages1 ? print 'disabled' : '')?>'>
							<a class='page-link' href='?page1=<?php echo $total_pages1;?>'>&gt;&gt;</a>
						</li>
					</ul>
				<?php } ?>
				
            </div>
        </section>

                <?php
            }


        ?>


    </section>
 

        <!-- How it works block starts -->
        <section class="how-it-works ">
            <div class="container">
                <div class="text-xs-center">
                    <h2>Easy 3 Step Order</h2>
                    <!-- 3 block sections starts -->
                    <div class="row how-it-works-solution">
                        <div class="col-xs-12 col-sm-12 col-md-4 how-it-works-steps white-txt col1">
                            <div class="how-it-works-wrap">
                                <div class="step step-1">
                                    <div class="icon" data-step="1">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 483 483" width="512" height="512">
                                            <g fill="#fff">
                                                <path d="M467.006 177.92c-.055-1.573-.469-3.321-1.233-4.755L407.006 62.877V10.5c0-5.799-4.701-10.5-10.5-10.5h-310c-5.799 0-10.5 4.701-10.5 10.5v52.375L17.228 173.164a10.476 10.476 0 0 0-1.22 4.938h-.014V472.5c0 5.799 4.701 10.5 10.5 10.5h430.012c5.799 0 10.5-4.701 10.5-10.5V177.92zM282.379 76l18.007 91.602H182.583L200.445 76h81.934zm19.391 112.602c-4.964 29.003-30.096 51.143-60.281 51.143-30.173 0-55.295-22.139-60.258-51.143H301.77zm143.331 0c-4.96 29.003-30.075 51.143-60.237 51.143-30.185 0-55.317-22.139-60.281-51.143h120.518zm-123.314-21L303.78 76h86.423l48.81 91.602H321.787zM97.006 55V21h289v34h-289zm-4.198 21h86.243l-17.863 91.602h-117.2L92.808 76zm65.582 112.602c-5.028 28.475-30.113 50.19-60.229 50.19s-55.201-21.715-60.23-50.19H158.39zM300 462H183V306h117v156zm21 0V295.5c0-5.799-4.701-10.5-10.5-10.5h-138c-5.799 0-10.5 4.701-10.5 10.5V462H36.994V232.743a82.558 82.558 0 0 0 3.101 3.255c15.485 15.344 36.106 23.794 58.065 23.794s42.58-8.45 58.065-23.794a81.625 81.625 0 0 0 13.525-17.672c14.067 25.281 40.944 42.418 71.737 42.418 30.752 0 57.597-17.081 71.688-42.294 14.091 25.213 40.936 42.294 71.688 42.294 24.262 0 46.092-10.645 61.143-27.528V462H321z" />
                                                <path d="M202.494 386h22c5.799 0 10.5-4.701 10.5-10.5s-4.701-10.5-10.5-10.5h-22c-5.799 0-10.5 4.701-10.5 10.5s4.701 10.5 10.5 10.5z" /> </g>
                                        </svg>
                                    </div>
                                    <h3>Choose a restaurant</h3>
                                    <p>We've got your covered with  restaurants in Accra. </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-4 how-it-works-steps white-txt col2">
                            <div class="step step-2">
                            <div class="icon" data-step="2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewbox="0 0 380.721 380.721">
                                        <g fill="#FFF">
                                            <path d="M58.727 281.236c.32-5.217.657-10.457 1.319-15.709 1.261-12.525 3.974-25.05 6.733-37.296a543.51 543.51 0 0 1 5.449-17.997c2.463-5.729 4.868-11.433 7.25-17.01 5.438-10.898 11.491-21.07 18.724-29.593 1.737-2.19 3.427-4.328 5.095-6.46 1.912-1.894 3.805-3.747 5.676-5.588 3.863-3.509 7.221-7.273 11.107-10.091 7.686-5.711 14.529-11.137 21.477-14.506 6.698-3.724 12.455-6.982 17.631-8.812 10.125-4.084 15.883-6.141 15.883-6.141s-4.915 3.893-13.502 10.207c-4.449 2.917-9.114 7.488-14.721 12.147-5.803 4.461-11.107 10.84-17.358 16.992-3.149 3.114-5.588 7.064-8.551 10.684-1.452 1.83-2.928 3.712-4.427 5.6a1225.858 1225.858 0 0 1-3.84 6.286c-5.537 8.208-9.673 17.858-13.995 27.664-1.748 5.1-3.566 10.283-5.391 15.534a371.593 371.593 0 0 1-4.16 16.476c-2.266 11.271-4.502 22.761-5.438 34.612-.68 4.287-1.022 8.633-1.383 12.979 94 .023 166.775.069 268.589.069.337-4.462.534-8.97.534-13.536 0-85.746-62.509-156.352-142.875-165.705 5.17-4.869 8.436-11.758 8.436-19.433-.023-14.692-11.921-26.612-26.631-26.612-14.715 0-26.652 11.92-26.652 26.642 0 7.668 3.265 14.558 8.464 19.426-80.396 9.353-142.869 79.96-142.869 165.706 0 4.543.168 9.027.5 13.467 9.935-.002 19.526-.002 28.926-.002zM0 291.135h380.721v33.59H0z" /> </g>
                                    </svg>
                                </div>
                                <h3>Choose a healthy meal</h3>
                                <p>Filter through different varieties of meals</p>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-4 how-it-works-steps white-txt col3">
                            <div class="step step-3">
                                <div class="icon" data-step="3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewbox="0 0 612.001 612">
                                        <path d="M604.131 440.17h-19.12V333.237c0-12.512-3.776-24.787-10.78-35.173l-47.92-70.975a62.99 62.99 0 0 0-52.169-27.698h-74.28c-8.734 0-15.737 7.082-15.737 15.738v225.043h-121.65c11.567 9.992 19.514 23.92 21.796 39.658H412.53c4.563-31.238 31.475-55.396 63.972-55.396 32.498 0 59.33 24.158 63.895 55.396h63.735c4.328 0 7.869-3.541 7.869-7.869V448.04c-.001-4.327-3.541-7.87-7.87-7.87zM525.76 312.227h-98.044a7.842 7.842 0 0 1-7.868-7.869v-54.372c0-4.328 3.541-7.869 7.868-7.869h59.724c2.597 0 4.957 1.259 6.452 3.305l38.32 54.451c3.619 5.194-.079 12.354-6.452 12.354zM476.502 440.17c-27.068 0-48.943 21.953-48.943 49.021 0 26.99 21.875 48.943 48.943 48.943 26.989 0 48.943-21.953 48.943-48.943 0-27.066-21.954-49.021-48.943-49.021zm0 73.495c-13.535 0-24.472-11.016-24.472-24.471 0-13.535 10.937-24.473 24.472-24.473 13.533 0 24.472 10.938 24.472 24.473 0 13.455-10.938 24.471-24.472 24.471zM68.434 440.17c-4.328 0-7.869 3.543-7.869 7.869v23.922c0 4.328 3.541 7.869 7.869 7.869h87.971c2.282-15.738 10.229-29.666 21.718-39.658H68.434v-.002zm151.864 0c-26.989 0-48.943 21.953-48.943 49.021 0 26.99 21.954 48.943 48.943 48.943 27.068 0 48.943-21.953 48.943-48.943.001-27.066-21.874-49.021-48.943-49.021zm0 73.495c-13.534 0-24.471-11.016-24.471-24.471 0-13.535 10.937-24.473 24.471-24.473s24.472 10.938 24.472 24.473c0 13.455-10.938 24.471-24.472 24.471zm117.716-363.06h-91.198c4.485 13.298 6.846 27.54 6.846 42.255 0 74.28-60.431 134.711-134.711 134.711-13.535 0-26.675-2.045-39.029-5.744v86.949c0 4.328 3.541 7.869 7.869 7.869h265.96c4.329 0 7.869-3.541 7.869-7.869V174.211c-.001-13.062-10.545-23.606-23.606-23.606zM118.969 73.866C53.264 73.866 0 127.129 0 192.834s53.264 118.969 118.969 118.969 118.97-53.264 118.97-118.969-53.265-118.968-118.97-118.968zm0 210.864c-50.752 0-91.896-41.143-91.896-91.896s41.144-91.896 91.896-91.896c50.753 0 91.896 41.144 91.896 91.896 0 50.753-41.143 91.896-91.896 91.896zm35.097-72.488c-1.014 0-2.052-.131-3.082-.407L112.641 201.5a11.808 11.808 0 0 1-8.729-11.396v-59.015c0-6.516 5.287-11.803 11.803-11.803 6.516 0 11.803 5.287 11.803 11.803v49.971l29.614 7.983c6.294 1.698 10.02 8.177 8.322 14.469-1.421 5.264-6.185 8.73-11.388 8.73z" fill="#FFF" /> </svg>
                                </div>
                                <h3>Pick up or Delivery</h3>
                                <p>Get your order delivered to your location</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- 3 block sections ends -->
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <p class="pay-info">Pay by Cash on delivery , Card or Paypal</p>
                    </div>
                </div>
            </div>
        </section>
        <!-- How it works block ends -->
		
        <!-- Featured restaurants starts -->
        <section class="featured-restaurants" id="farm1">
            <div class="container">
			
                <div class="row">
                    <div class="col-md-4">
                        <div class="title-block pull-left">
                            <h4>Featured Restaurants</h4> 
							</div>
                    </div>
                    <div class="col-md-8">
                        <!-- restaurants filter nav starts -->
                        <div class="farm-filter pull-right">

                          <button class="btn btn-dark btn-outline-warning"> African</button>
                          <button class="btn btn-dark btn-outline-warning"> International </button>
                          <button class="btn btn-dark btn-outline-warning"> India</button>
                          <button class="btn btn-dark btn-outline-warning"> Chinese</button>
                          <button class="btn btn-dark btn-outline-warning"> Ethiopia</button>
                          
                        </div>
                        <!-- farmers filter nav ends -->
                    </div>
                </div>
                <!-- farmers listing starts -->
						<div class="col-md-12">
				<?php
				/*How many records you want to show in a single page.*/
				$limit = 4;
				/*How may adjacent page links should be shown on each side of the current page link.*/
				$adjacents = 2;
				/*Get total number of records */
				$qq = "SELECT COUNT(*) 'total_rows' FROM restaurants";
				$r = mysqli_fetch_object(mysqli_query($con, $qq));
				$total_rows = $r->total_rows;
				/*Get the total number of pages.*/
				$total_pages = ceil($total_rows / $limit);
				
				
				if(isset($_GET['page']) && $_GET['page'] != "") {
					$page = $_GET['page'];
					$offset = $limit * ($page-1);
				} else {
					$page = 1;
					$offset = 0;
				}
                  
				  
				  ?>
				  <div class="container">
				<div class="row text-center py-5">
				
				<?php 
                        $ql="SELECT * FROM restaurants  limit $offset, $limit";
                        $result=mysqli_query($con,$ql);
                        while($row = mysqli_fetch_assoc($result)){
                            ?> 
                        <div class="col-md-3 col-sm-6 my-3 my-md-0">
                        <div class="card shadow" style = "color:#000;background:#eeeeee; border-radius:7px; margin-top:18px;height:300px">
                        <div>
                        <?php echo '<img onerror="this.src=`img/demoUpload.jpg`" class="figure-wrap bg-image" src ="upload/'.$row["image"].'" class="card-img-top" width="100px" height="100px";/>';?>
                        
                        </div>
                        <div class="card-body">
                        <span class="badge badge-success" ><?php echo "<i style='font-size:16px'>".$row['restaurantname']."</i>" ?></span>
                        
                        <hr>
                        <h5 class="card-title"><?php echo "".$row['cuisines']."" ?></h5>
                        <h6>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        </h6>
                        <a href='restaurantdetails.php?far=<?php echo  "".$row['restaurant_id'].""   ?>'><button class="btn btn-warning book_data" id="<?php echo $res; ?>">Learn More </button></a>

                        </div>
                        </div>
                        </div>
                        <br><br><br>
                        <?php
                                        }
				?>
				</div>
				</div>
				  <?php

				//Checking if the adjacent plus current page number is less than the total page number.
				//If small then page link start showing from page 1 to upto last page.
				if($total_pages <= (1+($adjacents * 2))) {
					$start = 1;
					$end   = $total_pages;
				} else {
					if(($page - $adjacents) > 1) {				   //Checking if the current page minus adjacent is greateer than one.
						if(($page + $adjacents) < $total_pages) {  //Checking if current page plus adjacents is less than total pages.
							$start = ($page - $adjacents);         //If true, then we will substract and add adjacent from and to the current page number  
							$end   = ($page + $adjacents);         //to get the range of the page numbers which will be display in the pagination.
						} else {								   //If current page plus adjacents is greater than total pages.
							$start = ($total_pages - (1+($adjacents*2)));  //then the page range will start from total pages minus 1+($adjacents*2)
							$end   = $total_pages;						   //and the end will be the last page number that is total pages number.
						}
					} else {									   //If the current page minus adjacent is less than one.
						$start = 1;                                //then start will be start from page number 1
						$end   = (1+($adjacents * 2));             //and end will be the (1+($adjacents * 2)).
					}
				}
				//If you want to display all page links in the pagination then
				//uncomment the following two lines
				//and comment out the whole if condition just above it.
				/*$start = 1;
				$end = $total_pages;*/
				?>
				
				<?php if($total_pages > 1) { ?>
					<ul class="pagination pagination-sm justify-content-center">
						<!-- Link of the first page -->
						<li class='page-item <?php ($page <= 1 ? print 'disabled' : '')?>'>
							<a class='page-link' href='?page=1'>&lt;&lt;</a>
						</li>
						<!-- Link of the previous page -->
						<li class='page-item <?php ($page <= 1 ? print 'disabled' : '')?>'>
							<a class='page-link' href='?page=<?php ($page>1 ? print($page-1) : print 1)?>#farm1'>PREVIOUS</a>
						</li>
						<!-- Links of the pages with page number -->
						<?php for($i=$start; $i<=$end; $i++) { ?>
						<li class='page-item <?php ($i == $page ? print 'active' : '')?>'>
							<a class='page-link' href='?page=<?php echo $i;?>#farm1'><?php echo $i;?></a>
						</li>
						<?php } ?>
						<!-- Link of the next page -->
						<li class='page-item <?php ($page >= $total_pages ? print 'disabled' : '')?>'>
							<a class='page-link' href='?page=<?php ($page < $total_pages ? print($page+1) : print $total_pages)?>#farm1'>NEXT</a>
						
                        </li>
						<!-- Link of the last page -->
						<li class='page-item <?php ($page >= $total_pages ? print 'disabled' : '')?>'>
							<a class='page-link' href='?page=<?php echo $total_pages;?>'>&gt;&gt;</a>
						</li>
					</ul>
				<?php } ?>
				<?php mysqli_close($con); ?>
 			</div>

               
               
            </div>
        </section>

        <section>
            <?php

                require "./template/footer.php";
            ?>
        </section>

    <script src="./lib/js/jquery.js" ></script>
    <script src="./lib/js/popper.js" ></script>
	
	 <script src="js/choices.js"></script>
	 <script src="js/wow.min.js"></script>
	 
    <script>
      const choices = new Choices('[data-trigger]',
      {
        searchEnabled: false,
        itemSelectText: '',
      });

    </script>
	<script src="./lib/js/gridjs.js" ></script>
	<script>
	  new WOW().init();
	  </script>
	   <script type="text/javascript">
    //menu toggle button
    
    $("#home").addClass('active');
	 //scrolling effect 
	 $(window).on("scroll",function(){
		 if($(window).scrollTop() >=50 ){
			 $('.navbar').css('background','#000').css('border-bottom','solid 1px #f1db88');
			 
		 }
		 else {
			 $('.navbar').css('background','transparent').css('border-bottom','transparent');
			 
		 }
		 
	 })
	
   </script>
   <script src="js/main.js" ></script>
   
  </body>
</html>
