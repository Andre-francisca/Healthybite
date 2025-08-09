
function $(selector){

    return document.querySelector(selector);

}

const navbar = document.querySelector('.fixed-top');
window.onscroll = () => {
    if (window.scrollY > 300) {
        navbar.classList.add('nav-active');
    } else {
        navbar.classList.remove('nav-active');
    }
};

load_cart_item_number();
function load_cart_item_number(cartItem)
{

 fetch('./processor/process.php?cartItem='+cartItem+'').then(function(response){
       return response.json()
   }).then(function(responseData){

     $('#cart-item').innerHTML = responseData;
   })

}

load_product(1);

function load_product(page = 1, query = '')
{
    $('#product_area').style.display = 'none';

    $('#skeleton_area').style.display = 'block';

    $('#skeleton_area').innerHTML = make_skeleton();

    fetch('./processor/process.php?page='+page+query+'').then(function(response){

        return response.json();

    }).then(function(responseData){

        var html = '';

        if(responseData.data){
          
            
            if(responseData.data.length > 0){
                 html += '<button type="button" class="btn btn-dark mt-3">Products Found <span class="badge badge-light">'+responseData.total_data+'</span></button>';
                html += '<div class="row">';
                
                for(var i = 0; i < responseData.data.length; i++){

                   html += '<div class="col-xs-12 col-sm-6 col-md-3 food-item mb-2 p-3">';
                   html += '<div class="food-item-wrap ">';
                   html += '<div class="figure-wrap bg-image " data-image-src="farmers/menupload/+responseData.data[i].image+">';
                   html += '<center><img class="figure-wrap bg-image"  src="farmers/menupload/'+responseData.data[i].image+'" /></center>';

                   html += '<div class="distance"><i class="fa fa-pin"></i>'+responseData.data[i].category+'</div>';
                   html += '<div class="rating pull-left"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> </div>';
                   html += '<div class="review pull-right"><a href="#">198 reviews</a> </div>';
                   html += '</div>';


                   html += '<div class="content">';

                   html += '<h5><a href="#">'+responseData.data[i].name+'</a></h5>';

                   html += '<div class="product-name">'+responseData.data[i].description+'</div>';

                   html += ' <div class="price-btn-block"> <span class="price">PLN '+responseData.data[i].price+'</span> ';

                   html +="<form action='' class='form-submit' >"
                   html += '<input type="hidden" class="menuid " id="product_id" value="'+responseData.data[i].product_id+'">';
                   html += '<input type="hidden" class="menuid" id="productname" value="'+responseData.data[i].name+'">';
                   html += '<input type="hidden" class="menuid" value="'+responseData.data[i].price+'">';
                   html += '<input type="hidden" class="menuid" value="'+responseData.data[i].image+'">';
                   html += '<input type="hidden" class="menuid" value="'+responseData.data[i].product_code+'">';
                   html += '<input type="hidden" class="menuid" value="'+responseData.data[i].farm_id+'">';
                   html += '<input type="hidden" class="menuid" value="'+responseData.data[i].location+'">';
                  

                   html += ' <b  class="btn theme-btn-dash pull-right"><button type="button"  class="btn btn-success pull-right addItemBtn" id="'+responseData.data[i].product_code+'" >Add to Cart&nbsp;<i class="fa fa-shopping-cart" style="color:#000"></i></button></b>';
                   html += '</form>';
                   html += '</div>';
                   html += '</div>';


                   html += '</div>';
                   html += '</div>';
                   

                   
                    
                }
                
                html += '</div>';
                $('#product_area').innerHTML = html

               
                var addbtn =  document.getElementsByClassName('addItemBtn'); 

                for(var i = 0; i < addbtn.length; i++)
                {
                    addbtn[i].onclick = function()
                    {

                        remove_active_class(addbtn);
                        this.classList.add('active');
                        
                        load_product(page = 1, make_query());
                        
                    }
                }

                

                
               
            }else{
                $('#product_area').innerHTML = '<p class="h6">No Product Found</p>';
            }
        }


        if(responseData.pagination)
        {
            
          
            $('#pagination_area').innerHTML = responseData.pagination;
          
           
        }

        setTimeout(function(){

            $('#product_area').style.display = 'block';

            $('#skeleton_area').style.display = 'none';

        }, 3000);

    });
}

function make_skeleton()
{
    var output = '<div class="row">';

    for(var count = 0; count < 8; count++)
    {
        output += '<div class="col-md-3 mb-3 p-4">';

        output += '<div class="mb-2 bg-light text-dark" style="height:240px;"></div>';

        output += '<div class="mb-2 bg-light text-dark" style="height:50px;"></div>';

        output += '<div class="mb-2 bg-light text-dark" style="height:25px;"></div>';

        output += '</div>';
    }

    output += '</div>';

    return output;
}

load_filter();

