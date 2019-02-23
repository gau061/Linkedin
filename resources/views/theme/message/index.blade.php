@extends($theme)
@section('content')

@php
    $url = explode('/',URL::current());
@endphp

<div class="container page-content">
    <div class="row">
        <div class="page-title">
            <h4>Messaging</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="tile tile-alt" id="messages-main">
                <div class="ms-menu">
                    <div class="ms-user clearfix">
                        <img src="{{ userProPic() }}" alt="" class="img-avatar pull-left">
                        <div>Signed in as <br> {{ fuserEmail() }}</div>
                    </div>
                    <div class="list-group lg-alt">
                       @foreach($frndlist as $key => $value)
                        @php
                            $uid = user_data($value->FRIEND_ID)->unique_id;
                        @endphp
                        <a class="list-group-item nav nav-tabs collapse-menus media tabs pageChange msg-read"  style="margin:0" data-toggle="tab" data-id="{{ user_data($value->FRIEND_ID)->unique_id }}" data-username="{{ user_data($value->FRIEND_ID)->Name }}" >
                            <div class="lv-avatar pull-left">
                                <img src="{{ user_data($value->FRIEND_ID)->ProPic }}" alt="" class="img-avatar">
                            </div>
                            <div class="media-body msg-dot">
                                <div class="list-group-item-heading">{{ user_data($value->FRIEND_ID)->Name }}  </div>
                                @if(in_array($uid,$msgread))<span class="pull-right"><i class="fa fa-circle"></i></span>@endif
                                @if(in_array($uid,$msgSeen))@endif
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                <div class="ms-body">
                    @if(empty($data))
                    <div class="action-header clearfix">
                        <div class="visible-xs" id="ms-menu-trigger">
                            <i class="fa fa-bars"></i>
                        </div>
                        <div class="pull-left hidden-xs">
                            <!-- <img src="{{userDefaultImage()}}" alt="" class="img-avatar m-r-10"> -->
                            <div class="lv-avatar pull-left"></div>
                            <span>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>
                            <span class="chat-name">Messages</span>
                        </div>
                        <ul class="ah-actions actions">
                            <li>
                                <!-- <a href=""  onclick=" return confirm('Are you Sure Delete all Message ?');" data-id="" class="delete-msg"> -->
                                    <i class="fa fa-trash"></i>
                                </a>
                            </li>   
                            <li class="dropdown">
                                <a href="" data-toggle="dropdown" aria-expanded="true">
                                    <i class="fa fa-bars"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li>
                                        <a href="">Refresh</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <aside class="aside-with-chat">
                        <div class="div-chat">
                            <p>Chat with Friends</p>
                        </div>
                    </aside>
                    @else
                    <div class="action-header clearfix">
                        <div class="visible-xs" id="ms-menu-trigger">
                            <i class="fa fa-bars"></i>
                        </div>
                        <div class="pull-left hidden-xs">
                            <img src="{{ profile_pic($data->profile_pic) }}" alt="" class="img-avatar m-r-10">
                            <div class="lv-avatar pull-left"></div>
                            <span>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>
                            <span class="chat-name">{{ $data->firstname }} {{ $data->lastname }}</span>
                        </div>
                        <ul class="ah-actions actions">
                            <li>
                                <a href="" data-id="{{ $url[4] }}" class="delete-msg">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </li>
                            <li class="dropdown">
                                <a href="" data-toggle="dropdown" aria-expanded="true">
                                    <i class="fa fa-bars"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li>
                                        <a href="">Refresh</a>
                                    </li>
                                    <!-- <li>
                                        <a href="">Message Settings</a>
                                    </li> -->
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <aside class="aside-with-chat">
                        <div class="div-chat">
                            @foreach($send as $key => $chatSet)
                                @php
                                    $url = explode('/',URL::current());
                                    $r_id = 'S_'.$url[4];
                                @endphp
                                @php
                                    $time = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$chatSet->created_at)->format('d/m/Y');
                                    $date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$chatSet->created_at)->format('h:i A');
                                @endphp
                                @if($r_id == $chatSet->chatbox_id)
                                    <!-- left side -->
                                    <div class="message-feed left">
                                        <div class="pull-left">
                                            <img src="{{ user_uniqueid_data($url[4])->ProPic }}" alt="" class="img-avatar">
                                        </div>
                                        <div class="media-body body-left">
                                            <div class="mf-content">{{ $chatSet->message }}</div>
                                            <small class="mf-date"><i class="fa fa-clock-o"></i> {{ $time }} at {{ $date }}</small>
                                        </div>
                                    </div>
                                    <!-- left side end -->
                                    @else
                                    <!-- right Side -->
                                    <div class="message-feed right">
                                        <div class="pull-right">
                                            <img src="{{ userProPic() }}" alt="" class="img-avatar">
                                        </div>
                                        <div class="media-body body-right">
                                            <div class="mf-content">{{ $chatSet->message }}</div>
                                            <small class="mf-date"><i class="fa fa-clock-o"></i> {{ $time }} at {{ $date }}</small>
                                        </div>
                                    </div>
                                    <!-- right side end -->
                                @endif
                            @endforeach
                        </div>
                            <span class="pull-right" id="check-mark"><i class="fa fa-check"></i> Seen</span>
                    </aside>
                    <div class="msb-reply">
                        {!! Form::open(['route'=>['message.send',$uniqueId],'method' => 'post','id'=>'forms']) !!}
                            <textarea placeholder="Enter your response..." name="message" class="msg" id="msg" maxlength=250 required ></textarea><grammarly-btn><div style="visibility: hidden; z-index: 2;" class="_e725ae-textarea_btn _e725ae-not_focused" data-grammarly-reactid=".0"><div class="_e725ae-transform_wrap" data-grammarly-reactid=".0.0"><div title="Protected by Grammarly" class="_e725ae-status" data-grammarly-reactid=".0.0.0">&nbsp;</div></div></div></grammarly-btn>
                            <button type="submit" class="msg-send"><i class="fa fa-paper-plane-o"></i></button>
                        {!! Form::close() !!}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('pageScript')
<script type="text/javascript" src="{{ ('/public/js/chat.js') }}"> </script>
@endsection