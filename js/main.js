$(document).ready(function(){

 $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

$(window).on("scroll",function(){
   if($(window).scrollTop() >=50 ){
      $('.navbar').css('background','#000').css('border-bottom','solid 1px #f1db88');
      
   }
   else {
      $('.navbar').css('background','transparent').css('border-bottom','transparent');
      
   }
   
})
 
$(".itemQty").on('change',function(){
	var $el = $(this).closest('tr');

	var itemid = $el.find(".itemid").val();
	var itemprice = $el.find(".itemprice").val();
	var qty = $el.find(".itemQty").val();

  
   location.reload(true);
	$.ajax({
       url: 'action.php',
       method:'post',
       cache: false,
       data:{qty:qty,itemid:itemid,itemprice:itemprice},
       success: function(response){
       	console.log(response);
        
       }
	});
}); 

   $(".addItemBtn").click(function(e){
    e.preventDefault();
    var $form = $(this).closest(".form-submit");
    var itemid = $form.find(".itemid").val();
    var itemname = $form.find(".itemname").val();
    var price = $form.find(".itemprice").val();
    var itemimage = $form.find(".itemimage").val();
    var itemcode = $form.find(".itemcode").val();
     var restaurantid = $form.find(".restaurantid").val();

    $.ajax({
       url: 'action.php',
       method: 'post',
       data:{itemid:itemid,itemname:itemname,price:price,itemimage:itemimage,itemcode:itemcode,restaurantid:restaurantid},
       success:function(response){
       	 $('#delete_Modal').modal('show'); 
       	$("#message").html(response);
       	load_cart_item_number();
       }
    });
  });
 
 load_cart_item_number();

 function load_cart_item_number(){
 	$.ajax({
       url: 'action.php',
       method: 'get',
       data: {cartItem:"cart_item"},
       success: function(response){
       	$("#cart-item").html(response);
       }
 	});
 }
});
	
	
	
	
	
	

	
	