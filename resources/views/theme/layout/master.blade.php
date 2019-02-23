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
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-69749261-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());
		gtag('config', 'UA-69749261-1');
	</script>



	<!-- Hotjar Tracking Code for http://www.alphansotech.com/ -->
	<script>
	(function(h,o,t,j,a,r){
		h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
		h._hjSettings={hjid:217658,hjsv:6};
		a=o.getElementsByTagName('head')[0];
		r=o.createElement('script');r.async=1;
		r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
		a.appendChild(r);
	})(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
	</script>
	<!-- **************** -->

	<!-- Start of Async Drift Code -->

	<script>
		"use strict";
		!function() {
			var t = window.driftt = window.drift = window.driftt || [];
			if (!t.init) {
				if (t.invoked) return void (window.console && console.error && console.error("Drift snippet included twice."));
					t.invoked = !0, t.methods = [ "identify", "config", "track", "reset", "debug", "show", "ping", "page", "hide", "off", "on" ],
				t.factory = function(e) {
					return function() {
						var n = Array.prototype.slice.call(arguments);
						return n.unshift(e), t.push(n), t;
					};
				}, t.methods.forEach(function(e) {
					t[e] = t.factory(e);
				}), t.load = function(t) {
					var e = 3e5, n = Math.ceil(new Date() / e) * e, o = document.createElement("script");
					o.type = "text/javascript", o.async = !0, o.crossorigin = "anonymous", o.src = "https://js.driftt.com/include/" + n + "/" + t + ".js";
					var i = document.getElementsByTagName("script")[0];
					i.parentNode.insertBefore(o, i);
				};
			}
		}();
		drift.SNIPPET_VERSION = '0.3.1';
		drift.load('ytv9wivyb2zn');
	</script>

	<!-- End of Async Drift Code -->


</head>

<body class="fadeInDown">
<!--Header Start-->

	
<header class="fadeInDown">
	@include('theme.layout.header')
</header>
<!--Header End-->

<!--Content Start-->
<div class="wrapper">
	@yield('content')
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