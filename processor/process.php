<?php

//process.php

$connect = new PDO("mysql:host=localhost; dbname=zielony", "root", "");


if(isset($_GET['cartItem']) && isset($_GET['cartItem']) == 'cart_item'){
	$stmt = $connect->prepare("SELECT * FROM cart");
	$stmt->execute();
	$rows = $stmt->rowCount();
	echo json_encode($rows);
}

if(isset($_GET["page"]))
{
	$data = array();

	$limit = 8;

	$page = 1;

	if($_GET["page"] > 1)
	{
		$start = (($_GET["page"] - 1) * $limit);

		$page = $_GET["page"];
	}
	else
	{
		$start = 0;
	}

	$where = '';

	$search_query = '';

	if(isset($_GET["category_filter"]))
	{
		$where .= ' category = "'.trim($_GET["category_filter"]).'" ';

		$search_query .= '&category_filter='.trim($_GET["category_filter"]);
	}

	if(isset($_GET["price_filter"]))
	{
		if($where != '')
		{
			$where .= ' AND '. $_GET["price_filter"];
		}
		else
		{
			$where .= $_GET["price_filter"];
		}

		$search_query .= '&price_filter='.$_GET["price_filter"];
	}

	if(isset($_GET["location_filter"]))
	{
		$location_array = explode(",", $_GET["location_filter"]);

		$location_condition = '';

		foreach($location_array as $location)
		{
			$location_condition .= 'address = "' .$location . '" OR ';
		}

		$location_condition = substr($location_condition, 0, -4);

		if($where != '')
		{
			$where .= ' AND ('.$location_condition.')';
		}
		else
		{
			$where .= $location_condition;
		}

		$search_query .= '&location_filter='.$_GET["location_filter"];
	}

	if(isset($_GET["search_filter"]))
	{
		$search_string = str_replace(" ", "%", $_GET["search_filter"]);

		if($where != '')
		{
			$where .= ' AND ( product_name LIKE "%'.$search_string.'%" ) ';
		}
		else
		{
			$where .= 'product_name LIKE "%'.$search_string.'%" ';
		}
		$search_query .= '&search_filter='.$_GET["search_filter"].'';
	}

	if($where != '')
	{
		$where = 'WHERE ' . $where;
	}

	$query = "SELECT * FROM product LEFT JOIN farmers ON product.farm_id = farmers.farm_id ".$where." ORDER BY product_id ASC";
	// $query = "SELECT * FROM menu m JOIN farmers r ".$where." m.res_id = r.res_id  ";

	// $query = "
	// SELECT * 
	// FROM menu 
	// ".$where."
	// ORDER BY menu_id ASC
	// ";

	$filter_query = $query . ' LIMIT ' . $start . ', ' . $limit . '';

	$statement = $connect->prepare($query);

	$statement->execute();

	$total_data = $statement->rowCount();

	$result = $connect->query($filter_query);
	
	foreach($result as $row)
	{
		// $image_array = explode(" ~ ", $row["images"]);


		$data[] = array(
			'name'		=>	$row['product_name'],
			'price'		=>	$row['price'],
			'category'		=>	$row['category'],
			'product_id'		=>	$row['product_id'],
			'product_code'		=>	$row['product_code'],
			'farm_id'		=>	$row['farm_id'],
			'description'		=>	$row['description'],
			'location'		=>	$row['address'],
			'image'		=>	$row['product_image']
		);
	}

	$pagination_html = '
	<nav aria-label="Page navigation example" class="justify-content-center item-align-center">
  		<ul class="pagination ">
	';

	$total_links = ceil($total_data/$limit);

	$previous_link = '';

	$next_link = '';

	$page_link = '';

	$page_array = array();

	if($total_links > 4)
	{
		if($page < 5)
		{
			for($count = 1; $count <= 5; $count++)
			{
				$page_array[] = $count;
			}

			$page_array[] = '...';

			$page_array[] = $total_links;
		}
		else
		{
			$end_limit = $total_links - 5;

			if($page > $end_limit)
			{
				$page_array[] = 1;

				$page_array[] = '...';

				for($count = $end_limit; $count <= $total_links; $count++)
				{
					$page_array[] = $count;
				}
			}
			else
			{
				$page_array[] = 1;

				$page_array[] = '...';

				for($count = $page - 1; $count <= $page + 1; $count++)
				{
					$page_array[] = $count;
				}

				$page_array[] = '...';

				$page_array[] = $total_links;
			}
		}
	}
	else
	{
		for($count = 1; $count <= $total_links; $count++)
		{
			$page_array[] = $count;
		}
	}

	for($count = 0; $count < count($page_array); $count++)
	{
		if($page == $page_array[$count])
		{
			$page_link .= '
				<li class="page-item active">
		      		<a class="page-link" href="#">'.$page_array[$count].'</a>
		    	</li>
			';

			$previous_id = $page_array[$count] - 1;

			if($previous_id > 0)
			{
				$previous_link = '<li class="page-item"><a class="page-link" href="javascript:load_product('.$previous_id.', `'.$search_query.'`)">Previous</a></li>';
			}
			else
			{
				$previous_link = '
					<li class="page-item disabled">
				        <a class="page-link" href="#">Previous</a>
				    </li>
				';
			}

			$next_id = $page_array[$count] + 1;

			if($next_id > $total_links)
			{
				$next_link = '
					<li class="page-item disabled">
		        		<a class="page-link" href="#">Next</a>
		      		</li>
				';
			}
			else
			{
				$next_link = '
				<li class="page-item"><a class="page-link" href="javascript:load_product('.$next_id.', `'.$search_query.'`)">Next</a></li>
				';
			}
		}
		else
		{
			if($page_array[$count] == '...')
			{
				$page_link .= '
					<li class="page-item disabled">
		          		<a class="page-link" href="#">...</a>
		      		</li>
				';
			}
			else
			{
				$page_link .= '
					<li class="page-item">
						<a class="page-link" href="javascript:load_product('.$page_array[$count].', `'.$search_query.'`)">'.$page_array[$count].'</a>
					</li>
				';
			}
		}
	}

	$pagination_html .= $previous_link . $page_link . $next_link;


	$pagination_html .= '
		</ul>
	</nav>
	';

	$output = array(
		'data'		=>	$data,
		'pagination'=>	$pagination_html,
		'total_data'=>	$total_data
	);

	echo json_encode($output);
}

