@inject('countData','App\User')
@inject('page','App\Page')
@inject('fuser','App\Frontuser')

<?php
  $currentPageURL = URL::current();


  $pageArray = explode('/', $currentPageURL);
  $pageActive = isset($pageArray[4]) ? $pageArray[4] : '';
  $pageActive_sub = isset($pageArray[5]) ? $pageArray[5] : '/';
  $pageActive_subsub = isset($pageArray[6]) ? $pageArray[6] : '/';

?>

<section class="sidebar">
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ adminUserData(auth()->user()->id)->ProPic }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <?php 
            $name = auth()->user()->first_name.' '.auth()->user()->last_name
          ?>
          <p title="{{ $name }}">{{ str_limit($name,18)}}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
          
          <li class="{{ $pageActive == 'dashboard' ? 'active' : ''  }}">
            <a href="{{ route('admin.index') }}">
              <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              <span class="pull-right-container">
              </span>
            </a>
          </li>

          <li class="{{ $pageActive == 'users' ? 'active' : ''  }}">
            <a href="{{ route('users.index') }}">
              <i class="fa fa-users"></i> <span>Admin User</span>
              <span class="pull-right-container">
                <small class="label pull-right bg-green">{{ $countData->countData() }}</small>
              </span>
            </a>
          </li>

          <li class="{{ $pageActive == 'frontuser' ? 'active' : ''  }}">
            <a href="{{ route('frontuser.index') }}">
              <i class="fa fa-users"></i> <span>Frontuser</span>
              <span class="pull-right-container">
                <small class="label pull-right bg-green">{{ count($fuser->fetchData()) }}</small>
              </span>
            </a>
          </li>

          <li class="{{ $pageActive == 'skills' ? 'active' : ''  }}">
            <a href="{{ route('skills.index') }}">
              <i class="fa fa-dashboard"></i> <span>Skills</span>
            </a>
          </li>
        
          @permission('role-list')
           <li class="{{ $pageActive == 'roles' ? 'active' : ''  }}">
            <a href="{{ route('roles.index') }}">
              <i class="fa fa-check-square-o"></i><span>Roles</span>
            </a>
          </li>
          @endpermission


          <li class="{{ $pageActive == 'menu' ? 'active' : ''  }}">
            <a href="{{ route('menus.index') }}">
              <i class="fa fa-check-square-o"></i><span>Menu Settings</span>
            </a>
          </li>

          <li class="{{ $pageActive == 'settings' ? 'active' : ''  }}">
            <a href="{{ route('settings.index') }}">
              <i class="fa fa-cog"></i><span>Site Settings</span>
            </a>
          </li>

          <li class="{{ $pageActive == 'contact' ? 'active' : ''  }}">
            <a href="{{ route('contact.index') }}">
              <i class="fa fa-cog"></i><span>Contact Us</span>
            </a>
          </li>


          <li class="treeview {{ $pageActive == 'pages'   ? 'menu-open' : ''  }}">
              <a href="">
                <i class="fa fa-files-o"></i><span>Pages</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
            <ul class="treeview-menu" style="display: {{ $pageActive == 'pages' ? 'block' : 'none'  }}; padding-left:0px; " >
              <li class="{{ $pageActive_sub == 'create' ? 'active' : ''  }}" style="border-bottom:1px solid #222d32;padding-bottom:5px;">
                <a href="{{ route('page.index') }}"><i class="fa fa-file-text-o"></i>Page Create</a>
              </li>
              @foreach($page->getList() as $key => $data)
              <li class="{{ $pageActive_sub == $data->page_slug ? 'active' : ''}}">
                <a href="{{ route('pages.index',$data->page_slug) }}"><i class="fa fa-file-text-o"></i>{{ $data->page_title }}</a>
              </li>
              @endforeach
            </ul>
          </li>

          <li class="{{ $pageActive == 'Industry' ? 'active' : ''  }}">
            <a href="{{ route('industry.display') }}">
              <i class="fa fa-industry"></i><span>Industry</span>
            </a>
          </li>


      </ul>
    </section>

    <style type="text/css"></style>

