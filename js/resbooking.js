    $(document).ready(function(){ 
         $(document).on('click', '.book_data', function(){  
           var resbook_id = $(this).attr("id");  
           $.ajax({  
                url:"php/fetchrestoowners.php",  
                method:"POST",  
                data:{resbook_id:resbook_id},  
                dataType:"json",  
                success:function(data){
					$('#resid').val(data.res_id);
                     $('#rname').html("<h5>"+data.rname+"</h5>");  
                    $('#image').attr('src','upload/'+data.image);  
                     $('#resModal').modal('show');  
                }  
           });  
      }); 
     
     });
     $('#insert_form').on("submit", function(event){  
           event.preventDefault();  
           // Create variables from the form
        
         $.ajax({  
                     url:"php/booksubmitform.php",  
                     method:"POST",  
                     data:$('#insert_form').serialize(),  
                     beforeSend:function(){  
                         $("#loader").html('<center><img src="img/loaderp.gif" width="100px" /></center>');
							$('.modal-body').css('opacity', '.5');
										},  
                     success:function(data){ 
						 					 
                   if(data = "response") {
					   $('.modal-body').css('opacity','');
					   $("#loader").html(' <center><p style="color:green" >Table successfully Booked</p></center>');
						setTimeout(function(){
						window.location = "restaurant.php"
							},6000);                                                                               
                     }  
		 }
                }); 
            
     
      }); 

     //Delete brand function
      $(document).ready(function(){ 
         $(document).on('click', '.delete_data', function(){  
           var lecturer_id = $(this).attr("id");  
           $.ajax({  
                url:"php/deletefetchofficer.php",  
                method:"POST",  
                data:{lecturer_id:lecturer_id},  
                dataType:"json",  
                success:function(data){  
                    $('#lecturer_id').val(data.off_id);
                     $('#lecd_id').val(data.id);  
                     $('#delete_Modal').modal('show');  
                }  
           });  
      }); 
     
     });
     $('#delete_form').on("submit", function(event){  
           event.preventDefault();  
           // Create variables from the form
         $.ajax({  
                     url:"php/deleteofficer.php",  
                     method:"POST",  
                     data:$('#delete_form').serialize(),  
                     beforeSend:function(){  
                         $("#loader2").html('<center><img src="img/loading.gif" width="100px" /></center>');
                      $('.modal-body').css('opacity', '.5');
                     },  
                     success:function(data){  
                           setTimeout(function(){  
                  $('#loader2').html('<p style="font-size:14px" class="text-success wow shake">officer successfully Deleted</p>');  
                          
                 setTimeout(function(){
               window.location = "officer.php"
                 },2300);
                $('.modal-body').css('opacity','');            
                $('#loader').fadeOut("slow");
                          }, 2000);
                          
                     }  
                }); 
            
     
      }); 