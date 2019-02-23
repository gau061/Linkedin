<script type="text/javascript" src="{{ asset('/public/js/jquery.1.11.1.min.js')}}"></script>
<!-- Bootstrap Js -->
<script src="{{ asset('/public/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('/public/js/toastr.min.js') }}"></script>
<!-- <script type="text/javascript" src="{{ asset('/public/js/custom-chat.js')}}"></script> -->
<!-- validation Js -->
<script src='http://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.4.5/js/bootstrapvalidator.min.js'></script>
<script type="text/javascript" src="{{ asset('/public/js/validation.js') }}"></script>
<!-- Validation Js -->
<!-- Toster Js -->
<!-- Select Js Start  -->
<script type="text/javascript" src="{{ asset('/public/js/select/bootstrap-select.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/public/js/select/bootstrap-typeahead.min.js')}}"></script>

<script type="text/javascript" src="{{ asset('/public/js/select2.min.js')}}"></script>
<!-- Select Js End -->
<!-- Bootstrap Form Helper Js -->
<script type="text/javascript" src="{{ asset('/public/js/bootstrap-formhelpers.min.js')}}"></script>
<!-- Form Js -->
<script type="text/javascript" src="{{ asset('/public/js/jquery.form.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('/public/js/jquery.validate.js')}}"></script>
<!-- sweetalert -->
<script type="text/javascript" src="{{ asset('/public/js/sweetalert.min.js')}}"></script>
<!-- SummerNote -->
<script type="text/javascript" src="{{ asset('/public/editor/summernote.js')}}"></script>
<!-- Date Picker Js -->
<script type="text/javascript" src="{{ asset('/public/js/bootstrap-datepicker.js')}}"></script>
<script type="text/javascript" src="{{ asset('/public/js/user/user.js') }}"></script>
<script type="text/javascript" src="{{ asset('/public/js/custom.js')}}"></script>


<!-- google maps list -->
<script type="text/javascript">
function initialize() {
    var acInputs = document.getElementsByClassName("query");
    for (var i = 0; i < acInputs.length; i++) {
        var autocomplete = new google.maps.places.Autocomplete(acInputs[i]);
        autocomplete.inputId = acInputs[i].id;
    }
}
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD0S3aLN9IVO7E2Eno0u-fv6K0WhU4VrTI&libraries=places&callback=initialize" async defer></script>
<!-- google maps list -->



