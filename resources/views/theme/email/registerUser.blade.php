<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta name="viewport" content="width=device-width" /><!-- IMPORTANT -->
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Activate your {{ forcompany() }}'s account<</title>
	<style type="text/css">
		@font-face {
		    font-family: 'bentonsansbold';
		    src: url('{{ asset("/font/bentonsans_bold-webfont.woff2") }}') format('woff2'),
		         url('{{ asset("/font/bentonsans_bold-webfont.woff") }}') format('woff');
		    font-weight: normal;
		    font-style: normal;

		}
		@font-face {
		    font-family: 'bentonsansmedium';
		    src: url('{{ asset("/font/bentonsans_medium-webfont.woff2") }}') format('woff2'),
		         url('{{ asset("/font/bentonsans_medium-webfont.woff") }}') format('woff');
		    font-weight: normal;
		    font-style: normal;
		}
		@font-face {
		    font-family: 'bentonsansregular';
		    src: url('{{ asset("/font/bentonsans_regular-webfont.woff2") }}') format('woff2'),
		         url('{{ asset("font/bentonsans_regular-webfont.woff") }}') format('woff');
		    font-weight: normal;
		    font-style: normal;

		}

		body{
			font-family:"bentonsansregular","Helvetica Neue",Helvetica,Roboto,Arial,sans-serif;
		}
		.mail-container{
			background: #f7f7f7;
			width: 100%;
			padding: 5px 0;
		}
		.mail-inner-content{
			width: 700px;
			margin: 20px auto;
			/*border: 1px solid #efefef;*/
			border-radius: 0px;			
		}
		.mail-header .mail-logo{
			text-align: center;
			padding: 20px 10px;
		}
		.mail-header .mail-header-title{
			background:#0077B5;
			color:#FFFFFF;
			text-align:center;
			padding:15px;
			letter-spacing: 2px;
		}
		.mail-header .mail-header-title h1{
			padding: 0;
			margin: 0;
			font-size: 20px;
		}
		.mail-body{
			padding: 20px;
			background: #ffffff;
		}
		.body-title{}
		.body-title h4{
			padding: 5px 0;
			color: #404040;
			font-weight: normal;			
			font-size: 18px;
			line-height: 30px;
			margin: 0;			
		}
		.body-title p span,
		.body-title h4 span{
			color: #0077B5;
		}
		.body-title p{
			padding: 10px 0 5px 0;
			margin: 0;
			font-size: 14px;
			color: #777777;
		}
		.bottom-dashed{
			border-bottom:1px dashed #d3d3d3;
		}
		.term-service{
			text-align: center;
			font-size: 10px;
			color: #999999;
		}
		.term-service a{
			color: #0077B5;
			text-decoration: none;			
		}
		.note{
			text-align: center;
			font-size: 13px;
			color: #666666;
		}
		.mail-footer{
			text-align: center;
		}
		.mail-footer p{
			font-size: 11px;
			padding: 5px 0;
			margin: 5px 0 5px 0;
			line-height: 20px;
			color: #999999;
			letter-spacing: 1px;
		}
		a.mail-button{
			background-color: transparent;
			border: 2px solid #0077B5;
			border-radius: 3px;
			color: #0077B5;
			display: inline-block;			
			font-size: 14px;
			letter-spacing: 1px;
			margin: 10px 0;
			padding: 10px 18px;
			text-decoration: none;
			width: auto;

		}
		a.mail-button:hover{
			transition: all 0.3s;
			background: #0077B5;
			color: #fff;
		}


	</style>
</head>

<body>
	<div class="mail-container">
		<div class="mail-inner-content">
			<!-- HEADER -->
			<div class="mail-header">
				<div class="mail-logo">
					<a href="">
						<img src="{{ for_logo() }}" alt="{{ forcompany() }}" height="50" />
					</a>
				</div>
				<div class="mail-header-title" >
					<h1>Activate your {{ forcompany() }}'s account</h1>
				</div>
			</div>
			<div class="mail-body">
				<div class="body-title">
					<h4>
						Dear <span>{{ $userdata->firstname }} {{ $userdata->lastname }}</span>, 
					</h4>
					<p>Almost done! Please click this link to activate your account and login with your password.</p>

					<a href="{{ route('activation',$userdata->remember_token) }}" class="mail-button">Activate Account</a>

					<p>If you did not recently attempt to activate your {{ forcompany() }} account, please disregard this email. </p>
				</div>
				<div class="bottom-dashed"></div>
				<p class="term-service">
	    			This order is subject to Eventz <a href="" target="_blank" >Terms of Service</a> and 
	    			<a href="" target="_blank" >Privacy Policy</a>
				</p>
			</div>
			<!-- FOOTER -->
			<div class="mail-footer">
				<p> This email was sent to {{ frommail() }} <br/>
				 Copyright © 2018 {{ forcompany() }}. All rights reserved. </p>
			</div>

		</div>
	</div>
</body>
</html>