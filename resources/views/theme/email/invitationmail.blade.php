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
			
			.widget-body.bordered-top {
				border-top: 1px solid #fff;
				border-top-color: rgb(255, 255, 255);
			}
			.bordered-sky {
				border-color: #0077B5 !important;
			}
			.widget-body {
				background-color: #fbfbfb;
				padding: 5px;
			}
			.card {
				position: relative;
				background-color: #fff;
				border: 1px solid #eee;
				border-radius: 3px;
			}
			.card .content {
				padding: 10px;
			}
			.widget-body .list-profile {
				list-style: none;
				margin: 0;
				padding: 0;
			}
			.widget-body .list-profile li:last-child {
				border-bottom: 0px solid #efefef;
			}
			.widget-body .list-profile li {
				display: block;
				padding: 5px 5px;
				border-bottom: 1px solid #efefef;
			}
			.widget-body .list-profile {
				list-style: none;
			}
			.widget-body .list-text.user-connection {
				width: calc(100% - 104px);
			}
			.widget-body .list-image {
				width: 80px;
				height: 80px;
				border-radius: 0px;
				text-align: center;
				display: inline-block;
			}
			img {
				border-radius: 0;
			}
			.widget-body .list-text.user-connection {
				width: calc(100% - 104px);
			}
			.widget-body .list-text {
				display: inline-block;
				width: calc(100% - 100px);
				vertical-align: top;
			}
			.img-thumbnail {
				display: inline-block;
				max-width: 100%;
				height: auto;
				padding: 4px;
				line-height: 1.42857143;
				background-color: #fff;
				border: 1px solid #ddd;
				border-radius: 4px;
				-webkit-transition: all .2s ease-in-out;
				-o-transition: all .2s ease-in-out;
				transition: all .2s ease-in-out;
			}
			.widget-body .list-text h3.list-text-title {
				font-size: 16px;
				font-weight: 600;
				margin: 0;
				padding: 0px 8px;
			}
			.widget-body .user-connection .user-btn-gorup {
				padding: 5px 0 0 10px;
				margin-top: 12px;
			}
			.btn-primary, .btn-primary:focus {
				background-color: #0077B5 !important;
				border-color: #0077B5;
				color: #fff;
				padding: 5px 10px;
				text-decoration: none;
			}
			.btn-info, .btn-info:focus {
				background-color: #999999 !important;
				text-decoration: none;
				border-color: #999999;
				padding: 5px 10px;
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
					<h1>Invitation Mail</h1>
				</div>
			</div>
			<div class="mail-body">
				<div class="body-title">
					<h4>
						Dear <span>{{$userinfo->name}}</span>, 
					</h4>
					<p>I am <span><a href="{{route('profile',$userinfo->user_unique)}}">{{$userinfo->ToName}}</a></span>,I have invited you to join in my group [{{$userinfo->group_title}}]
					I do hope you will consider joining the group as a member.
					</p>
				</div>
					<div class="widget-body bordered-top bordered-sky">
							<div class="card">
								<div class="content">
									<ul class="list-profile" id="connect">
										<li class="mt-list-item">
											<div class="list-image">
												<img alt="image" class="img-thumbnail"  href="#" src="{{$userinfo->groupImage}}">
											</div>
											<div class="list-text user-connection">
												<h3 class="list-text-title wordwap">
												<a href="{{route('groups.index',$userinfo->group_id)}}">{{ $userinfo->group_title }}</a>
												</h3>
												<div class="user-btn-gorup">
													<a href="{{route('joingroup.request',['acceptgroupinvitation',$userinfo->group_id])}}" class="btn btn-primary">Accept</a>
													<a href="{{route('joingroup.request',['invitationremove',$userinfo->group_id])}}" class="btn btn-info">Decline</a>
												</div>
											</div>
										</li>
									</ul>
								</div>
							</div>
						</div>
					<!--member-->
			<div class="bottom-dashed"></div>
				<p class="term-service">
	    			<a href="" target="_blank" >Terms of Service</a> and 
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