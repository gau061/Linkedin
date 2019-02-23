
<script type="text/javascript">
	toastr.options.escapeHtml = true;
	toastr.options.closeButton = true;
	toastr.options.showMethod = 'slideDown';
	// toastr.options.hideMethod = 'slideUp';
	// toastr.options.closeMethod = 'slideUp';
	toastr.optionsOverride = 'positionclass = "toast-bottom-left"';
	toastr.options.positionClass = 'toast-bottom-left';
</script>

@if ($errors->any())
<script type="text/javascript">
	toastr.error('Please check the form below for errors', '', {timeOut: 5000})
</script>
@endif

@if ($message = Session::get('success'))
<script type="text/javascript">
	toastr.success('<?php echo $message; ?>', '', {timeOut: 5000})
</script>
<?php Session::forget('success');?>
@endif

@if ($message = Session::get('error'))
<script type="text/javascript">
	toastr.error('<?php echo $message; ?>', '', {timeOut: 5000})
</script>
<?php Session::forget('error');?>
@endif

@if ($message = Session::get('warning'))
<script type="text/javascript">
	toastr.warning('<?php echo $message; ?>', '', {timeOut: 5000})
</script>
<?php Session::forget('warning');?>
@endif

@if ($message = Session::get('info'))
<script type="text/javascript">
	toastr.info('<?php echo $message; ?>', '', {timeOut: 5000})
</script>
<?php Session::forget('info');?>
@endif