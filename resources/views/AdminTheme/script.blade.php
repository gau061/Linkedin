<!-- jQuery 3 -->
<script src="{{ asset('/public/AdminTheme/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('/public/AdminTheme/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- Bootbox -->
<script src="{{ asset('/public/AdminTheme/dist/js/bootbox.js') }}"></script>
<!-- DataTables -->
<script src="{{ asset('/public/AdminTheme/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/public/AdminTheme/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<!-- SlimScroll -->
<script src="{{ asset('/public/AdminTheme/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('/public/AdminTheme/bower_components/fastclick/lib/fastclick.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('/public/AdminTheme/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('/public/AdminTheme/dist/js/demo.js') }}"></script>
<script type="text/javascript" src="{{ asset('/public/js/bootstrap-formhelpers.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/public/js/bootstrap-select.min.js') }}"></script>
<!-- Custome Js -->
<script type="text/javascript" src="{{ asset('/public/editor/summernote.js')}}"></script>


<script type="text/javascript" src="{{ asset('/public/AdminTheme/custom.js')}}"></script>

<script src="{{ asset('/public/AdminTheme/dist/js/form.js') }}"></script>

<script src="{{ asset('/public/AdminTheme/dist/js/crud.js') }}"></script>

<script src="{{ asset('/public/AdminTheme/plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>

<script src="{{ asset('/public/AdminTheme/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>

<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

<!-- <script type="text/javascript" src="{{ asset('/public/js/googlemap.js')}}"></script> -->

<script type="text/javascript">
function initialize() {
    var acInputs = document.getElementsByClassName("query");
    for (var i = 0; i < acInputs.length; i++) {
        var autocomplete = new google.maps.places.Autocomplete(acInputs[i]);
        autocomplete.inputId = acInputs[i].id;
    }
}
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCLKoNTyy97I6OBhH-hzihK4POolwvjHJk&libraries=places&callback=initialize" async defer></script>

<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCI6ov84Lz6uXTAT-iYqAd-XEeCv34oDHo&libraries=places&callback=initAutocomplete" async defer></script> -->
<script>
  	$(document).ready(function () {
    	$('.sidebar-menu').tree()

	    $('.datatable').DataTable({
			'paging'      : true,
			'lengthChange': false,
			'searching'   : true,
			'ordering'    : true,
			'info'        : true,
			'autoWidth'   : true
	    })
	})

  $(function () {

    $('#example1').DataTable()
    $('.frontuser-data').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : false,
      'info'        : true,
      'autoWidth'   : false
    })
  })

$('.datepicker').datepicker({
      autoclose: true,
      format: 'yyyy-mm-dd',
      orientation: "bottom auto",
})



	$(document).ready(function () {
  $(".digits").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
     	$(".errmsg").html("Digits Only").show().fadeOut("slow");
        return false;
    }
   });
});

</script>