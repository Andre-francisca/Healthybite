$(function() {
	 jQuery.validator.setDefaults({
    errorElement: 'span',
    errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
    }
}); //for red border warning
	
 $("#profilet").validate({
				
				rules:{
				
				password: {
					required: true,				
				}
			    },
				messages: {
					password: {
			
					     required:	"please enter your password"
					
					}
				},
				submitHandler: function(form) {	
					
				//$(".error").html('<img src="img/loading1.gif" width="200px" />');
		// Create variables from the form
				var fname = $("#fname").val();
				var email = $("#email").val();
				var phone = $("#phone").val();
				var pid = $("#pid").val();
				var password = $("#password").val();
				$.post("profileprocess.php",{
					beforeSend:function(){  
                         // $('#response').html('<center><img src="img/loading1.gif" width="180px"/></center>'); 
						//$("#loading").html('<center><img src="img/loading.gif" width="100px" /></center>');
						$('.modal-body').css('opacity', '.4');						  
                     }, 
					fname: fname,pid:pid,email: email,phone: phone, password: password})
				 .done(function(data){
					      if(data == "success"){
							  $('.modal-body').css('opacity', '');
						$("#messages").html(' <center><p style="color:green" >Profile successfully updated</p></center>');
						$("#loading").html('<img src="img/loaderp.gif" width="14px" /> &nbsp;Updated');
                           setTimeout(function(){ 
							
                                window.location = "profile.php";
                          }, 4000); 
                          
					             }
					else{
						
						 setTimeout(function(){  
                              $("#messages").html(' <center><p style="color:red" class="wow shake">Invalid Credentials</p></center>');
							$('.modal-body').css('opacity', '');  
                          }, 5000); 
						
					}
					
				})
            
          }
 });  //button validation


});
	
	