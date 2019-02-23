
$('.summernote').summernote({
	height: 600,


	// toolbar
      toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'italic', 'underline','clear']],
        ['fontname', ['fontname']],
        ['fontsize', ['fontsize']], 
        ['foreColor', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['height', ['height']],
        ['table', ['table']],
        ['insert', ['link', 'picture']],
        // ['view', ['fullscreen', 'codeview']],
        ['help', ['undo','redo','help']]
      ],

      // style tag
      styleTags: ['p', 'blockquote', 'pre', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6'],

      // default fontName
      defaultFontName: 'Arial',

      // fontName
      fontNames: [
        'Serif', 'Sans', 'Arial', 'Arial Black', 'Courier',
        'Courier New', 'Comic Sans MS', 'Helvetica', 'Impact', 'Lucida Grande',
        'Lucida Sans', 'Tahoma', 'Times', 'Times New Roman', 'Verdana'
      ],

      // pallete colors(n x n)
      colors: [
        ['#000000', '#424242', '#636363', '#9C9C94', '#CEC6CE', '#EFEFEF', '#F7F7F7', '#FFFFFF'],
        ['#FF0000', '#FF9C00', '#FFFF00', '#00FF00', '#00FFFF', '#0000FF', '#9C00FF', '#FF00FF'],
        ['#F7C6CE', '#FFE7CE', '#FFEFC6', '#D6EFD6', '#CEDEE7', '#CEE7F7', '#D6D6E7', '#E7D6DE'],
        ['#E79C9C', '#FFC69C', '#FFE79C', '#B5D6A5', '#A5C6CE', '#9CC6EF', '#B5A5D6', '#D6A5BD'],
        ['#E76363', '#F7AD6B', '#FFD663', '#94BD7B', '#73A5AD', '#6BADDE', '#8C7BC6', '#C67BA5'],
        ['#CE0000', '#E79439', '#EFC631', '#6BA54A', '#4A7B8C', '#3984C6', '#634AA5', '#A54A7B'],
        ['#9C0000', '#B56308', '#BD9400', '#397B21', '#104A5A', '#085294', '#311873', '#731842'],
        ['#630000', '#7B3900', '#846300', '#295218', '#083139', '#003163', '#21104A', '#4A1031']
      ],

      // fontSize
      fontSizes:['8', '9', '10', '11', '12', '14', '16', '18', '24', '36'],

      // lineHeight
      lineHeights: ['1.0', '1.2', '1.4', '1.5', '1.6', '1.8', '2.0', '3.0'],


});

$('.date').datepicker({
	format:'yyyy-mm-dd',
	useCurrent: true,
});

$(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});

$('.show-more').click(function(){
	$('.skill-toogle').slideToggle(333)

	if ($(this).html() == 'Show More') {
  		$(this).html('Hide');
    } else{
      	$(this).html('Show More');                
    }
    
});

$('.exe-show').click(function(){
	$('.exe-toogle').slideToggle(333)

	if ($(this).html() == 'Show More') {
  		$(this).html('Hide');
    } else{
      	$(this).html('Show More');                
    }
    
});

$('.edu-show').click(function(){
	$('.edu-toogle').slideToggle(333)

	if ($(this).html() == 'Show More') {
  		$(this).html('Hide');
    } else{
      	$(this).html('Show More');                
    }
    
});


$('.checkbox8').change(function(){
	if ($(this).prop('checked') == true) {
		$('.to-yser').css('display','none');
		$('.pre').css('display','block');
		$(this).html('Present');
	}else{
		$('.to-yser').css('display','block');
		$('.pre').css('display','none');
	}
});

$('.checkbox7').change(function(){
	if ($(this).prop('checked') == true) {
		$('.to-yser').css('display','none');
		$('.pre').css('display','block');
		$(this).html('Present');
	}else{
		$('.to-yser').css('display','block');
		$('.pre').css('display','none');
	}
});



function isNumber(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
    }


