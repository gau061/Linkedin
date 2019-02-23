$( document ).ready(function() {

     $('#searchgroup').typeahead({
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
});