function load_filter()
{
    fetch('./processor/process.php?action=filter').then(function(response){

        return response.json();

    }).then(function(responseData){

        if(responseData.category)
        {

            if(responseData.category.length > 0)            
            {
                var html = '<div class="list-group">';

                for(var i = 0; i < responseData.category.length; i++)
                {
                    html += '<label class="list-group-item">';

                    html += '&nbsp;<input id="cb2" type="radio" class="form-check-input me-1 category_filter" name="category_filter" value="'+responseData.category[i].name+'" >';

                    html += responseData.category[i].name+' <span class="text-muted">('+responseData.category[i].total+')</span>';

                    html += '</label>';
                }

                html += '</div>';

                $('#category_filter').innerHTML = html;

                var category_elements = document.getElementsByClassName('category_filter');

                for(var i = 0; i < category_elements.length; i++)
                {

                    
                    category_elements[i].onclick = function(){
                        
                        load_product(page = 1, make_query());

                    }
                }
            }

        }

        if(responseData.price)
        {
            if(responseData.price.length > 0)
            {
                var html = '<div class="list-group">';

                for(var i = 0; i < responseData.price.length; i++)
                {
                    html += '<a href="#" class="list-group-item list-group-item-action price_filter" id="'+responseData.price[i].condition+'"><span><b>PLN</b></span> '+responseData.price[i].name+' <span class="text-muted">('+responseData.price[i].total+')</a>';
                }

                html += '</div>';

                $('#price_filter').innerHTML = html;

                var price_elements = document.getElementsByClassName('price_filter');

                for(var i = 0; i < price_elements.length; i++)
                {
                    price_elements[i].onclick = function()
                    {
                        remove_active_class(price_elements);

                        this.classList.add('active');

                        load_product(page = 1, make_query());
                    }
                }
            }
        }

        if(responseData.location)
        {
            if(responseData.location.length > 0)
            {
                var html = '<div class="list-group">';

                for(var i = 0; i < responseData.location.length; i++)
                {
                    html += '<label class="list-group-item">';

                    html += '&nbsp;<input id="cb2" type="checkbox" class="form-check-input me-1 location_filter"  value="'+responseData.location[i].name+'" />';

                    html += responseData.location[i].name + ' <span class="text-muted">('+responseData.location[i].total+')</span>';

                    html += '</label>';
                }

                html += '</div>';

                $('#location_filter').innerHTML = html;

                var location_elements = document.getElementsByClassName("location_filter");

                for(var i = 0; i < location_elements.length; i++)
                {
                    location_elements[i].onclick = function(){

                        load_product(page = 1, make_query());

                    }
                }
            }
        }

    });
}

function make_query()
{
    var query = '';

    var category_elements = document.getElementsByClassName('category_filter');

    for(var i = 0; i < category_elements.length; i++)
    {
        if(category_elements[i].checked)
        {
            query += '&category_filter='+category_elements[i].value+'';
        }
    }


    var addbtn =  document.getElementsByClassName('addItemBtn'); ;

    for(var i = 0; i < addbtn.length; i++)
    {

        if(addbtn[i].matches('.active'))
        {

            var productcode = addbtn[i].getAttribute('id')

            fetch('./action.php?productcode='+productcode+'').then(function(response){

                return response.json();
        
            }).then(function(responseData){

                load_cart_item_number();
                var myModal = new bootstrap.Modal(document.getElementById("delete_Modal"), {});
                myModal.show();
                // new bootstrap.Modal(delete_Modal).show();
                $('#message').innerHTML = responseData;
               
            })
        }
      
    }





    var price_elements = document.getElementsByClassName('price_filter');

    for(var i = 0; i < price_elements.length; i++)
    {
        if(price_elements[i].matches('.active'))
        {
            query += '&price_filter='+price_elements[i].getAttribute('id')+'';
        }
    }

    var location_elements = document.getElementsByClassName('location_filter');

    var locationlist = '';

    for(var i = 0; i < location_elements.length; i++)
    {
        if(location_elements[i].checked)
        {
            locationlist += location_elements[i].value +',';
        }
    }

    if(locationlist != '')
    {
        query += '&location_filter='+locationlist+'';
    }

    var search_query = $('#search_textbox').value;

    query += '&search_filter='+search_query+'';

    return query;
}

function remove_active_class(element)
{
    for(var i = 0; i < element.length; i++)
    {
        if(element[i].matches('.active'))
        {
            element[i].classList.remove("active");
        }
    }
}

$('#clear_filter').onclick = function(){

    var category_elements = document.getElementsByClassName('category_filter');

    for(var count = 0; count < category_elements.length; count++)
    {
        category_elements[count].checked = false;
    }

    var price_elements = document.getElementsByClassName('price_filter');

    remove_active_class(price_elements);

    var location_elements = document.getElementsByClassName('location_filter');

    for(var count = 0; count < location_elements.length; count++)
    {
        location_elements[count].checked = false;
    }

    $('#search_textbox').value = '';

    load_product(1, '');

}

$('#search_button').onclick = function(){

    var search_query = $('#search_textbox').value;

    if(search_query != '')
    {
        load_product(page = 1, make_query());
    }

}