function sub1(slug){

  if (slug == 'CoverImage') {
     var form = new FormData(document.getElementById('avatar_form'));
     var file = document.getElementById('coverPic').files[0];

     if (file) {   
          form.append('coverPic', file);
      }
  }else{
     var form = new FormData(document.getElementById('profile_form'));
     var file = document.getElementById('proPic').files[0];

     if (file) {   
          form.append('proPic', file);
      }
  }
      $.ajax({
        type: 'post',
        url: "/profile/cover/"+slug,
        data:form,
        cache: false,
        contentType: false,
        processData: false,
        success: function ( output ) {
          if (output == 'cover') {
            $("#CoverImage").load(current_page_url+" #CoverImage>*");
            toastr.success('Your Cover Image is Updated.', '', {timeOut: 5000})
          }else{
            $("#ProfileImage").load(current_page_url+" #ProfileImage>*");
            toastr.success('Your Profile Image is Updated.', '', {timeOut: 5000})
          }
        }
    });

}

$('.msg-cncel').click(function(){
  var urls = $(this).attr('data-url');
  //alert(urls);
  swal({
    title: "Are you sure?",
    text: "Are you sure  to cancel this request ?",
    type: "warning",
    showCancelButton: true,
    confirmButtonClass: "btn-danger",
    confirmButtonText: "Yes, delete it!",
    cancelButtonText: "No",
    closeOnConfirm: false,
    closeOnCancel: false
  },
  function(isConfirm) {
    if (isConfirm) {
      $.ajax({
        url:urls,
        method:'get',
      })
      swal({
        title:"Request Cancelled.",
        text:' ',
        type:'success',
      },function(){
        location.reload();
      })
    } else {
      swal("Not Cancel", " ", "error");
    }
  });
});

/*Delete Group*/
  $('.btn-group-delete').click(function(){
  var urls = $(this).attr('data-url');

  swal({
    title: "Are you sure?",
    text: "Are You Sure You Want To Delete This Group ?",
    type: "warning",
    showCancelButton: true,
    confirmButtonClass: "btn-danger",
    confirmButtonText: "Yes, delete it!",
    cancelButtonText: "No, cancel plz!",
    closeOnConfirm: false,
    closeOnCancel: false
  },
  function(isConfirm) {
    if (isConfirm) {
      $.ajax({
        url:urls,
        method:'get',
        success: function ( output ) {
          //alert(output);  
          swal({
            title:"Deleted Group.",
            text:' ',
            type:'success',
          },function(){
            window.location.href = output            
          })
        }
      })
    } else {
      swal("Cancelled", " ", "error");
    }
});
});

/*Remove Member*/
  $('.btn-member-delete').click(function(){
  var urls = $(this).attr('data-url');
    //alert(urls);
  swal({
    title: "Are you sure?",
    text: "Are You Sure You Want To Delete This Member ?",
    type: "warning",
    showCancelButton: true,
    confirmButtonClass: "btn-danger",
    confirmButtonText: "Yes, delete it!",
    cancelButtonText: "No, cancel plz!",
    closeOnConfirm: false,
    closeOnCancel: false
  },
  function(isConfirm) {
    if (isConfirm) {
      $.ajax({
        url:urls,
        method:'get',
        success: function ( output ) {
          // alert(output);  
          swal({
            title:"Delete Member.",
            text:' ',
            type:'success',
          },function(){
            window.location.href = output            
          })
        }
      })
    } else {
      swal("Cancelled", " ", "error");
    }
});
});


/*Leave Group*/
$('.leavegroup').click(function(){
  var urls = $(this).attr('data-url');
    // alert(urls);
  swal({
    title: "Are you sure?",
    text: "Are You Sure You Want To Leave This Group ?",
    type: "warning",
    showCancelButton: true,
    confirmButtonClass: "btn-danger",
    confirmButtonText: "Yes, delete it!",
    cancelButtonText: "No, cancel plz!",
    closeOnConfirm: false,
    closeOnCancel: false
  },
  function(isConfirm) {
    if (isConfirm) {
      $.ajax({
        url:urls,
        method:'get',
        success: function ( output ) {
          // alert(output);
          swal({
            title:"Leave Group.",
            text:' ',
            type:'success',
          },function(){
            window.location.href = output            
          })
        }
      })
    } else {
      swal("Cancelled", " ", "error");
    }
});
});
  