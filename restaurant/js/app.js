$(document).ready(function() {




    $('#category').change(function() {
            
        var id = $(this).find(':selected')[0].id;
        $.ajax({
            type:'POST',
            url:'./php/getsubCategory.php',
            data:{id:id},
            cache: false,
            success:function(data){
                $("#subcategory").html(data);
            }
        });
    });

})