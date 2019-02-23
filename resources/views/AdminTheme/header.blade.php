

    <a href="{{ route('admin.index') }}" class="logo">
      
      <span class="logo-mini"><b>{{substr(env('PREFIX_NAME'),0,3)}}</b></span>
      <span class="logo-lg"><b>{{ env('PREFIX_NAME') }}</b></span>
    </a>
    
    <nav class="navbar navbar-static-top">
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{ adminUserData(auth()->user()->id)->ProPic }}" class="user-image" alt="User Image">
              <span class="hidden-xs">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }} </span>
            </a>
            <ul class="dropdown-menu">
              <li class="user-header">
                <img src="{{ adminUserData(auth()->user()->id)->ProPic }}" class="img-circle" alt="User Image">
                <p>
                  {{ str_limit(auth()->user()->first_name,13)}} {{ str_limit(auth()->user()->last_name,7) }} <br>
                 @if(auth()->user()->admin_type == 0)Master Admin @else Sub Admin</p>@endif
                  <small>Member since {{ date_format(auth()->user()->created_at,'M Y') }}</small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="{{ route('user.index') }}" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a class="btn btn-default btn-flat"
                     href="{{ route('logout') }}">
                      Sign out
                  </a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>

    