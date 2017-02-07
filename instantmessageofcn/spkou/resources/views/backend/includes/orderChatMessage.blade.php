<div class="row order-conversation" data-url="{{ route('backend.order.conflict.pullorderchat',$orderId)}}">
    <div class="portlet box gray-color">
        <div class="portlet-title">
            <div class="caption" id="caption-chat" style="color: black">
                {{ trans('member.chat') }}
            </div>
        </div>
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <div class="scroller" id="content-chat" style="height: 525px; padding : 10px" data-always-visible="1" data-rail-visible1="1">
                <center><h3>chat content ...</h3></center>
            </div>
            <div class="chat-form">
                <div style="color:#ff0000" class="error-msg"></div>
                <form action="{{ route('backend.order.conflict.postorderchat') }}" method="post" class="">
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                    <input type="hidden" name="orderId" id="orderId" value="{{$orderId}}">
                    <div class="input-cont">
                        <input class="form-control message" name="message" id="message" type="text" placeholder="{{ trans('member.leave_message') }}..." />
                    </div>
                    <div class="upload-sound">
                        <a href="javascript:;"><i class="fa fa-microphone"></i></a>
                    </div>
                    <div class="upload-picture">
                        <a href="javascript:;" id="chat-message-img" data-url='{{ route('backend.order.conflict.postorderchatimage') }}'><i class="fa fa-photo"></i></a>
                    </div>
                </form>
            </div>
            <!-- END FORM-->
        </div>
    </div>
</div>
<!-- Modal -->
<div id="modalAddFileChat" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            {!! Form::open(['route' => 'frontend.mychat.postorderchatimage', 'id' => 'add-order-file-chat', 'method' => 'post', 'class' => 'form-horizontal', 'files' => true]) !!}
                <input type="hidden" name="orderId" value="{{$orderId}}">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">{{ trans('member.add_file') }}</h4>
                </div>
                <div class="modal-body">
                    <div class="form-body">
                        <div class="modal-alert-container">
                            
                        </div>
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