if(isset($_GET["action"]))
{
	$data = array();

	$query = "
	SELECT category, COUNT(product_id) AS Total 
	FROM product 
	GROUP BY category
	";

	foreach($connect->query($query) as $row)
	{
		$sub_data = array();
		$sub_data['name'] = $row['category'];
		$sub_data['total'] = $row['Total'];
		$data['category'][] = $sub_data;
	}

	$price_range = array(
		'price < 10'					=>	'Under 10',
		'price > 10 && price < 30'	=>	'10 - 30',
		'price > 30 && price < 50'	=>	'30 - 50',
		'price > 50 && price < 80'=>	'50 - 80',
		'price > 80'					=>	'Over 80'
	);

	foreach($price_range as $key => $value)
	{
		$query = "
		SELECT COUNT(product_id) AS Total 
		FROM product 
		WHERE ".$key." 
		";

		$sub_data = array();

		foreach($connect->query($query) as $row)
		{
			$sub_data['name'] = $value;
			$sub_data['total'] = $row['Total'];
			$sub_data['condition'] = $key;
		}
		$data['price'][] = $sub_data;
	}

	$query = "
	SELECT address, COUNT(product_id) AS Total 
	FROM product 
	GROUP BY address
	";

	foreach($connect->query($query) as $row)
	{
		$sub_data = array();
		$sub_data['name'] = $row['address'];
		$sub_data['total'] = $row['Total'];
		$data['location'][] = $sub_data;
	}

	echo json_encode($data);
}

?>