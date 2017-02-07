@extends('frontend.layouts.default')

@section('title')
My Chat
@endsection

@section('description')
My Publish Order Details
@endsection

@section('author')
bengsnail
@endsection

@section('header')
    <link href="/assets/global/plugins/bootstrap-touchspin/bootstrap.touchspin.css" rel="stylesheet" type="text/css" />
    <link href="/assets/pages/css/profile.min.css" rel="stylesheet" type="text/css" />
    <link href="/custom/css/frontend/myChat.css" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            @include('frontend.flash')
            <!-- BEGIN PAGE BASE CONTENT -->
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <span class="caption-subject font-blue bold uppercase">My Chat</span>
                            </div>
                        </div>
                        <div class="portlet-body new-order">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="portlet box gray-color file-upload">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                Recent Chat
                                            </div>
                                        </div>
                                        <div class="portlet-body form">
                                            <div class="scroller" style="height: 525px;" data-always-visible="1" data-rail-visible1="1">
                                                <ul class="chats" id="recent-chats" data-url="">
                                                    @foreach($recentChat as $key=>$chat)
                                                    <li class="in">
                                                        <a href="javascript:void(0)" data-url="{{ route('frontend.mychat.pullchat',$key) }}">
                                                            <img class="avatar" alt="" src="../assets/layouts/layout/img/avatar2.jpg" />
                                                        </a>
                                                        <div class="message">
                                                            <span class="arrow"></span>
                                                            <a href="javascript:void(0)" data-url="{{ route('frontend.mychat.pullchat',$key) }}" class="name">{{ $chat['email'] }}</a><br>
                                                            <span class="datetime"> at {{ $chat['time'] }}</span>
                                                            <span class="body">{{str_limit($chat['last_chat'], 30)}}</span>
                                                        </div>
                                                    </li>
                                                    @endforeach
                                                    <div class="form-group text-center" style="margin-top:10px">
                                                        <button type="button" class="btn default" data-toggle="modal" data-target="#modalChatInvite">invite to chat</button>
                                                    </div>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8 clearfix">
                                    <div class="portlet box gray-color">
                                        <div class="portlet-title">
                                            <div class="caption" id="caption-chat">
                                                title ...
                                            </div>
                                        </div>
                                        <div class="portlet-body form">
                                            <!-- BEGIN FORM-->
                                            <div class="scroller" id="content-chat" style="height: 525px" data-always-visible="1" data-rail-visible1="1">
                                                <center><h3>chat content ...</h3></center>
                                            </div>
                                            <div class="chat-form hidden">
                                                <div style="color:#ff0000" class="error-msg"></div>
                                                <form action="{{ route('frontend.mychat.postchat') }}" method="post" class="">
                                                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                                                    <input type="hidden" name="receiver" id="receiverId" value="0">
                                                    <div class="input-cont">
                                                        <input class="form-control message" name="message" type="text" placeholder="Type a message here..." /> </div>
                                                    <div class="btn-cont">
                                                        <span class="arrow"> </span>
                                                        <button type="submit" class="btn blue icn-only">
                                                            <i class="fa fa-check icon-white"></i>
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- END FORM-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PAGE BASE CONTENT -->
        </div>
        <!-- END CONTENT BODY -->
         @include('frontend.includes.modalChatInvite',['userToInvite'=>$userToInvite])
    </div>
    <!-- END CONTENT -->
@endsection


@section('footer')
<script src="custom/js/frontend/myChat.js" type="text/javascript"></script>
<script type="text/javascript">
</script>
@endsection