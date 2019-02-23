<!doctype html>
<html lang="en" class="gr__demos_bootdey_com">
<head>
<!-- SEO DATA -->
<!-- <title>@yield('meta_title')</title> -->
<title>@yield('title','Pro Network')</title>
<!-- <meta name="description" content="@yield('meta_description')"> -->
<!-- <meta name="keywords" content="@yield('meta_keywords')"> -->
<meta name="description" content="LinkedIn clone - Make your industry niche professional networking platform at just $199!">
<meta name="author" content="alphansotech">
<!-- SEO DATA -->
<meta name="_token" content="{!! csrf_token() !!}"/>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">   

<link rel="icon" type="image/png" href="{{ asset('/public/img/favicon.png') }}" />

	<script type="text/javascript">
        var current_page_url = "<?php echo URL::current(); ?>";
        var current_page_fullurl = "<?php echo URL::full(); ?>";
    </script>

@include('theme.layout.css')


<!-- Global site tag (gtag.js) - Google Analytics -->
<!-- <script async src="https://www.googletagmanager.com/gtag/js?id=UA-69749261-1"></script>
<script>
window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('js', new Date());

gtag('config', 'UA-69749261-1');
</script>
<!--Start of Tawk.to Script--
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5a65e4bfd7591465c706f9db/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script> -->
<!--End of Tawk.to Script-->

</head>

<body class="fadeInDown">
<!--Header Start-->

	
<header class="fadeInDown">
	@include('theme.layout.header')
</header>
<!--Header End-->
<div class="wrapper">
	<div class="page-content">
	@include('theme.layout.groupheader')
	@yield('content')
	</div>
</div>
<!--Content End-->

<!--Foooter Start-->
<footer class="footer animated">
	@include('theme.layout.footer')
</footer>
<!--Footer End-->

<!--script start-->
@include('theme.layout.script')
<!--script end-->

<!--page script start-->
@yield('pageScript')
<!--page script end-->
@include('theme.layout.notification')
</body>
</html>