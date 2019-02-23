var date = new Date()
var lastDay = new Date(date.getFullYear(), date.getMonth() + 1 , date.getDate() )
var lastDayWithSlashes = ('0' + lastDay.getDate()).slice(-2) + '/' + ('0' + lastDay.getMonth()).slice(-2) + '/' + lastDay.getFullYear()
var time = ('0' + date.getHours()).slice(-2) +':'+ ('0' + date.getMinutes()).slice(-2)

var hours = date.getHours();
var minutes = date.getMinutes();
var ampm = hours >= 12 ? 'PM' : 'AM';
hours = hours % 12;
hours = hours ? hours : 12; // the hour '0' should be '12'
minutes = minutes < 10 ? '0'+minutes : minutes;
var strTime = ('0' + hours).slice(-2) + ':' + minutes + ' ' + ampm;


// $('#msg').keydown(function(event) {
//     if (event.keyCode == 13) {
//     	event.preventDefault();
//         this.form.submit();
//         return true;
//      }
// });

$(document).ready(function() {
	ChatScrollDown()
	$('.msg').focus();
});

function ChatScrollDown(){
	var $elem = $('.div-chat')
	$(".aside-with-chat").animate({ scrollTop: $('.aside-with-chat').prop("scrollHeight")}, 0);
	// $('.aside-with-chat').animate({scrollTop: $elem.height()}, 800);
}

$('body').on('click','.msg-send', function(e){	
	$(this).parents('form').ajaxForm({
		success:function(data){			
			//alert(data.userMessage + data.userImage)
			if(data.message == null){
				$('.msg').focus();

			}
			else{	            
	            var div = ''+
				'<div class="message-feed right">'+
					'<div class="pull-right">'+
						'<img src="'+ data.userImage +'" alt="" class="img-avatar">'+
					'</div>'+
					'<div class="media-body body-right">'+
						'<div class="mf-content">' + data.message + '</div>'+
						'<small class="mf-date"><i class="fa fa-clock-o"> </i>'+'  ' + lastDayWithSlashes + ' at '+ strTime +'</small>'+
					'</div>'+
				'</div>'
 				$('.div-chat').append(div); 				
	            $('#forms')[0].reset();
	            $('.msg').focus();
	            // $('#check-mark').html('');
	            ChatScrollDown()
			}
		}
	});
});


$('body').on('click','.delete-msg',function(e){
		e.preventDefault();
	if (confirm("Are you sure?")) {
		var id = $(this).data('id');
		$.ajax({
			url: '/message/delete/'+id,
			type: 'GET',
			success:function(data){
				$('.div-chat').text('');
				toastr.success(data,'', {timeOut: 5000})
			}
		})
    }
    return false;
});

// function submitOnEnter(event,id) {

//     if (event.keyCode == 13) {	

//     	var data = $("#msg").val();
//     	event.preventDefault();
//     	$.ajaxSetup({
//           	headers: {
// 	            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
// 	        }
// 		});
//     	var token = $('meta[name="_token"]').attr('content'); 

// 		$.ajax({
// 	       type:'POST',
// 	       url :"/message/send/"+id,
// 	       dataType:'JSON',
// 	       data:{_token:token,message:data},
// 	       success:function(data){
// 	            if(data.message == null){
// 					$('.msg').focus();
// 				} else {
// 					var div = '<div class="mf-content">' + data.message + '</div>'+'<small class="mf-date"> <i class="fa fa-clock-o"> </i>'+' ' + lastDayWithSlashes + ' at '+ strTime +'</small>';
// 		            $('.body-right').append(div);
// 		            $('#forms')[0].reset();
// 		            // Scroll bar
// 		            var div = ''+
// 					'<div class="message-feed right">'+
// 						'<div class="pull-left">'+
// 							'<img src="public/img/guy-3.jpg" alt="" class="img-avatar">'+
// 						'</div>'+
// 						'<div class="media-body body-right">'+
// 							'<div class="mf-content">' + data.message + '</div>'+
// 							'<small class="mf-date"><i class="fa fa-clock-o"> </i>'+'  ' + lastDayWithSlashes + ' at '+ time +'</small>'+
// 						'</div>'+
// 					'</div>'
// 	 				$('.div-chat').append(div);

