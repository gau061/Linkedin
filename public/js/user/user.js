var optionsUser = { 
    complete: function(response) 
    {
    	console.log(response);
        if($.isEmptyObject(response.responseJSON.error)){
            window.location.href = current_page_url;
        }else{
            printErrorMsg(response.responseJSON.error);
        }
    }
};

$("body").on("click",".create",function(e){
	$(this).parents("form").ajaxForm(optionsUser);
});

function printErrorMsg (msg) {
	$(".print-error-msg").find("ul").html('');
	$(".print-error-msg").css('display','block');
	$.each( msg, function( key, value ) {
		$(".print-error-msg").find("ul").append('<li style="display:block;padding:2px 0 0 0;"><i class="fa fa-times">&nbsp;&nbsp;</i>'+value+'</li>');
	});
}
