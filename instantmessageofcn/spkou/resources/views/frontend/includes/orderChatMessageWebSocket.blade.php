<input type="hidden" id="ipRatchet" name="ipRatchet" value='{{env("RACHET_IPPORT", "127.0.0.1:8080")}}'>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>chatapp</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/3.0.3/handlebars.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>


    <link rel="stylesheet" href="/custom/css/frontend/myChatWebSocket.css">
</head>
<body>
    <div id="wrapper">  
        <div id="user-container">   
            <label for="user">What's your name?</label>
            <input type="text" id="user" name="user">
            <button type="button" id="join-chat">Join Chat</button>
        </div>

        <div id="main-container" class="hidden">        
            <button type="button" id="leave-room">Leave</button>
            <div id="messages">
                
            </div>

            <div id="msg-container">
                <input type="text" id="msg" name="msg">
                <button type="button" id="send-msg">Send</button>
            </div>
        </div>

    </div>

    <script id="messages-template" type="text/x-handlebars-template">
        @{{#each messages}}
        <div class="msg">
            <div class="time">@{{time}}</div>
            <div class="details">
                <span class="user">@{{user}}</span>: <span class="text">@{{text}}</span>
            </div>
        </div>
        @{{/each}}
    </script>

    <script src="/custom/js/frontend/myChatOrderMessageWebSocket.js"></script>
</body>
</html>
<div class="row order-conversation hidden" data-url="{{ route('frontend.mychat.pullorderchat',$orderId)}}" data-urlfile="{{ route('frontend.mychat.pullorderchatfile',$orderId)}}">
    <div class="col-md-8 clearfix">
        <div class="portlet box gray-color">
            <div class="portlet-title">
                <div class="caption" id="caption-chat">
                    {{ trans('member.chat') }} with web socket
                </div>
            </div>
            <div class="portlet-body form">
                <!-- BEGIN FORM-->
                <div class="scroller" id="content-chat" style="height: 525px" data-always-visible="1" data-rail-visible1="1">
                    <center><h3>chat content ...</h3></center>
                </div>
                <div class="chat-form">
                    <div style="color:#ff0000" class="error-msg"></div>
                    <form action="{{ route('frontend.mychat.postorderchat') }}" method="post" class="">
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                        <input type="hidden" name="orderId" id="orderId" value="{{$orderId}}">
                        <div class="input-cont">
                            <input class="form-control message" name="message" id="message" type="text" placeholder="{{ trans('member.leave_message') }}..." />
                        </div>
                        <!--
                        <div class="btn-cont">
                            <span class="arrow"> </span>
                            <button type="submit" class="btn blue icn-only">
                                <i class="fa fa-check icon-white"></i>
                            </button>
                        </div>
                        -->
                        <div class="upload-sound">
                            <a href="javascript:;"><i class="fa fa-microphone"></i></a>
                        </div>
                        <div class="upload-picture">
                            <a href="javascript:;" id="chat-message-img" data-url='{{ route('frontend.mychat.postorderchatimage') }}'><i class="fa fa-photo"></i></a>
                        </div>
                    </form>
                </div>
                <!-- END FORM-->
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="portlet box gray-color file-upload">
            <div class="portlet-title">
                <div class="caption">
                    {{ trans('member.extra_size_pattern') }}
                </div>
            </div>
            <div class="portlet-body form">
                <!-- BEGIN FORM-->
                <form action="#" class="form-horizontal">
                    <div class="form-body">
                        <div class="form-group text-center">
                            @if ($cad)
                            <div class="scroller" id="content-file" data-always-visible="1" data-rail-visible1="1">
                                <ul class="file-list col-md-12">
                                    @foreach ($cad as $key => $var)
                                        <li>
                                            <div class="file-logo pull-left">
                                                <img src="/images/cad.png" style="width: 30px;" />
                                            </div>
                                            <div class="file-info pull-left text-left">
                                                {!! $var->message !!}
                                            </div>
                                        </li>
                                    @endforeach
                                    {{--sample file list--}}
                                    {{--<li>--}}
                                        {{--<div class="file-logo pull-left">--}}
                                            {{--<img alt="file-logo" src="/images/file-logo.png">--}}
                                        {{--</div>--}}
                                        {{--<div class="file-info text-left">--}}
                                            {{--filename : file one<br/>--}}
                                            {{--<span class="size-datetime">456MB 2015-01-12 10:30:50</span><br>--}}
                                            {{--<a href="javascript:;" class="download-file">下载纸样</a>--}}
                                        {{--</div>--}}
                                    {{--</li>--}}
                                    {{--<li>--}}
                                        {{--<div class="file-logo pull-left">--}}
                                            {{--<img alt="file-logo" src="/images/file-logo.png">--}}
                                        {{--</div>--}}
                                        {{--<div class="file-info text-left">--}}
                                            {{--filename : file two<br/>--}}
                                            {{--<span class="size-datetime">456MB 2015-01-12 10:30:50</span><br>--}}
                                            {{--<a href="javascript:;" class="download-file">下载纸样</a>--}}
                                        {{--</div>--}}
                                    {{--</li>--}}
                                </ul>
                            </div>
                            @else
                                <div id="file-content">
                                    <i class="fa fa-file-o text-center"></i>
                                    <br>
                                    <div class="no-file">
                                        {{ trans('member.no_pattern_file') }}
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="form-group text-center">
                            <button type="button" class="btn blue upload" id="chat-message-file" data-url="{{ route('frontend.mychat.postorderchatfile') }}">{{ trans('member.upload_pattern') }}</button> 
                        </div>
                    </div>
                </form>
                <!-- END FORM-->
            </div>
        </div>
        <div class="text-center">
            <button type="button" class="btn blue btn-helpdesk" id="invite-helpdesk" data-url="{{ route('frontend.mychat.postinvitehelpdeskchat',$orderId) }}">{{ trans('member.contact_helpdesk') }}</button>
            <button type="button" class="btn blue btn-extra-size" data-toggle="modal" data-target="#modalCreateExtraSize">+ {{ trans('member.apply_extra_size') }}</button>
        </div>
    </div>
</div>
<!-- Modal -->
<div id="modalAddFileChat" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            {!! Form::open(['route' => 'frontend.mychat.postorderchatfile', 'id' => 'add-order-file-chat', 'method' => 'post', 'class' => 'form-horizontal', 'files' => true]) !!}
                <input type="hidden" name="orderId" value="{{$orderId}}">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">{{ trans('member.add_file') }}</h4>
                </div>
                <div class="modal-body">
                    <div class="form-body">
                        <div class="modal-alert-container"></div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">{{ trans('member.filename') }}</label>
                            <div class="col-md-9">
                                {!! Form::text('message', '', ['class' => 'form-control', 'placeholder' => 'Message']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">{{ trans('member.file') }}</label>
                            <div class="col-md-9">
                                {!! Form::file('file', ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn blue" id="btn-submit-file">{{ trans('member.confirm_add') }}</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('member.cancel') }}</button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

<div id="modal-cad" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h3>{{ trans('member.extra_size_pattern') }}</h3>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>