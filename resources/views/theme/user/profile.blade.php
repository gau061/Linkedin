@extends($theme)

@section('content')

        <div class="container">
            <div class="row page-content">
                <!-- ********************************************** -->
                <!-- Left side -->
                <!-- ********************************************** -->
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-12 user-pro-respo">
                            <div class="cover profile">
                                <div class="wrapper">
                                    <div class="image" id="CoverImage">
                                        <img src="{{ user_data($data->id)->CoverPic }}" class="show-in-modal" alt="people">
                                    </div>
                                </div>
                                <div class="image-logo">
                                    @if(chackeAuthUser() == $data->id)
                                    <form name="myForm" id="avatar_form" enctype="multipart/form-data" method="post" action="">
                                        {{ csrf_field() }}
                                        <input type="file" name="cover_image" id="coverPic" style="display: none;" accept=".png, .jpg, .jpeg" class="cover-image" onchange="sub1('CoverImage')">
                                            <label for="coverPic">
                                                <i class="fa fa-pencil image-icon"></i>
                                            </label>
                                        <div  class="preview"></div>    
                                    </form>
                                    @endif
                                </div>

                                <div class="cover-info">
                                    <div class="avatar">
                                        <div class="pro-image" id="ProfileImage">
                                            <img src="{{ user_data($data->id)->ProPic }}" alt="people" class="profile-hover">
                                        </div>
                                        @if(chackeAuthUser() == $data->id)
                                        <form name="myForm" id="profile_form" enctype="multipart/form-data" method="post" action="">
                                        {{ csrf_field() }}
                                        <input type="file" name="profile_image" id="proPic" style="display: none;" accept=".png, .jpg, .jpeg" class="profile_image" onchange="sub1('ProfileImage')">
                                        </form>
                                        <div class="proPicedit">
                                            <label for="proPic"><i class="fa fa-pencil"></i></label>
                                        </div>
                                        @endif
                                    </div>
                                    
                                    <div class="profile-date">
                                        <div class="name"><a href="{{ route('profile',user_data($data->id)->user_id) }}" class="text-center">{{ $data->firstname }} {{ $data->lastname }}</a></div>
                                        <div class="text">
                                            <p>@ {{ strtolower($data->firstname) }}_{{ strtolower($data->lastname) }}</p>
                                            @if(!is_null($data->city) || !is_null($data->state) ||  !is_null($data->country))
                                                <p>{{ $data->city }}, <span class="bfh-states" data-country="{{ $data->country }}" data-state="{{ $data->state }}"></span>, <span class="bfh-countries" data-country="{{ $data->country }}"></span></p>
                                            @endif
                                            <div class="text-center">
                                                @if(auth()->guard('frontuser')->user()->unique_id != $data->unique_id)
                                                    @if(! is_null($status))
                                                        @if($status['request_status'] == 'Connected')
                                                            <a href="{{ route('message.index',$data->unique_id) }}" onclick="pageChange({{ $data->unique_id }})" class="btn msg-btn">@lang('words.msg_acp.text_1')</a>
                                                            <a href="{{ route('request.send',['remove',$data->id]) }}" class="btn btn-info msg-remove">Remove</a>

                                                        @elseif($status['reciver_id']  == auth()->guard('frontuser')->user()->id &&  $status['request_status'] == 'Pending')
                                                            <div class="user-btn-gorup">
                                                                <a href="{{ route('request.status',['ignore',$status->sender_id]) }}" class="btn msg-btn">@lang('words.msg_acp.text_3')</a>
                                                                &nbsp;&nbsp;&nbsp;
                                                                <a href="{{ route('request.status',['accept',$status->sender_id]) }}" class="btn btn-primary msg-btn-ac msg-btn">@lang('words.msg_acp.text_4')</a>
                                                            </div>
                                                        @else
                                                            <a href="javascript:void(0)" data-msg="Request cancelled." data-url="{{ route('request.send',['cancel',$data->id]) }}" class="btn btn-primary msg-btn-ac msg-btn msg-cncel">@lang('words.request_cancel.text_2')</a>
                                                        @endif
                                                        
                                                    @else
                                                        <a href="{{ route('request.send',['send',$data->id]) }}" class="btn btn-primary msg-btn-ac msg-btn">@lang('words.msg_acp.text_5')</a>
                                                    @endif
                                                @endif
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <ul class="cover-nav">
                                <li class="pro-tab"><a href="{{ route('profile',user_data(chackeAuthUser())->user_id) }}"><i class="fa fa-fw fa-user-o"></i>@lang('words.pro_menu.tab_1')</a></li>
                                <li class="pro-tab"><a href="{{ route('timeline.index',$data->unique_id) }}"><i class="fa fa-fw fa-bars"></i> @lang('words.pro_menu.tab_2')</a></li>
                                <li class="pro-tab"><a href="{{ route('connection.list') }}"><i class="fa fa-fw fa-users"></i> @lang('words.pro_menu.tab_3')</a></li>
                                @if(auth()->guard('frontuser')->user()->unique_id == $data->unique_id)
                                <li class="active pro-tab"><a href="#" data-toggle="modal" data-target="#myModal"><i class="fa fa-fw fa-edit"></i> @lang('words.pro_menu.tab_4')</a>
                                    @include('theme.user.model')
                                </li>
                                @endif
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                    </div>                    
                    <!-- ********************************************** -->
                    <!-- ********************************************** -->
                    <div class="row">
                        <div class="col-md-12">
                            <!-- ********************************************** -->
                            <div class="widget">
                                <div class="widget-header header-wid-res">
                                    <h3 class="widget-caption">@lang('words.skill_pro.text_1')</h3>
                                    <div class="widget-addnew">
                                        @if(auth()->guard('frontuser')->user()->unique_id == $data->unique_id)
                                            <button class="btn btn-link" data-toggle="modal" data-target="#myskills"><i class="fa fa-plus"></i> @lang('words.pro_btn.btn_5')</button>
                                            @include('theme.user.skills')       
                                        @endif
                                    </div>
                                </div>
                                <div class="widget-body bordered-top bordered-sky">
                                    <div class="card">
                                        <div class="content">
                                            <ul class="list-profile">
                                                @php
                                                    $i = 1;
                                                @endphp
                                                
                                                @if(!empty($user_skills))
                                                    @foreach($user_skills as $key => $val)
                                                        @if($i <= 5)
                                                        <li>
                                                            <div class="list-text width-1">
                                                                <h3 class="list-text-title">{{ $val->skills }}</h3>
                                                            </div>
                                                            @if(auth()->guard('frontuser')->user()->unique_id == $data->unique_id)
                                                            <div class="list-setting">
                                                                <a href="{{ route('user.skills.remove',$val->id) }}" class="" onclick="return confirm('{{ trans('words.request_cancel.text_3') }}')"><i class="fa fa-trash"></i></a>
                                                            </div>
                                                            @endif
                                                            <div class="clearfix"></div>
                                                        </li>
                                                        @else
                                                            <li class="skill-toogle" style="display: none;">
                                                                <div class="list-text width-1">
                                                                    <h3 class="list-text-title">{{ $val->skills }}</h3>
                                                                </div>
                                                                @if(auth()->guard('frontuser')->user()->unique_id == $data->unique_id)
                                                                <div class="list-setting">
                                                                    <a href="{{ route('user.skills.remove',$val->id) }}" class="" onclick="return confirm('{{ trans('words.request_cancel.text_3') }}')"><i class="fa fa-trash"></i></a>
                                                                </div>
                                                                @endif
                                                                <div class="clearfix"></div>
                                                            </li>
                                                        @endif
                                                        @php $i++; @endphp
                                                    @endforeach
                                                @else
                                                    <li>
                                                        <div class="list-text width-1">
                                                                <h3 class="list-text-title">@lang('words.skill_pro.text_2')</h3>
                                                        </div>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                    @if($i > 6)
                                    <div class="text-center hidden-xs">
                                        <label for="shm" class="show-more" style="width: 100%;">@lang('words.pro_btn.btn_3')</label>
                                        <input type="checkbox" id="shm" style="display: none;">
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <!-- ********************************************** -->
                            <div class="widget">
                                <div class="widget-header">
                                    <h3 class="widget-caption">@lang('words.exe_pro.text_1')</h3>
                                    @if(auth()->guard('frontuser')->user()->unique_id == $data->unique_id)
                                    <div class="widget-addnew">
                                        <button class="btn btn-link" data-toggle="modal" data-target="#myexe"><i class="fa fa-plus"></i> @lang('words.pro_btn.btn_5')</button>
                                        @include('theme.user.experince')
                                    </div>
                                     @endif
                                </div>
                                <div class="widget-body bordered-top bordered-sky">
                                    <div class="card">
                                        <div class="content">
                                            <ul class="list-profile">
                                            @php
                                                $i = 1;
                                            @endphp
                                            @if(! empty($exe) && count($exe) > 0)
                                                @foreach($exe as $key => $exea)
                                                    @if($i <= 3)
                                                        <li class="exp">
                                                            <div class="list-icon">
                                                                <i class="fa fa-building-o"></i>
                                                            </div>
                                                            <div class="list-text exp-head">
                                                                <h3 class="list-text-title exp-title">{{ $exea->title }}</h3>
                                                                <p class="list-inner-text">{{ $exea->company }}</p>
                                                                @php 
                                                                    $exes = $exea->from;
                                                                    $date = explode('-',$exes);

                                                                    $todat = $exea->to;
                                                                    $todates = explode('-',$todat);
                                                                @endphp
                                                                <p class="list-inner-text">
                                                                    {{ date("M", mktime(0, 0, 0, $date[0], 1)) }} - {{$date[1]}}
                                                                                            To
                                                                    @if(! empty($todat))                        
                                                                        {{ date("M", mktime(0, 0, 0, $todates[0], 1)) }} - {{$todates[1]}}
                                                                    @else
                                                                        Present
                                                                    @endif
                                                                </p>
                                                            </div>
                                                            @if(auth()->guard('frontuser')->user()->unique_id == $data->unique_id)
                                                            <div class="list-setting list-resp-setting">
                                                                    <button class="btn btn-link" data-toggle="modal" data-target="#update-{{ $exea->id }}"><i class="fa fa-edit"></i></button>
                                                                    <a href="{{ route('experince.delete',$exea->id) }}" class="" onclick="return confirm('Are You Sure ?')"><i class="fa fa-trash"></i></a>
                                                            </div>
                                                            <!-- <div class="exp-btn visible-xs">
                                                                <button class="btn btn-link" data-toggle="modal" data-target="#update-{{ $exea->id }}"><i class="fa fa-edit"></i></button>
                                                                <a href="{{ route('experince.delete',$exea->id) }}" class="" onclick="return confirm('Are You Sure ?')"><i class="fa fa-trash"></i></a>
                                                            </div> -->
                                                            @endif
                                                            <div class="clearfix"></div>
 
                                                        </li>
                                                    @else                                            
                                                        <li class="exe-toogle exp" style="display: none;">
                                                                <div class="list-icon">
                                                                    <i class="fa fa-building-o"></i>
                                                                </div>
                                                                <div class="list-text exp-head">
                                                                <h3 class="list-text-title exp-title">{{ $exea->title }}</h3>
                                                                <p class="list-inner-text">{{ $exea->company }}</p>
                                                                @php 
                                                                    $exes = $exea->from;
                                                                    $date = explode('-',$exes);

                                                                    $todat = $exea->to;
                                                                    $todates = explode('-',$todat);
                                                                @endphp
                                                                <p class="list-inner-text">
                                                                    {{ date("M", mktime(0, 0, 0, $date[0], 1)) }} - {{$date[1]}}
                                                                                            To
                                                                    @if(! empty($todat))                        
                                                                        {{ date("M", mktime(0, 0, 0, $todates[0], 1)) }} - {{$todates[1]}}
                                                                    @else
                                                                        Present
                                                                    @endif
                                                                </p>
                                                            </div>
                                                                <div class="clearfix"></div>
                                                                @if(auth()->guard('frontuser')->user()->unique_id == $data->unique_id)
                                                                <div class="list-setting">
                                                                    <button class="btn btn-link" data-toggle="modal" data-target="#update-{{ $exea->id }}"><i class="fa fa-edit"></i></button>
                                                                    <a href="{{ route('experince.delete',$exea->id) }}" class="" onclick="return confirm('{{ trans('words.request_cancel.text_3') }}')"><i class="fa fa-trash"></i></a>
                                                                </div>
                                                                @endif
                                                            </li>
                                                    @endif
                                                    @php $i++; @endphp
                                                @endforeach
                                            @else
                                            <li>
                                                <div class="list-text width-1">
                                                    <h3 class="list-text-title">@lang('words.exe_pro.text_10')</h3>
                                                </div>
                                            </li>
                                            @endif
                                            </ul>
                                        </div>
                                    </div>  
                                    @if($i > 4)
                                    <div class="text-center">
                                        <label for="shm" class="exe-show" style="color: #006BA3;width:100%;">@lang('words.pro_btn.btn_3')</label>
                                        <input type="checkbox" id="shm" style="display: none;">
                                    </div>
                                    @endif
                                    
                                    @if(auth()->guard('frontuser')->user()->unique_id == $data->unique_id)
                                        @foreach($exe as $key => $exea)
                                            @include('theme.user.exeupdate')
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <!-- ********************************************** -->                            
                            <div class="widget">
                                <div class="widget-header">
                                    <h3 class="widget-caption">@lang('words.edu_pro.text_1')</h3>
                                    @if(auth()->guard('frontuser')->user()->unique_id == $data->unique_id)
                                        <div class="widget-addnew">
                                            <button class="btn btn-link" data-toggle="modal" data-target="#education"><i class="fa fa-plus"></i> @lang('words.pro_btn.btn_5')</button>
                                            @include('theme.user.education')
                                        </div>
                                    @endif
                                </div>
                                <div class="widget-body bordered-top bordered-sky">
                                    <div class="card">
                                        <div class="content">
                                            <ul class="list-profile">
                                                @php
                                                    $i = 1;
                                                @endphp
                                                @if(! empty($education) && count($education) > 0)    
                                                    @foreach($education as $key => $value)
                                                        @if($i <= 3)
                                                            <li class="exp">
                                                                <div class="list-icon">
                                                                    <i class="fa fa-university"></i>
                                                                </div>
                                                                <div class="list-text exp-head">
                                                                    <h3 class="list-text-title exp-title">{{ $value->school }}</h3>
                                                                    <p class="list-inner-text">{{ $value->course }}</p>
                                                                    <p class="list-inner-text"> {{ $value->from }} To {{ $value->to }}</p>
                                                                </div>
                                                                @if(auth()->guard('frontuser')->user()->unique_id == $data->unique_id)
                                                                <div class="list-setting list-resp-setting">
                                                                    <button class="btn btn-link" data-toggle="modal" data-target="#edu-{{ $value->id }}"><i class="fa fa-edit"></i></button><a href="{{ route('education.delete',$value->id) }}" class="" onclick="return confirm('{{ trans('words.request_cancel.text_3') }}')"><i class="fa fa-trash"></i></a>
                                                                </div>
                                                                @endif
                                                                <div class="clearfix"></div>
                                                            </li>
                                                        @else
                                                             <li class="edu-toogle" style="display: none;">
                                                                <div class="list-icon">
                                                                    <i class="fa fa-university"></i>
                                                                </div>
                                                                <div class="list-text">
                                                                    <h3 class="list-text-title">{{ $value->school }}</h3>
                                                                    <p class="list-inner-text">{{ $value->course }}</p>
                                                                    <p class="list-inner-text"> {{ $value->from }} To {{ $value->to }}</p>
                                                                </div>
                                                                @if(auth()->guard('frontuser')->user()->unique_id == $data->unique_id)
                                                                <div class="list-setting">
                                                                    <button class="btn btn-link" data-toggle="modal" data-target="#edu-{{ $value->id }}"><i class="fa fa-edit"></i></button><a href="{{ route('education.delete',$value->id) }}" class="" onclick="return confirm('{{ trans('words.request_cancel.text_3') }}')"><i class="fa fa-trash"></i></a>
                                                                </div>
                                                                @endif
                                                            </li>
                                                        @endif
                                                        @php $i++; @endphp
                                                    @endforeach
                                                @else
                                                    <li>
                                                        <div class="list-text width-1">
                                                            <h3 class="list-text-title">No Recomended Educations.</h3>
                                                        </div>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>  
                                     @if($i > 4)
                                        <div class="text-center hidden-xs">
                                            <label for="shm" class="edu-show" style="color: #006BA3;width:100%; ">@lang('words.pro_btn.btn_3')</label>
                                            <input type="checkbox" id="shm" style="display: none;">
                                        </div>
                                    @endif
                                    @if(auth()->guard('frontuser')->user()->unique_id == $data->unique_id)
                                        @foreach($education as $key => $edu)
                                            @include('theme.user.eduupdate')
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <!-- ********************************************** -->
                        </div>         
                    </div>
                    <!-- ********************************************** -->
                    <!-- ********************************************** -->
                </div>
                <!-- ********************************************** -->
                <!-- Left Side over -->
                <!-- ********************************************** -->
                <!-- right side -->
                <!-- ********************************************** -->
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12 col-lg-12 col-sm-6">
                            <div class="widget">
                                <div class="widget-header">
                                    <h3 class="widget-caption">@lang('words.pro_rgt.text_1')</h3>
                                </div>
                                <div class="widget-body bordered-top bordered-sky">
                                    <ul class="list-unstyled profile-about margin-none">
                                        <li class="padding-v-5">
                                            <div class="row">
                                                <div class="col-sm-4"><span class="text-muted">@lang('words.pro_rgt.text_2')</span></div>
                                                <div class="col-sm-8">
                                                    {!! Carbon\Carbon::parse($data->birthdate)->format('d F Y') !!}
                                                </div>
                                            </div>
                                        </li>
                                        <li class="padding-v-5">
                                            <div class="row">
                                                <div class="col-sm-4"><span class="text-muted">@lang('words.pro_rgt.text_4')</span></div>
                                                <div class="col-sm-8">
                                                    @if($data->gender == 0)
                                                        Male
                                                    @else
                                                        Female
                                                    @endif
                                                </div>
                                            </div>
                                        </li>
                                        <li class="padding-v-5">
                                            <div class="row">
                                                <div class="col-sm-4"><span class="text-muted">@lang('words.pro_rgt.text_5')</span></div>
                                                <div class="col-sm-8">
                                                    {{$data->city}},
                                                    <span class="bfh-states" data-country="{{user_data(chackeAuthUser())->country}}" data-state="{{user_data(chackeAuthUser())->state}}"></span>, 
                                                    <span class="bfh-countries" data-country="{{user_data(chackeAuthUser())->country}}"></span>
                                                </div>
                                            </div>
                                        </li>
                                        @if(! is_null($data->cellphone))
                                        <li class="padding-v-5">
                                            <div class="row">
                                                <div class="col-sm-4"><span class="text-muted">@lang('words.pro_rgt.text_3')</span></div>
                                                <div class="col-sm-8">{{$data->cellphone}}</div>
                                            </div>
                                        </li>
                                        @endif
                                        @if(! is_null($data->website))
                                        <li class="padding-v-5">
                                            <div class="row">
                                                <div class="col-sm-4"><span class="text-muted">@lang('words.pro_rgt.text_6')</span></div>
                                                <div class="col-sm-8"><a href="{{ user_data(chackeAuthUser())->website }}" target="_blank">{{ $data->website }}</a></div>
                                            </div>
                                        </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @if(chackeAuthUser() == $data->id)
                            @if(!empty($recConn))
                                <div class="col-md-12 col-lg-12 col-sm-6">
                                    <div class="widget widget-friends">
                                        <div class="widget-header">
                                            <h3 class="widget-caption">@lang('words.pro_rgt_b.text_1')</h3>
                                        </div>
                                        <div class="widget-body bordered-top  bordered-sky">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <ul class="img-grid" style="margin: 0 auto;">
                                                        @foreach($recConn as $key => $value)
                                                        <li>
                                                            <a href="{{ route('profile',user_data($value->FRIEND_ID)->user_id) }}">
                                                                <img src="{{ user_data($value->FRIEND_ID)->ProPic }}" alt="image">
                                                            </a>
                                                        </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
                <!-- ********************************************** -->
                <!-- right side over -->
                <!-- ********************************************** -->
            </div>
        </div>
@endsection