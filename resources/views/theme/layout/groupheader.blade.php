@inject('notify','App\GroupRequest')

<div class="group-header">
  <div class="container">
      <div class="row">        
        <div class="col-sm-12">
          <ul class="group-menu">        
            <li style="margin-top:11px"><a href="{{ route('group.usergroups') }}">My Groups</a></li>
            <li style="margin-top:11px"><a href="{{ route('group.discover') }}">Discover</a></li>
            <li style="margin-top:11px"><a href="{{ route('group.create') }}">Create Groups</a></li>
            <li style="margin-top:11px"><a href="{{route('group.notification')}}" id="notify">Notifications
                                        @if($notify->getnotify() > 0)
                                          <span class="badge">
                                            <i class="fa fa-bell" aria-hidden="true" id="bell"></i>
                                          {!! $notify->getnotify() < 99? $notify->getnotify() :'99+' !!}
                                          </span>
                                          @endif
                                        </a>
            </li>
            <li>
              {!! Form::open(['route'=>'groupview','method'=>'get'])!!}
            <div class="text-search">
              <input type="text" name="searchgroup" class="form-control text-box-search" placeholder="Search Groups" id="tag" value="{{ Input::get('searchgroup') }}" autocomplete="off">
              <i class="fa fa-search search"></i>
              {!! Form::submit('Search')!!}
              {!! Form::close() !!}
            </div>
            </li>
                 
          </ul>
        </div>
      </div>
  </div>
</div>
@section('pageScript')
<script type="text/javascript" src="{{ asset('/public/js/search/search.js') }}"></script>
@endsection