// 		            var $elem = $('.div-chat')
// 			    	$('.aside-with-chat').animate({scrollTop: $elem.height()}, 800);
// 				}
//        		}
//         });
//     }
// }




$('.pageChange').click(function(){


	 
	var userId = $(this).attr("data-id")
	var userName = $(this).attr("data-username")

	var datas = history.pushState(null, null, '/messages/'+userId);

	var url=window.location.href;
	var arr=url.split('/')[4];




	$('.chat-name').text(' ');
	$('.chat-name').text(userName);

	 location.reload();
	 window.location.href = window.location.href;
	$.ajax({
		url: "/message/fetch/"+arr,
		cache: false,
		dataType: "json",
		success: function (data) {

					$('.div-chat').html('')
					console.log(data)
					$.each(data[0], function(key, value) {
						var date = new Date(value.created_at)
						var lastDay = new Date(date.getFullYear(), date.getMonth() + 1 , date.getDate() )
						var lastDayWithSlashes = ('0' + lastDay.getDate()).slice(-2) + '/' + ('0' + lastDay.getMonth()).slice(-2) + '/' + lastDay.getFullYear()
						var time = ('0' + date.getHours()).slice(-2) +':'+ ('0' + date.getMinutes()).slice(-2)

						var hours = date.getHours();
						var minutes = date.getMinutes();
						var ampm = hours >= 12 ? 'PM' : 'AM';
						hours = hours % 12;
						hours = hours ? hours : 12; // the hour '0' should be '12'
						minutes = minutes < 10 ? '0'+minutes : minutes;
						var strTime = ('0' + hours).slice(-2) + ':' + minutes + ' ' + ampm;

						if (value.chatbox_id == 'R_'+ arr) {
							var fc = 'right'
							var bc = 'body-right'
							var ic = 'pull-right'
							var image = data[2]['user']
						}else{
							var fc = 'left'
							var bc = 'body-left'
							var ic = 'pull-left'
							var image = data[2]['friend']
						}


						var div = ''+
						'<div class="message-feed '+fc+'">'+
							'<div class="'+ic+'">'+
								'<img src="'+image+'" alt="" class="img-avatar">'+
							'</div>'+
							'<div class="media-body '+bc+'">'+
								'<div class="mf-content">' + value.message + '</div>'+'<small class="mf-date"><i class="fa fa-clock-o"> </i>'+'  ' + lastDayWithSlashes + ' at '+ strTime +'</small>'+
							'</div>'+
						'</div>'
		 				$('.div-chat').append(div);
		 				
					});
	 				ChatScrollDown()
		},
		error: function (jqXHR, textStatus, errorThrown) {
			console.log(textStatus, errorThrown);
		}
	});

});


$('.msg-read').click(function(){
	var s_id = $(this).attr('data-id');

	$.ajax({
		url:'/msg/read/'+s_id,
		method:'get',
		data:s_id,
		success:function(response){
			console.log(response);
		}
	});
});



var timeout = setTimeout(reloadChat, 5000);

function reloadChat () {
	var url=window.location.href;
	var id=url.split('/')[4];
	    
	// $('.left').load('/message/'+arr,function () {
	//     $(this).unwrap();
	timeout = setTimeout(reloadChat, 5000);

	    $.ajax({
	    	url:'/new/msg/fetch/'+id,
	    	method:'get',
	    	success:function(response){
	    		if(!jQuery.isEmptyObject(response)){

	    			for (var i = 0; i < response.length; i++) {
			    		var div = ''+
						'<div class="message-feed left">'+
							'<div class="pull-left">'+
								'<img src="'+ response[i].profile_pic +'" alt="" class="img-avatar">'+
							'</div>'+
							'<div class="media-body body-left">'+
								'<div class="mf-content">'+ response[i].message + '</div>'+'<small class="mf-date"><i class="fa fa-clock-o"> </i>'+'  ' + lastDayWithSlashes + ' at '+ strTime +'</small>'+
							'</div>'+
						'</div>'
			 			$('.div-chat').append(div);
			 			
	    			}

	    		}
				$.ajax({
					url: '/new/msg/status/'+id,
					method: 'get',
					success:function(data){
						console.log(data);
						$('#check-mark').html('');
					}
				})
	    	}
	    })


	// });

}