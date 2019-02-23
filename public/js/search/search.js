	$( document ).ready(function() {

     $('#tags').typeahead({
        ajax: {
            url: "connection/search",
            method: "get",
            response: function(data) {
            },
            triggerLength: 1
        },
        scrollBar:true,
        onSelect: displayResult
      });
      function displayResult(item) {
        var srchdata = item
        window.location = "profile/" + srchdata.value
      }



/*Search User*/
    $('#searchuser').typeahead({
        ajax: {
            url: "/invite/user/",
            method: "get",
            response: function(data) {
            // var g_id = $(this).attr('data-id');
            },
            triggerLength: 1
        },
        scrollBar:true,
      });

    $('#tag').typeahead({
          ajax: {
              url: "/group/search",
              method: "get",
              response: function(data) {
              },
              triggerLength: 1
          },
          scrollBar:true, 
      }); 
});









// $('body').on('keyup','#searchText',function(){

//   var data = $(this).val();
//    $.ajax({
//     url:"{{ route('connectd.list') }}",
//     data:{data:data},
//     success: function(result){
//         $('#connect').html('');
//       if(result == ''){
//         $('#connect').html('No record Found');  
//       }   
//           $.each(result, function( key, value ) {
//               var html = '<li class="mt-list-item">'+
//                                 '<div class="list-image">'+
//                                     '<img alt="image" class="img-thumbnail" src="{{userDefaultImage()}}">'+
//                                 '</div>'+
//                                 '<div class="list-text user-connection">'+
//                                     '<h3 class="list-text-title wordwap">'+ value.firstname +'</h3>'+
//                                     '<p class="list-inner-text">'+
//                                         ','+   
//                                         '<span class="bfh-states" data-country="{{ $req->country }}" data-state="{{ $req->state }}"></span>,'+
//                                         '<span class="bfh-countries" data-country="{{ $req->country }}"></span>'+
//                                         '</p>'+
//                                     '<div class="user-btn-gorup">'+
//                                         '<a href="" class="btn btn-info">Ignore</a>'+
//                                         '&nbsp;&nbsp;&nbsp;'+
//                                         '<a href="" class="btn btn-primary">Accept</a>'+
//                                     '</div>'+
//                                 '</div>'+
//                             '</li>' 

//           $('#connect').append(html);
//       });
//       }
//   });
// });