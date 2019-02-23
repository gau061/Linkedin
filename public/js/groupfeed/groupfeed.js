 $(document).ready(function() {
 $('#postImage').change(function(){
        showImage(this);
        $('#postType').val('1');
    });
 });

function showImage(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
        $('.media').html('');
        $('.media').css('display','block')
        $('.media #groupPostImg').css('display','block')
        $('.media').append('<a href="javascript:void(0)" onclick="removeMedia()" class="btn btn-primary media-close" data-type="1"><i class="fa fa-close"></i></a>')
        $('.media').append('<img id="groupPostImg" src="" alt="your image" />')
        $('.media #groupPostImg').attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
  }
}
function removeMedia(){
    var type = $(this).attr("data-type")
    if(type==1){
        $('.media #groupPostImg').attr('src', '');
    }
    $('.media').html('');
    $('#postType').val('0');

}

/* =================================================== */
/* FEED CREATE FUNCTION */
/* =================================================== */
var optionsFeed = { 
    complete: function(response) 
    {
        console.log(response);
        if($.isEmptyObject(response.responseJSON.error)){
            window.location.href = current_page_url;
        }else{
            print_ErrorMsg(response.responseJSON.error);
        }
    }
};

$("body").on("click",".createFeed",function(e){
    $(this).parents("form").ajaxForm(optionsFeed);
});


/* =================================================== */
/* FEED LIKE FUNCTION */
/* =================================================== */
$('#postFeed').on('click', '.feed-like', function(e){
    e.preventDefault();
    var groupId = $(this).attr('data-gid')
    var userId  = $(this).attr("data-user")
    var fuserId  = $(this).attr("data-fuser")
    var postId = $(this).attr("data-feed")
    var thisElement = $(this)    
    if(userId != '') {
        $.ajax({
            type: "GET",
            url:"/groupfeed/like",
            data:"fid="+postId+'&uid='+userId+'&fuid='+fuserId+'&groupId='+groupId,
            dataType: 'json',
            complete: function(){
                // alert('hi');
            },
            success: function(likeData){             
                if(likeData.status == 1){                       
                    thisElement.html('<i class="fa fa-thumbs-up"></i> Like')
                }else{
                    thisElement.html('<i class="fa fa-thumbs-o-up"></i> Like')
                }
                $("#FeedBody-"+postId+" .postLike").html(likeData.feedLikes+" likes")                
                toastr.success(likeData.success, '', {timeOut: 1000})
            },
            error: function(jqXhr, textStatus, errorThrown){
                alert(errorThrown)
                console.log( errorThrown );
            }
        });
    }
});

/* =================================================== */
/* FEED COMMENT FUNCTION */
/* =================================================== */
var comment = {
    complete: function(response) {
        console.log(response);
        if($.isEmptyObject(response.responseJSON.error)){
            var post_id = response.responseJSON.post_id
            //alert(response.responseJSON.feedCommet)            
            var pComment    = response.responseJSON.commentData 
            var commentdata = '<div class="box-comment">'+
                '<img class="img-circle img-sm" src="'+pComment.cmt_profilePid+'" alt="'+pComment.cmt_fullname+'">'+
                '<div class="comment-text">'+
                    '<span class="username">'
                        +pComment.cmt_fullname+
                        '<span class="text-muted pull-right">'+pComment.cmt_commetdate+'</span>'+
                    '</span>'+
                    '<p>'+pComment.cmt_comment+'</p>'+
                '</div>'+
            '</div>'
            $("#comment-"+post_id+" .box-comments").append(commentdata)
            $("#FeedBody-"+post_id+" .postComment").html(response.responseJSON.feedCommet+" comments")
            $("#frm-comment-"+post_id)[0].reset();
            toastr.success(response.responseJSON.success, '', {timeOut: 5000})
        }else{
            print_ErrorMsg(response.responseJSON.error);
        }
    }
}

$('#postFeed').delegate('.feedComment', 'click', function(e){    
    $(this).parents("form").ajaxForm(comment);
});

/* =================================================== */
/* FEED POST REMOVE */
/* =================================================== */
$('#postFeed').on('click', '.removeFeed', function(e){
    var postId = $(this).attr("data-feed")
    var posturl = $(this).attr("data-url")
    var groupId = $(this).attr("data-gid")    
    swal({
        title: "Are you sure?",
        text: "Remove this feed",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: true
    },
    function(isConfirm){
        if (isConfirm){            
            $.ajax({
                type: "GET",
                url:posturl,
                data:"fid="+postId+'&gid='+groupId,
                dataType: 'json',            
                success: function(likeData){                    
                    if(likeData.success){
                        $("#feedPost-"+postId).remove()
                        toastr.success(likeData.success, '', {timeOut: 1000})
                    }else{
                        toastr.error(likeData.error, '', {timeOut: 1000})
                    }
                },
                error: function(jqXhr, textStatus, errorThrown){
                    alert(errorThrown)
                    console.log( errorThrown );
                }
            });
        }
        
    });
});
/* =================================================== */


