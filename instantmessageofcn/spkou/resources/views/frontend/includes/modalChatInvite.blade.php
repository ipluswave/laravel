<!-- Modal -->
<div id="modalChatInvite" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            {{--<script type="text/javascript" src="/custom/js/frontend/modalAddBankAccount.js"></script>--}}
            {!! Form::open(['route' => 'frontend.mychat.postchat', 'id' => 'invite-chat-form', 'method' => 'post', 'class' => 'form-horizontal']) !!}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title bold">Invite to Chat</h4>
                </div>
                <div class="modal-body">
                    <div class="form-body">
                        <div class="col-md-12" id="invite-chat-sucess">
                            
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">User</label>
                            <div class="col-md-6">
                                <select class="form-control" name="receiver">
                                    <option>-user-</option>
                                    @foreach($userToInvite as $key=>$var)
                                        <option value="{{$key}}">{{ $var['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Message</label>
                            <div class="col-md-6">
                                <textarea placeholder="message" class="form-control" name="message"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn blue" id="submit-report-form">Send</button>
                    <button type="button" class="btn gray01" data-dismiss="modal">Cancel</button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>