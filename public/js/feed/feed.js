
$(document).ready(function() {
    $("#ApostImage").change(function() {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
              $('#artImg').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });

    $('#postImage').change(function(){
        //alert('hello');
        $('#postVideo').val("");           
        $('.media #pVideo source').attr('src', '');
        showImage(this);
        $('#postType').val('1');
    });


    $('#postVideo').click(function(){        
        $('#postImage').val("");
        $('.media #pImg').attr('src', '');
        showVideo(this);
        $('#postType').val('2');
    });
});

function showImage(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
        $('.media').html('');
        $('.media').css('display','block')
        $('.media #pImg').css('display','block')
        $('.media').append('<a href="javascript:void(0)" onclick="removeMedia()" class="btn btn-primary media-close" data-type="1"><i class="fa fa-close"></i></a>')
        $('.media').append('<img id="pImg" src="" alt="your image" />')
        $('.media #pImg').attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
  }
}
function showVideo(input) {
    $('.media').html('');
    $('.media').css('display','block')
    $('.media #pVideo').css('display','block')
    $('.media').append('<a href="javascript:void(0)" onclick="removeMedia()" class="btn btn-primary media-close" data-type="2"><i class="fa fa-close"></i></a>')
    $('.media').append('<input type="text" class="form-control input-md videotextarea" placeholder="Youtube/Vimeo Video Id" name="post_video" />')    
}
function removeMedia(){
    var type = $(this).attr("data-type")
    alert(type);
    if(type==1){
        $('.media #pImg').attr('src', '');
    }
    if(type==2){
        $('.media #pVideo source').attr('src', '');
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
function print_ErrorMsg (msg) {
    $(".print-error-msg").find("ul").html('');
    $(".print-error-msg").css('display','block');
    $.each( msg, function( key, value ) {
        $(".print-error-msg").find("ul").append('<li style="display:block;padding:2px 0 0 0;"><i class="fa fa-times">&nbsp;&nbsp;</i>'+value+'</li>');
    });
}
/* =================================================== */
/* FEED SHARE FUNCTION */
/* =================================================== */
$('#postFeed').on('click', '.feed-share', function(e){
    e.preventDefault();
    var userId      = $(this).attr("data-user")
    var fuserId     = $(this).attr("data-fuser")
    var postId      = $(this).attr("data-feed")
    var thisElement = $(this)
    if(userId != '') {
        // $('#feedSharData #postId').val(postId);
        // $('#feedSharData #postId').val(postId);
        // $("#feedShareModal").modal()

        $.ajax({
            type: "GET",
            url:"/feed/share",
            data:"fid="+postId+'&uid='+userId+'&fuid='+fuserId,
            // dataType: 'json',
            complete: function(){
            },
            success: function(shareData){
                var postData = shareData.feedData
                //alert(shareData)
                // console.log(shareData)
                $('#feedSharData #postId').val(postId);
                $('#feedSharData #feedData').html(postData);
                $("#feedShareModal").modal()
                // toastr.success(shareData.success, '', {timeOut: 1000})
            },
            error: function(jqXhr, textStatus, errorThrown){
                alert(errorThrown)
                console.log( errorThrown );
            }
        });
    }
});
/* =================================================== */
/* FEED LIKE FUNCTION */
/* =================================================== */
$('#postFeed').on('click', '.feed-like', function(e){
    e.preventDefault();
    var userId  = $(this).attr("data-user")
    var fuserId  = $(this).attr("data-fuser")
    var postId = $(this).attr("data-feed")
    var thisElement = $(this)    
    if(userId != '') {
        $.ajax({
            type: "GET",
            url:"/feed/like",
            data:"fid="+postId+'&uid='+userId+'&fuid='+fuserId,
            dataType: 'json',
            complete: function(){
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
/* FEED POST REMOVE */
/* =================================================== */
$('#postFeed').on('click', '.removeFeed', function(e){
    var postId = $(this).attr("data-feed")
    var posturl = $(this).attr("data-url")
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
                data:"fid="+postId,
                dataType: 'json',            
                success: function(likeData){                    
                    if(likeData.success){
                        $("#feedPost-"+postId).remove()
                        toastr.success(likeData.success, '', {timeOut: 1000})
                    }else{
                        toastr.error(likeData.error, '', {timeOut: 1000})
                    }
                    //swal("Deleted!", "Your imaginary file has been deleted.", "success");
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