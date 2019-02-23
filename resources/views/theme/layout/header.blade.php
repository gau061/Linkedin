@inject('CountNotification', 'App\Notification')
@inject('menu','App\Menu')
@inject('msg','App\Message')

<div class="container">
    <div class="row">
        <div class="col-sm-12 col-xs-12 col-md-3 col-lg-3 site-logo-cover">
            <div class="site-logo">
                <a href="{{ route('index') }}">
                    <img src="{{ for_logo() }}" alt="{{ forcompany() }}" title="{{ forcompany() }}" />
                </a>
            </div>
        </div>
        @if(auth()->guard('frontuser')->check())
        @php
            $url = URL::current();
            $url = explode('/',$url);
            $pageactive = isset($url)?$url[3]:'';
        @endphp
        
                <nav class="navbar col-lg-9 col-md-9">
                    <div id="navbar" class="navbar-collapse">
                        <!-- responsive menu -->
                            <label class="visible-xs visible-sm toggle-btn-menu" for="chek-box-menu"><i class="fa fa-bars" aria-hidden="true"></i>
                                <div class="user-pro">
                                        <a  class="user-link" href="">
                                            <img src="{{ user_data(chackeAuthUser())->ProPic }}" class="user-profile" alt="user">
                                        </a>
                                        <span class="label wordwap acname-respon-name">
                                            <a href="{{ route('profile',chackeAuth()?usernames():'') }}">{{ user_data(chackeAuthUser())->Name }}</a>
                                        </span>                    
                                    </div>
                            </label>
                            <input type="checkbox" name="toggle-menu" id="chek-box-menu" role="button" class="hidden">

                        <!-- responsive menu -->
                        <ul class="nav navbar-nav navbar-right" id="main-menu-res">
                            <li class="{{ $pageactive == 'feed'?'actives':'' }}"><a href="{{ route('feeds') }}">@lang('words.main_menu.menu_1')</a></li>
                            <li class="{{ $pageactive == 'profile'?'actives':'' }}">
                                <a href="{{ route('profile',chackeAuth()?usernames():'') }}">@lang('words.main_menu.menu_2')</a>
                            </li>
                            
                            <li class="{{ $pageactive == 'connection'?'actives':'' }}" ><a href="{{ route('connection.index') }}">@lang('words.main_menu.menu_3') 
                                @if(count($CountNotification->countReq()) > 0 )
                                    <span class="badge">
                                        {{ count($CountNotification->countReq()) }}
                                    </span>
                                @endif
                            </a></li>
                            {{--<li class="{{ $pageactive == 'groups'?'actives':'' }}"><a href="{{ route('group.usergroups') }}">@lang('words.main_menu.menu_4')</a></li>--}}
                            <li class="{{ $pageactive == 'message'?'actives':'' }}">
                                <a href="{{ route('message.index') }}">@lang('words.main_menu.menu_5')
                                        @if($msg->getMsgNoti() > 0)
                                        <span class="badge">
                                            <i class="fa fa-bell" aria-hidden="true"></i>
                                            {!! $msg->getMsgNoti() < 99? $msg->getMsgNoti() :'99+' !!}
                                        </span>
                                        @endif
                                </a>
                            </li>
                            <li class="visible-xs visible-sm"><a href="">Job</a></li>
                            <li class="visible-xs visible-sm"><a href="{{ route('user.logout') }}">@lang('words.main_menu.menu_6') </a></li>

                            <a  class="user-link hidden-sm hidden-xs">
                              <img src="{{ user_data(chackeAuthUser())->ProPic }}" class="user-profile" alt="user">
                            </a>
                            <!-- toogle menu -->
                            <div class="sub-menu">
                                <ul class="">
                                  <li class="hidden-xs hidden-sm">
                                    <div class="user-pro">
                                        <img src="{{ user_data(chackeAuthUser())->ProPic }}" class="user-ppic" alt="user">
                                        <span class="label wordwap">
                                            <a href="">{{ user_data(chackeAuthUser())->Name }}</a>
                                        </span>                                        
                                    </div>
                                  </li>
                                  <li><span class="line"></span></li>
                                 <!--  <li><a href="{{ route('group.usergroups') }}">Group</a></li> -->
                                  <li><a href="{{ route('connection.index') }}">Connection</a></li>
                                  <li><a href="">Job</a></li>
                                  <li><span class="line"></span></li>
                                  <!-- <li><a href="">Post setting</a></li> -->
                                  <!-- <li><a href="">Group setting</a></li> -->
                                  <!-- <li><span class="line"></span></li> -->
                                  @foreach($menu->getData() as $datas)
                                    <li><a href="{{ route('p.index',$datas->page_slug) }}">{{ $datas->page_title }}</a></li>
                                  @endforeach
                                  <li><span class="line"></span></li>
                                  <!-- <li><a href="">Terms And Condition</a></li>
                                  <li><a href="">Help Center</a></li>
                                  <li><span class="line"></span></li> -->
                                  <li><a href="{{ route('user.logout') }}">@lang('words.main_menu.menu_6') </a></li>
                                </ul>
                            </div>
                                <!-- toogle menu -->
                        </ul>
                    </div>
                </nav>
            <!-- </div> -->
        @else
            <div class="col-sm-8 col-xs-12 col-md-6 col-lg-6 col-md-offset-3 col-lg-offset-3">
                <div class="header-login">
                    {!! Form::open(['route'=>'signin.post','method'=>'post']) !!}
                        <div class="form-group row">
                            <div class="hidden-sm-down col-md-2"></div>
                            
                            <div class="col-sm-5 col-md-4">
                                <input type="email" name="email" class="form-control" placeholder="@lang('words.user_login.email_place')" value="Joel.Brooks@test.com">
                            </div>
                            <div class="col-sm-5 col-md-4">
                                <input type="password" name="password" class="form-control" placeholder="@lang('words.user_login.passw_place')" value="123456">
                            </div>
                            <div class="col-sm-2 col-md-2">
                                <input type="submit" name="login" value="@lang('words.user_login.login_btn')" class="btn btn-primary btn-block" />
                                <a href="{{ route('email.form') }}" class="pull-right"><small>@lang('words.user_login.forget_pwd')</small></a>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>                    
        @endif
    </div>
</div>
