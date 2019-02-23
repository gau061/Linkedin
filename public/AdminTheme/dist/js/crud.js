
$(".remove-crud").click(function(){
	var current_object = $(this);

   	    bootbox.confirm("Are you sure delete this item?", function(result) {
        if(result){ 
            var action = current_object.attr('data-action');
            var token = $('input [name="_token"]').val();

            var id = current_object.attr('data-id');
	

			$('body').html("<form class='form-inline remove-form' method='POST' action='"+action+"'></form>");
			$('body').find('.remove-form').append('<input name="_token" type="hidden" value="'+ token +'">');
			$('body').find('.remove-form').append('<input name="id" type="hidden" value="'+ id +'">');
			$('body').find('.remove-form').submit();
		}
	}); 
});