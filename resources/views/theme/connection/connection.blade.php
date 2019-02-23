@inject('CountNotification', 'App\Notification')

@extends($theme)
@section('content')
        <div class="container">
            <div class="row page-content">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-3 col-sm-6 col-sm-offset-3 col-md-offset-0">
                            <div class="profile-nav">
                                <div class="widget">
                                    <div class="widget-body">
                                        <div class="user-heading">
                                                <h1>@if( count($CountNotification->Connected()) > 0) {{ count($CountNotification->Connected()) }} @endif</h1>
                                            <p>@lang('words.connection_pg.text_1')</p>
                                            <hr/>
                                            <a href="{{ route('connection.list') }}">
                                                <h3>@lang('words.connection_pg.text_2')</h3>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9 col-sm-12 col-md-9">
                            <div class="text-search">
                                <input type="text" name="search" class="form-control text-box-search" placeholder="{{ trans('words.connection_pg.text_3') }}" id="tags" value="{{ Input::get('search') }}" autocomplete="off">
                                <i class="fa fa-search search"></i>
                            </div>
                            <br>
                            @if(!empty($connect) && count($connect) > 0)
                            <div>
                                <div class="widget">
                                    <div class="widget-header">
                                        <h3 class="widget-caption">@lang('words.connection_pg.text_4')  ({{ count($CountNotification->countReq()) }})</h3>
                                    </div>
                                    <div class="widget-body bordered-top bordered-sky">
                                        <div class="card">
                                            <div class="content">
                                                <ul class="list-profile invitation-box">
                                                    @foreach($connect as $key => $req)
                                                    <li>
                                                        
                                                        <div class="list-image">
                                                            <img alt="image" class="img-thumbnail" src="{{ user_uniqueid_data($req->unique_id)->ProPic }}">
                                                        </div>
                                                        <div class="list-text user-connection">
                                                            <h3 class="list-text-title wordwap">
                                                                <a href="{{ route('profile',[strtolower($req->firstname.'_'.$req->lastname.'-'.$req->unique_id)]) }}">
                                                                    {{ $req->firstname }} {{ $req->lastname }}
                                                                </a>
                                                            </h3>
                                                            
                                                            <p class="list-inner-text">
                                                                {{ $req->city }},   
                                                                <span class="bfh-states" data-country="{{ $req->country }}" data-state="{{ $req->state }}"></span>,
                                                                <span class="bfh-countries" data-country="{{ $req->country }}"></span>
                                                                </p>
                                                            <div class="user-btn-gorup">
                                                                <a href="{{ route('request.status',['ignore',$req->sender_id]) }}" class="btn btn-info">@lang('words.msg_acp.text_3')</a>
                                                                &nbsp;&nbsp;&nbsp;
                                                                <a href="{{ route('request.status',['accept',$req->sender_id]) }}" class="btn btn-primary">@lang('words.msg_acp.text_4')</a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end post state form -->
                            </div>
                            @endif
                            <div class="">
                                <div class="widget">
                                    <div class="widget-header">
                                        <h3 class="widget-caption">@lang('words.connection_pg.text_5')</h3>
                                    </div>
                                    <div class="widget-body bordered-top bordered-sky">
                                        <div class="card">
                                            <div class="content">
                                                <div class="row contact-box-main">
                                            @if(!empty($fof) && count($fof) > 0)
                                                @foreach($fof as $key => $foflist)
                                                    <div class="col-md-3 col-sm-3">
                                                        <div class="contact-box center-version">
                                                            <a href="{{ route('profile',user_data($foflist->FRIEND_ID)->user_id) }}">
                                                                <img alt="image" class="img-thumbnail" src="{{ user_data($foflist->FRIEND_ID)->ProPic }}">
                                                                <h4 class="m-b-xs wordwap"><strong>{{ user_data($foflist->FRIEND_ID)->Name }}</strong></h4>
                                                                <!-- <div class="font-bold wordwap ">eCommerce Specialist</div> -->
                                                            </a>                                                                
                                                            <div class="contact-box-footer">
                                                                <div class="btn-group">
                                                                    @if(in_array($foflist->FRIEND_ID,$requ_check))
                                                                        <a href="javascript:void(0)" class="btn btn-primary msg-btn-ac msg-btn msg-cncel" data-url="{{ route('request.send',['cancel',$foflist->FRIEND_ID]) }}">@lang('words.request_cancel.text_2')</a>
                                                                    @else
                                                                        <a class="btn btn-primary" href="{{ route('request.send',['send',$foflist->FRIEND_ID]) }}">@lang('words.msg_acp.text_5')</a>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                @lang('words.msg_acp.text_2')
                                            @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<!-- Modal -->
@endsection
@section('pageScript')
    <script type="text/javascript" src="{{ asset('/public/js/search/search.js') }}"></script>
@endsection